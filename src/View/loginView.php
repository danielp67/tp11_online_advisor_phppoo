<?php
$title = 'Se connecter';
ob_start();
?>

<div class="row mx-auto">
    <div class="col-6 offset-3">
        <h1>Bienvenue sur Online Advisor !</h1>
        
        <form method="post" action="users/logUser" class="card">
            <legend class="card-header text-secondary">Connexion</legend>
            <div class="form-inline mt-2">
                <label for="login" class="col-5 offset-1 text-right ">Nom d'utilisateur : </label>
                <input type="text" name="login" class="form-control col-5" id="login" size="30" minlength="2" value="Username">
            </div>
            <div class="form-inline mt-2">
                <label for="pass" class="col-5 offset-1 text-right">Mot de passe : </label>
                <input type="password" name="pass" class="form-control col-5" id="pass" size="30" minlength="6" maxlength="14" placeholder="mot de passe">
            </div>
            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="resterconnecter">
                <label class="form-check-label" for="resterconnecter">Se souvenir de moi</label>
            </div>
            <div class="form-group mt-2">
                <a class="text-warning mb-2" href="">Informations de compte oubliées ?</a>
                <input type="submit" class="btn btn-success ml-2" value="Connexion" />
            </div>
            <div class="card-footer">
                <a href="main/newUserPage" id="forSubscribe">Pas encore de compte ?</a>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require('template.php');
