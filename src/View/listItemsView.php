<?php $title='Liste des items' ?>

<?php ob_start(); ?>
  

<p>Bienvenue sur Online Advisor !</p>
<p><a href="index.php">Retour à la liste des items</a></p>


<p class="news">Nouveau item :</p>

      <form method="post" action="" class="news">

                      <label for="item">Item : </label>
                      <input type="text" name="item" id="item"  size="30" minlength="2" maxlength="50" required >
                      </br>
                      <label for="category">Categorie : </label>
                      <input type="text" name="item" id="item"  size="30" minlength="2" maxlength="50" required >
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
try
{
  // On se connecte à MySQL
  $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
  // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


// Requête qui insère les derniers messages

if(isset($_POST['titre']) AND isset($_POST['contenu']))
{
  $insert_message=$bdd->prepare('INSERT INTO billets(titre, contenu, date_creation) VALUES (:titre, :contenu, NOW())');

  $insert_message->execute(array(
    'titre' => $_POST['titre'],
    'contenu'=> $_POST['contenu']
  ));



  $insert_message->closeCursor();
}

  while($affiche_message = $posts->fetch()){

 ?>
<div class="news">
    <h3>
        <?php echo htmlspecialchars($affiche_message['titre']); ?>
        <em>le <?php echo $affiche_message['date_creation']; ?></em>
    </h3>
    
    <p>
    <?php
    // On affiche le contenu du billet
    echo nl2br(htmlspecialchars($affiche_message['contenu']));
    ?>
    <br />
    <em><a href="index.php?action=post&amp;id=<?php echo $affiche_message['id']; ?>">Commentaires</a></em>
    </p>
</div>
<?php

  }


  $posts->closeCursor();

 ?>
  

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

