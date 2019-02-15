@extends('layouts.fullwidth')

@section('styles')

@endsection
@section('content')
    <table class="table-style-2">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Connexion</th>
                <th scope="col">Suppression</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td scope="row">{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td style="text-align: center;"><a href="/admin/users/{{$user->id}}/login">👤</a></td>
                    <td style="text-align: center;"><a href="/admin/users/{{$user->id}}/delete">X</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

