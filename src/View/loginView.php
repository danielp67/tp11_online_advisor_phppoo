<?php $title='Se connecter' ?>

<?php ob_start(); ?>


<p>Bienvenue sur Online Advisor !</p>
<p><a href="index.php">Retour à la liste des items</a></p>


<form method="post" action="index.php?action=loginUser" class="news">

                            <div class="form-group">
                                <legend class="text-secondary mt-3">Connexion</legend>
                                <div class="form-group">
                                    <label for="email">E-mail :</label>
                                    <input type="email" class="form-control" id="email" size="30" minlength="2" value="nom@exemple.com">
                                </div>
                                <div class="form-group">
                                    <label for="password">Mot de passe :</label>
                                    <input type="password" class="form-control" id="password" size="30" minlength="6" maxlength="14" placeholder="mot de passe">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="resterconnecter">
                                    <label class="form-check-label" for="resterconnecter">Se souvenir de moi</label>
                                </div>
                                <div class="form-group mt-3">
                                    <a class="text-warning mb-2" href="">Informations de compte oubliées ?</a>
                                    <input type="submit" class="btn btn-success ml-2" value="Connexion" />
                                </div>
                                <hr>
                                <div class="form-group">
                                    <a href="index.php?p=newUserPage" id="forSubscribe">Pas encore de compte ?</a>
                                   
                                </div>
                            </div>
                       
     

</form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>