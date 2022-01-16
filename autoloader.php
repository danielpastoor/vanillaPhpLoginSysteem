<?php
//Database connection
include BASEPATHWEBSITE . "/config/db.php";
//All Helper files
include BASEPATHWEBSITE . "/helpers/helpers.php";
include BASEPATHWEBSITE . "/helpers/routeHelper.php";
include BASEPATHWEBSITE . "/helpers/enqueueHelper.php";
include BASEPATHWEBSITE . "/helpers/requestHelper.php";
//MiddleWares
include BASEPATHWEBSITE . "/middleware/AuthMiddleWare.php";
//Validater
include BASEPATHWEBSITE . "/validater/validateAuthForm.php";
//All Controllers
include BASEPATHWEBSITE . "/controllers/AuthController.php";
include BASEPATHWEBSITE . "/controllers/dashboardController.php";
include BASEPATHWEBSITE . "/controllers/loginController.php";
include BASEPATHWEBSITE . "/controllers/registerController.php";
