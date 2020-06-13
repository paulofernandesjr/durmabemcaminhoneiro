@extends('layouts.login')

@section('content')
<div class="splash-container">
    <div class="card card-border-color card-border-color-primary">
        <div class="card-header">
            <img class="logo-img" src="{{ asset('img/logo.png') }}" alt="logo" width="102">
            <span class="splash-description">Por favor, insira suas informações de usuário.</span>
        </div>
        <div class="card-body">
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input class="form-control" id="cpf" name="cpf" type="text" placeholder="CPF" data-mask="999.999.999-99" autocomplete="off">

                    @if ($errors->has('cpf'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('cpf') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input class="form-control" id="password" type="password" name="password" placeholder="Senha">

                    @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group row login-tools">
                    <div class="col-6 login-remember">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="remember" type="checkbox">
                            <span class="custom-control-label">Manter conectado</span>
                        </label>
                    </div>
                    <div class="col-6 login-forgot-password">
                        <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                    </div>
                </div>
                <div class="form-group login-submit">
                    <button type="submit" class="btn btn-primary btn-xl">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
