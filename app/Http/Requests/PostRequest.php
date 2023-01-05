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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'task_name' => ['required', 'max:20'],
            'task_description' => ['required'],
            'assign_person_name' => ['required','max:20'],
            'estimate_hour' => ['required'],
        ];
    }

    public function passedValidation()
    {
        $this->merge(['user_id' => auth()->id()]);
    }
}