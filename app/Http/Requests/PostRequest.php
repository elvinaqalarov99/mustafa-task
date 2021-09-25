<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $image = $this->isMethod('POST') ? 'required' : 'nullable';
        
        return [
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => "$image|mimes:png,jpg,jpeg,gif|max:1024",
            'state' => 'nullable'
        ];
    }
}