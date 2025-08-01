@extends('dashboard.admin.layouts.app')
@section('page_title', 'Add SMTP Email Settings')

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
        $pageName = 'Add SMTP Email Settings';
        $pageName2 = 'Add New SMTP Email Settings Records';
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
<form action="{{ route('settings.smtp.update') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">

                <!-- Enable/Disable SMTP -->
                <div class="form-group col-md-6">
                    <label for="smtp_email">SMTP Email</label>
                    <select name="smtp_email" id="smtp_email" class="form-control">
                        <option value="Disable" {{ ($settings['smtp_email'] ?? 'Disable') == 'Disable' ? 'selected' : '' }}>
                            Disable [uses PHP mail()]
                        </option>
                        <option value="Enable" {{ ($settings['smtp_email'] ?? '') == 'Enable' ? 'selected' : '' }}>
                            Enable
                        </option>
                    </select>
                </div>
            </div>

            <div id="enable-panel">
                <div class="row">
                    @php
                        $default = [
                            'smtp_host' => 'ssl://smtp.googlemail.com',
                            'smtp_port' => '465',
                            'smtp_timeout' => '30',
                            'smtp_user' => 'test@example.com',
                            'smtp_pass' => '',
                            'char_set' => 'utf-8',
                            'new_line' => '\r\n',
                            'mail_type' => 'html',
                        ];
                    @endphp

                    @foreach ($default as $key => $val)
                        <div class="form-group col-md-6">
                            <label for="{{ $key }}">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                            <input type="text" class="form-control" name="{{ $key }}"
                                value="{{ old($key, $settings[$key] ?? $val) }}"
                                placeholder="{{ $val }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ url('admin/dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var smtpSelect = document.getElementById('smtp_email');
        var panel = document.getElementById('enable-panel');

        function togglePanel() {
            if (smtpSelect.value === 'Enable') {
                panel.style.display = 'block';
            } else {
                panel.style.display = 'none';
            }
        }

        smtpSelect.addEventListener('change', togglePanel);
        togglePanel(); // Run on page load
    });
</script>



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
