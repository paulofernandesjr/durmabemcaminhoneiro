<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function listar()
    {
        return Estado::orderBy('uf', 'asc')
            ->select('uf', 'id')
            ->get();
    }
}
