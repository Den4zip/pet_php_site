<?php
function get_db_connection() {
    $host = getenv('DB_HOST');
    $port = getenv('DB_PORT');
    $db   = getenv('DB_DATABASE');
    $user = getenv('DB_USERNAME');
    $pass = getenv('DB_PASSWORD');

    $dsn = "pgsql:host=$host;port=$port;dbname=$db;";
    
    try {
        $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $pdo;
    } catch (PDOException $e) {
        // In a real application, you would log this error and show a generic error page.
        die("Connection failed: " . $e->getMessage());
    }
}
?>