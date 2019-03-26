@extends('layouts.fullwidth')

@section('styles')

@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4 text-center">L'espace Administrateur</h2>
            <h4 class="text-center my-4">Simploniens de la fabrique {{ $fabric_admin->name }}</h4>
            <table class="table">
                <thead class="colorBackgroundSimplon">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th class="text-center" scope="col">Connexion</th>
                    <th class="text-center" scope="col">Suppression</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td scope="row">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="icon align-middle" style="text-align: center;">
                                <a href="/admin/users/{{ $user->id }}/login"><i class="fas fa-2x fa-user-ninja"></i></a>
                            </td>
                            <td class="icon align-middle" style="text-align: center;">
                                <a href="/admin/users/{{ $user->id }}/delete"><i class="fas fa-2x fa-user-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

