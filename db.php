<?php
$host = 'localhost';    // Your database host
$db   = 'myliste';      // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
