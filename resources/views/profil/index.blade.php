@extends('layouts.fullwidth')

@section('title', 'Profil')

@section('content')

<div class="pt-3 pb-4">
    {{-- <h1 class="colorTextSimplon text-center mb-3">Bonjour, {{ $user->name }}</h1> --}}
    <div class="card mx-3">
        <div class="card-body row">
            <div class="col-12 col-sm-2">
                <div class='avatarFrame'> 
                <span class="badge badge-danger" style="
                    position: absolute;
                    top: 20px;
                    border-radius: 50%;
                    width: 30px;
                    line-height: 24px;
                    height: 30px;
                ">{{ $user->points }}</span>
                    <img class="rounded-circle" style="width: 100%;" src="{{ $user->getUrlfriendlyAvatar() }}" />
                </div>
            </div>
            <div class="col-12 col-sm-4 align-self-center">
                <h2 class="colorTextSimplon">Bonjour, {{ $user->name }} !</h4>
                <h6>Aujourd'hui tu as {{ $user->points }} points de Karma</h4>
                <p>Ta fabrique : <span class="underlineText">{{$user->fabric->name}}</span></p>
            </div>
            <div class="col-12 col-sm-6 align-self-center">
                <div class="row">
                    <div class="col-12 col-sm-6 card-text text-center">
                        <h6>Retrouve les questions que tu as posé à la communauté</h6>
                        <a class="btn btn-outline-danger" href="{{ route('questions.user') }}">Mes questions</a>
                    </div>
                    <div class="col-12 col-sm-6 card-text text-center">
                        <h6>Parcour les questions de la communauté et donne tes réponses</h6>
                        <a class="btn btn-danger" href="{{ route('questions.index') }}">Donne une réponse</a>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <div class="container-fluid ml-3 mt-4">
        <div class="row mr-3">
            <div class="card col-md-6 col-12 ">
                <div class="card-body ">
                    <div class="align-self-center">
                    <h2 class="colorTextSimplon text-center pb-3">Mon profil</h2>
                    <hr class="pb-3">
                    <form method="POST" action="{{ route('profil.editProfil') }}">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text label">
                                    <i class="fas fa-signature "></i>
                                </span>
                            </div>
                            <input class="form-control input-connexion" type="text" name="name" value="{{$user->name}}" placeholder="Nom de compte"  autofocus aria-describedby="basic-addon1">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text label">
                                    <i class="fas fa-envelope "></i>
                                </span>
                            </div>
                            <input class="form-control input-connexion" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail"  autofocus aria-describedby="basic-addon1">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text label">
                                    <i class="fas fa-fingerprint"></i>
                                </span>
                            </div>
                            <input class="form-control input-connexion" type="password" name="password" placeholder="Nouveau mot de passe" aria-describedby="basic-addon1">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text label">
                                    <i class="fas fa-fingerprint"></i>
                                </span>
                            </div>
                            <input class="form-control input-connexion" id="password-confirm" type="password" name="password_confirmation" placeholder="Répéter votre Nouveau mot de passe" aria-describedby="basic-addon1">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <input type="submit" value="Mettre à jour" class="btn btn-custom btn-block colorBackgroundSimplon">
                    </form>
                </div>
                </div>
            </div>
            <div class="card col-md-6 col-12">
                <div class="card-body">
                    <h2 class="colorTextSimplon text-center pb-3">Mes Stats</h2>
                    <hr class="pb-3">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <td>Nombres de questions :</td>
                                <td class="colorTextSimplon text-center">{{ count($user->questions) }}</td>
                            </tr>
                            <tr>
                                <td>Nombres de réponses :</td>
                                <td class="colorTextSimplon text-center">{{ count($user->answers) }}</td>
                            </tr>
                            <tr>
                                <td>Nombres de réponses validées :</td>
                                <td class="colorTextSimplon text-center">{{ $answers_is_selected }}</td>
                            </tr>
                            <tr>
                                <td>Points Karma :</td>
                                <td class="colorTextSimplon text-center">{{ $user->points }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <canvas id="myChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script>

let nbQuestions = {{ json_encode(count($user->questions)) }};
let nbAnswers = {{ json_encode(count($user->answers)) }};
let nbAnswersIsSelected = {{ json_encode($answers_is_selected) }};

console.log(nbQuestions, nbAnswers);

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [''],
        datasets: [{
            label: 'Questions',
            data: [nbQuestions],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255,99,132,1)',
            borderWidth: 1
        }, {
            label: 'Réponses',
            data: [nbAnswers],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor:  'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Réponses Validées',
            data: [nbAnswersIsSelected],
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor:  'rgba(255, 206, 86, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

</script>


@endsection