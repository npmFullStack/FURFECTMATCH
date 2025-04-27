<?php
function getDbConnection() {
    // Database configuration
    $db_host = "127.0.0.1";      // Database server address
    $db_name = "furfect_match";  // Database name
    $db_user = "root";           // Database username
    $db_pass = "";               // Database password

    try {
        // Create PDO instance
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        
        // Set error mode to exceptions
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Set default fetch mode to associative array
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $conn;
        
    } catch (PDOException $e) {
        // If connection fails, show error message
        die("Database connection failed: " . $e->getMessage());
    }
}
?>