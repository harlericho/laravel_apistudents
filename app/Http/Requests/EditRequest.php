<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            //
            'dni' => 'required|min:10|max:10|unique:students,dni,' . $this->route('student')->id,
            'names' => 'required|min:3',
            'email' => 'required|email|min:10|unique:students,email,' . $this->route('student')->id,
            'age' => 'required|numeric|min:18|max:60',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
