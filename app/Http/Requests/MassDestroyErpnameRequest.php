<?php

namespace App\Http\Requests;

use App\Models\Erpname;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyErpnameRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('erpname_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:erpnames,id',
        ];
    }
}
