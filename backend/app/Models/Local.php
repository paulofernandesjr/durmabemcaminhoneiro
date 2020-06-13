<?php

namespace App\Models;

use App\Traits\GerarUuid;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use GerarUuid;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    protected $table = 'locais';

    protected $fillable = [
        'nome',
        'cep',
        'estado_id',
        'cidade_id',
        'bairro',
        'logradouro',
        'complemento',
        'numero',
        'sentido',
        'rodovia',
        'km',
        'latitude',
        'longitude',
        'valor_estadia',
        'categoria',
        'vagas',
        'chuveiros_masculinos',
        'chuveiros_femininos',
        'banheiros_masculinos',
        'banheiros_femininos',
        'aceita_reserva',
    ];

    protected $hidden = [
        'id', 'estado_id', 'cidade_id'
    ];

    public function getCategoriaAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getValorEstadiaAttribute($value)
    {
        return str_replace('.', ',', $value);
    }

    public function formataAceitaReserva()
    {
        if ($this->aceita_reserva === 'on') {
            $this->aceita_reserva = true;
        } else {
            $this->aceita_reserva = false;
        }

        return $this;
    }

    public function formataValorEstadia()
    {
        if (!is_null($this->valor_estadia) && $this->valor_estadia !== '') {
            $this->valor_estadia = str_replace(',', '.', $this->valor_estadia);
        } else {
            $this->valor_estadia = null;
        }

        return $this;
    }

    public function formataCategoria($dados)
    {
        $this->categoria = json_encode([
            'durma_bem_caminhoneiro' => array_key_exists('durma_bem_caminhoneiro', $dados) ? $dados['durma_bem_caminhoneiro'] : false,
            'apoio_ccr' => array_key_exists('apoio_ccr', $dados) ? $dados['apoio_ccr'] : false,
            'restaurante' => array_key_exists('restaurante', $dados) ? $dados['restaurante'] : false,
            'abastecimento' => array_key_exists('abastecimento', $dados) ? $dados['abastecimento'] : false,
        ]);

        return $this;
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id', 'id');
    }

    public function cidade()
    {
        return $this->belongsTo('App\Models\Cidade', 'cidade_id', 'id');
    }
}
