<div class="section-warp ask-me">
    <div class="container clearfix">
        <div class="box_icon box_warp box_no_border box_no_background" box_border="transparent" box_background="transparent" box_color="#FFF">
            <div class="row">
                <div class="col-md-12">
                    <h2>Bienvenue sur Exchange.Simplon</h2>
                    <p>
                        Tous les Simplonnien.ne.s débutant.e.s font face aux mêmes problèmes/bogues/erreurs, mais n'osent pas toujours demander ou ne trouvent pas toujours les bonnes réponses.
                        <br>Sois rassuré.e, ici tu es libre de poser la question que tu veux, une réponse fiable et de confiance te sera faite par un.e autre apprenant.e, un.e ancien.ne Simplonien.ne ou un formateur.
                        <br><b>N'attend plus, pose ta question dès maintenant !</b>
                    </p>
                    <form action="search" method="post" class="form-style form-style-2">
                        {{ csrf_field() }}
                        <div class="form-style form-style-2">
                            <p>
                                <input type="text" id="question_title" name="search" value="Recherche une question, tu es sur de trouver une réponse." onfocus="if(this.value=='Recherche une question, tu es sur de trouver une réponse.')this.value='';" onblur="if(this.value=='')this.value='Recherche une question, tu es sur de trouver une réponse.';">
                                <i class="icon-pencil"></i>
                                <button type="submit" class="color button small publish-question" >Rechercher</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div><!-- End row -->
        </div><!-- End box_icon -->
    </div><!-- End container -->
</div><!-- End section-warp -->