@extends('dashboard.admin.layouts.app')
@section('page_title', 'Edit Meta Tags')

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
        $pageName = 'Edit Meta Tags';
        $pageName2 = 'Edit New Meta Tags Records';
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

                               <form action="{{ route('meta_tags.update', $meta->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="row">

            {{-- Category --}}
            <div class="form-group col-md-6">
                <label for="category">Category</label>
                <select class="form-control"  name="category">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $meta->category == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- County --}}
            <div class="form-group col-md-6">
                <label for="county">County</label>
                <select class="form-control" name="county">
                    <option value="">Select County</option>
                    @foreach ($locations as $loc)
                        <option value="{{ $loc->id }}" {{ $meta->county == $loc->id ? 'selected' : '' }}>
                            {{ $loc->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- City --}}
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <select class="form-control" name="city">
                    <option value="">Select City</option>
                    @foreach ($locations as $loc)
                        <option value="{{ $loc->id }}" {{ $meta->city == $loc->id ? 'selected' : '' }}>
                            {{ $loc->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Region --}}
            <div class="form-group col-md-6">
                <label for="region">Region</label>
                <select name="region" class="form-control">
                    <option value="1" {{ $meta->region == 1 ? 'selected' : '' }}>Northern</option>
                    <option value="2" {{ $meta->region == 2 ? 'selected' : '' }}>Central</option>
                    <option value="3" {{ $meta->region == 3 ? 'selected' : '' }}>Southern</option>
                </select>
            </div>

            {{-- Disable H1 --}}
            <div class="form-group col-md-6">
                <label for="disableh1">Disable H1?</label>
                <select name="disableh1" class="form-control">
                    <option value="0" {{ $meta->disableh1 == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $meta->disableh1 == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            {{-- H1 --}}
            <div class="form-group col-md-6">
                <label for="h1">H1</label>
                <input type="text" required name="h1" class="form-control" value="{{ $meta->h1 }}" placeholder="Enter H1">
            </div>

            {{-- Meta Title --}}
            <div class="form-group col-md-6">
                <label for="metatitle">Meta Title</label>
                <input type="text" required name="metatitle" class="form-control" value="{{ $meta->metatitle }}" placeholder="Enter Meta Title">
            </div>

            {{-- Meta Description --}}
            <div class="form-group col-md-6">
                <label for="metadesc">Meta Description</label>
                <textarea required name="metadesc" class="form-control" rows="3">{{ $meta->metadesc }}</textarea>
            </div>

            {{-- Meta Keywords --}}
            <div class="form-group col-md-6">
                <label for="metakeywords">Meta Keywords</label>
                <textarea required name="metakeywords" class="form-control" rows="3">{{ $meta->metakeywords }}</textarea>
            </div>

            {{-- Page Top Description --}}
            <div class="form-group col-md-12">
                <label for="pagetop">Page Top Description</label>
                <textarea required name="pagetop" class="form-control" id="content" rows="4">{{ $meta->pagetop }}</textarea>
            </div>

            {{-- Page Bottom Description --}}
            <div class="form-group col-md-12">
                <label for="pagebottom">Page Bottom Description</label>
                <textarea required name="pagebottom" class="form-control" rows="4">{{ $meta->pagebottom }}</textarea>
            </div>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('meta_tags.index') }}" class="btn btn-secondary">Cancel</a>
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
