@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.vendor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vendors.update", [$vendor->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="vendor_name">{{ trans('cruds.vendor.fields.vendor_name') }}</label>
                <input class="form-control {{ $errors->has('vendor_name') ? 'is-invalid' : '' }}" type="text" name="vendor_name" id="vendor_name" value="{{ old('vendor_name', $vendor->vendor_name) }}">
                @if($errors->has('vendor_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vendor_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.vendor_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.vendor.fields.remarks') }}</label>
                <input class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" type="text" name="remarks" id="remarks" value="{{ old('remarks', $vendor->remarks) }}">
                @if($errors->has('remarks'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remarks') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.remarks_helper') }}</span>
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