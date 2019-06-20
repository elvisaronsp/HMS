<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:45|min:3',
            'surname' => 'required|string|max:45|min:3',
            'birthday' => 'required|date',
            'gender' => ['required', Rule::in(['male', 'female']) ],
            'phone' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string|min:5',
            'email' => 'required|email',
            'blood_type_id' => 'required|int',
            'avatar' => 'required|string',
        ];
    }
}
