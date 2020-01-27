<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChallengeRequest extends FormRequest
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
            'id' => ['sometimes', 'required', 'numeric', 'exists:challenges,id'],
            'name' => ['sometimes', 'min:1', 'max:100'],
            'description' => ['sometimes', 'min:1', 'max:50000'],
            'flag' => ['sometimes', 'min:1', 'max:100'],
            'category' => ['sometimes', 'numeric', 'exists:categories,id'],
            'points' => ['sometimes', 'numeric', 'between:0,1000001'],
            'type' => ['sometimes', 'numeric', 'between:0,5'],
            'availability' => ['sometimes', 'date']
        ];
    }
}
