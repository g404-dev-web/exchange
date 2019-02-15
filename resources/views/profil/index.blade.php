@extends('layouts.2-columns')

@section('title', 'Poser une question')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
@endsection


@section('content')
<form method="POST" action="{{ route('profil.editProfil') }}">
    {{ csrf_field() }}

    <p class="login-text"><span class="color">Fabrique : </span>{{$user->fabric->name}}</p>
    <div class="form-inputs clearfix medium">
        <p class="login-text">
        <input type="text" name="name" value="{{$user->name}}" placeholder="Username" required autofocus>
            <i class="icon-user"></i>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </p>
        
        <p class="login-text">
        <input type="email" name="email" value="{{$user->email}}" placeholder="Email" required autofocus>
            <i class="icon-envelope"></i>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </p>
        
    </div>
    <p class="">
        <input type="submit" value="Update" class="button color small ">
    </p>
</form>

<div class="{{ Request::is('questions/user') ? 'current_page_item' : '' }}">
    <a class="color button small" href="{{ route('questions.user') }}">Mes questions</a>
</div>
@endsection