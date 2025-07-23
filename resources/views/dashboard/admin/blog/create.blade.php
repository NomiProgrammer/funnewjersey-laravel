@extends('dashboard.admin.layouts.app')
@section('page_title', 'Add Blog ')

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
        $pageName = 'Add Blog ';
        $pageName2 = 'Add New Blog  Records';
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
                                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">

                                            {{-- Type --}}
                                            <div class="form-group col-md-6">
                                                <label for="type">Type</label>
                                                <select class="form-control" name="type" id="type">
                                                    <option value="">Select Type</option>
                                                    @php
                                                        $types = [
                                                            'blog' => 'Blog Post',
                                                            'product' => 'Product',
                                                            'article' => 'Article',
                                                            'news' => 'Homepage News',
                                                            'deal' => 'Fun Deals',
                                                        ];
                                                    @endphp
                                                    @foreach ($types as $key => $label)
                                                        <option value="{{ $key }}"
                                                            {{ old('type') == $key ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            {{-- Category --}}
                                            <div class="form-group col-md-6">
                                                <label for="category">Category</label>
                                                <select class="form-control" name="category">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Title --}}
                                            <div class="form-group col-md-6">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Enter Title">
                                            </div>

                                            {{-- Meta Title --}}
                                            <div class="form-group col-md-6">
                                                <label for="bmetatitle">Meta Title</label>
                                                <input type="text" class="form-control" name="bmetatitle"
                                                    placeholder="Meta Title">
                                            </div>

                                            {{-- Meta Description --}}
                                            <div class="form-group col-md-6">
                                                <label for="bmetadescription">Meta Description</label>
                                                <textarea class="form-control" name="bmetadescription" rows="3"></textarea>
                                            </div>

                                            {{-- Page H1 --}}
                                            <div class="form-group col-md-6">
                                                <label for="pageh1">Page H1</label>
                                                <input type="text" class="form-control" name="pageh1"
                                                    placeholder="Page H1">
                                            </div>

                                            <div id="productFields" class="row d-none">
                                                <div class="form-group col-md-6">
                                                    <label for="price">Product Price</label>
                                                    <input type="number" class="form-control" name="price"
                                                        value="{{ old('price') }}">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="shipping">Product Shipping</label>
                                                    <input type="number" class="form-control" name="shipping"
                                                        value="{{ old('shipping') }}">
                                                </div>
                                            </div>


                                            {{-- Content --}}
                                            <div class="form-group col-md-12">
                                                <label for="description">Content</label>
                                                <textarea name="description" id="content" class="form-control" rows="5"></textarea>
                                            </div>

                                            {{-- Featured Image --}}
                                            <div class="form-group col-md-6">
                                                <label for="featured_img">Featured Image</label>
                                                <input type="file" class="form-control" name="featured_img">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('blog.index') }}" class="btn btn-secondary">Cancel</a>
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
        function toggleProductFields() {
            const type = document.getElementById('type').value;
            const productFields = document.getElementById('productFields');

            if (type === 'product') {
                productFields.classList.remove('d-none');
            } else {
                productFields.classList.add('d-none');
            }
        }

        document.getElementById('type').addEventListener('change', toggleProductFields);
        window.addEventListener('DOMContentLoaded', toggleProductFields);
    </script>
@endsection
