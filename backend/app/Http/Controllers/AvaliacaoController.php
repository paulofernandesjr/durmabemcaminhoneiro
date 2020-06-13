<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Local;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function avaliar(Request $request, $localUuid)
    {
        $local = Local::where('uuid', $localUuid)
            ->firstOrFail();

        return Avaliacao::create([
            'motorista_id' => auth()->user()->id,
            'local_id' => $local->id,
            'nota' => $request->get('nota')
        ]);
    }
}
