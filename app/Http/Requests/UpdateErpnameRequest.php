<?php

namespace App\Http\Requests;

use App\Models\Erpname;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateErpnameRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('erpname_edit');
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
