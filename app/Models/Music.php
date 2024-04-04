<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Music extends Model
{
    use HasFactory;

    protected $table = "musics";
    protected $fillable = [
        'id',
        'name',
        'release_date',
        'author_id',
    ];


    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'release_date' => ['required', 'regex:/^[0-9]+$/'],
            'author_id'    => 'exists:authors,id',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigratório',
            'name.string'   => 'O campo nome deve conter um texto válido',
            'nome.max'      => 'O campo nome deve conter no máximo 255 caracteres',

            'release_date.required'  => 'A data de lançamento é um campo obrigatório',
            'release_date.regex' => 'O dano de lançamento deve ser um numero valido',
            'author_id.exists' => 'O id do author da música deve estar resgistrado'
        ];
    }

    public function validate(array $atributtes)
    {
        $validator = Validator::make($atributtes, $this->rules(), $this->messages());

        return $validator;
    }
}
