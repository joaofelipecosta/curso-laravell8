<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdatePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //ecl se tem permissão ou não para fazer ação, no caso cadastrar ou editar
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() // onde ficam todas nossas validações
    {
        $id = $this->segment(2);

        $rules = [
            'title' => [
                     'required',
                     'min:3',
                     'max:160',

                     Rule::unique('posts')->ignore($id),
                    ], //string com validações
            'content' =>
                    'nullable|
                     min:5|
                     max:10000',
                 //Exemplo de outra validação: passo array com todas validações
            'photo' => [
                   'required',
                    'image'
                    ]
            ];

           if ($this->method() == 'PUT') {

            $rules['photo'] = ['nualble', 'image'];

           }


            return $rules;
    }
}
