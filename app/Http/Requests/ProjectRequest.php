<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => ['required', 'min:3', 'max:255'],
            'deal' => ['required', 'gt:2']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The POC Title is required',
            'title.min' => 'The POC Title must at least be 3 characters',
            'title.max' => 'Hmm.. POC Title seems to be too long!',

            'deal.required' => 'The Deal amount is required',
            'deal.gt' => 'The Deal amount is greater than 0'

        ];
    }
}
