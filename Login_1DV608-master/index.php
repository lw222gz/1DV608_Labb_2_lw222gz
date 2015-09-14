<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('controller/LoginController.php');

require_once('model/LoginModel.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE MODELS/ VIEWS/ Controllers
$lm = new LoginModel();

$v = new LoginView($lm);
$dtv = new DateTimeView();
$lv = new LayoutView();


$loginCont = new LoginController($v, $lm);
$loginCont -> init();


$lv->render($lm -> getLoginStatus(), $v, $dtv);

