@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Profile')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
@endpush

@section('admin-content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Your Profile</h3>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="form-horizontal" action="{{ route('system.updateprofile', ['locale' => app()->getLocale()]) }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">Profile Picture</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <img class="thumbnail" id="user_photo" src="" style="width:100px;" />
                                        <input type="file" name="profile_photo" class="form-control mt-2">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">Username</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="text" name="user_name" value="{{ old('user_name', $profile->user_name) }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">Email</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="text" name="user_email" value="{{ old('user_email', $profile->user_email) }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">New Password</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">Confirm Password</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">First Name</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="text" name="first_name" value="{{ old('first_name', $profile->first_name) }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">Last Name</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="text" name="last_name" value="{{ old('last_name', $profile->last_name) }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">Phone</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="text" name="phone" value="{{ old('phone', $profile->getMeta('phone')) }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">Gender</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender', $profile->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">Address</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="text" name="address" value="{{ old('address', $profile->address) }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">City</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="text" name="city" value="{{ old('city', $profile->city) }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">State</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="text" name="state" value="{{ old('state', $profile->state) }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">Zip</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <input type="text" name="zip" value="{{ old('zip', $profile->zip) }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-lg-2 control-label">Role</label>
                                    <div class="col-sm-9 col-lg-10 controls">
                                        <select name="role_id" class="form-control">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $profile->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Update</button>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Your Profile</h3>
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

                                <form class="form-horizontal" action="{{ route('system.updateprofile', ['locale' => app()->getLocale()]) }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-lg-2 control-label">Profile Picture</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <img class="thumbnail" id="user_photo" src="" style="width:100px;" />
                                            <input type="file" name="profile_photo" class="form-control mt-2">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-lg-2 control-label">Username</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" name="user_name" value="{{ old('user_name', $profile->user_name) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-lg-2 control-label">Email</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" name="user_email" value="{{ old('user_email', $profile->user_email) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-lg-2 control-label">New Password</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-lg-2 control-label">Confirm Password</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-lg-2 control-label">First Name</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" name="first_name" value="{{ old('first_name', $profile->first_name) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-lg-2 control-label">Last Name</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" name="last_name" value="{{ old('last_name', $profile->last_name) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-lg-2 control-label">Phone</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="text" name="phone" value="{{ old('phone', $profile->getMeta('phone')) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Update</button>
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

@push('scripts')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });
    </script>
@endpush
