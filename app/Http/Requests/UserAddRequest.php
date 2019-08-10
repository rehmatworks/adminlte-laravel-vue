<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'This field is required.',
            'last_name.required' => 'This field is required.',
            'email.required' => 'This field is required.',
            'password.required' => 'This field is required.',
            'first_name.max' => 'Max lenght allowed is 255.',
            'last_name.max' => 'Max lenght allowed is 255.',
            'email.max' => 'Max lenght allowed is 255.',
            'password.max' => 'Max lenght allowed is 255.',
            'email.unique' => 'This email is already taken.'
        ];
    }
}
