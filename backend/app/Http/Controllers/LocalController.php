<?php

namespace App\Http\Controllers;

use App\Core\Listing\LocalListing;
use App\Http\Requests\LocalRequest;
use App\Models\Estado;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locais = LocalListing::new()
            ->setFilters($request->all())
            ->setColumns([
                'uuid',
                'nome',
                'estado_uf',
                'cidade_nome'
            ])
            ->setOrders([
                'nome' => 'asc'
            ])
            ->paginate();

        return response()->view('locais.listagem', ['locais' => $locais]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::orderBy('uf', 'asc')
            ->get();

        return response()->view('locais.inserir-editar', ['estados' => $estados]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LocalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalRequest $request)
    {
        (new Local($request->validated()))
            ->formataAceitaReserva()
            ->formataValorEstadia()
            ->formataTags($request->validated())
            ->save();

        $request->session()->flash('success', 'O local foi cadastrado com sucesso!');

        return redirect()->route('locais.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $local = Local::with(['estado', 'cidade'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        return response()->view('locais.visualizar', ['local' => $local]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $local = Local::where('uuid', $uuid)
            ->firstOrFail();

        $estados = Estado::orderBy('uf', 'asc')
            ->get();

        return response()->view('locais.inserir-editar', ['local' => $local, 'estados' => $estados]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LocalRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalRequest $request, $uuid)
    {
        $local = Local::where('uuid', $uuid)
            ->firstOrFail();

        $local->fill($request->validated())
            ->formataAceitaReserva()
            ->formataValorEstadia()
            ->formataTags($request->validated())
            ->save();

        $request->session()->flash('success', 'O local foi atualizado com sucesso!');

        return redirect()->route('locais.index');
    }
}
