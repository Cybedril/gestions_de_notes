<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function authorize()
    {
        return true; // On autorise la requête
    }

    public function rules()
    {
        return [
            'note' => 'required|numeric|min:0|max:20', // Note entre 0 et 20
        ];
    }

    public function messages()
    {
        return [
            'note.min' => 'La note doit être supérieure ou égale à 0.',
            'note.max' => 'La note doit être inférieure ou égale à 20.',
        ];
    }
}
