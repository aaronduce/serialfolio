<?php

namespace Src\Controller;

use Src\Model\SFDB;

if ($_ENV["ENV"] == "production") {
    error_reporting(0);
    ini_set('display_errors', 0);
}

class SFController {
    private $db;
    private $requestMethod;
    private $uri;

    private $sfdb;

    public function __construct($db, $requestMethod, $uri) {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->uri = json_decode($uri);

        $this->sfdb = new SFDB($db);
    }

    public function processRequest() {
        if ($this->requestMethod === 'GET') {
            if (! $this->uri[1]) {
                $serials = $this->sfdb->getSerials();
                header("Content-Type: text/html; charset=UTF-8");
                include __DIR__.'/../View/main.php';
            } else {
                header("Content-Type: text/html; charset=UTF-8");
                include __DIR__.'/../View/Error/404.php';
            }
        } else if ($this->requestMethod === 'POST') {
            $this->sfdb->addSerial($_POST["sName"], $_POST["sSerial"]);
            $serials = $this->sfdb->getSerials();
            header("Content-Type: text/html; charset=UTF-8");
            include __DIR__.'/../View/main.php';
        } else {
            $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
            $response['body'] = json_encode([
                'error' => 'Invalid input'
            ]);
            return $response;
        }
    }
}