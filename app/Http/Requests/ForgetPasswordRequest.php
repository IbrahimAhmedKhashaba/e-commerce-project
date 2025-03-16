<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
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
        $data = [
            'email' => 'required|email',
        ];

        if(request()->is('*/verify')){
            $data['code'] = 'required|numeric|digits:5';
        }
        if(request()->is('*/reset')){
            $data['password'] = 'required|min:8|confirmed';
        }

        return $data;
    }
}
