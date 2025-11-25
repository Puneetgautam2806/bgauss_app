<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkTbl;

class MenuController extends Controller
{
    public function index()
    {
        $menus = LinkTbl::with('parent', 'children')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('menus.list', compact('menus'));
    }
    
    public function create()
    {
        $parentMenus = LinkTbl::where('is_parent', true)
            ->orWhereNull('parent_id')
            ->get();
        
        return view('menus.create', compact('parentMenus'));
    }
    
     public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_name' => 'required|string|max:255',
            'path'      => 'nullable|string|max:255',
            'is_parent' => 'nullable|boolean',
            'icon'      => 'nullable|string|max:255',
            'order'     => 'nullable|integer',
            'display'   => 'required|boolean',
            'parent_id' => 'nullable|exists:linktbl,id', // adjust if table name is different
        ]);

        // If checkbox not ticked, set is_parent = 0
        $validated['is_parent'] = $request->has('is_parent') ? 1 : 0;

        // Save into DB
        LinkTbl::create($validated);

        return redirect()->route('menus.index')
                         ->with('success', 'Menu created successfully!');
    }
    
    public function edit(LinkTbl $menu)
    {
        $parentMenus = LinkTbl::where('is_parent', true)
            ->where('id', '!=', $menu->id)
            ->orWhereNull('parent_id')
            ->get();
        
        return view('menus.edit', compact('menu', 'parentMenus'));
    }
    
    public function update(Request $request, LinkTbl $menu)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'path' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_parent' => 'boolean',
            'display' => 'boolean',
            'parent_id' => 'nullable|exists:linktbl,id'
        ]);
        
        $menu->update($request->all());
        
        return redirect()->route('menus.index')
            ->with('success', 'Menu updated successfully');
    }
    
    public function destroy(LinkTbl $menu)
    {
        $menu->delete();
        
        return redirect()->route('menus.list')
            ->with('success', 'Menu deleted successfully');
    }
}
