@extends('layouts.app')

@section('title', 'Visualizar local')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('locais.index') }}">Locais</a></li>
<li class="breadcrumb-item active">Visualizar local</li>
@endsection

@section('content')
<div class="main-content container-fluid">
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('locais.index') }}" class="btn btn-space btn-secondary">
                <i class="icon icon-left mdi mdi-arrow-left"></i>
                Voltar
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header card-header-divider">
                    <i class="icon icon-left mdi mdi-gas-station"></i>
                    Visualizar local
                    <span class="card-subtitle">Informações gerais sobre o local.</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{ $local->nome }}</h3>
                            <h6 class="text-muted">{{ $local->cidade->nome }}/{{ $local->estado->nome }}</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content" id="map" data-latitude="{{ $local->latitude }}" data-longitude="{{ $local->longitude }}" style="height: 300px;"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                <li>CEP: {{ $local->cep }}</li>
                                <li>Rodovia: {{ $local->rodovia }}</li>
                                <li>Km: {{ $local->km }}</li>
                                <li>Sentido: {{ $local->sentido }}</li>
                                <li>Bairro: {{ $local->bairro }}</li>
                                <li>Logradouro: {{ $local->logradouro }}</li>
                                <li>Complemento: {!! $local->complemento ? $local->complemento : '<span class="text-danger">Não definido.</span>' !!}</li>
                                <li>Número: {!! $local->numero ? $local->numero : '<span class="text-danger">Não definido.</span>' !!}</li>
                                <li>Latitude: {{ $local->latitude }}</li>
                                <li>Longitude: {{ $local->longitude }}</li>
                                <li>Valor da estádia: {!! $local->valor_estadia ? $local->valor_estadia : '<span class="text-danger">Não definido.</span>' !!}</li>
                                <li>Vagas: {{ $local->vagas }}</li>
                                <li>Chuveiros masculinos: {{ $local->chuveiros_masculinos }}</li>
                                <li>Chuveiros femininos: {{ $local->chuveiros_femininos }}</li>
                                <li>Banheiros masculinos: {{ $local->banheiros_masculinos }}</li>
                                <li>Banheiros femininos: {{ $local->banheiros_femininos }}</li>
                                <li>Aceita reserva: <span class="badge {{ $local->aceita_reserva ? 'badge-success' : 'badge-secondary' }}">{{ $local->aceita_reserva ? 'Sim' : 'Não' }}</span></li>
                                <li>Durma bem caminhoneiro: <span class="badge {{ $local->categoria['durma_bem_caminhoneiro'] ? 'badge-success' : 'badge-secondary' }}">{{ $local->categoria['durma_bem_caminhoneiro'] ? 'Sim' : 'Não' }}</span></li>
                                <li>Apoio CCR: <span class="badge {{ $local->categoria['apoio_ccr'] ? 'badge-success' : 'badge-secondary' }}">{{ $local->categoria['apoio_ccr'] ? 'Sim' : 'Não' }}</span></li>
                                <li>Restaurante: <span class="badge {{ $local->categoria['restaurante'] ? 'badge-success' : 'badge-secondary' }}">{{ $local->categoria['restaurante'] ? 'Sim' : 'Não' }}</span></li>
                                <li>Abastecimento: <span class="badge {{ $local->categoria['abastecimento'] ? 'badge-success' : 'badge-secondary' }}">{{ $local->categoria['abastecimento'] ? 'Sim' : 'Não' }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}&callback=initMap" async defer></script>
<script>
    function initMap() {
        const latitude = $('#map').data('latitude');
        const longitude = $('#map').data('longitude');

        const map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: latitude,
                lng: longitude
            },
            zoom: 16
        });

        new google.maps.Marker({
            position: {
                lat: latitude,
                lng: longitude
            },
            map: map,
            title: 'Hello World!'
        });
    }
</script>
@endsection
