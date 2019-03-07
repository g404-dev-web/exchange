@extends('layouts.fullwidth')

@section('title', 'Connexion')

@section('content')

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="card-title colorTextSimplon">Se connecter</h3>
                    <hr>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="input-group py-3">
                            <div class="input-group-prepend ">
                                <span class="input-group-text label">
                                    <i class="fas fa-envelope "></i>
                                </span>
                            </div>
                            <input class="form-control input-connexion" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus aria-describedby="basic-addon1">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group py-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text label">
                                    <i class="fas fa-fingerprint "></i>
                                </span>
                            </div>
                            <input class="form-control input-connexion" type="password" name="password" placeholder="Mot de passe" required aria-describedby="basic-addon1">
                            <div class="input-group-append addonsPretendLogin radiusRightBtn">
                                <span class="input-group-text label ">
                                    <a class="colorTextWhite noTextDecoration" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                </span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="mb-2">
                            <input type="submit" value="Connexion" class="btn-custom btn btn-block colorBackgroundSimplon ">
                        </div>
                        <div class="custom-control custom-checkbox colorTextSimplon">
                            <input type="checkbox" class="custom-control-input" name="remember {{ old('remember') ? 'checked' : '' }}" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Se rappeler de moi</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 ">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="card-title colorTextSimplon">S'enregistrer</h3>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravdio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequa. Vivamus vulputate posuere nisl quis consequat.</p>
                    <a href="{{ url('/register') }}" class=" text-center btn btn-custom btn-block colorBackgroundSimplon">Créer un compte</a> 
                </div>
            </div>
        </div>
    </div>

@endsection
