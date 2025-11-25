@extends('master_layout')
@section('title', 'Charger Inward List')

@section('content')
    <style>
        /* Prevent wrapping for short numeric/date columns */
        .no-wrap {
            white-space: nowrap;
        }

        /* Set fixed but responsive widths */
        .col-date {
            width: 120px;
        }

        .col-serial {
            width: 140px;
        }

        .col-vin {
            width: 140px;
        }

        .col-warranty {
            width: 90px;
        }

        .col-status {
            width: 110px;
        }

        .col-action {
            width: 140px;
        }

        /* Better table look */
        table.custom-table th {
            background: #1e1e2f !important;
            color: #fff !important;
            font-weight: 600;
        }

        table.custom-table td {
            vertical-align: middle;
            font-size: 14px;
            padding: 10px 12px;
        }

        /* Improve action buttons layout */
        .action-btns {
            display: flex;
            gap: 8px;
            white-space: nowrap;
        }

        .btn-sm {
            padding: 4px 10px !important;
            font-size: 13px;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Charger Pending List</h4>

            </div>

            <div class="card-body">

                <div class="card mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Filter</h5>

                    </div>

                    <div class="collapse show" id="filterBox">
                        <div class="card-body">
                            <form method="GET" action="">
                                <div class="row g-3">

                                    <div class="col-md-3">
                                        <label class="form-label">Serial No.</label>
                                        <input type="text" name="serial" class="form-control" placeholder="Search...">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Vin</label>
                                        <input type="text" name="vin" class="form-control" placeholder="Enter VIN">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">All</option>
                                            <option value="pending">Pending</option>
                                            <option value="in-progress">In Progress</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Inward Date</label>
                                        <input type="date" name="inward_date" class="form-control">
                                    </div>

                                </div>

                                <div class="mt-4 d-flex justify-content-end gap-2">
                                    <a href="{{ route('charger.list') }}" class="btn btn-outline-secondary">
                                        Reset
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-search"></i> Search
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped align-middle custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="no-wrap col-date">Inward Date</th>
                            <th class="no-wrap col-serial">Serial No</th>
                            <th>Dealer</th>
                            <th>Part</th>
                            <th class="no-wrap col-vin">VIN</th>
                            <th class="no-wrap col-warranty">Warranty</th>
                            <th class="no-wrap col-status">Status</th>
                            <th class="no-wrap col-action">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($chargers as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td class="no-wrap">{{ $item->inward_date }}</td>

                                <td class="no-wrap">{{ $item->part_serial_no }}</td>

                                <td>
                                    {{ $item->dealer_name }}<br>
                                    <small class="text-muted">{{ $item->dealer_code }}</small>
                                </td>

                                <td>
                                    {{ $item->part_name }}<br>
                                    <small class="text-muted">{{ $item->part_code }}</small>
                                </td>

                                <td class="no-wrap">{{ $item->vin_number }}</td>

                                <td>
                                    @if ($item->warranty_remark == 'in_warranty')
                                        <span class="badge bg-success">In</span>
                                    @else
                                        <span class="badge bg-danger">Out</span>
                                    @endif
                                </td>

                                    <td class="no-wrap">
                                        @php
                                            $short = [
                                                'Pending for Customer Approval' => 'Pending',
                                                'Repair Not Possible' => 'RNP',
                                                'Water Ingress' => 'Water',
                                                'WIP' => 'WIP',
                                                'dispatch' => 'Dispatch'
                                            ];
                                        @endphp

                                        <span class="badge bg-info"
                                            title="{{ $item->status }}">
                                            {{ $short[$item->status] ?? $item->status }}
                                        </span>
                                    </td>


                                <td>
                                    <div class="action-btns">
                                        <button class="btn btn-sm btn-primary viewBtn" data-item="{{ json_encode($item) }}">
                                            View
                                        </button>
                                        <button class="btn btn-sm btn-warning updateBtn" data-item="{{ json_encode($item) }}">
                                            Update
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    </div>

    <div class="modal fade" id="previewModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Charger Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <table class="table table-bordered">
                        <tbody id="modalData"></tbody>
                    </table>





                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="updateForm" method="POST" action="{{ route('charger.update.status') }}">
                @csrf
                <div class="modal-content">

                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">Update Charger Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="charger_id" id="charger_id">

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="statusSelect" class="form-select">
                                <option value="">Select Status</option>
                                <option value="WIP">WIP</option>
                                <option value="Repair Not Possible">Repair Not Possible</option>
                                <option value="Water Ingress">Water Ingress</option>
                                <option value="Pending for Customer Approval">Pending for Customer Approval</option>
                                <option value="dispatch">Dispatch</option>
                            </select>
                        </div>

                        <!-- Dispatch Extra Fields -->
                        <div id="dispatchFields" style="display:none;">

                            <div class="mb-3">
                                <label class="form-label">Child Part Used</label>
                                <select name="child_parts[]" class="form-select" id="childParts" multiple>
                                    <option value="Part A">Part A</option>
                                    <option value="Part B">Part B</option>
                                    <option value="Part C">Part C</option>
                                </select>
                                <small class="text-muted">Press CTRL to select multiple</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Resolution Remark</label>
                                <textarea name="resolution_remark" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Dispatch Date</label>
                                <input type="date" name="dispatch_date" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Dispatch LR No</label>
                                <input type="text" name="dispatch_lr_no" class="form-control">
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Update Status</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <script>
        document.querySelectorAll('.viewBtn').forEach(btn => {
            btn.addEventListener('click', function () {

                let data = JSON.parse(this.getAttribute('data-item'));
                let html = `
                <tr><th>Inward Date</th><td>${data.inward_date ?? ''}</td></tr>
                <tr><th>Serial No</th><td>${data.part_serial_no ?? ''}</td></tr>
                <tr><th>LR No</th><td>${data.inward_lr_no ?? ''}</td></tr>
                <tr><th>Dealer</th><td>${data.dealer_name} (${data.dealer_code})</td></tr>
                <tr><th>Part</th><td>${data.part_name} (${data.part_code})</td></tr>
                <tr><th>VIN</th><td>${data.vin_number ?? ''}</td></tr>
                <tr><th>Sales Date</th><td>${data.sales_date ?? ''}</td></tr>
                <tr><th>Warranty</th><td>${data.warranty_remark}</td></tr>
                <tr><th>Problem</th><td>${data.problem_remark ?? ''}</td></tr>
                <tr><th>Status</th><td>${data.status}</td></tr>

                <tr><th>Created At</th><td>${data.created_at}</td></tr>
            `;

                document.getElementById('modalData').innerHTML = html;

                let modal = new bootstrap.Modal(document.getElementById('previewModal'));
                modal.show();
            });
        });

        document.querySelectorAll('.updateBtn').forEach(btn => {
            btn.addEventListener('click', function () {

                let data = JSON.parse(this.getAttribute('data-item'));

                document.getElementById('charger_id').value = data.id;
                document.getElementById('statusSelect').value = data.status;

                toggleDispatchFields(data.status);

                let modal = new bootstrap.Modal(document.getElementById('updateModal'));
                modal.show();
            });
        });

        // Show / Hide Dispatch Fields
        document.getElementById('statusSelect').addEventListener('change', function () {
            toggleDispatchFields(this.value);
        });

        function toggleDispatchFields(status) {
            if (status === 'dispatch') {
                document.getElementById('dispatchFields').style.display = 'block';
            } else {
                document.getElementById('dispatchFields').style.display = 'none';
            }
        }

    </script>

    




@endsection