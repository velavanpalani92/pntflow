<?php

namespace App\Http\Requests;

use App\Models\Outward;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOutwardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('outward_edit');
    }

    public function rules()
    {
        return [];
    }
}
