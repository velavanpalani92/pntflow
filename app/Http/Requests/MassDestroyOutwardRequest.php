<?php

namespace App\Http\Requests;

use App\Models\Outward;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOutwardRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('outward_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:outwards,id',
        ];
    }
}
