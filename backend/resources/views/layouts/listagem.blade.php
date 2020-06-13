@extends('layouts.app')

@section('title', $nomePlural)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">{{ $nomePlural }}</li>
@endsection

@section('content')
<div class="main-content container-fluid">
    @if (isset($prefixoRota))
    <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-space btn-primary" href="{{ route($prefixoRota.'.create') }}">
                <i class="icon icon-left mdi mdi-{{ $icon }}"></i>
                Cadastrar um novo {{ $nomeSingular }}
            </a>
        </div>
    </div>
    @endif
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-table">
                @if ($filtros)
                @yield('filtros')
                @endif
                <div class="card-header">
                    <i class="icon icon-left mdi mdi-{{ $icon }}"></i>
                    {{ $nomePlural }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                @yield('cabecario')
                            </tr>
                        </thead>
                        <tbody>
                            @yield('linhas')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $entidade->links() }}
        </div>
    </div>
</div>
@endsection
@if (session('success'))

@include('components.notification', ['message' => session('success')])

@endif
