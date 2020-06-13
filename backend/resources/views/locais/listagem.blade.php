@extends('layouts.listagem', ['nomeSingular' => 'local', 'nomePlural' => 'Locais', 'prefixoRota' => 'locais', 'entidade' => $locais, 'icon' => 'gas-station', 'filtros' => false])

@section('cabecario')
<th>Nome</th>
<th>Estado</th>
<th>Cidade</th>
<th class="actions"></th>
@endsection

@section('linhas')
@forelse ($locais as $local)
<tr>
    <td>{{ $local->nome }}</td>
    <td>{{ $local->estado_uf }}</td>
    <td>{{ $local->cidade_nome }}</td>
    <td class="actions">
        <div class="btn-group btn-hspace">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">Ações <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="{{ route('locais.show', $local->uuid) }}"><i class="mdi mdi-eye"></i> Visualizar</a>
                <a class="dropdown-item" href="{{ route('locais.edit', $local->uuid) }}"><i class="mdi mdi-edit"></i> Atualizar</a>
            </div>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center">Nenhum registro encontrado!</td>
</tr>
@endforelse
@endsection
