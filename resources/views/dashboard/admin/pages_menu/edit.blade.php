@extends('dashboard.admin.layouts.app')
@section('page_title', 'Edit Page')

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
        $pageName = 'Edit Page';
        $pageName2 = 'Edit New Page Records';
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
                    <form action="{{ route('pages.update', $page->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="row">
            <!-- Title -->
            <div class="form-group col-md-6">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $page->title) }}" class="form-control" required>
            </div>

            <!-- Alias -->
            <div class="form-group col-md-6">
                <label for="alias">Alias</label>
                <input type="text" id="alias" name="alias" value="{{ old('alias', $page->alias) }}" class="form-control">
            </div>

            <!-- Show in Menu -->
            <div class="form-group col-md-6">
                <label for="show_in_menu">Show in Menu</label>
                <select id="show_in_menu" name="show_in_menu" class="form-control" required>
                    <option value="0" {{ $page->show_in_menu == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $page->show_in_menu == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            <!-- Layout -->
            <div class="form-group col-md-6">
                <label for="layout">Layout</label>
                <select id="layout" name="layout" class="form-control" required>
                    <option value="1" {{ $page->layout == 1 ? 'selected' : '' }}>Leftbar with Content</option>
                    <option value="2" {{ $page->layout == 2 ? 'selected' : '' }}>Rightbar with Content</option>
                    <option value="3" {{ $page->layout == 3 ? 'selected' : '' }}>Only Content</option>
                </select>
            </div>

            <!-- Content From -->
            <div class="form-group col-md-6">
                <label for="content_from">Content From</label>
                <select id="content_from" name="content_from" class="form-control" required>
                    <option value="url" {{ $page->content_from == 'url' ? 'selected' : '' }}>URL</option>
                    <option value="manual" {{ $page->content_from == 'manual' ? 'selected' : '' }}>Manual</option>
                </select>
            </div>

            <!-- URL -->
            <div class="form-group col-md-6">
                <label for="url">URL</label>
                <input type="text" id="url" name="url" value="{{ old('url', $page->url) }}" class="form-control">
            </div>

            <!-- Content -->
            <div class="form-group col-md-12">
                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control" rows="4">{{ old('content', $page->content) }}</textarea>
            </div>
        </div>

        <hr>
        <h5>SEO Settings</h5>
        <div class="row">
            <!-- Meta Title -->
            <div class="form-group col-md-6">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="seo_settings[meta_title]" value="{{ old('seo_settings.meta_title', $seo['meta_title'] ?? '') }}" class="form-control">
            </div>

            <!-- Crawl After -->
            <div class="form-group col-md-6">
                <label for="crawl_after">Crawl After (days)</label>
                <input type="number" id="crawl_after" name="seo_settings[crawl_after]" value="{{ old('seo_settings.crawl_after', $seo['crawl_after'] ?? '') }}" class="form-control">
            </div>

            <!-- Meta Description -->
            <div class="form-group col-md-12">
                <label for="meta_description">Meta Description</label>
                <textarea id="meta_description" name="seo_settings[meta_description]" class="form-control" rows="3">{{ old('seo_settings.meta_description', $seo['meta_description'] ?? '') }}</textarea>
            </div>

            <!-- Key Words -->
            <div class="form-group col-md-12">
                <label for="key_words">Key Words</label>
                <textarea id="key_words" name="seo_settings[key_words]" class="form-control" rows="2">{{ old('seo_settings.key_words', $seo['key_words'] ?? '') }}</textarea>
            </div>
        </div>

        <!-- Status -->
        <div class="row">
            <div class="form-group col-md-6">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="1" {{ $page->status == 1 ? 'selected' : '' }}>Published</option>
                    <option value="2" {{ $page->status == 2 ? 'selected' : '' }}>Drafted</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pages.index') }}" class="btn btn-secondary">Cancel</a>
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
