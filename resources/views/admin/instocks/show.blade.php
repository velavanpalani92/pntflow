@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.instock.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instocks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.instock.fields.id') }}
                        </th>
                        <td>
                            {{ $instock->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instock.fields.type') }}
                        </th>
                        <td>
                            {{ $instock->type->category_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instock.fields.vendor') }}
                        </th>
                        <td>
                            {{ $instock->vendor->vendor_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instock.fields.serialno') }}
                        </th>
                        <td>
                            {{ $instock->serialno }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instock.fields.source') }}
                        </th>
                        <td>
                            {{ App\Models\Instock::SOURCE_SELECT[$instock->source] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instock.fields.remarks') }}
                        </th>
                        <td>
                            {{ $instock->remarks }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instock.fields.category') }}
                        </th>
                        <td>
                            {{ $instock->category->category_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instock.fields.status') }}
                        </th>
                        <td>
                            {{ $instock->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instocks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection