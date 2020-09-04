<?php
$title = 'Liste des items';
ob_start();
?>


<div class="row px-5 py-5">
  <div class="col-12">
    <h1>Bienvenue <?= $_SESSION['login'] ?> sur Online Advisor !</h1>
    <div class="row">
      <div class="col-6">
        <p>Dernière connexion le <?= $_SESSION['lastLoginAt'] ?></p>
      </div>
      <div class="col-6">
        <p><a class="btn btn-danger" href="users/sessionDestroy">
        Se déconnecter</a></p>
      </div>
    </div>
  </div>

  
  <div class="col-10 offset-1">
    <div class="card mt-3 bg-light">
     
        <form method="post" action="items/addNewItem" class="news">
          <legend class=" card-header">Nouveau item :</legend>
          <div class="card-body">
          <div class="form-inline mt-1">
          <label for="itemName" class="col-3">Item : </label>
          <input class="form-control col-3" type="text" name="itemName"
          id="itemName" minlength="2" maxlength="50" required>
          </div>

          <div class="form-inline mt-1">
          <label for="category"  class="col-3">Catégorie : </label>
          <input class="form-control col-3" type="text" name="category"
          id="category" minlength="2" maxlength="50" required>
          </div>

          <div class="form-inline mt-1">
          <label for="rate"  class="col-3" >Note : </label>
          <input class="form-control col-1" type="number" name="rate" id="rate"
          min="1" max="5" required>  /5
          </div>
          <div class="form-inline mt-3">
          <label for="review"  class="col-3">Commentaire : </label>
          <input class="form-control col-6" type="text" name="review"
          id="review" placeholder="votre commentaire" size="50" maxlength="255"
          required>
          </div>

          <input class="mt-2 btn btn-success" type="submit" value="Envoyer" />

        </form>
      </div>
    </div>

    <h4 class="mt-4">Derniers items notés :</h4>

    <?php
    while ($affiche_message = $listItems->fetch()) {
        ?>
        
          <div class="card mt-3 bg-light">
            
              <div class="card-header">
              <div class="row">
              <div class="col-4 offset-4 text-center">
                <h3><?= htmlspecialchars($affiche_message['item_name']); ?></h3>
              </div>
              <div class="col-4 text-right">
                <h3>Note : <?= htmlspecialchars($affiche_message['rate']); ?>
                /5</h3>
              </div>
            </div>
              </div>

              <div class="card-body">
                <div class="card-text font-weight-bold">
                  De <em>
                  <?= nl2br(htmlspecialchars($affiche_message['user_login'])); ?>
                  </em> :
                  
                  <?= nl2br(htmlspecialchars($affiche_message['review'])); ?>
                
                  <br>
                <a class="mt-2 btn btn-primary" 
                href="items/getComments/<?php echo $affiche_message['id']; ?>">
                  Voir les commentaires</a>
                </div>
              </div>


              <div class="card-footer">
              <div class="row">
                <div class="col-6">Catégorie : 
                  <?= htmlspecialchars($affiche_message['category']); ?>
                </div>
                <div class="col-6">Date : 
                  <?= $affiche_message['date_creation']; ?>
                </div>
              </div>
              </div>
            
              
            
              </div>
      <?php
    }

    $listItems->closeCursor();
    ?>
  </div>
</div>

<?php
$content = ob_get_clean();
require('template.php');
