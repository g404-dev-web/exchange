@extends('layouts.fullwidth')

@section('content')

    <div class="col-md-6 offset-md-3 mt-5">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title colorTextSimplon">Réinitialiser votre mot de passe</h3>
                <hr>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="post" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="input-group py-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text label" id="basic-addon1">
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
                    <input type="submit" value="Envoyer" class="btn btn-custom colorBackgroundSimplon btn-block mt-3">
                </form>
            </div>
        </div>
    </div>

    {{--<div class="login">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="page-content">
                    <h2>Reset Password</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-style form-style-3">
                        <form method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <div class="form-inputs clearfix">

                                <p class="login-text">
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                                    <i class="icon-envelope"></i>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <p class="form-submit login-submit">
                                <input type="submit" value="Send Password Reset Link" class="button color small submit">
                            </p>
                        </form>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
        </div><!-- End row -->
    </div><!-- End login -->--}}

@endsection
