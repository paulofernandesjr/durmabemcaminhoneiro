<?php

namespace App\Http\Controllers;

use App\Core\Listing\ReservaListing;
use App\Http\Requests\ReservaRequest;
use App\Models\Local;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function reservas(Request $request)
    {
        return ReservaListing::new()
            ->setFilters($request->all())
            ->setColumns([
                'uuid',
                'data_chegada_em',
                'data_saida_em',
                'nome',
                'estado_uf',
                'cidade_nome',
                'rodovia',
                'km',
                'tags',
                'valor_estadia',
                'latitude',
                'longitude',
            ])
            ->map(function ($local) {
                $local->data_chegada_em = (new Carbon($local->data_chegada_em))->format('d/m/Y H:i');
                $local->data_saida_em = (new Carbon($local->data_saida_em))->format('d/m/Y H:i');
                $local->valor_estadia = str_replace('.', ',', $local->valor_estadia);
                $local->tags = json_decode($local->tags, true);

                return $local;
            })
            ->setOrders([
                'data_chegada_em' => 'asc',
                'data_saida_em' => 'asc'
            ])
            ->collect();
    }

    public function reservar(ReservaRequest $request, $localUuid)
    {
        $local = Local::where('uuid', $localUuid)
            ->firstOrFail();

        $this->authorize('reservar', [new Reserva(), $local, $request]);

        return Reserva::create(array_merge($request->validated(), ['motorista_id' => auth()->user()->id, 'local_id' => $local->id]));
    }

    public function verificarDisponibilidade($vagas, $quantidadeReservada)
    {
        return $vagas > $quantidadeReservada;
    }

    public function validarData($dataChegada, $dataSaida)
    {
        return $dataChegada->gt(new Carbon) && $dataSaida->gt($dataChegada);
    }

    public function quantidadeReservada($local, $dataChegada, $dataSaida)
    {
        return Reserva::where('local_id', $local->id)
            ->where(function ($query) use ($dataChegada, $dataSaida) {
                $query->where('data_chegada_em', '>=', $dataChegada)
                    ->where('data_chegada_em', '>', $dataSaida);
            })
            ->orWhere(function ($query) use ($dataChegada) {
                $query->where('data_chegada_em', '<=', $dataChegada)
                    ->where('data_saida_em', '>', $dataChegada);
            })
            ->count();
    }
}
