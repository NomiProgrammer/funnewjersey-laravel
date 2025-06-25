@extends('dashboard.admin.layouts.app')
@section('page_title', 'Dashboard')

@section('css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('admin-content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Users DataTable</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">User Records</h3>
            </div>
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Email Verified At</th>
                    <th>Created At</th>
                  </tr>
                </thead>
                <tbody></tbody> <!-- Keep empty, Yajra fills this -->
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js')
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    $(function () {
      $('#example2').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('base.index') }}",
        columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'email_verified_at', name: 'email_verified_at' },
          { data: 'created_at', name: 'created_at' }
        ]
      });
    });
  </script>
@endsection
