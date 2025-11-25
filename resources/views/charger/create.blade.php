@extends('master_layout')
@section('title', 'Inward Charger')

@section('content')
<div class="container">
    <h2>Inward Charger Entry</h2>

    <form action="{{ route('charger.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            {{-- Inward Date --}}
            <div class="col-md-6 mb-3">
                <label>Inward Date</label>
                <input type="date" name="inward_date" class="form-control" required>
            </div>

            {{-- Part Serial Number --}}
            <div class="col-md-6 mb-3">
                <label>Part Serial No</label>
                <input type="text" name="part_serial_no" class="form-control" required>
            </div>

            {{-- LR Number --}}
            <div class="col-md-6 mb-3">
                <label>Inward LR No</label>
                <input type="text" name="inward_lr_no" class="form-control">
            </div>

            {{-- Dealer Name --}}
            <div class="col-md-6 mb-3">
                <label>Dealer Name</label>
                <input type="text" name="dealer_name" class="form-control">
            </div>

            {{-- Dealer Code --}}
            <div class="col-md-6 mb-3">
                <label>Dealer Code</label>
                <input type="text" name="dealer_code" class="form-control">
            </div>

            {{-- Part Name --}}
            <div class="col-md-6 mb-3">
                <label>Part Name</label>
                <input type="text" name="part_name" class="form-control" required>
            </div>

            {{-- Part Code --}}
            <div class="col-md-6 mb-3">
                <label>Part Code</label>
                <input type="text" name="part_code" class="form-control">
            </div>

            {{-- VIN Number --}}
            <div class="col-md-6 mb-3">
                <label>VIN Number</label>
                <input type="text" name="vin_number" class="form-control">
            </div>

            {{-- Sales Date --}}
            <div class="col-md-6 mb-3">
                <label>Sales Date</label>
                <input type="date" name="sales_date" class="form-control">
            </div>

            {{-- Warranty Remark --}}
            <div class="col-md-6 mb-3">
                <label>Warranty Remark</label><br>
                <label><input type="radio" name="warranty_remark" value="in_warranty" checked> In Warranty</label>
                <label class="ms-3"><input type="radio" name="warranty_remark" value="out_warranty"> Out Warranty</label>
            </div>

            {{-- Problem Remark --}}
            <div class="col-md-12 mb-3">
                <label>Problem Remark</label>
                <textarea name="problem_remark" class="form-control" rows="3"></textarea>
            </div>

            {{-- Status --}}
            <div class="col-md-6 mb-3">
                <label>Status</label>
                <input type="text" name="status" class="form-control" value="WIP" readonly>
            </div>

            {{-- Device Status (readonly) --}}
            <div class="col-md-6 mb-3">
                <label>Device Status</label>
                <input type="text" name="device_status" class="form-control" value="Pending" readonly>
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Save Inward</button>
    </form>
</div>
@endsection
