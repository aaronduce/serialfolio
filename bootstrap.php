<?php

require 'vendor/autoload.php';

use Src\System\DbConn;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbConn = (new DbConn())->getConn();

