@extends('layouts.app')

@section('title', !isset($entidade) ? 'Cadastrar '.$nomeSingular : 'Atualizar '.$nomeSingular)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route($prefixoRota.'.index') }}">{{ $nomePlural }}</a></li>
<li class="breadcrumb-item active">{{ !isset($entidade) ? 'Cadastrar '.$nomeSingular : 'Atualizar '.$nomeSingular }}</li>
@endsection

@section('content')
<div class="main-content container-fluid">
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route($prefixoRota.'.index') }}" class="btn btn-space btn-secondary">
                <i class="icon icon-left mdi mdi-arrow-left"></i>
                Voltar
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header card-header-divider">
                    <i class="icon icon-left mdi mdi-{{ $icon }}"></i>
                    {{ !isset($entidade) ? 'Cadastrar '.$nomeSingular : 'Atualizar '.$nomeSingular }}
                    <span class="card-subtitle">Preencha os dados abaixo para {{ !isset($entidade) ? 'cadastrar' : 'atualizar' }} um {{ $nomeSingular }}.</span>
                </div>
                <div class="card-header-divider">
                    <span class="card-subtitle">Legenda: <span class="text-danger">*</span> Campos obrigatórios</span>
                </div>
                <div class="card-body">
                    <form action="{{ isset($entidade) ? route($prefixoRota.'.update', $entidade->uuid) : route($prefixoRota.'.store') }}" method="POST">
                        {{ csrf_field() }}
                        {{ isset($entidade) ? method_field('PUT') : '' }}

                        @yield('campos')
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-space btn-primary">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
