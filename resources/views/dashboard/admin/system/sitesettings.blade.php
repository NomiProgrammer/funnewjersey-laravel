@extends('dashboard.admin.layouts.app')

@section('page_title', 'Generate Site Settings')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .sitemap-options {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sitemap-options li {
            margin-bottom: 10px;
        }

        .btn.btn-secondary {
            margin-left: auto;
        }
    </style>
@endsection

@section('admin-content')
    @php
        $pageName = 'Generate Site Settings';
        $pageName2 = 'Site Settings Options';
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
<form action="{{ route('system.sitesettings.save') }}" method="POST">
    @csrf

    {{-- Site Title --}}
    <div class="form-group">
        <label for="site_title">Site Title</label>
        <input type="text" name="site_title" class="form-control" value="{{ $values['site_title'] ?? '' }}">
    </div>

    {{-- Bottom Text (TinyMCE) --}}
    <div class="form-group">
        <label for="bottom_text">Homepage Bottom Text</label>
        <textarea name="bottom_text" id="content" class="form-control">{{ $values['bottom_text'] ?? '' }}</textarea>
    </div>

    {{-- Footer Text --}}
    <div class="form-group">
        <label for="footer_text">Footer Text</label>
        <input type="text" name="footer_text" class="form-control" value="{{ $values['footer_text'] ?? '' }}">
    </div>

    {{-- Site Logo --}}
<div class="form-group col-md-6">
    <label for="site_logo">Site Logo</label><br>

    {{-- Show existing logo --}}
    @if(!empty($values['site_logo']))
        <div class="mb-2">
            <img src="{{ asset('front_assets/uploads/site/' . $values['site_logo']) }}" alt="Site Logo" style="max-height: 80px;">
        </div>
    @endif

    {{-- File input --}}
    <input type="file" name="site_logo" class="form-control" id="site_logo">
</div>

    {{-- Site Language --}}
    <div class="form-group">
        <label for="site_lang">Site Language</label>
        <select name="site_lang" class="form-control">
            @php
                $langs = ['en' => 'English', 'es' => 'Spanish', 'fr' => 'French']; // Extend as needed
            @endphp
            @foreach($langs as $key => $lang)
                <option value="{{ $key }}" {{ ($values['site_lang'] ?? '') == $key ? 'selected' : '' }}>{{ $lang }}</option>
            @endforeach
        </select>
    </div>

    {{-- Text Direction --}}
    <div class="form-group">
        <label for="site_direction">Text Direction</label>
        <select name="site_direction" class="form-control">
            <option value="ltr" {{ ($values['site_direction'] ?? '') == 'ltr' ? 'selected' : '' }}>LTR</option>
            <option value="rtl" {{ ($values['site_direction'] ?? '') == 'rtl' ? 'selected' : '' }}>RTL</option>
        </select>
    </div>

    {{-- Items Per Page --}}
    <div class="form-group">
        <label for="per_page">Items Per Page</label>
        <select name="per_page" class="form-control">
            @foreach([5,6,9,10,12,15,18,20,24,28,30,33,36,40,50,100] as $num)
                <option value="{{ $num }}" {{ ($values['per_page'] ?? '') == $num ? 'selected' : '' }}>{{ $num }}</option>
            @endforeach
        </select>
    </div>

    {{-- Default Page Layout --}}
    <div class="form-group">
        <label for="default_layout">Default Page Layout</label>
        @php
            $layouts = ['Left bar with content', 'Right bar with content', 'Only content'];
        @endphp
        <select name="default_layout" class="form-control">
            @foreach($layouts as $index => $layout)
                <option value="{{ $index }}" {{ ($values['default_layout'] ?? '') == $index ? 'selected' : '' }}>{{ $layout }}</option>
            @endforeach
        </select>
    </div>

    {{-- CSS Compression --}}
    <div class="form-group">
        <label for="css_compression">CSS Compression</label>
        <select name="css_compression" class="form-control">
            <option value="No" {{ ($values['css_compression'] ?? '') == 'No' ? 'selected' : '' }}>No</option>
            <option value="Yes" {{ ($values['css_compression'] ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
        </select>
    </div>

    {{-- Google Analytics Tracking Code --}}
    <div class="form-group">
        <label for="ga_tracking_code">Google Analytics Tracking Code</label>
        <textarea name="ga_tracking_code" class="form-control">{{ $values['ga_tracking_code'] ?? '' }}</textarea>
    </div>

    {{-- Meta Description --}}
    <div class="form-group">
        <label for="meta_description">Meta Description</label>
        <textarea name="meta_description" class="form-control">{{ $values['meta_description'] ?? '' }}</textarea>
    </div>

    {{-- Meta Keywords --}}
    <div class="form-group">
        <label for="key_words">Meta Keywords</label>
        <textarea name="key_words" class="form-control">{{ $values['key_words'] ?? '' }}</textarea>
    </div>

    {{-- Crawl After --}}
    <div class="form-group">
        <label for="crawl_after">Crawl After (in days)</label>
        <input type="text" name="crawl_after" class="form-control" value="{{ $values['crawl_after'] ?? '' }}">
    </div>

    {{-- Submit --}}
    <div class="form-group">
        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save Settings</button>
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

