<?php

namespace App\Models;

use App\Traits\GerarUuid;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use GerarUuid;

    CONST CREATED_AT = 'criado_em';
    CONST UPDATED_AT = 'atualizado_em';

    CONST AGUARDANDO_MOTORISTA = 'Aguardando motorista';
    const CANCELADA = 'Cancelada';
    const MOTORISTA_CHEGOU = 'Motorista chegou';

    protected $table = 'reservas';

    protected $fillable = [
        'status',
        'data_chegada_em',
        'data_saida_em',
        'motorista_id',
        'local_id'
    ];

    protected $hidden = [
        'id',
        'motorista_id',
        'local_id'
    ];
}
