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
            'rodovia' => 'locais.rodovia',
            'km' => 'locais.km',
            'aceita_reserva' => 'locais.aceita_reserva',
            'valor_estadia' => 'locais.valor_estadia',
            'tags' => 'locais.tags',
            'vagas_disponiveis' => DB::raw($this->vagasDisponiveisSql())
        ];
    }

    public function buildQuery()
    {
        $query = DB::table('locais')
            ->join('estados', 'estados.id', 'locais.estado_id')
            ->join('cidades', 'cidades.id', 'locais.cidade_id');

        if ($this->hasFilter('rodovia') && $this->getFilter('rodovia')) {
            $query->where('locais.rodovia', $this->getFilter('rodovia'));
        }

        if ($this->hasFilter('sentido') && $this->getFilter('sentido')) {
            $query->where('locais.sentido', $this->getFilter('sentido'));
        }

        if ($this->hasFilter('estado') && $this->getFilter('estado')) {
            $query->where('estados.uf', $this->getFilter('estado'));
        }

        if ($this->hasFilter('data_chegada_em') && $this->getFilter('data_chegada_em') && 
            $this->hasFilter('data_saida_em') && $this->getFilter('data_saida_em')
        ) {
            $query->where(function ($query) {
                $query->where('aceita_reserva', false)
                    ->orWhereRaw($this->vagasDisponiveisSql().' > 0');
            });
        }

        return $query;
    }

    public function vagasDisponiveisSql()
    {
        $dataChegada = $this->getFilter('data_chegada_em');
        $dataSaida = $this->getFilter('data_chegada_em');

        return '(locais.vagas - (SELECT COUNT(reservas.id) FROM reservas WHERE 
            reservas.local_id = locais.id and 
            (
                (data_chegada_em >= \''.$dataChegada.'\' and data_saida_em > \''.$dataSaida.'\')
                or (data_chegada_em <= \''.$dataChegada.'\' and data_saida_em > \''.$dataChegada.'\')
            )
        ))';
    }
}
