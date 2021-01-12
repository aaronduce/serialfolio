<?php

require "../bootstrap.php";
use Src\Controller\SFController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$uriArray = json_encode($uri);

$requestMethod = $_SERVER['REQUEST_METHOD'];

$SFController = new SFController($dbConn, $requestMethod, $uriArray);


if (($uri[1] == 'api')) {
    header('HTTP/1.1 403 Forbidden');
    exit();
} else {
    $SFController->processRequest();
}


