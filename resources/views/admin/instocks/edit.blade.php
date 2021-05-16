@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.instock.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.instocks.update", [$instock->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="type_id">{{ trans('cruds.instock.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id">
                    @foreach($types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('type_id') ? old('type_id') : $instock->type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instock.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vendor_id">{{ trans('cruds.instock.fields.vendor') }}</label>
                <select class="form-control select2 {{ $errors->has('vendor') ? 'is-invalid' : '' }}" name="vendor_id" id="vendor_id">
                    @foreach($vendors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('vendor_id') ? old('vendor_id') : $instock->vendor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('vendor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vendor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instock.fields.vendor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="serialno">{{ trans('cruds.instock.fields.serialno') }}</label>
                <input class="form-control {{ $errors->has('serialno') ? 'is-invalid' : '' }}" type="text" name="serialno" id="serialno" value="{{ old('serialno', $instock->serialno) }}">
                @if($errors->has('serialno'))
                    <div class="invalid-feedback">
                        {{ $errors->first('serialno') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instock.fields.serialno_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.instock.fields.source') }}</label>
                <select class="form-control {{ $errors->has('source') ? 'is-invalid' : '' }}" name="source" id="source">
                    <option value disabled {{ old('source', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Instock::SOURCE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('source', $instock->source) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('source'))
                    <div class="invalid-feedback">
                        {{ $errors->first('source') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instock.fields.source_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="orderno">{{ trans('cruds.instock.fields.orderno') }}</label>
                <input class="form-control {{ $errors->has('orderno') ? 'is-invalid' : '' }}" type="text" name="orderno" id="orderno" value="{{ old('orderno', $instock->orderno) }}">
                @if($errors->has('orderno'))
                    <div class="invalid-feedback">
                        {{ $errors->first('orderno') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instock.fields.orderno_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.instock.fields.remarks') }}</label>
                <input class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" type="text" name="remarks" id="remarks" value="{{ old('remarks', $instock->remarks) }}">
                @if($errors->has('remarks'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remarks') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instock.fields.remarks_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="category_id">{{ trans('cruds.instock.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $instock->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instock.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.instock.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $instock->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instock.fields.status_helper') }}</span>
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