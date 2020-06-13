<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Motorista;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistroController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => ['required', 'string', 'max:255'],
            'celular' => ['required', 'string', 'celular_com_ddd', 'max:15'],
            'cpf' => ['required', 'string', 'formato_cpf', 'max:14', 'unique:motoristas'],
            'senha' => ['required', 'string', 'min:8'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:motoristas'],
            'data_nascimento' => ['nullable', 'date'],
            'numero_cnh' => ['nullable', 'string', 'min:11', 'max:11', 'regex:/^[0-9]+$/'],
            'categoria_cnh' => ['nullable', 'string'],
            'vencimento_cnh' => ['nullable', 'date'],
            'rntrc' => ['nullable', 'string', 'min:12', 'max:12', 'regex:/[A-Za-z]{3}-[0-9]{8}/'],
            'cep' => ['nullable', 'formato_cep'],
            'logradouro' => ['nullable', 'string', 'max:255'],
            'numero' => ['nullable', 'string', 'max:20'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade_id' => ['nullable', 'integer'],
            'estado_id' => ['nullable', 'integer'],
            'cursos' => ['nullable', 'array'],
            'cursos.*.descricao' => ['required', 'string'],
            'cursos.*.nome' => ['required_without:cursos.*.curso_id', 'nullable', 'string'],
            'cursos.*.curso_id' => ['required_without:cursos.*.nome', 'nullable', 'integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Motorista
     */
    protected function create(array $data)
    {
        $motorista = (new Motorista)->fill($data)
            ->padronizaRntrc()
            ->criptografaSenha()
            ->formatarCelular();

        $motorista->save();

        return $motorista;
    }
}
