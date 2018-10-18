@extends('layouts.fullwidth')

@section('title', 'Users - Admin ')

@section('styles')
@endsection


@section('content')
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Connexion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td scope="row">{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><a href="/admin/users/{{$user->id}}/login">👤</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@section('scripts')
@endsection
