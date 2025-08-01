@extends('dashboard.admin.layouts.app')

@section('page_title', 'Generate Sitemap XML')

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
        $pageName = 'Generate Sitemap XML';
        $pageName2 = 'Sitemap XML Generator Options';
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

                                <form action="{{ route('admin.system.get_sitemap_xml') }}" method="POST">
                                    @csrf
                                    <ul class="sitemap-options">
                                        <li>
                                            <label><input type="checkbox" name="pages" value="1"> Pages</label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="blog_post" value="2"> Blog
                                                Posts</label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="estate" value="3"> Ads</label>
                                        </li>
                                    </ul>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check"></i> Create XML
                                        </button>

                                        @if (file_exists(public_path('sitemap.xml')))
                                            <a class="btn btn-success" href="{{ url('sitemap.xml') }}" target="_blank">
                                                View XML
                                            </a>
                                        @endif
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
