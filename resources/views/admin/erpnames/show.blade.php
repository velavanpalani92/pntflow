@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.erpname.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.erpnames.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.erpname.fields.id') }}
                        </th>
                        <td>
                            {{ $erpname->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.erpname.fields.erpname') }}
                        </th>
                        <td>
                            {{ $erpname->erpname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.erpname.fields.code') }}
                        </th>
                        <td>
                            {{ $erpname->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.erpname.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Erpname::STATUS_SELECT[$erpname->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.erpname.fields.zone') }}
                        </th>
                        <td>
                            {{ $erpname->zone->zone ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.erpnames.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#erp_outwards" role="tab" data-toggle="tab">
                {{ trans('cruds.outward.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="erp_outwards">
            @includeIf('admin.erpnames.relationships.erpOutwards', ['outwards' => $erpname->erpOutwards])
        </div>
    </div>
</div>

@endsection