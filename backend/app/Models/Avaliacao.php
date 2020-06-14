<?php

namespace App\Models;

use App\Traits\GerarUuid;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use GerarUuid;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    protected $table = 'avaliacoes';

    protected $fillable = [
        'nota',
        'motorista_id',
        'local_id'
    ];

    protected $hidden = [
        'id',
        'motorista_id',
        'local_id'
    ];
}
