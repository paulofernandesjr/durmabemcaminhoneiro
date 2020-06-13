<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Ramsey\Uuid\Uuid;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->delete();

        DB::table('estados')->insert([
            ['id' => 1, 'uuid' => Uuid::uuid4(), 'nome' => 'Acre', 'uf' => 'AC'],
            ['id' => 2, 'uuid' => Uuid::uuid4(), 'nome' => 'Alagoas', 'uf' => 'AL'],
            ['id' => 3, 'uuid' => Uuid::uuid4(), 'nome' => 'Amapá', 'uf' => 'AP'],
            ['id' => 4, 'uuid' => Uuid::uuid4(), 'nome' => 'Amazonas', 'uf' => 'AM'],
            ['id' => 5, 'uuid' => Uuid::uuid4(), 'nome' => 'Bahia', 'uf' => 'BA'],
            ['id' => 6, 'uuid' => Uuid::uuid4(), 'nome' => 'Ceará', 'uf' => 'CE'],
            ['id' => 7, 'uuid' => Uuid::uuid4(), 'nome' => 'Distrito Federal', 'uf' => 'DF'],
            ['id' => 8, 'uuid' => Uuid::uuid4(), 'nome' => 'Espírito Santo', 'uf' => 'ES'],
            ['id' => 9, 'uuid' => Uuid::uuid4(), 'nome' => 'Goiás', 'uf' => 'GO'],
            ['id' => 10, 'uuid' => Uuid::uuid4(), 'nome' => 'Maranhão', 'uf' => 'MA'],
            ['id' => 11, 'uuid' => Uuid::uuid4(), 'nome' => 'Mato Grosso', 'uf' => 'MT'],
            ['id' => 12, 'uuid' => Uuid::uuid4(), 'nome' => 'Mato Grosso do Sul', 'uf' => 'MS'],
            ['id' => 13, 'uuid' => Uuid::uuid4(), 'nome' => 'Minas Gerais', 'uf' => 'MG'],
            ['id' => 14, 'uuid' => Uuid::uuid4(), 'nome' => 'Pará', 'uf' => 'PA'],
            ['id' => 15, 'uuid' => Uuid::uuid4(), 'nome' => 'Paraíba', 'uf' => 'PB'],
            ['id' => 16, 'uuid' => Uuid::uuid4(), 'nome' => 'Paraná', 'uf' => 'PR'],
            ['id' => 17, 'uuid' => Uuid::uuid4(), 'nome' => 'Pernambuco', 'uf' => 'PE'],
            ['id' => 18, 'uuid' => Uuid::uuid4(), 'nome' => 'Piauí', 'uf' => 'PI'],
            ['id' => 19, 'uuid' => Uuid::uuid4(), 'nome' => 'Rio de Janeiro', 'uf' => 'RJ'],
            ['id' => 20, 'uuid' => Uuid::uuid4(), 'nome' => 'Rio Grande do Norte', 'uf' => 'RN'],
            ['id' => 21, 'uuid' => Uuid::uuid4(), 'nome' => 'Rio Grande do Sul', 'uf' => 'RS'],
            ['id' => 22, 'uuid' => Uuid::uuid4(), 'nome' => 'Rondônia', 'uf' => 'RO'],
            ['id' => 23, 'uuid' => Uuid::uuid4(), 'nome' => 'Roraima', 'uf' => 'RR'],
            ['id' => 24, 'uuid' => Uuid::uuid4(), 'nome' => 'Santa Catarina', 'uf' => 'SC'],
            ['id' => 25, 'uuid' => Uuid::uuid4(), 'nome' => 'São Paulo', 'uf' => 'SP'],
            ['id' => 26, 'uuid' => Uuid::uuid4(), 'nome' => 'Sergipe', 'uf' => 'SE'],
            ['id' => 27, 'uuid' => Uuid::uuid4(), 'nome' => 'Tocantins', 'uf' => 'TO'],
        ]);
    }
}
