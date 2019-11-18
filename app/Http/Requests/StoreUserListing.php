<?php

namespace Everlytic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserListing extends FormRequest
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
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|max:255',
            'position' => 'required|max:255',
        ];
    }
}
