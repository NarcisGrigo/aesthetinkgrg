<?php

/**
The 'chargeClass' function will therefore be called when a class is required.
The argument will be the name of the required class.

 */
function chargeClass($className)
{
    // We replace the \ which are in the name of the class to load with / which is the folder separator
    // used in most operating systems
    // ⚠ REMINDER: in namespaces, you can only use \

    $filePath = str_replace("\\", "/", $className);
    $className = str_replace("Controller/", "", $filePath);

    $root = __DIR__ . "/../" . $filePath . ".php";
    // d_die($className." ok");
    // if (!file_exists($root)) {
    //     $root = __DIR__ . "/../controller/admin/" . $filePath . ".php";
    // }
    if (file_exists($root)) {
        require $root;
    } else {
        throw new Exception("La class $className n'a pas été trouvée.");
    }
}

/**
The spl_autoload_register function allows you to define the function that will be
executed each time a class is required by the code (for example,
when using the 'new' keyword to instantiate an object)
 */
spl_autoload_register("chargeClass");