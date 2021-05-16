@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.zone.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.zones.update", [$zone->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="zone">{{ trans('cruds.zone.fields.zone') }}</label>
                <input class="form-control {{ $errors->has('zone') ? 'is-invalid' : '' }}" type="text" name="zone" id="zone" value="{{ old('zone', $zone->zone) }}">
                @if($errors->has('zone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zone.fields.zone_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.zone.fields.region') }}</label>
                <select class="form-control {{ $errors->has('region') ? 'is-invalid' : '' }}" name="region" id="region">
                    <option value disabled {{ old('region', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Zone::REGION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('region', $zone->region) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('region'))
                    <div class="invalid-feedback">
                        {{ $errors->first('region') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zone.fields.region_helper') }}</span>
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