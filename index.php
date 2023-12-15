<?php

spl_autoload_register(function ($className) {
    include_once($className . ".php");
});
$path = $_SERVER['REQUEST_URI'];
$url = '/scandiweb';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-type: application/json; charset=UTF-8");

require('Router/Route.php');
(new model\Route)->run($path);
