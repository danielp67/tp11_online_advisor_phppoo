<?php
require('controller/controller.php');

try {
    // ...
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}
