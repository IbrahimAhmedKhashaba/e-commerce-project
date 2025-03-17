<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('admin');
        $data = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $id,
            'role_id' => 'required|integer|exists:roles,id',
            'status' => 'required|boolean',
        ];

        if(request()->is('*/admins/*/store')){
            $data['password'] = 'required|string|min:8|confirmed';
        }

        return $data;
    }
}
