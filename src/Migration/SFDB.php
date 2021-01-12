<?php

require 'bootstrap.php';

/**
 * FullDB.php
 * Initialises a bare/empty database or existing database with new tables.
 */

$statement = <<<EOS
    CREATE TABLE IF NOT EXISTS migrations (
        id INT NOT NULL AUTO_INCREMENT,
        tables VARCHAR(30) NOT NULL,
        migrated DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) ENGINE=INNODB;

    INSERT INTO migrations (tables) VALUES ('migrations');

    CREATE TABLE IF NOT EXISTS serials (
        id INT NOT NULL AUTO_INCREMENT,
        serialName MEDIUMTEXT NOT NULL,
        serialKey MEDIUMTEXT NOT NULL,
        created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) ENGINE=INNODB;

    INSERT INTO migrations (tables) VALUES ('serials');
EOS;

try {
    $createTable = $dbConn->exec($statement);
    echo "Successfully migrated database initialisation from SFDB.php to ".$_ENV['DB_DATABASE'];
} catch (\PDOException $e) {
    exit($e->getMessage());
}