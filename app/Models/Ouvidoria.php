<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class Ouvidoria extends Model
{
    use HasFactory;

    protected $table = 'ouvidorias';
    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'assunto_id',
        'mensagem',
        'status_id',
    ];

    public function rules($anonymous = false)
    {  
        // if($request->input('nome')){
        //     $request->merge([
        //         'nome' => ucfirst($request->input('nome')),
        //     ]);
        // }
        Validator::extend('mail',  function ($attribute, $value, $parameters, $validator) {
            $value = preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $value);               
            if ($value == 1) {
                return true;
            }
            else {
                return false;
            }
        });

        if(!$anonymous){
            return [
                'nomeFC' => ['required'],
                'cpfFC' => ['required', 'cpf'],
                'emailFC' => ['required', 'mail'],
                'reclamacaoFC' => ['required'],
                'mensagemFC' => ['required', 'min:10', 'max:500'],
            ];
        }else{
            return [
                'emailFC' => ['required', 'mail'],
                'reclamacaoFC' => ['required'],
                'mensagemFC' => ['required', 'min:10', 'max:500'],
            ];
        }
    }

    public function messages()
    {
        return [
            'required' => 'O campo precisa ser preenchido',
            'cpfFC.cpf' => 'CPF Inválido. Por favor, preencha novamente.',
            'emailFC.mail' => 'Digite um e-mail válido',
            'mensagemFC.min' => 'A mensagem tem que ter no mínimo 10 caracteres',
            'mensagemFC.max' => 'A mensagem possui um límite de 500 caracteres'
        ];
    }

    public function status()
    {
        return $this->belongsTo(StatusOuvidoria::class, 'status_id', 'id');
    }

    public function assuntoTipo()
    {
        return $this->belongsTo(Assunto::class, 'assunto_id', 'id');
    }

}
