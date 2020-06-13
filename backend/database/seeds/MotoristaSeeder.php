<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class MotoristaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motoristas')->insert([
            [
                'uuid' => Uuid::uuid4(),
                'nome' => 'Durma bem caminhoneiro',
                'cpf' => '111.111.111-11',
                'celular' => '11111111111',
                'email' => 'anonimo@durmabemcaminhoneiro.com.br',
                'senha' => Hash::make('password'),
                'criado_em' => new Carbon()
            ]
        ]);
    }
}
