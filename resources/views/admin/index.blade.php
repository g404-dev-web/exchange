@extends('layouts.fullwidth')

@section('content')

    <section class="gray-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="score-container">
                    <br><br>
                    <h3>
                        Admin Space 
                    </h3>
                </div>
            </div>
        </div>
        <br><hr>
    </section>

     <section> 
        <div class="row">
            <div class="col s12">

                <ul class="tabs">
                    <li class="tab col s6"><a class="active"  href="#createJobs">Liste des questions</a></li>
                    <li class="tab col s6"><a href="#createClient">Liste des Users</a></li>
                    
                </ul>
            </div>
            <div id="createJobs" class="col s12">
                {{-- Formaulaire création d'offre via l'admin --}}
                @include('admin/partials/listQuestions')
            </div>

            <div id="createClient" class="col s12">
                {{-- formulaire creation client via l'admin --}}
                @include('admin/partials/listUsers')
            </div>

         </div>
    </section>
 @endsection