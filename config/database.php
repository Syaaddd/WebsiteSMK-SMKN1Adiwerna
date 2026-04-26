<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'smkn1adiwerna');
define('BASE_URL', '/smkn1adiwerna');
define('SITE_NAME', 'SMKN 1 Adiwerna');
define('ROOT_DIR', dirname(__DIR__));

function getDB(): ?mysqli {
    static $conn = null;
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) return null;
        $conn->set_charset('utf8mb4');
    }
    return $conn;
}
