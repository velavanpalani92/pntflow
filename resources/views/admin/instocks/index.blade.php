@extends('layouts.admin')
@section('content')
@can('instock_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.instocks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.instock.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Instock', 'route' => 'admin.instocks.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.instock.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Instock">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.instock.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.instock.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.instock.fields.vendor') }}
                    </th>
                    <th>
                        {{ trans('cruds.instock.fields.serialno') }}
                    </th>
                    <th>
                        {{ trans('cruds.instock.fields.source') }}
                    </th>
                    <th>
                        {{ trans('cruds.instock.fields.orderno') }}
                    </th>
                    <th>
                        {{ trans('cruds.instock.fields.remarks') }}
                    </th>
                    <th>
                        {{ trans('cruds.instock.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.instock.fields.status') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('instock_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.instocks.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.instocks.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'type_category_name', name: 'type.category_name' },
{ data: 'vendor_vendor_name', name: 'vendor.vendor_name' },
{ data: 'serialno', name: 'serialno' },
{ data: 'source', name: 'source' },
{ data: 'orderno', name: 'orderno' },
{ data: 'remarks', name: 'remarks' },
{ data: 'category_category_name', name: 'category.category_name' },
{ data: 'status_name', name: 'status.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Instock').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection