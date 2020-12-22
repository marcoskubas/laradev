<?php

namespace LaraDev\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Course extends FormRequest
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

    public function messages(){
        return [
            'name:required'  => 'Por favor, insira o nome do curso',
            'tutor:required' => 'Por favor, insira o tutor do curso',
            'email:required' => 'Por favor, insira o e-maill do curso'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required',
            'tutor' => 'required|min:3|max:8',
            'email' => 'required|email',
        ];
    }
}
