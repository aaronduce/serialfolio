<?php

namespace Src\Model;

class SFDB {
    private $db = null;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getSerials() {
        $statement = "SELECT * FROM serials ORDER BY serialName ASC;";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function addSerial(String $serialName, String $serialKey) {
        $statement = "
            INSERT INTO serials
                (serialName, serialKey)
            VALUES
                (:serialName, :serialKey);
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'serialName' => $serialName,
                'serialKey' => $serialKey
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}