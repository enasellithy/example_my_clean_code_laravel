<?php

namespace App\Http\Requests\Admin\Student;

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
        $email = $this->request->get("email");
        return [
            'name' => [
                'required',
                'min:4',
                'max:100',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($email, 'email'),
            ],
            'password' => [
                'required',
                'min:4',
            ],
            'school_id' => [
                'required',
                'numeric',
                'gt:0',
            ]
        ];
    }
}
