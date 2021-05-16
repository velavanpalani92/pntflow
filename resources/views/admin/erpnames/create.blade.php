@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.erpname.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.erpnames.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="erpname">{{ trans('cruds.erpname.fields.erpname') }}</label>
                <input class="form-control {{ $errors->has('erpname') ? 'is-invalid' : '' }}" type="text" name="erpname" id="erpname" value="{{ old('erpname', '') }}">
                @if($errors->has('erpname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('erpname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.erpname.fields.erpname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="code">{{ trans('cruds.erpname.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}">
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.erpname.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.erpname.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Erpname::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.erpname.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="zone_id">{{ trans('cruds.erpname.fields.zone') }}</label>
                <select class="form-control select2 {{ $errors->has('zone') ? 'is-invalid' : '' }}" name="zone_id" id="zone_id">
                    @foreach($zones as $id => $entry)
                        <option value="{{ $id }}" {{ old('zone_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('zone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.erpname.fields.zone_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection