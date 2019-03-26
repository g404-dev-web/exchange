@extends('layouts.fullwidth')

@section('content')

    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <h2>Reset Password</h2>
                <hr>
                <form method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-group py-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text label" id="basic-addon1">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        <input class="form-control input-connexion" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus aria-describedby="basic-addon1">
                        @if($errors->has('email'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="input-group py-2 {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text label" id="basic-addon2">
                                <i class="fas fa-fingerprint"></i>
                            </span>
                        </div>
                        <input class="form-control input-connexion" type="password" name="password" placeholder="Mot de passe" required aria-describedby="basic-addon2">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group py-3 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text label" id="basic-addon3">
                                <i class="fas fa-fingerprint"></i>
                            </span>
                        </div>
                        <input class="form-control input-connexion" type="password" name="password_confirmation" placeholder="Répéter le mot de passe" required aria-describedby="basic-addon3">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="pb-3 pt-4">
                        <input type="submit" value="Enregistrer le nouveau mot de passe" class="btn-custom btn btn-block colorBackgroundSimplon ">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
