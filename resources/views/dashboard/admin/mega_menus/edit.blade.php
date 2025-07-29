@extends('dashboard.admin.layouts.app')
@section('page_title', 'Edit Mega Menus')

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
        $pageName = 'Edit Mega Menus';
        $pageName2 = 'Edit New Mega Menus Records';
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
                                <div id="alert-container"
                                    style="position: fixed; top: 17px; right: 20px; z-index: 9999; max-width: 300px;">
                                    @if (session('success'))
                                        <div class="alert-message"
                                            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 20px; color: #fff; background: #47C363; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); height: 71px; width: 106%; align-content: center;">
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

                                    @if ($errors->any())
                                        <div class="alert-message"
                                            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #ff0018; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
                                            <ul style="margin: 0; padding-left: 20px;">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                      <form action="{{ route('mega_menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header">
            <h4>Edit Mega Menu</h4>
        </div>

        <div class="card-body">
            {{-- Title --}}
            <div class="col-md-6 mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $menu->title }}" required>
            </div>

            {{-- Category --}}
            <div class="col-md-6 mb-3">
                <label>Category</label>
                <select name="category" class="form-control" required>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $menu->category == $cat->id ? 'selected' : '' }}>
                            {{ $cat->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- First Link Column --}}
            <div class="form-group">
                <label for="col1">First Link Column</label>
                <textarea id="content" name="col1" class="form-control" rows="5">{{ $menu->col1 }}</textarea>
            </div>

            {{-- Featured Section 1 --}}
            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-primary">Featured Section 1</h5>
                <input type="text" name="col2" class="form-control mb-2" placeholder="Featured Title 1" value="{{ $menu->col2 }}">
                <input type="text" name="col3" class="form-control mb-2" placeholder="Featured Subtitle 1" value="{{ $menu->col3 }}">
                <input type="text" name="col4" class="form-control mb-2" placeholder="Featured Link 1" value="{{ $menu->col4 }}">
                <input type="file" name="featured_img" class="form-control mb-2">
                @if ($menu->featured_img)
                    <img src="{{ asset($menu->featured_img) }}" width="80" class="mt-2">
                @endif
            </div>

            {{-- Featured Section 2 --}}
            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-success">Featured Section 2</h5>
                <input type="text" name="col5" class="form-control mb-2" placeholder="Featured Title 2" value="{{ $menu->col5 }}">
                <input type="text" name="col1a" class="form-control mb-2" placeholder="Featured Subtitle 2" value="{{ $menu->col1a }}">
                <input type="text" name="col2a" class="form-control mb-2" placeholder="Featured Link 2" value="{{ $menu->col2a }}">
                <input type="file" name="featured_img2" class="form-control mb-2">
                @if ($menu->featured_img2)
                    <img src="{{ asset($menu->featured_img2) }}" width="80" class="mt-2">
                @endif
            </div>

            {{-- Featured Section 3 --}}
            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-warning">Featured Section 3</h5>
                <input type="text" name="col3a" class="form-control mb-2" placeholder="Featured Title 3" value="{{ $menu->col3a }}">
                <input type="text" name="col4a" class="form-control mb-2" placeholder="Featured Subtitle 3" value="{{ $menu->col4a }}">
                <input type="text" name="col5a" class="form-control mb-2" placeholder="Featured Link 3" value="{{ $menu->col5a }}">
                <input type="file" name="featured_img3" class="form-control mb-2">
                @if ($menu->featured_img3)
                    <img src="{{ asset($menu->featured_img3) }}" width="80" class="mt-2">
                @endif
            </div>

            {{-- Featured Section 4 --}}
            <div class="p-3 mb-4 border rounded bg-light">
                <h5 class="text-danger">Featured Section 4</h5>
                <input type="text" name="col6a" class="form-control mb-2" placeholder="Featured Title 4" value="{{ $menu->col6a }}">
                <input type="text" name="col7a" class="form-control mb-2" placeholder="Featured Subtitle 4" value="{{ $menu->col7a }}">
                <input type="text" name="col8a" class="form-control mb-2" placeholder="Featured Link 4" value="{{ $menu->col8a }}">
                <input type="file" name="featured_img4" class="form-control mb-2">
                @if ($menu->featured_img4)
                    <img src="{{ asset($menu->featured_img4) }}" width="80" class="mt-2">
                @endif
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('mega_menus.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const productFields = document.getElementById('productFields');

        function toggleProductFields() {
            if (typeSelect.value === 'product') {
                productFields.classList.remove('d-none');
            } else {
                productFields.classList.add('d-none');
            }
        }

        // Run on page load
        toggleProductFields();

        // Run on change
        typeSelect.addEventListener('change', toggleProductFields);
    });
</script>

@endsection
