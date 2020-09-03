<?php
$title = 'Error';
ob_start();
?>


<div class="row mx-auto py-5">
            <div class="col-6 offset-3">
          <a class="center btn btn-primary" href="items/listItemPage">
          Retour à la page précédente</a>
          </div>
</div>

<div class="row mx-auto py-5">
    <div class="col-6 offset-3">
    
    <div class="card my-3 bg-light border-success">
      
        <div class="card-header">
          <div class=""><h3> Erreur !!! </h3>
          </div>
        </div>
        
        <div class="card-body">
          <div class="card-text font-weight-bold"><?=  $error;?>
        </div>
        </div>

    </div>

    </div>
    </div>

<?php
$content = ob_get_clean();
require('template.php');
