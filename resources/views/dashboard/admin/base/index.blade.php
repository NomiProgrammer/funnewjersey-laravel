@extends('dashboard.admin.layouts.app')
@section('page_title', 'Users')

@section('admin-content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
        </div>
        <div class="card-body">
<table id="datatable" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
        </div>
    </div>
@endsection

@include('components.datatables-script', [
    'tableId' => 'datatable',
    'ajaxUrl' => route('users.index'), // Your ajax route
    'columns' => [
        ['data' => 'name', 'name' => 'name'],
        ['data' => 'email', 'name' => 'email'],
        ['data' => 'created_at', 'name' => 'created_at']
    ]
])
