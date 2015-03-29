<?php
require_once(__DIR__ . '/BmailsController.php');
require_once(__DIR__ . '/ActionHandler.php');
BmailsController::me($argv);
$actionHandler = new ActionHandler();
$actionHandler->run();
