<?php

namespace App\Http\Requests;

use App\Models\Instock;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInstockRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('instock_create');
    }

    public function rules()
    {
        return [
            'serialno' => [
                'string',
                'nullable',
            ],
            'orderno' => [
                'string',
                'nullable',
            ],
            'remarks' => [
                'string',
                'nullable',
            ],
        ];
    }
}
