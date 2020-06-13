<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Ramsey\Uuid\Uuid;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'uuid' => Uuid::uuid4(),
            'nome' => 'Durma bem caminhoneiro',
            'email' => 'contato@durmabemcaminhoneiro.com.br',
            'cpf' => '195.190.200-98',
            'senha' => Hash::make('password'),
            'criado_em' => new Carbon()
        ]);
    }
}
