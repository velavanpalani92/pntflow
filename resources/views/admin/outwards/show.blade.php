@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.outward.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.outwards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.outward.fields.id') }}
                        </th>
                        <td>
                            {{ $outward->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outward.fields.erp') }}
                        </th>
                        <td>
                            {{ $outward->erp->erpname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outward.fields.serialno') }}
                        </th>
                        <td>
                            {{ $outward->serialno->serialno ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outward.fields.category') }}
                        </th>
                        <td>
                            {{ $outward->category->category_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outward.fields.status') }}
                        </th>
                        <td>
                            {{ $outward->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.outwards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection