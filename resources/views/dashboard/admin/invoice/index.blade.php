@extends('dashboard.admin.layouts.app')
@section('page_title', 'Manage Banner Ads')

@section('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        table.dataTable thead {
            background-color: #17a2b8;
            color: white;
            font-weight: 600;
        }
        table.dataTable tfoot {
            background-color: #17a2b8;
            color: white;
            font-weight: 600;
        }
        table.dataTable thead th.sorting:before,
        table.dataTable thead th.sorting:after,
        table.dataTable tfoot th.sorting:before,
        table.dataTable tfoot th.sorting:after {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        .paginate_button.page-item.active a {
            background-color: #17a2b8 !important;
            color: white !important;
        }
        .paginate_button.page-item a:hover {
            background-color: #e0f7fa !important;
            color: #000 !important;
        }
        .dt-buttons .btn-outline-secondary {
            color: #6c757d !important;
            border-color: #6c757d !important;
        }
        .dt-buttons .btn-outline-success {
            color: #28a745 !important;
            border-color: #28a745 !important;
        }
        .dt-buttons .btn-outline-danger {
            color: #dc3545 !important;
            border-color: #dc3545 !important;
        }
        .dt-buttons .btn-outline-primary {
            color: #007bff !important;
            border-color: #007bff !important;
        }
        .dt-buttons .btn {
            margin-right: 8px;
            background-color: transparent !important;
            box-shadow: none !important;
            padding: 4px 10px !important;
        }
        .dt-buttons .btn:hover {
            background-color: transparent !important;
            opacity: 0.85;
        }
    </style>
@endsection

@section('admin-content')
    @php
        $pageName = 'Manage Banner Ads';
        $pageName2 = 'Banner Ads Records';
    @endphp

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $pageName }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $pageName }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">{{ $pageName2 }}</h3>
                                <div class="card-tools">
                                    <a href="" class="float-right btn btn-block btn-success btn-sm">
                                        <i class="fas fa-plus"></i>&nbsp; Add New
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Total</th>
            <th>Title</th>
            <th>Description</th>
            <th>Customer</th>
            <th>Paid Date</th>
            <th>Due Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Total</th>
            <th>Title</th>
            <th>Description</th>
            <th>Customer</th>
            <th>Paid Date</th>
            <th>Due Date</th>
            <th>Status</th>
        </tr>
    </tfoot>
    <tbody></tbody>
</table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    $('#example2').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: "{{ route('invoice.index') }}", // 👉 make sure this route exists!
        columns: [
            { data: 'id', name: 'id' },
            { data: 'total', name: 'total' },
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'created_by', name: 'created_by' }, // Assuming 'Customer' means 'created_by'
            { data: 'assigned_to', name: 'assigned_to' }, // Using 'assigned_to' as Paid Date? Adjust if needed!
            { data: 'expires', name: 'expires' }, // Due Date = 'expires'
            { data: 'status', name: 'status' }
        ],
        dom: "<'d-flex justify-content-between align-items-center mb-3'<'dt-buttons'B><'dataTables_filter'f>>" +
            "<'table-responsive'tr>" +
            "<'d-flex justify-content-between align-items-center mt-3'lip>",
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fas fa-copy"></i> Copy', className: 'btn btn-outline-secondary btn-sm me-2' },
            { extend: 'excelHtml5', text: '<i class="fas fa-file-excel"></i> Excel', className: 'btn btn-outline-success btn-sm me-2' },
            { extend: 'pdfHtml5', text: '<i class="fas fa-file-pdf"></i> PDF', className: 'btn btn-outline-danger btn-sm me-2' },
            { extend: 'print', text: '<i class="fas fa-print"></i> Print', className: 'btn btn-outline-primary btn-sm me-2' }
        ]
    });
</script>

@endsection
