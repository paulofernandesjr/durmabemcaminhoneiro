<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Models\Local;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
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
