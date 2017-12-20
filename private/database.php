<?php // Adapted from: (Lynda.com - Kevin Skoglund, 2017) ?>
<?php

require_once ('db_credentials.php');

// Create a database connection
function db_connect() {
    confirm_db_connect();
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

// Disconnect from database connection
function db_disconnect($connection) {
    if (isset($connection)) {
        mysqli_close($connection);
    }
}

// Sanitise strings to prevent SQL injection
function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection, $string);
}

// Test if connection succeeded
function confirm_db_connect() {
    if (mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

// Test if query succeeded
function confirm_result_set($result_set) {
    if (!$result_set) {
        exit("Database query failed.");
    }
}

?>