<?php

namespace App\Http\Requests;

use App\Models\Erpname;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreErpnameRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('erpname_create');
    }

    public function rules()
    {
        return [
            'erpname' => [
                'string',
                'nullable',
            ],
            'code' => [
                'string',
                'nullable',
            ],
        ];
    }
}
