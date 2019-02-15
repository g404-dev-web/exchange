@extends('layouts.fullwidth')

@section('title', 'Connexion')

@section('content')
    <div class="login">
        <div class="row">
            <div class="col-md-6">
                <div class="page-content">
                    <h2>Login</h2>
                    <div class="form-style form-style-3">
                        <form method="POST" action="{{ route('login') }}">
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
                                <p class="login-password">
                                    <input type="password" name="password" placeholder="Password" required>
                                    <i class="icon-lock"></i>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                                </p>
                            </div>
                            <p class="form-submit login-submit">
                                <input type="submit" value="Log in" class="button color small login-submit submit">
                            </p>
                            <div class="rememberme">
                                <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me</label>
                            </div>
                        </form>
                    </div>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
            <div class="col-md-6">
                <div class="page-content">
                    <h2>Register Now</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravdio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequa. Vivamus vulputate posuere nisl quis consequat.</p>
                    <a href="{{ url('/register') }}" class="button small color">Create an account</a>
                </div><!-- End page-content -->
            </div><!-- End col-md-6 -->
        </div><!-- End row -->
    </div><!-- End login -->

@endsection
