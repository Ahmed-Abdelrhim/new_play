<?php

namespace App\Http\Requests\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
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
            //'author_id' => 'required|numeric',
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان البلوج بوست مطلوب',
            'title.string' => 'عنوان البلوج بوست يجد ان يكون حروف',
            'title.min' => 'عنوان البلوج بوست يجب الا يكون اقل من 4 حروف',
            'content.required' => 'محتوي البلوج بوست مطلوب',
            'content.string' => 'محتوي البلوج بوست يجب ان يكون حروف',
            'content.min' => 'محتوي البلوج بوست يجب الا يكون اقل من 8 حروف',
        ];
    }
}
