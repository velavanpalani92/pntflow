@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.outward.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.outwards.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="erp_id">{{ trans('cruds.outward.fields.erp') }}</label>
                <select class="form-control select2 {{ $errors->has('erp') ? 'is-invalid' : '' }}" name="erp_id" id="erp_id">
                    @foreach($erps as $id => $entry)
                        <option value="{{ $id }}" {{ old('erp_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('erp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('erp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outward.fields.erp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="serialno_id">{{ trans('cruds.outward.fields.serialno') }}</label>
                <select class="form-control select2 {{ $errors->has('serialno') ? 'is-invalid' : '' }}" name="serialno_id" id="serialno_id">
                    @foreach($serialnos as $id => $entry)
                        <option value="{{ $id }}" {{ old('serialno_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('serialno'))
                    <div class="invalid-feedback">
                        {{ $errors->first('serialno') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outward.fields.serialno_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="category_id">{{ trans('cruds.outward.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outward.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.outward.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outward.fields.status_helper') }}</span>
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