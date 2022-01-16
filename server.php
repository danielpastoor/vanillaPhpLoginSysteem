<?php

define("BASEPATHWEBSITE", __DIR__);

//Autloader
require BASEPATHWEBSITE . "/autoloader.php";

// Importing routing
include BASEPATHWEBSITE . "/router/router.php";

RouteHelper::index();
