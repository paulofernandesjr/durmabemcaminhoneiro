<?php

namespace App\Models;

use App\Traits\GerarUuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class Motorista extends Authenticatable
{
    use GerarUuid, HasApiTokens;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const MOTORISTA_DURMA_BEM_CAMINHONEIRO_ID = 2;

    protected $table = 'motoristas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'cpf',
        'senha',
        'email',
        'celular',
        'data_nascimento',
        'numero_cnh',
        'categoria_cnh',
        'vencimento_cnh',
        'rntrc',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade_id',
        'estado_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'senha', 'remember_token', 'estado_id', 'cidade_id'
    ];

    public function criptografaSenha()
    {
        $this->senha = !is_null($this->senha) ? Hash::make($this->senha) : auth()->user()->senha;

        return $this;
    }

    public function formatarCelular()
    {
        $celular = str_replace('(', '', $this->celular);
        $celular = str_replace(')', '', $celular);
        $celular = str_replace('-', '', $celular);
        $this->celular = str_replace(' ', '', $celular);

        return $this;
    }

    public function padronizaRntrc()
    {
        $this->rntrc = strtoupper($this->rntrc);

        return $this;
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->cpf;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function findForPassport($username)
    {
        return $this->where('cpf', $username)->first();
    }
}
