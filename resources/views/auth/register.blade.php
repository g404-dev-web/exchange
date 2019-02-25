@extends('layouts.fullwidth')

@section('title', 'Inscription')

@section('content')
    <div class="login">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="page-content">
                    <h2>Enregistrement</h2>
                    <div class="form-style form-style-3">
                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            {{ csrf_field() }}

                            <div class="form-inputs clearfix">
                                <p class="login-text">
                                    <input type="text" name="name" value="" placeholder="Nom de compte" required autofocus>
                                    <i class="icon-user"></i>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </p>
                                <p class="form-inputs clearfix">
                                        {{-- <i class="icon-laptop"></i> --}}
                                    <select name="fabric_id" required >
                                        <option value="" disabled selected><i class="icon-laptop"></i> Quelles est votre fabrique Simplon ?</option>
                                        @foreach ( $fabrics as $fabric )
                                            <option value="{{ $fabric->id }}">{{ $fabric->name }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <p class="login-text">
                                    <input type="email" name="email" value="" placeholder="E-mail" required autofocus>
                                    <i class="icon-envelope"></i>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </p>
                                <p class="login-password">
                                    <input type="password" name="password" placeholder="Mot de passe" required>
                                    <i class="icon-lock"></i>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </p>
                                <p class="login-password">
                                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Répéter le mot de passe" required>
                                    <i class="icon-lock"></i>
                                </p>
                            </div>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary active">Voulez-vous recevoir des notifications ?
                                    <input autocomplete="off" id='checkbox' type="checkbox" onclick="enableNotifications({type:'all'})">
                                </label>                                                      
                            </div>                            
                            <p class="form-submit login-submit">
                                <input type="submit" value="S'enregistrer" class="button color small login-submit submit">
                            </p>
                        </form>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
        </div><!-- End row -->
    </div><!-- End login -->

@endsection

@section('scripts')

@endsection