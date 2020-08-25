<?php $title='Créer son compte' ?>

<?php ob_start(); ?>


<p>Bienvenue sur Online Advisor !</p>
<p><a href="index.php">Retour à la liste des items</a></p>


<form method="post" action="users/addNewUser" class="news">

                            <div id="signup" class="form-group">
                                <legend class="text-secondary mt-3">Inscription</legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="login">Nom d'utilisateur : </label>
                                            <input class="form-control" type="text" name="login" id="login" required minlength="4">
                                        </div>
                                        <div class="form-group">
                                            <label for="mail">E-mail : </label>
                                            <input class="form-control" type="email" name="mail" id="mail" placeholder="nom@exemple.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="pass">Mot de passe : </label>
                                            <input class="form-control" type="pass" name="pass" id="pass">
                                        </div>
                                        <div class="form-group">
                                            <label for="pass2">Confirmation : </label>
                                            <input class="form-control" type="pass2" name="pass2" id="pass2">
                                        </div>
                                    </div>
                                </div>
                                
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="condition">
                                            <label class="form-check-label" for="condition"> <a class="text-warning" href="">Accepter les conditions 
                                                    d'utilisation</a></label>
                                        </div>
                                    
                                        <div class="form-group mt-3">
                                            <input type="submit" class="btn btn-success" value="Inscription" />
                                        </div>
                                    
                                </div>
                                <hr>
                                <div class="form-group mt-2">
                                    <a  href="users/loginPage" id="forConnexion">Déjà Inscrit ?</a>
                                    
                                </div>
                            </div>
                     
                       
     

</form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>