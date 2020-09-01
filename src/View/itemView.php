<?php
$title = 'Poster un nouveau commentaire';
ob_start();
?>


<div class="row mx-auto py-5">
  
      <div class="col-12">
        <h1>Bienvenue <?= $_SESSION['login'] ?> sur Online Advisor !</h1>

        <div class="row">
          <div class="col-6">
            <p>Dernière connexion le <?= $_SESSION['lastLoginAt'] ?></p>
          </div>
          <div class="col-6">
            <p><a class="btn btn-danger" href="users/sessionDestroy">Se déconnecter</a></p>
          </div>
          <div class="col-4 offset-4">
          <a class="center btn btn-primary" href="items/listItemPage">Retour à la liste des items</a>
          </div>
        </div>
        
      </div>


    <div class="col-10 offset-1">
    <div class="card my-3 bg-light border-success">
      
        <div class="card-header">
        <div class="row">
          <div class="col-4 offset-4 text-center"><h3><?= htmlspecialchars($getItem['item_name']); ?></h3>
          </div>
          <div class="col-4 text-right"><h3>Note : <?= htmlspecialchars($getItem['rate']); ?>/5</h3>
          </div>
        </div>
        </div>
        
        <div class="card-body">
          <div class="card-text font-weight-bold">De <em><?= nl2br(htmlspecialchars($getItem['user_login'])); ?></em> : <?= nl2br(htmlspecialchars($getItem['review'])); ?>
        </div>
        </div>
        
        <div class="card-footer">
        <div class="row">
          <div class="col-6">Catégorie : <?= htmlspecialchars($getItem['category']); ?></div>
          <div class="col-6">Date : <?= $getItem['date_creation']; ?></div>
        </div>
        </div>
    
    </div>



    <h4>Commentaires :</h4>

    <?php
    while ($affiche_message = $getComments->fetch()) {
        ?>
    
          <div class="card my-3 bg-light">
            <div class="card-body">
              <div class="card-title">
                <?= htmlspecialchars($affiche_message['user_login']); ?>
                  <em>le <?= $affiche_message['date_comment']; ?></em>
                
              </div>

              <h5><?= nl2br(htmlspecialchars($affiche_message['comment'])); ?></h5>

            </div>
          </div>
        <?php
    }
    ?>


    <form method="post" action="comments/addComment/<?= $getItem['id'] ?>" class="news">
      <label for="comment">Nouveau commentaire : </label>
      <input type="text" name="comment" id="comment" placeholder="Votre commentaire" size="50" maxlength="255" required>
      </br>
      <input class="mt-2 btn btn-primary" type="submit" value="Envoyer" />
    </form>

    <?php

    $getComments->closeCursor();
    ?>
  </div>
</div>

<?php
$content = ob_get_clean();
require('template.php');
