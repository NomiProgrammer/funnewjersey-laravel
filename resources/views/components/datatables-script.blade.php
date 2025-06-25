@push('css')
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        let tableId = '{{ $tableId ?? 'datatable' }}';
        let ajaxUrl = '{{ $ajaxUrl ?? request()->url() }}';
        let columns = {!! json_encode($columns ?? []) !!};

        $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: ajaxUrl,
            columns: columns
        });
    });
</script>
@endpush
