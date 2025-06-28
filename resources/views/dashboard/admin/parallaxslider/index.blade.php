@extends('dashboard.admin.layouts.app')
@section('page_title', 'Manage Parallax Slides')

@section('css')
    <!-- Same CSS as yours -->
    <!-- Keep your DataTables, FontAwesome and custom table styling -->
    <!-- Keep as-is -->
@endsection

@section('admin-content')
@php
    $pageName = 'Manage Parallax Slides';
    $pageName2 = 'Parallax Slider Records';
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
                                        <th>ID</th>
                                        <th>Slide Order</th>
                                        <th>Featured Img</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Created By</th>
                                        <th>Create Time</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Link</th>
                                        <th>Alt Tag</th>
                                        <th>Button</th>
                                        <th>Expires</th>
                                        <th>Starts</th>
                                        <th>City</th>
                                        <th>County</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Slide Order</th>
                                        <th>Featured Img</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Created By</th>
                                        <th>Create Time</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Link</th>
                                        <th>Alt Tag</th>
                                        <th>Button</th>
                                        <th>Expires</th>
                                        <th>Starts</th>
                                        <th>City</th>
                                        <th>County</th>
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
    <!-- Same JS CDN scripts as you have -->
    <script>
        $('#example2').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: "{{ route('parallax.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'slide_order', name: 'slide_order' },
                { data: 'featured_img', name: 'featured_img' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'created_by', name: 'created_by' },
                { data: 'create_time', name: 'create_time' },
                { data: 'status', name: 'status' },
                { data: 'category', name: 'category' },
                { data: 'link', name: 'link' },
                { data: 'alttag', name: 'alttag' },
                { data: 'button', name: 'button' },
                { data: 'expires', name: 'expires' },
                { data: 'starts', name: 'starts' },
                { data: 'city', name: 'city' },
                { data: 'county', name: 'county' },
            ],
            dom: "<'d-flex justify-content-between align-items-center mb-3'<'dt-buttons'B><'dataTables_filter'f>>" +
                "<'table-responsive'tr>" +
                "<'d-flex justify-content-between align-items-center mt-3'lip>",
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i> Copy',
                    className: 'btn btn-outline-secondary btn-sm me-2'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-outline-success btn-sm me-2'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'btn btn-outline-danger btn-sm me-2'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Print',
                    className: 'btn btn-outline-primary btn-sm me-2'
                }
            ]
        });
    </script>
@endsection
