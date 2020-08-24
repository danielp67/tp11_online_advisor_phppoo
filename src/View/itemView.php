<?php $title='Poster un nouveau commentaire' ?>

<?php ob_start(); ?>


<p>Bienvenue sur Online Advisor !</p>
<p><a href="index.php">Retour à la liste des items</a></p>


<div class="news">
    <h3>
        <?php echo htmlspecialchars($post['titre']); ?>
        <em>le <?php echo $post['date_creation']; ?></em>
        
    </h3>
    
    <p>
    <?php
    echo nl2br(htmlspecialchars($post['contenu']));
    ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
while($affiche_message = $comments->fetch()){

  ?>
<div class="news">
<h3><?php echo $affiche_message['auteur']. '<em> le '. $affiche_message['date_commentaire'];?>
<a href="index.php?action=modify&amp;id=<?php echo $affiche_message['id']; ?>" > (Modifier) </a></em></h3>
<?php echo '<p>'.$affiche_message['commentaire'].'</p></div><br/>';
}

?>


<p class="news">Nouveau commentaire :</p>

<form method="post" action="index.php?action=addComment&amp;id=<?=$post['id'] ?>" class="news">

                <label for="auteur">Auteur : </label>
                <input type="text" name="auteur" id="auteur"  size="50" minlength="2" maxlength="50">
                </br>
                <label for="comment">Commentaire : </label>
                <input type="text" name="comment" id="comment" placeholder="Votre commentaire" size="50" maxlength="255" required >
                </br>

                 <input type="submit" value="Envoyer" />

</form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>