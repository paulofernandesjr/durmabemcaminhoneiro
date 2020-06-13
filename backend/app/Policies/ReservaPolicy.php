<?php

namespace App\Policies;

use App\Http\Controllers\ReservaController;
use App\Models\Local;
use App\Models\Motorista;
use App\Models\Reserva;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class ReservaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function reservar(Motorista $motorista, Reserva $reserva, Local $local, Request $request)
    {
        $dataChegadaDesejada = new Carbon($request->validated()['data_chegada_em']);
        $dataSaidaDesejada = new Carbon($request->validated()['data_saida_em']);
        $quantidadeReservada = (new ReservaController)->quantidadeReservada($local, $dataChegadaDesejada, $dataSaidaDesejada);

        return (new ReservaController)->validarData($dataChegadaDesejada, $dataSaidaDesejada) &&
            (new ReservaController)->verificarDisponibilidade($local->vagas, $quantidadeReservada);
    }
}
