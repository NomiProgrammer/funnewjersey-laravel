@extends('dashboard.admin.layouts.app')
@section('page_title', 'Payment History')

@section('css')
    {{-- Include the same DataTables CSS used on invoices page --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <style>
        table.dataTable thead {
            background-color: #17a2b8;
            color: white;
            font-weight: 600;
        }

        .paginate_button.page-item.active a {
            background-color: #17a2b8 !important;
            color: white !important;
        }
    </style>
@endsection

@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Payment History</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                {{-- Filter Form --}}
                @if (Auth::user()->hasRole('admin'))
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Filter Payments by Date</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('invoices.payment') }}" method="GET">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>From Date</label>
                                        <input type="text" class="form-control" name="fromdate"
                                            value="{{ request('fromdate') }}" placeholder="YYYY-MM-DD">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>To Date</label>
                                        <input type="text" class="form-control" name="todate"
                                            value="{{ request('todate') }}" placeholder="YYYY-MM-DD">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-success btn-block">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- Payments Table --}}
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Payment Records</h3>
                    </div>
                    <div class="card-body">
                        <table id="payments-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->paymentid }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->paymentdate }}</td>
                                        <td>
                                            @if ($payment->relatedInvoice)
                                                <a href="{{ url('/payments/?invoiceid=' . $payment->relatedInvoice->id) }}">
                                                    {{ $payment->relatedInvoice->title }}
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    {{-- Include DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#payments-table').DataTable({
                responsive: true,
                paging: false,
                searching: false,
                ordering: true,
                info: false
            });
        });
    </script>
@endsection
