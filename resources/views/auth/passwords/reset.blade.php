@extends('layouts.fullwidth')

@section('content')
    <div class="login">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="page-content">
                    <h2>Reset Password</h2>
                    <div class="form-style form-style-3">
                        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <p class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <div class="col-md-12">
                                    <input id="email" type="email" placeholder="email" name="email" value="{{ $email or old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </p>

                            <p class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input id="password" type="password" placeholder="password" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </p>

                            <p class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" placeholder="repeat password" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </p>

                            <p class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="button color small login-submit submit">
                                        Reset Password
                                    </button>
                                </div>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
