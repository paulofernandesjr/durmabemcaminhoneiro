@extends('layouts.form', ['entidade' => isset($local) ? $local : null, 'nomeSingular' => 'local', 'nomePlural' => 'Locais', 'prefixoRota' => 'locais', 'icon' => 'gas-station'])

@section('campos')
<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="nome">Nome <span class="text-danger">*</span></label>
        <input class="form-control @error('nome') is-invalid @enderror" id="nome" type="text" name="nome" placeholder="Nome do local" value="{{ $local->nome ?? old('nome') }}">

        @if ($errors->has('nome'))
        <span class="text-danger">
            <strong>{{ $errors->first('nome') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="cep">CEP <span class="text-danger">*</span></label>
        <input class="form-control @error('cep') is-invalid @enderror" id="cep" type="text" name="cep" placeholder="CEP" data-mask="99999-999" autocomplete="off" value="{{ $local->cep ?? old('cep') }}">

        @if ($errors->has('cep'))
        <span class="text-danger">
            <strong>{{ $errors->first('cep') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="estado">Estado <span class="text-danger">*</span></label>
        <select class="form-control @error('estado_id') is-invalid @enderror" name="estado_id" id="estado">
            <option value="" disabled selected>Selecione um estado</option>
            @foreach ($estados as $estado)
            <option value="{{ $estado->id }}" {{ (isset($local) && $local->estado_id == $estado->id) || old('estado_id') == $estado->id ? 'selected' : '' }}>{{ $estado->uf }}</option>
            @endforeach
        </select>

        @if ($errors->has('estado_id'))
        <span class="text-danger">
            <strong>{{ $errors->first('estado_id') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="cidade">Cidade <span class="text-danger">*</span></label>
        <select class="form-control @error('cidade_id') is-invalid @enderror" name="cidade_id" id="cidade">
            <option value="" disabled selected>Selecione um estado antes</option>
        </select>

        @if ($errors->has('cidade_id'))
        <span class="text-danger">
            <strong>{{ $errors->first('cidade_id') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="rodovia">Rodovia <span class="text-danger">*</span></label>
        <input type="text" name="rodovia" id="rodovia" class="form-control @error('rodovia') is-invalid @enderror" placeholder="Ex: 30" value="{{ $local->rodovia ?? old('rodovia') }}">

        @if ($errors->has('rodovia'))
        <span class="text-danger">
            <strong>{{ $errors->first('rodovia') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="km">Km <span class="text-danger">*</span></label>
        <input type="text" name="km" id="km" class="form-control @error('km') is-invalid @enderror" placeholder="Ex: 30" value="{{ $local->km ?? old('km') }}">

        @if ($errors->has('km'))
        <span class="text-danger">
            <strong>{{ $errors->first('km') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="sentido">Sentido <span class="text-danger">*</span></label>
        <select class="form-control @error('sentido') is-invalid @enderror" name="sentido" id="sentido">
            <option value="">Selecione o sentido da via</option>
            <option value="norte" {{ (isset($local) && $local->sentido == 'norte') || old('sentido') == 'norte' ? 'selected' : '' }}>Norte</option>
            <option value="nordeste" {{ (isset($local) && $local->sentido == 'nordeste') || old('sentido') == 'nordeste' ? 'selected' : '' }}>Nordeste</option>
            <option value="noroeste" {{ (isset($local) && $local->sentido == 'noroeste') || old('sentido') == 'noroeste' ? 'selected' : '' }}>Noroeste</option>
            <option value="sul" {{ (isset($local) && $local->sentido == 'sul') || old('sentido') == 'sul' ? 'selected' : '' }}>Sul</option>
            <option value="sudeste" {{ (isset($local) && $local->sentido == 'sudeste') || old('sentido') == 'sudeste' ? 'selected' : '' }}>Sudeste</option>
            <option value="sudoeste" {{ (isset($local) && $local->sentido == 'sudoeste') || old('sentido') == 'sudoeste' ? 'selected' : '' }}>Sudoeste</option>
            <option value="leste" {{ (isset($local) && $local->sentido == 'leste') || old('sentido') == 'leste' ? 'selected' : '' }}>Leste</option>
            <option value="oeste" {{ (isset($local) && $local->sentido == 'oeste') || old('sentido') == 'oeste' ? 'selected' : '' }}>Oeste</option>
        </select>

        @if ($errors->has('sentido'))
        <span class="text-danger">
            <strong>{{ $errors->first('sentido') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="bairro">Bairro <span class="text-danger">*</span></label>
        <input type="text" name="bairro" id="bairro" class="form-control @error('bairro') is-invalid @enderror" placeholder="Ex: Consolação" value="{{ $local->bairro ?? old('bairro') }}">

        @if ($errors->has('bairro'))
        <span class="text-danger">
            <strong>{{ $errors->first('bairro') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="logradouro">Logradouro <span class="text-danger">*</span></label>
        <input type="text" name="logradouro" id="logradouro" class="form-control @error('logradouro') is-invalid @enderror" placeholder="Ex: Avenida Paulista" value="{{ $local->logradouro ?? old('logradouro') }}">

        @if ($errors->has('logradouro'))
        <span class="text-danger">
            <strong>{{ $errors->first('logradouro') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="complemento">Complemento </label>
        <input type="text" name="complemento" id="complemento" class="form-control @error('complemento') is-invalid @enderror" placeholder="Ex: Apto" value="{{ $local->complemento ?? old('complemento') }}">

        @if ($errors->has('complemento'))
        <span class="text-danger">
            <strong>{{ $errors->first('complemento') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="numero">Número</label>
        <input type="number" name="numero" id="numero" class="form-control @error('numero') is-invalid @enderror" placeholder="Ex: 30" value="{{ $local->numero ?? old('numero') }}">

        @if ($errors->has('numero'))
        <span class="text-danger">
            <strong>{{ $errors->first('numero') }}</strong>
        </span>
        @endif
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Para ajustar o local com precisao clique no icone e arraste para o local desejado.</label>
        <div class="content" id="map" style="height: 300px;" data-latitude="{{ isset($local) ? $local->latitude : '' }}" data-longitude="{{ isset($local) ? $local->longitude : '' }}"></div>
    </div>
</div>
<hr>
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="valor-estadia">Valor da estádia <span class="text-danger d-none" id="valor-estadia-span">*</span></label>
        <input type="text" name="valor_estadia" id="valor-estadia" class="form-control @error('valor_estadia') is-invalid @enderror" data-mask="000.000.000.000,00" data-mask-reverse="true" placeholder="Ex: 100,00" value="{{ $local->valor_estadia ?? old('valor_estadia') }}">

        @if ($errors->has('valor_estadia'))
        <span class="text-danger">
            <strong>{{ $errors->first('valor_estadia') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-1">
        <label for="vagas">Vagas <span class="text-danger">*</span></label>
        <input type="number" name="vagas" id="vagas" class="form-control @error('vagas') is-invalid @enderror" placeholder="Ex: 100" value="{{ $local->vagas ?? old('vagas') }}">

        @if ($errors->has('vagas'))
        <span class="text-danger">
            <strong>{{ $errors->first('vagas') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-2">
        <label for="chuveiros-masculinos">Chuveiros masculinos <span class="text-danger">*</span></label>
        <input type="number" name="chuveiros_masculinos" id="chuveiros-masculinos" class="form-control @error('chuveiros_masculinos') is-invalid @enderror" placeholder="Ex: 5" value="{{ $local->chuveiros_masculinos ?? old('chuveiros_masculinos') }}">

        @if ($errors->has('chuveiros_masculinos'))
        <span class="text-danger">
            <strong>{{ $errors->first('chuveiros_masculinos') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-2">
        <label for="chuveiros-femininos">Chuveiros femininos <span class="text-danger">*</span></label>
        <input type="number" name="chuveiros_femininos" id="chuveiros-femininos" class="form-control @error('chuveiros_femininos') is-invalid @enderror" placeholder="Ex: 8" value="{{ $local->chuveiros_femininos ?? old('chuveiros_femininos') }}">

        @if ($errors->has('chuveiros_femininos'))
        <span class="text-danger">
            <strong>{{ $errors->first('chuveiros_femininos') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-2">
        <label for="banheiros-masculinos">Banheiros masculinos <span class="text-danger">*</span></label>
        <input type="number" name="banheiros_masculinos" id="banheiros-masculinos" class="form-control @error('banheiros_masculinos') is-invalid @enderror" placeholder="Ex: 2" value="{{ $local->banheiros_masculinos ?? old('banheiros_masculinos') }}">

        @if ($errors->has('banheiros_masculinos'))
        <span class="text-danger">
            <strong>{{ $errors->first('banheiros_masculinos') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-2">
        <label for="banheiros-femininos">Banheiros femininos <span class="text-danger">*</span></label>
        <input type="number" name="banheiros_femininos" id="banheiros-femininos" class="form-control @error('banheiros_femininos') is-invalid @enderror" placeholder="Ex: 3" value="{{ $local->banheiros_femininos ?? old('banheiros_femininos') }}">

        @if ($errors->has('banheiros_femininos'))
        <span class="text-danger">
            <strong>{{ $errors->first('banheiros_femininos') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <label>Aceita reserva online?</label>
        <div class="switch-button switch-button-yesno">
            <input type="checkbox" name="aceita_reserva" id="aceita-reserva" {{ (isset($local) && $local->aceita_reserva) || old('aceita_reserva') == 'on' ? 'checked' : '' }}><span>
                <label for="aceita-reserva"></label></span>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label>Durma bem caminhoneiro?</label>
        <div class="switch-button switch-button-yesno">
            <input type="checkbox" name="durma_bem_caminhoneiro" id="durma-bem-caminhoneiro" {{ (isset($local) && $local->categoria['durma_bem_caminhoneiro']) || old('durma_bem_caminhoneiro') == 'on' ? 'checked' : '' }}><span>
                <label for="durma-bem-caminhoneiro"></label></span>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label>Apoio da CCR?</label>
        <div class="switch-button switch-button-yesno">
            <input type="checkbox" name="apoio_ccr" id="apoio-ccr" {{ (isset($local) && $local->categoria['apoio_ccr']) || old('apoio_ccr') == 'on' ? 'checked' : '' }}><span>
                <label for="apoio-ccr"></label></span>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label>Restaurante?</label>
        <div class="switch-button switch-button-yesno">
            <input type="checkbox" name="restaurante" id="restaurante" {{ (isset($local) && $local->categoria['restaurante']) || old('restaurante') == 'on' ? 'checked' : '' }}><span>
                <label for="restaurante"></label></span>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label>Abastecimento?</label>
        <div class="switch-button switch-button-yesno">
            <input type="checkbox" name="abastecimento" id="abastecimento" {{ (isset($local) && $local->categoria['abastecimento']) || old('abastecimento') == 'on' ? 'checked' : '' }}><span>
                <label for="abastecimento"></label></span>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}&callback=initMap" async defer></script>
<script>
    let map;
    let markers = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -13.7025048,
                lng: -69.6903341
            },
            zoom: 4
        });
    }

    // Adds a marker to the map and push to the array.
    function addMarker(location = null, latLng = null) {
        deleteMarkers();

        const marker = new google.maps.Marker({
            position: location ? location : latLng,
            map: map,
            draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function() {
            document.getElementsByName('latitude')[0].value = marker.getPosition().lat();
            document.getElementsByName('longitude')[0].value = marker.getPosition().lng();
        })

        markers.push(marker);

        $('#latitude').val(marker.getPosition().lat());
        $('#longitude').val(marker.getPosition().lng());
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setMapOnAll(null);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }
</script>
<script>
    $(document).ready(function() {
        if ($('#cep').val().length === 9 || $('#cep').val().length === 10) {
            procurarEnderecoPorCep();
        }

        if ($('#estado').val() !== '' && $('#estado').val() !== null && $('#cep').val() === '') {
            listarCidadesPorEstado($('#estado').val())
                .then(() => {
                    if (@JSON(old('cidade_id')) || @JSON(isset($local) ? $local->cidade_id : null)) {
                        $('#cidade').val(@JSON(old('cidade_id')) ? @JSON(old('cidade_id')) : @JSON(isset($local) ? $local->cidade_id : null));
                    }
                });
        }
    });

    $('#aceita-reserva').change(function() {
        if ($('#aceita-reserva').is(':checked')) {
            $('#valor-estadia-span').removeClass('d-none');
        } else {
            $('#valor-estadia-span').addClass('d-none');
        }
    });

    $('#cep').on('change', function() {
        if ($('#cep').val().length === 9 || $('#cep').val().length === 10) {
            procurarEnderecoPorCep();
        } else {
            alert('O CEP é inválido!');
        }
    });

    $('#estado').on('change', function() {
        listarCidadesPorEstado($('#estado').val());
    });

    $('#logradouro').on('change', function() {
        pegarLatitudeLongitude($('#logradouro').val(), $('#cidade option[value="' + $('#cidade').val() + '"]').text());
    });

    function procurarEnderecoPorCep() {
        fetch('https://viacep.com.br/ws/' + $('#cep').val().replace('-', '').replace('.', '') + '/json/')
            .then(response => {
                if (response.status === 200) {
                    response.json()
                        .then(data => {
                            $.each($('#estado option'), function() {
                                if ($(this).text() === data.uf) {
                                    $('#estado').val($(this).val());

                                    listarCidadesPorEstado($('#estado').val())
                                        .then(() => {
                                            $.each($('#cidade option'), function() {
                                                if ($(this).text() === data.localidade) {
                                                    $('#cidade').val($(this).val());
                                                }
                                            });
                                        });
                                }
                            });

                            $('#bairro').val(data.bairro);
                            $('#logradouro').val(data.logradouro);

                            if ($('#map').data('latitude') && $('#map').data('longitude')) {
                                addMarker(null, {
                                    lat: $('#map').data('latitude'),
                                    lng: $('#map').data('longitude')
                                });
                                const latLng = new google.maps.LatLng($('#map').data('latitude'), $('#map').data('longitude'));
                                map.setCenter(latLng);
                                map.setZoom(16);

                                $('#map').data('latitude', '');
                                $('#map').data('longitude', '');
                            } else {
                                pegarLatitudeLongitude(data.logradouro, data.localidade);
                            }
                        });
                } else {
                    alert('O CEP não foi encontrado!');
                }
            });
    }

    function listarCidadesPorEstado(estadoId) {
        const url = new URL(@JSON(env('APP_URL')) + '/api/cidades/listar_por_estado');
        url.searchParams.append('estado_id', estadoId);

        return new Promise((resolve, reject) => {
            fetch(url)
                .then(response => {
                    if (response.status === 200) {
                        response.json()
                            .then(data => {
                                $('#cidade').html('<option value="">Selecione uma cidade</option>');

                                data.forEach(cidade => {
                                    $('#cidade').append('<option value="' + cidade.id + '">' + cidade.nome + '</option>')
                                });

                                return resolve();
                            });
                    } else {
                        alert('Não foi possível encontrar as cidades do estado escolhido.');

                        return reject();
                    }
                });
        });
    }

    function pegarLatitudeLongitude(endereco, cidade) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'address': endereco + ', ' + cidade,
            'region': 'br'
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                results.forEach(apiEndereco => {
                    if (apiEndereco.address_components[0].long_name.toLowerCase().trim() === endereco.toLowerCase().trim()) {
                        $('#latitude').val(apiEndereco.geometry.location.lat());
                        $('#longitude').val(apiEndereco.geometry.location.lng());

                        addMarker(null, {
                            lat: apiEndereco.geometry.location.lat(),
                            lng: apiEndereco.geometry.location.lng()
                        });

                        const latLng = new google.maps.LatLng(apiEndereco.geometry.location.lat(), apiEndereco.geometry.location.lng());
                        map.setCenter(latLng);
                        map.setZoom(16);
                    } else {
                        alert('Não foi possível encontrar o endereço no mapa, por favor, encontre o endereço no mapa!')
                    }
                });
            }
        });
    }
</script>
@endsection