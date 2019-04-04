@extends('layouts.fullwidth')

@section('styles')

@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-10 offset-1">
            <h2 class="mb-5 text-center">L'espace Administrateur</h2>

            <ul class="nav nav-tabs nav-fill pt-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="nav-user-tab" href="#nav-user" data-toggle="tab" role="tab" aria-controls="nav-user">Les Simplonnien.ne.s</a>
                </li>
                <li class="nav-item">
                    <a id="nav-fabric-tab" href="#nav-fabric" class="nav-link" data-toggle="tab" role="tab" aria-controls="nav-fabric">Les Fabriques</a>
                </li>
                <li class="nav-item">
                    <a id="nav-admin-tab" href="#nav-admin" class="nav-link" data-toggle="tab" role="tab" aria-controls="nav-admin">Demande d'admins</a>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
                    <h4 class="text-center my-5">Simplonien.ne.s de la fabrique {{ $fabricAdmin }}</h4>
                    <table class="table col-10 offset-1">
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

                <div class="tab-pane fade" role="tabpanel" id="nav-fabric" aria-labelledby="nav-profile-tab">
                    <h4 class="text-center my-5">Ajouter une nouvelle fabrique Simplon</h4>
                    <div class="col-8 offset-2">
                        <form action="{{ route('addFabric') }}" method="post" class="my-5 mx-4">
                            {{ csrf_field() }}
                            <div class="input-group pb-4">
                                <input type="text" class="form-control" placeholder="Nom de la ville de la Fabrique Simplon" name="name">
                                <div class="input-group-append">
                                    <button class="btn colorBackgroundSimplon" type="submit">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h4 class="text-center my-3">Liste de toutes les fabriques :</h4>
                    <div class="row">

                        @foreach ($fabrics->chunk(5) as $chunk)
                            <ul class="list-group col-4 mb-3">
                                @foreach ($chunk as $fabric)

                                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                                        {{ $fabric->name }}
                                        <span class="badge badge-dark badge-pill">{{ $fabric->user->count() }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" role="tabpanel" id="nav-admin" aria-labelledby="nav-admin-tab">
                    <div class="col-10 offset-1">
                        <h4 class="text-center mb-4 mt-5">En attente d'être accepté admin : </h4>
                        <table class="table">
                            <thead style="background-color: white">
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Fabric</th>
                                <th class="text-center" scope="col">Accepter</th>
                                <th class="text-center" scope="col">Refuser</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($wantedAdmin as $wanted)
                                <tr>
                                    <td>{{ $wanted->name }}</td>
                                    <td>{{ $wanted->email }}</td>
                                    <td>{{ $wanted->fabricName }}</td>
                                    <td class="icon align-middle" style="text-align: center;">
                                        <a href="/admin/users/{{ $wanted->id }}/approved"><i class="fas fa-user-plus"></i></a>
                                    </td>
                                    <td class="icon align-middle" style="text-align: center;">
                                        <a href="/admin/users/{{ $wanted->id }}/refused"><i class="fas  fa-user-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






        </div>
        <div class="col-5 ">



    </div>

    </div>
</div>


@endsection

