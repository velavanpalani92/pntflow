@can('erpname_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.erpnames.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.erpname.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.erpname.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-zoneErpnames">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.erpname.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.erpname.fields.erpname') }}
                        </th>
                        <th>
                            {{ trans('cruds.erpname.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.erpname.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.erpname.fields.zone') }}
                        </th>
                        <th>
                            {{ trans('cruds.zone.fields.region') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($erpnames as $key => $erpname)
                        <tr data-entry-id="{{ $erpname->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $erpname->id ?? '' }}
                            </td>
                            <td>
                                {{ $erpname->erpname ?? '' }}
                            </td>
                            <td>
                                {{ $erpname->code ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Erpname::STATUS_SELECT[$erpname->status] ?? '' }}
                            </td>
                            <td>
                                {{ $erpname->zone->zone ?? '' }}
                            </td>
                            <td>
                                @if($erpname->zone)
                                    {{ $erpname->zone::REGION_SELECT[$erpname->zone->region] ?? '' }}
                                @endif
                            </td>
                            <td>
                                @can('erpname_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.erpnames.show', $erpname->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('erpname_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.erpnames.edit', $erpname->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('erpname_delete')
                                    <form action="{{ route('admin.erpnames.destroy', $erpname->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('erpname_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.erpnames.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-zoneErpnames:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('div#sidebar').on('transitionend', function(e) {
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  })
  
})

</script>
@endsection