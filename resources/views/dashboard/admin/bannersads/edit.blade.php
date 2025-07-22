@extends('dashboard.admin.layouts.app')
@section('page_title', 'Edit Banner')

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
        $pageName = 'Edit Banner';
        $pageName2 = 'Edit New Banner Records';
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

                          <form action="{{ route('banners-ads.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Slide Order</label>
            <input type="number" name="slide_order" class="form-control" value="{{ old('slide_order', $banner->slide_order) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Current Image</label><br>
            @if ($banner->featured_img)
                <img src="{{ asset('storage/' . $banner->featured_img) }}" alt="Featured Image" style="max-height: 150px;">
            @endif
        </div>

        <div class="col-md-6 mb-3">
            <label>Change Featured Image</label>
            <input type="file" name="featured_img" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title) }}" required>
        </div>

        <div class="col-md-12 mb-3">
            <label>Description</label>
            <textarea name="description" id="content" class="form-control" rows="4">{{ old('description', $banner->description) }}</textarea>
        </div>

        <div class="col-md-6 mb-3">
            <label>Assigned To</label>
            <select name="assigned_to" class="form-control">
                <option value="">-- None --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $banner->assigned_to == $user->id ? 'selected' : '' }}>
                        {{ $user->first_name }} {{ $user->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>Created By</label>
            <select name="created_by" class="form-control">
                <option value="">-- None --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $banner->created_by == $user->id ? 'selected' : '' }}>
                        {{ $user->first_name }} {{ $user->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Published</option>
                <option value="2" {{ $banner->status == 2 ? 'selected' : '' }}>Drafted</option>
                <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Unpublished</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>State (County)</label>
            <select name="state" class="form-control" required>
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ $banner->state == $state->id ? 'selected' : '' }}>
                        {{ $state->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>Link</label>
            <input type="url" name="link" class="form-control" value="{{ old('link', $banner->link) }}">
        </div>

        <div class="col-md-6 mb-3">
            <label>Slot</label>
            <input type="text" name="slot" class="form-control" value="{{ old('slot', $banner->slot) }}">
        </div>

        <div class="col-md-6 mb-3">
            <label>Category</label>
            <select name="category" class="form-control" required>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $banner->category == $cat->id ? 'selected' : '' }}>
                        {{ $cat->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>Date Expires</label>
            <input type="date" name="expires" class="form-control" value="{{ old('expires', $banner->expires) }}">
        </div>

        <div class="col-md-6 mb-3">
            <label>Banner Type</label>
            <select name="type" class="form-control" required>
                <option value="1" {{ $banner->type == '1' ? 'selected' : '' }}>Top Horizontal</option>
                <option value="2" {{ $banner->type == '2' ? 'selected' : '' }}>Sidebar Square</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>Region</label>
            <select name="region" class="form-control" required>
                <option value="1" {{ $banner->region == '1' ? 'selected' : '' }}>North NJ</option>
                <option value="2" {{ $banner->region == '2' ? 'selected' : '' }}>South NJ</option>
                <option value="3" {{ $banner->region == '3' ? 'selected' : '' }}>Southern NJ</option>
            </select>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('bannersads.index') }}" class="btn btn-secondary">Cancel</a>
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
