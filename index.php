<?php
require "inc/init.inc.php";
// d_die($_SERVER);
// d_die(ROOT);
/*
URL: index.php?controller=user&method=update&id=32
*/
$admin      = $_GET["doc"] ?? null;
$controller = $_GET["controller"] ?? "home";
$method     = $_GET["method"] ?? "list";
$id         = $_GET["id"] ?? null;

if (!empty($admin)) {
    $classController = "Controller\\admin\\" . ucfirst($controller) . "Controller";
} else {
    $classController = "Controller\\" . ucfirst($controller) . "Controller";
}

//$classController = "Controller\\" . ucfirst($controller) . "Controller";  // ucfirst: met la première lettre d'un string en majuscule
/* $classController = "Controller\UserController"
   $method = "list"
*/

/* We can instantiate an object using a string for the class name.
    _⚠ the class name must be in a variable to be able to use 'new'
*/

try {
    $controller = new $classController;
    // $UserController->update($id);

    $controller->$method($id);
} catch (Exception $e) {
    echo "Error : " . $e->getMessage();
}