<?php
require_once(__DIR__ . '/ActionHandler.php');
$actionHandler = new ActionHandler($argv);
$actionHandler->run();
