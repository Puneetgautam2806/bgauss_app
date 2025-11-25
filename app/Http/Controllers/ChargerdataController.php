<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChargerData;

class ChargerdataController extends Controller
{
    public function index(Request $request)
    {
        $query = ChargerData::query();

        if ($request->from) {
        $query->whereDate('inward_date', '>=', $request->from);
    }

    if ($request->to) {
        $query->whereDate('inward_date', '<=', $request->to);
    }

    if ($request->status) {
        $query->where('status', $request->status);
    }

    if ($request->warranty) {
        $query->where('warranty_remark', $request->warranty);
    }

    if ($request->serial) {
        $query->where('part_serial_no', 'like', '%' . $request->serial . '%');
    }

    if ($request->dealer) {
        $query->where('dealer_code', 'like', '%' . $request->dealer . '%');
    }

    $chargers = $query->orderBy('id', 'DESC')->get();

    return view('charger.list', compact('chargers'));
        
    }

    public function create()
    {
        // Logic to show create charger data form
        return view('charger.create');
    }

    public function store(Request $request)
    {
         $validated = $request->validate([
            'inward_date'       => 'required|date',
            'part_serial_no'    => 'required|string|max:255',
            'inward_lr_no'      => 'nullable|string|max:255',
            'dealer_name'       => 'required|string|max:255',
            'dealer_code'       => 'nullable|string|max:100',
            'part_name'         => 'required|string|max:255',
            'part_code'         => 'nullable|string|max:255',
            'vin_number'        => 'nullable|string|max:255',
            'sales_date'        => 'nullable|date',

            'warranty_remark'   => 'required|in:in_warranty,out_warranty',
            'problem_remark'    => 'nullable|string|max:1000',

            'status'            => 'nullable|string|max:50',      // default wip
            'device_status'     => 'nullable|string|max:50',      // default pending
        ]);

        // Insert
        ChargerData::create($validated);

        return redirect()->route('charger.list')->with('success', 'Inward charger saved successfully.');
    }


    public function pending(Request $request)
    {
        $chargers = ChargerData::where('device_status', 'pending')
                    ->orderBy('id', 'DESC')
                    ->get();

        return view('charger.pending', compact('chargers'));
    }
    public function dispatch(Request $request)
    {
        $chargers = ChargerData::where('device_status', 'completed')->orWhere('status', 'dispatch')
                    ->orderBy('id', 'DESC')
                    ->get();

        return view('charger.dispatch', compact('chargers'));
    }

    public function updateStatus(Request $request)
    {
        $charger = ChargerData::find($request->charger_id);

        $charger->status = $request->status;

        if ($request->status == 'dispatch') {
            $charger->child_parts_used = json_encode($request->child_parts);
            $charger->resolution_remark = $request->resolution_remark;
            $charger->dispatch_date = $request->dispatch_date;
            $charger->dispatch_lr_no = $request->dispatch_lr_no;
            $charger->device_status = 'Completed';
        }

        $charger->save();

        return redirect()->back()->with('success', 'Status Updated Successfully');
    }

    
}
