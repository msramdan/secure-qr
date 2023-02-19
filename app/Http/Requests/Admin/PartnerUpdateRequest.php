<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PartnerUpdateRequest extends FormRequest
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
            'email' => 'required|email', Rule::unique('users')->ignore($this->id, 'id'),
            'phone' => 'required|min:1|max:15',
            'password' => 'confirmed',
            'pic' => 'required|min:5|max:100',
            'photo' => 'mimes:png,jpg,jpeg|max:3040',
            'alamat' => 'required|min:10|string'
        ];
    }
}
