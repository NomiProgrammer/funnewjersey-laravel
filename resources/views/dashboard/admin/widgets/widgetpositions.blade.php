@extends('dashboard.admin.layouts.app')
@section('page_title', 'Widget Positions')

@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    .widget-box { margin-bottom: 20px; }
    ol.droptrue { min-height: 150px; border: 2px dashed #ccc; padding: 10px; background: #f9f9f9; }
    ol.droptrue li { margin-bottom: 10px; padding: 10px; background: #fff; border: 1px solid #ccc; cursor: move; }
</style>
@endsection

@section('admin-content')
@php
    $pageName = 'Widget Positions';
    $pageName2 = 'Manage Widget Positions';
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
        <form action="{{ route('widgets.widgetpositions') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label>Select Position</label>
                    <select name="position" class="form-control" onchange="this.form.submit()">
                        @foreach($positions as $position)
                          <option value="{{ $position['name'] }}" {{ $selected_pos == $position['name'] ? 'selected' : '' }}>
                              {{ ucfirst(str_replace('_', ' ', $position['name'])) }}
                          </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <br>

        <div class="row">
            <!-- Available Widgets -->
            <div class="col-md-6">
                <div class="card widget-box">
                    <div class="card-header bg-info text-white">
                        Available Widgets
                    </div>
                    <div class="card-body">
                        <ol id="sortable1" class="droptrue">
                            @foreach($widgets as $widget)
                                @if(!in_array($widget->alias, $active_widgets))
                                    <li class="ui-state-default">
                                        <input type="hidden" name="widget[]" value="{{ $widget->alias }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>{{ $widget->alias }} | {{ $widget->name }}</span>

                                            <button type="button" class="btn btn-sm btn-info edit-widget-btn"
                                                data-alias="{{ $widget->alias }}"
                                                data-name="{{ $widget->name }}">
                                                Edit
                                            </button>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Active Widgets -->
            <div class="col-md-6">
                <form action="{{ url('admin/widgets/savewidgetpositions') }}" method="POST" id="positions_widgets_form">
                    @csrf
                    <input type="hidden" name="position" value="{{ $selected_pos }}">
                    <div class="card widget-box">
                        <div class="card-header bg-success text-white">
                            Active Widgets for: {{ ucfirst(str_replace('_', ' ', $selected_pos)) }}
                        </div>
                        <div class="card-body">
                            <ol id="sortable2" class="droptrue active-widgets">
                                @foreach($active_widgets as $alias)
                                    @php
                                        $widget = $widgets->firstWhere('alias', $alias);

                                    @endphp
                                    @if($widget)
                                        <li class="ui-state-highlight">
                                            <input type="hidden" name="widget[]" value="{{ $widget->alias }}">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>{{ $widget->name }}</span>
                                                <button type="button" class="btn btn-sm btn-info edit-widget-btn"
                                                    data-alias="{{ $widget->alias }}"
                                                    data-name="{{ $widget->name }}">
                                                    Edit
                                                </button>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                            <button type="submit" class="btn btn-success mt-3">Save Widget Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<!-- Edit Widget Modal -->
<!-- Modal -->
<div class="modal fade" id="editWidgetModal" tabindex="-1" role="dialog" aria-labelledby="editWidgetModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editWidgetModalLabel">Edit Widget</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" id="modalWidgetAlias">
          <div class="form-group">
            <label for="modalWidgetName">Widget Name</label>
            <input type="text" id="modalWidgetName" class="form-control">
          </div>
          <div class="form-group">
            <label for="modalWidgetContent">Content</label>
            <textarea id="modalWidgetContent" rows="10" class="form-control"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="updateWidgetBtn">Update</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(document).on('click', '#updateWidgetBtn', function () {
        let alias = $('#modalWidgetAlias').val();
        let content = $('#modalWidgetContent').val();
        let url = "{{ route('admin.widgets.update-content', ['locale' => app()->getLocale(), 'alias' => 'ALIAS_PLACEHOLDER']) }}".replace('ALIAS_PLACEHOLDER', alias);

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                content: content
            },
            success: function(response) {
                $('#editWidgetModal').modal('hide');
                alert('Widget updated successfully!'); // Or use a more elegant notification
            },
            error: function() {
                alert('Failed to update widget.');
            }
        });
    });

    $(document).on('click', '.edit-widget-btn', function () {
        let alias = $(this).data('alias');
        let name = $(this).data('name');

        $('#modalWidgetAlias').val(alias);
        $('#modalWidgetName').val(name);
        $('#modalWidgetContent').val('Loading...');

        // Use the route() helper to generate the correct URL
        let url = "{{ route('admin.widgets.get-content', ['locale' => app()->getLocale(), 'alias' => 'ALIAS_PLACEHOLDER']) }}".replace('ALIAS_PLACEHOLDER', alias);

        $.get(url, function (data) {
            $('#modalWidgetContent').val(data.content);
        }).fail(function () {
            $('#modalWidgetContent').val('Could not load content.');
        });

        $('#editWidgetModal').modal('show');
    });
</script>


@endsection
