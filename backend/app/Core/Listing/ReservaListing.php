<?php

namespace App\Core\Listing;

use Illuminate\Support\Facades\DB;

class ReservaListing extends Listing implements InterfaceListing
{
    public function availableColumns()
    {
        return [
            'uuid' => 'reservas.uuid',
            'data_chegada_em' => 'reservas.data_chegada_em',
            'data_saida_em' => 'reservas.data_saida_em',
            'nome' => 'locais.nome',
            'estado_uf' => 'estados.uf',
            'cidade_nome' => 'cidades.nome',
            'rodovia' => 'locais.rodovia',
            'km' => 'locais.km',
            'tags' => 'locais.tags',
            'latitude' => 'locais.latitude',
            'longitude' => 'locais.longitude',
        ];
    }

    public function buildQuery()
    {
        $query = DB::table('reservas')
            ->join('locais', 'locais.id', 'reservas.local_id')
            ->join('estados', 'estados.id', 'locais.estado_id')
            ->join('cidades', 'cidades.id', 'locais.cidade_id')
            ->where('reservas.motorista_id', auth()->user()->id);

        return $query;
    }
}
