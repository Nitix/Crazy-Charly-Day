<?php

require_once ('common.php');

$action = RestoController::callAction();
RestoController::$action();

?>