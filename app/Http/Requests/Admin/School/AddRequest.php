<?php

namespace App\Http\Requests\Admin\School;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:4',
                'max:100',
                'unique:schools',
            ]
        ];
    }
}
