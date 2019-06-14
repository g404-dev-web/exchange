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
                            <input class="form-control input-connexion" type="text" name="name" value="" placeholder="Nom d'utilisateur" required autofocus aria-describedby="basic-addon1">
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
                            <select name="fabric_ids[]" class="custom-select input-connexion" required multiple>
                                <option value="" disabled selected>Quelles sont vos fabriques Simplon ?</option>
                                @foreach ( $fabrics as $fabric )
                                    <option value="{{ $fabric->id }}">{{ $fabric->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-control py-2 my-2  ">
                            <div class="custom-control custom-checkbox">
                                <input autocomplete="off" class="custom-control-input " type="checkbox"  onclick="enableNotifications({type:'all'})" id="checkboxAdmin">
                                <label class="custom-control-label " for="checkboxAdmin">Je suis formateur et veux être admin</label>
                            </div>
                        </div> --}}
                        <div class="input-group py-2">
                            <div class="input-group-prepend ">
                                <span class="input-group-text label">
                                    <i class="fas fa-laptop "></i>
                                </span>
                            </div>
                            <select name="want_is_admin" class="custom-select input-connexion" required >
                                <option value="0" selected>Je suis un.e apprenant.e</option>
                                <option value="1" >Je suis un.e formateur.trice</option>
                            </select>
                        </div>
                        <div class="input-group py-2">
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
                                <input autocomplete="off" class="custom-control-input " type="checkbox"  onclick="enableNotifications(this, {type:'all'})" id="checkboxNotification">
                                <label class="custom-control-label " for="checkboxNotification">Voulez-vous recevoir des notifications ?</label>
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
