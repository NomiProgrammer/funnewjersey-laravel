@extends('dashboard.admin.layouts.app')
@section('page_title', 'Edit Widgets')

@section('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .btn.btn-secondary {
            margin-left: 89%;
        }
    </style>
@endsection

@section('admin-content')
    @php
        $pageName = 'Edit Widgets';
        $pageName2 = 'Edit New Widgets Records';
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
                            </div>
                            <div class="card-body">
                                <form action="{{ route('package.update', $package->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card-body">
        <div class="row">

            <div class="form-group col-md-6">
                <label for="type">Type</label>
                <select class="form-control" name="type" required>
                    <option value="">-- Select Type --</option>
                    <option value="post_package" {{ $package->type == 'post_package' ? 'selected' : '' }}>Post Package</option>
                    <option value="featured_package" {{ $package->type == 'featured_package' ? 'selected' : '' }}>Featured Package</option>
                    <option value="banner_package" {{ $package->type == 'banner_package' ? 'selected' : '' }}>Banner Package</option>
                    <option value="deal_package" {{ $package->type == 'deal_package' ? 'selected' : '' }}>Deal Package</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $package->title) }}" required>
            </div>

            <div class="form-group col-md-12">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description', $package->description) }}</textarea>
            </div>

            <div class="form-group col-md-4">
                <label for="price">Price</label>
                <input type="number" class="form-control" name="price" value="{{ old('price', $package->price) }}" step="0.01" required>
            </div>

            <div class="form-group col-md-4">
                <label for="expiration_time">Expiration Time (Days)</label>
                <input type="number" class="form-control" name="expiration_time" value="{{ old('expiration_time', $package->expiration_time) }}" required>
            </div>

            <div class="form-group col-md-4">
                <label for="status">Status</label>
                <select class="form-control" name="status" required>
                    <option value="1" {{ $package->status == 1 ? 'selected' : '' }}>Public</option>
                    <option value="0" {{ $package->status == 0 ? 'selected' : '' }}>Admin Only</option>
                </select>
            </div>

        </div>
    </div>

     <div class="card-footer d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('package.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
</form>



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
@endsection
