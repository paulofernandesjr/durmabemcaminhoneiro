<?php

namespace App\Core\Listing;

use Illuminate\Support\Facades\DB;

class LocalListing extends Listing implements InterfaceListing
{
    public function availableColumns()
    {
        return [
            'uuid' => 'locais.uuid',
            'nome' => 'locais.nome',
            'estado_uf' => 'estados.uf',
            'cidade_nome' => 'cidades.nome',
            'vagas' => 'locais.vagas',
            'valor_estadia' => 'locais.valor_estadia',
            'bairro' => 'locais.bairro',
            'logradouro' => 'locais.logradouro',
            'complemento' => 'locais.complemento',
            'numero' => 'locais.numero',
            'banheiros_masculinos' => 'locais.banheiros_masculinos',
            'banheiros_femininos' => 'locais.banheiros_femininos',
            'chuveiros_masculinos' => 'locais.chuveiros_masculinos',
            'chuveiros_femininos' => 'locais.chuveiros_femininos',
            'aceita_reserva' => 'locais.aceita_reserva'
        ];
    }

    public function buildQuery()
    {
        $query = DB::table('locais')
            ->join('estados', 'estados.id', 'locais.estado_id')
            ->join('cidades', 'cidades.id', 'locais.cidade_id');

        if ($this->getFilter('estado_id') && $this->getFilter('estado_id')) {
            $query->where('locais.estado_id', $this->getFilter('estado_id'));
        }

        if ($this->getFilter('cidade_id') && $this->getFilter('cidade_id')) {
            $query->where('locais.cidade_id', $this->getFilter('cidade_id'));
        }

        return $query;
    }
}
