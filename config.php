<?php

/**
 * DATABASE CONFIGURATION FILE
 * 
 * This file establishes connection to MySQL database using PDO
 * PDO (PHP Data Objects) provides a secure way to interact with databases
 * 
 * Security Features:
 * - Uses prepared statements to prevent SQL injection
 * - Centralized connection management
 * - Error handling with exceptions
 * 
 * @author UD & VV
 */

// Database connection parameters
$db_host = 'localhost';      // Database server (usually localhost for local development)
$db_name = 'shop_db';        // Database name
$db_user = 'root';           // Database username (default for XAMPP/local)
$db_pass = '';               // Database password (empty for XAMPP/local)

try {
    /**
     * Create PDO database connection
     * 
     * DSN (Data Source Name) format: mysql:host=HOST;dbname=DATABASE
     * PDO::ERRMODE_EXCEPTION enables exception throwing for errors
     * This allows us to catch and handle database errors gracefully
     */
    $conn = new PDO(
        "mysql:host=$db_host;dbname=$db_name",  // Connection string
        $db_user,                                 // Username
        $db_pass,                                 // Password
        [
            // Set error mode to exceptions for better error handling
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

            // Set default fetch mode to associative array
            // This makes it easier to access data by column name
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

            // Disable emulated prepared statements for better security
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );

    // Connection successful (no output needed)

} catch (PDOException $e) {
    /**
     * Handle connection errors
     * In production, you should log errors instead of displaying them
     * For development, we show the error message
     */
    die("Database Connection Failed: " . $e->getMessage());
}

/**
 * USAGE EXAMPLE:
 * 
 * // Prepared statement (prevents SQL injection)
 * $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
 * $stmt->execute([$email]);
 * $user = $stmt->fetch();
 * 
 * // Insert data
 * $stmt = $conn->prepare("INSERT INTO products (name, price) VALUES (?, ?)");
 * $stmt->execute([$product_name, $price]);
 */
