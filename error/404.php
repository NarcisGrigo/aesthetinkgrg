<?php

require "../inc/init.inc.php";
$h1 = "ERROR 404 : The page does not exist";
include ROOT . "views/header.html.php";
?>

<h2>🛑 URL requested does not exist</h2>

<a href="/" class="btn btn-primary">
    <i class="fa fa-home"></i>
    Return to the home page
</a>

<?php
include "../views/footer.html.php";