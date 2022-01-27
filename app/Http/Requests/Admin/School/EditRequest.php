<?php

namespace App\Http\Requests\Admin\School;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $name = $this->request->get("name");
        return [
            'name' => [
                'required',
                'min:4',
                'max:100',
                Rule::unique('schools')->ignore($name, 'name'),
            ]
        ];
    }
}
