@extends('dashboard.admin.layouts.app')
@section('page_title', 'Manage Backups')

@section('css')
    <!-- DataTables CSS + FontAwesome -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        table.dataTable thead, table.dataTable tfoot {
            background-color: #17a2b8;
            color: white;
            font-weight: 600;
        }
        .paginate_button.page-item.active a {
            background-color: #17a2b8 !important;
            color: white !important;
        }
        .paginate_button.page-item a:hover {
            background-color: #e0f7fa !important;
            color: #000 !important;
        }
    </style>
@endsection

@section('admin-content')
    @php
        $pageName = 'Manage Backups';
        $pageName2 = 'Backup Records';
    @endphp

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"><h1>{{ $pageName }}</h1></div>
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
                            <div class="card-header d-flex justify-content-between">
                                <h3 class="card-title">{{ $pageName2 }}</h3>
                                <div>
                                    <a href="{{ route('admin.backups.create.sql') }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-database"></i> SQL Backup
                                    </a>
                                    <a href="{{ route('admin.backups.create.image') }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-image"></i> Image Backup
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                     <div id="alert-container"
                                    style="position: fixed; top: 17px; right: 20px; z-index: 9999; max-width: 300px;">
                                    @if (session('success'))
                                        <div class="alert-message"
                                            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 20px; color: #fff; background: #47C363; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);height: 71px;width: 106%;align-content: center;">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert-message"
                                            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #ff0018; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if (session('info'))
                                        <div class="alert-message"
                                            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #17a2b8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
                                            {{ session('info') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="table-responsive">
                                    <table id="backupTable" class="table table-bordered table-striped dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Filename</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         @foreach($files as $index => $file)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $file }}</td>
        <td>
            {{ \Carbon\Carbon::createFromTimestamp(filectime(public_path('assets/backups/' . $file)))->format('Y-m-d H:i') }}
        </td>
        <td>
            <a href="{{ route('admin.backups.download', $index) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-download"></i> Download
            </a>
            @if(Str::endsWith($file, '.sql'))
                <a href="{{ route('admin.backups.restore', $index) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-undo-alt"></i> Restore
                </a>
            @endif
            <form action="{{ route('admin.backups.delete', $index) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this backup?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
            </form>
        </td>
    </tr>
@endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Filename</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div> <!-- card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <!-- jQuery + DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#backupTable').DataTable({
                responsive: true,
                paging: true,
                ordering: true,
                info: true,
            autoWidth: false,
            });
        });
    </script>
@endsection
