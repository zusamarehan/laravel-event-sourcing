<?php

namespace App\Http\Requests;

use App\Command;
use App\Domain\Command\UpdateCurrentCommand;
use Illuminate\Contracts\Validation\Validator;
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

    /**
     * Get the validator instance for the request and
     * add attach callbacks to be run after validation
     * is completed.
     *
     * @return Validator
     */
    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function($validator){
            // Call the after method of the FormRequest (see below)
            $this->after($validator);
        });
    }
    /**
     * Attach callbacks to be run after validation is completed.
     *
     * @param  Validator $validator
     * @return callback
     */
    public function after($validator)
    {
        if($validator->errors()->getMessageBag()->count() > 0) {
            (new UpdateCurrentCommand($this->request->get('_pudding_command')))('failed', $validator->errors()->getMessageBag()->first());
        }
    }
}
