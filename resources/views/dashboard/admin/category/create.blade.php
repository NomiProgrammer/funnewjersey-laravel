@extends('dashboard.admin.layouts.app')
@section('page_title', 'Add Category')

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
        $pageName = 'Add Category';
        $pageName2 = 'Add New Category Records';
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
                               <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Name</label>
            <input type="text" required name="title" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Mini Title</label>
            <input type="text" required name="minititle" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Category URL</label>
            <input type="text" required name="url" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Make Category Private</label>
            <select required name="not_public" class="form-control">
                <option value="0">Public</option>
                <option value="1">Private</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>Disable H1</label>
            <select required name="noh1" class="form-control">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Hardlink Category to URL</label>
            <select required name="islink" class="form-control">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>Listing Count Override</label>
            <input type="number" required name="countoverride" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Parent</label>
            <select  name="parent" class="form-control">
                <option value="">No Parent</option>
                @foreach ($parent as $bc)
                    <option value="{{ $bc->id }}" {{ old('parent') == $bc->id ? 'selected' : '' }}>{{ $bc->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>FA Icon</label>
            <input type="text" required name="fa_icon" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Category Thumbnail</label>
            <input type="file"  name="featured_img" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Thumbnail Alt Tag</label>
            <input type="text" required name="img_alt" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Default Details Image</label>
            <input type="file"  name="featured_img2" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Default Image Alt Tag</label>
            <input type="text"  name="img_alt2" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Featured Listing Image</label>
            <input type="file"  name="featured_img3" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Featured Listing Alt Tag</label>
            <input type="text" required name="img_alt3" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Meta Title</label>
            <input type="text" required name="metatitle2" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Meta Keywords</label>
            <input type="text" required name="metakeywords2" class="form-control">
        </div>
        <div class="col-md-12 mb-3">
            <label>Meta Description</label>
            <textarea required name="metadescription2" id="content" class="form-control" rows="2"></textarea>
        </div>

        <div class="col-md-12 mb-3">
            <label>Category Description Top</label>
            <textarea required name="catdesc" id="content" class="form-control" rows="3"></textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label>Category Description Bottom</label>
            <textarea required name="catdesc2" id="content" class="form-control" rows="3"></textarea>
        </div>

        <div class="col-md-6 mb-3">
            <label>Meta Title (Location)</label>
            <input type="text" required name="metatitle" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Meta Keywords (Location)</label>
            <input type="text" required name="metakeywords" class="form-control">
        </div>
        <div class="col-md-12 mb-3">
            <label>Meta Description (Location)</label>
            <textarea required name="metadescription" class="form-control" rows="2"></textarea>
        </div>

        <div class="col-md-12 mb-3">
            <label>Category Description Top (variables)</label>
            <textarea required name="catdescvar" class="form-control" rows="3"></textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label>Category Description Bottom (variables)</label>
            <textarea required name="catdesc2var" class="form-control" rows="3"></textarea>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
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
