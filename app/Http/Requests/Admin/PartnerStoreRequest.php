<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartnerStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:1|max:50|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:1|max:15',
            'password' => 'required|min:7|confirmed',
            'pic' => 'required|min:5|max:100',
            'photo' => 'required|mimes:png,jpg',
            'alamat' => 'required|min:10|string'
        ];
    }
}
