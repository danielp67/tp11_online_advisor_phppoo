<?php       


$title='Liste des items' ?>

<?php ob_start(); ?>
  

<p>Bienvenue <?= $_SESSION['login'] ?> sur Online Advisor !</p>

<p>Dernière connexion le  <?= $_SESSION['lastLoginAt'] ?></p>

<p><a href="users/sessionDestroy">Se déconnecter</a></p>



<p class="news">Nouveau item :</p>

      <form method="post" action="items/addNewItem" class="news">

                      <label for="itemName">Item : </label>
                      <input type="text" name="itemName" id="itemName"  size="30" minlength="2" maxlength="50" required >
                      </br>
                      <label for="category">Categorie : </label>
                      <input type="text" name="category" id="category"  size="30" minlength="2" maxlength="50" required >
                      </br>
                      <label for="rate">Note : </label>
                      <input type="number" name="rate" id="rate" min="1" max="5" required >
                      </br>
                      <label for="review">Commentaire : </label>
                      <input type="text" name="review" id="review" placeholder="votre commentaire" size="50" maxlength="255" required >
                      </br>
                      
                      <input type="submit" value="Envoyer" />

      </form>


<p class='news'>Derniers items notés :</p>

<?php




  while($affiche_message = $listItems->fetch()){

 ?>
<div class="news">
    <h3>
        <?php echo htmlspecialchars($affiche_message['item_name']); ?>
        <?php echo htmlspecialchars($affiche_message['category']); ?>
        <em>le <?php echo $affiche_message['date_creation']; ?></em>
        <?php echo htmlspecialchars($affiche_message['rate']); ?>
    </h3>
    
    <p>
    <?php
    // On affiche le contenu du billet
    echo nl2br(htmlspecialchars($affiche_message['review']));
    echo nl2br(htmlspecialchars($affiche_message['user']));
    ?>
    <br />
    <em><a href="items/getComments/<?php echo $affiche_message['id']; ?>">Commentaires</a></em>
    </p>
</div>
<?php

  }

  $listItems->closeCursor();

 ?>
  

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

