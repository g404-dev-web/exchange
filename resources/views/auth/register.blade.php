@extends('layouts.fullwidth')

@section('title', 'Inscription')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="card-title colorTextSimplon">Enregistrement</h3>
                    <hr>
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        {{ csrf_field() }}
                        <div class="input-group py-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text label">
                                    <i class="fas fa-signature"></i>
                                </span>
                            </div>
                            <input class="form-control input-connexion" type="text" name="name" value="" placeholder="Nom de compte" required autofocus aria-describedby="basic-addon1">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group py-2">
                            <div class="input-group-prepend ">
                                <span class="input-group-text label">
                                    <i class="fas fa-laptop "></i>
                                </span>
                            </div>
                            <select name="fabric_id" class="custom-select input-connexion" required >
                                <option value="" disabled selected>Quelles est votre fabrique Simplon ?</option>
                                @foreach ( $fabrics as $fabric )
                                    <option value="{{ $fabric->id }}">{{ $fabric->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group py-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text label">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <input class="form-control input-connexion" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus aria-describedby="basic-addon1">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group py-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text label">
                                    <i class="fas fa-fingerprint"></i>
                                </span>
                            </div>
                            <input class="form-control input-connexion" type="password" name="password" placeholder="Mot de passe" required aria-describedby="basic-addon1">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group py-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text label">
                                    <i class="fas fa-fingerprint"></i>
                                </span>
                            </div>
                            <input class="form-control input-connexion" id="password-confirm" type="password" name="password_confirmation" placeholder="Répéter le mot de passe" required aria-describedby="basic-addon1">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-control py-2">
                            <div class="custom-control custom-checkbox">
                                <input autocomplete="off" class="custom-control-input " type="checkbox"  onclick="enableNotifications({type:'all'})" id="customCheck1">
                                <label class="custom-control-label " for="customCheck1">Voulez-vous recevoir des notifications ?</label>
                            </div>
                        </div>
                        
                        <div class="pb-3 pt-4">
                            <input type="submit" value="S'enregistrer" class="btn-custom btn btn-block colorBackgroundSimplon ">
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection