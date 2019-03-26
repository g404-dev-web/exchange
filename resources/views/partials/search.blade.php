<div id="search" class="colorBackgroundSimplon">
    <div class="container-fluid searchBar">
        <div class="row">
            <div class="col-md-12">
                @if (!Auth::check())
                <div class="text-center">
                    <h2 class="my-5">Bienvenue sur Simplon-Exchange.Help</h2>
                    <p class="pb-3">
                        Tous les Simplonnien.ne.s débutant.e.s font face aux mêmes problèmes/bogues/erreurs, mais n'osent pas toujours demander ou ne trouvent pas toujours les bonnes réponses.
                        <br>Sois rassuré.e, ici tu es libre de poser la question que tu veux, une réponse fiable et de confiance te sera faite par un.e autre apprenant.e, un.e ancien.ne Simplonien.ne ou un formateur.
                        <br><b>N'attend plus, pose ta question dès maintenant !</b>
                    </p>
                </div>
                @endif

                <form method="get" class="mt-5 mb-5">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text label" id="basic-addon1"><i class="fas fa-pencil-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" name="search" aria-label="Username" aria-describedby="basic-addon1" value="Recherche une question, tu es sur de trouver une réponse." onfocus="if(this.value=='Recherche une question, tu es sur de trouver une réponse.')this.value='';" onblur="if(this.value=='')this.value='Recherche une question, tu es sur de trouver une réponse.';">
                        <div class="input-group-append">
                            <button class="btn btn-custom colorBackgroundSimplon" type="submit" id="button-addon2">Rechercher</button>
                        </div>
                    </div>
                    {{-- <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-pencil-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="Recherche une question, tu es sur de trouver une réponse." onfocus="if(this.value=='Recherche une question, tu es sur de trouver une réponse.')this.value='';" onblur="if(this.value=='')this.value='Recherche une question, tu es sur de trouver une réponse.';">
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</div>
