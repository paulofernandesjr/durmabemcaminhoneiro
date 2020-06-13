<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'cep' => 'required|formato_cep',
            'estado_id' => 'required|integer',
            'cidade_id' => 'required|integer',
            'rodovia' => 'required',
            'km' => 'required',
            'sentido' => 'required',
            'bairro' => 'required',
            'logradouro' => 'required',
            'complemento' => '',
            'numero' => '',
            'latitude' => 'required',
            'longitude' => 'required',
            'aceita_reserva' => '',
            'valor_estadia' => 'required_if:aceita_reserva,==,on|nullable|regex:/^\d+(\,\d{1,2})?$/',
            'vagas' => 'required|integer',
            'chuveiros_masculinos' => 'required|integer|min:0',
            'chuveiros_femininos' => 'required|integer|min:0',
            'banheiros_masculinos' => 'required|integer|min:0',
            'banheiros_femininos' => 'required|integer|min:0',
            'durma_bem_caminhoneiro' => '',
            'apoio_ccr' => '',
            'abastecimento' => '',
            'restaurante' => '',
            'abastecimento' => ''
        ];
    }

    public function attributes()
    {
        return [
            'estado_id' => 'estado',
            'cidade_id' => 'cidade',
            'valor_estadia' => 'valor da estádia',
            'numero' => 'número'
        ];
    }
}
