@extends('master_layout')
@section('title', 'Charger Inward List')

@section('content')
<style>
    /* Prevent wrapping for short numeric/date columns */
    .no-wrap {
        white-space: nowrap;
    }

    /* Set fixed but responsive widths */
    .col-date { width: 120px; }
    .col-serial { width: 140px; }
    .col-vin { width: 140px; }
    .col-warranty { width: 90px; }
    .col-status { width: 110px; }
    .col-action { width: 140px; }

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
                <h4 class="mb-0">Charger Inward List</h4>
                <a href="{{ route('charger.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Add New Inward
                </a>
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
                                        <input type="text" name="serial" class="form-control"
                                            placeholder="Search...">
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

                                <td>
                                    <span class="badge bg-info">{{ ucfirst($item->status) }}</span>
                                </td>

                                <td>
                                    <div class="action-btns">
                                        <button class="btn btn-sm btn-secondary viewBtn"
                                                data-item="{{ json_encode($item) }}">
                                            View
                                        </button>

                                        <a href="{{ route('charger.edit', $item->id) }}"
                                        class="btn btn-sm btn-primary">
                                        Edit
                                        </a>
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
    <script>
        document.querySelectorAll('.viewBtn').forEach(btn => {
            btn.addEventListener('click', function() {

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
    </script>




@endsection
