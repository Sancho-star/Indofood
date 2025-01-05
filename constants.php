<?php 
    // Start Session
    session_start();

    // Create Constants to Store Non-Repeating Values
    define('SITEURL', 'http://localhost/sanchi/.vscode/phpclglife/indofood2/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD','');
    define('DB_NAME', 'food-order');
    
    // Database Connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check if connection was successful
    if (!$conn) {
        die("Database Connection Failed: " . mysqli_connect_error());
    }

    // Selecting Database (optional since it's included in the mysqli_connect)
    // $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); 

?>
