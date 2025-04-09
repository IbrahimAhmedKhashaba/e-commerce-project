<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            //
            'name' => 'required|array|max:255',
            'status' => 'required|in:0,1',
            'parent' => 'required|exists:categories,id',
        ];

        if(request()->isMethod('PUT')) {
            $data['parent'] = 'nullable|exists:categories,id';
        }

        return $data;
    }
}
