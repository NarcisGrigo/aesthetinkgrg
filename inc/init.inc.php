<?php

/* ⚠ You must include the autoload file BEFORE executing the session_start() function otherwise there will be
        an error if we try to store an object in the superglobal variable $_SESSION */
require "autoload.php";
session_start();
include __DIR__ . "/functions.inc.php";
define("ROOT", "/aesthetink/");
define("ROLE_USER", "ROLE_USER");
define("ROLE_ADMIN", "ROLE_ADMIN");
define("INSERTED", "Register");
define("UPDATED", "Modify");
define("DELETED", "Delete");
define("UPLOAD_productsS_IMG", "uploads/productss/");
define("EN_ATTENTE", "Waiting");