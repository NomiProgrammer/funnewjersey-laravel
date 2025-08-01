@extends('dashboard.admin.layouts.app')

@section('page_title', 'Email Template Editor')

@section('admin-content')
    @php
        $pageName = 'Email Templates';
        $pageName2 = 'Edit Email Template';
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
                    <div class="col-md-3">
                        <div class="list-group">
                            @foreach ($emails as $email)
                                <a href="{{ route('system.emailview', ['id' => $email->id]) }}"
                                    class="list-group-item list-group-item-action {{ request('id') == $email->id ? 'active' : '' }}">
                                    {{ ucwords(str_replace('_', ' ', $email->email_name)) }}
                                </a>
                            @endforeach

                        </div>
                    </div>

                    <div class="col-md-9">
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
                                @if (!$selectedEmail)
                                    <div class="alert alert-info">Click an email template from the left to edit.</div>
                                @else
                                    <form action="{{ route('system.updateemail') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $selectedEmail->id }}">

                                        @php
                                            $values = json_decode($selectedEmail->values);
                                        @endphp

                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" name="subject"
                                                value="{{ old('subject', $values->subject ?? '') }}" class="form-control">
                                            @error('subject')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Body</label>
                                            <textarea name="body" class="form-control" rows="8">{{ old('body', $values->body ?? '') }}</textarea>
                                            @error('body')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        @if (isset($values->avl_vars))
                                            <div class="alert alert-info">
                                                <strong>Available Variables:</strong> {{ $values->avl_vars }}
                                                <input type="hidden" name="avl_vars" value="{{ $values->avl_vars }}">
                                            </div>
                                        @endif

                                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>
                                            Save</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection
