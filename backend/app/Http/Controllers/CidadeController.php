<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function listarCidadesPorEstado(Request $request)
    {
        return Cidade::where('estado_id', $request->get('estado_id'))
            ->get();
    }
}
