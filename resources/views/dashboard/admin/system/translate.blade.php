@extends('dashboard.admin.layouts.app')

@section('page_title', 'Auto translator')

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
        $pageName = 'Auto translator';
        $pageName2 = 'Auto translator Options';
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

<form class="form-horizontal" action="{{ route('system.translatelang') }}" method="POST">
    @csrf

    <div class="form-group row">
        <label class="col-sm-3 col-lg-2 col-form-label">From Language</label>
        <div class="col-sm-4 col-lg-5">
            <select name="base_lang" id="base_lang" class="form-control">
                @foreach($all_langs as $short_name => $long_name)
                    <option value="{{ $short_name }}">{{ $short_name }}</option>
                @endforeach
            </select>
            @error('base_lang')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-lg-2 col-form-label">Target Language Name</label>
        <div class="col-sm-4 col-lg-5">
            <input type="text" name="target_lang_name" class="form-control" value="{{ old('target_lang_name') }}">
            @error('target_lang_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4 offset-sm-3 col-lg-5 offset-lg-2">
            <button type="submit" class="btn btn-success">Save</button>
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
