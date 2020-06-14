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
            ->criptografaSenha()
            ->formatarCelular();

        $motorista->save();

        return $motorista;
    }
}
