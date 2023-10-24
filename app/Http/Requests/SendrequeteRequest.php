<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendrequeteRequest extends FormRequest
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
        return [
            'objet' => 'required',
            'msg' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
           'objet.required' => 'Veuillez definir l\'objet de votre demande',
           'msg.required' => 'Veuillez entrer une description'  
        ] ;
    }

}
