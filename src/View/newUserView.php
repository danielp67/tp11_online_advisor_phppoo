<?php
$title = 'Créer son compte';
ob_start();
?>

<div class="row mx-auto">
    <div class="col-6 offset-3">
        <h1>Bienvenue sur Online Advisor !</h1>

        <form method="post" action="users/addNewUser" class="card">
            <legend class="card-header text-secondary">Inscription</legend>
            <div class="form-inline mt-2">
                <label for="login" class="col-5 offset-1 text-right ">
                    Nom d'utilisateur : </label>
                <input class="form-control col-5" type="text" name="login"
                id="login" required minlength="4">
            </div>
            <div class="form-inline mt-2">
                <label for="mail" class="col-5 offset-1 text-right ">
                    E-mail : </label>
                <input class="form-control col-5" type="email" name="mail"
                id="mail" placeholder="nom@exemple.com">
            </div>
            <div class="form-inline mt-2">
                <label for="pass" class="col-5 offset-1 text-right ">
                    Mot de passe : </label>
                <input class="form-control col-5" type="password" name="pass"
                id="pass">
            </div>
            <div class="form-inline mt-2">
                <label for="pass2" class="col-5 offset-1 text-right ">
                    Confirmation : </label>
                <input class="form-control col-5" type="password" name="pass2"
                id="pass2">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="condition">
                <label class="form-check-label" for="condition">
                    <a class="text-warning" href="">
                    Accepter les conditions
                        d'utilisation</a></label>
            </div>
            <div class="form-group mt-3">
                <input type="submit" class="btn btn-success"
                value="Inscription" />
            </div>
            <div class="card-footer">
                <a href="main/loginPage" id="forConnexion">Déjà Inscrit ?</a>
            </div>
        </form>
    </div>
</div>


<?php
$content = ob_get_clean();
require('template.php');
