@extends('dashboard.admin.layouts.app')
@section('page_title', 'Edit Parallax Slider')

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
        $pageName = 'Edit Parallax Slider';
        $pageName2 = 'Edit New Parallax Slider Records';
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

                             <form action="{{ route('parallax.update', $parallax->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card-body">
        <div class="row">
            @foreach([
                'title' => 'Title',
                'link' => 'Link',
                'alttag' => 'Alt Tag',
                'button' => 'Button Text',
                'starts' => 'Date Starts',
                'expires' => 'Date Expires',
                'slide_order' => 'Slide Order'
            ] as $field => $label)
                <div class="form-group col-md-6">
                    <label for="{{ $field }}">{{ $label }}</label>
                    <input type="{{ in_array($field, ['starts', 'expires']) ? 'date' : 'text' }}"
                           class="form-control"
                           name="{{ $field }}"
                           value="{{ old($field, $parallax->$field) }}"
                           placeholder="Enter {{ $label }}">
                </div>
            @endforeach

            <div class="form-group col-md-6">
                <label for="category">Category</label>
                <select class="form-control" name="category">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $parallax->category == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="county">County</label>
                <select class="form-control" name="county">
                    <option value="">Select County</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ $parallax->county == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="city">City</label>
                <select class="form-control" name="city">
                    <option value="">Select City</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ $parallax->city == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-12">
                <label for="description">Content</label>
                <textarea class="form-control" id="content" name="description" rows="4">{{ old('description', $parallax->description) }}</textarea>
            </div>

            <div class="form-group col-md-6">
                <label for="created_by">Assigned To</label>
                <select class="form-control" name="created_by">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $parallax->created_by == $user->id ? 'selected' : '' }}>
                            {{ $user->first_name }} {{ $user->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="featured_img">Featured Image</label>
                <input type="file" class="form-control" name="featured_img">
                @if ($parallax->featured_img)
                    <img src="{{ asset($parallax->featured_img) }}" alt="" style="margin-top:10px; max-height: 100px;">
                @endif
            </div>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('parallax.index') }}" class="btn btn-secondary">Cancel</a>
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
