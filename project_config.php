<?php
/**
 * Project Configuration File
 * Grocery Store Application
 * 
 * This file contains all project-wide configurations and path definitions
 */

// ============================================
// ERROR REPORTING (Development Mode)
// ============================================
// Set to E_ALL for development, 0 for production
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ============================================
// PROJECT PATHS
// ============================================
// Define base directory (works on any drive)
define('BASE_PATH', __DIR__);

// Define common directories
define('CSS_PATH', BASE_PATH . '/css');
define('JS_PATH', BASE_PATH . '/js');
define('IMAGES_PATH', BASE_PATH . '/images');
define('UPLOADED_IMG_PATH', BASE_PATH . '/uploaded_img');

// URL paths (for use in HTML/CSS)
define('BASE_URL', '/grocery store/grocery store'); // Adjust based on your server setup
define('CSS_URL', BASE_URL . '/css');
define('JS_URL', BASE_URL . '/js');
define('IMAGES_URL', BASE_URL . '/images');
define('UPLOADED_IMG_URL', BASE_URL . '/uploaded_img');

// ============================================
// DATABASE CONFIGURATION
// ============================================
define('DB_HOST', 'localhost');
define('DB_NAME', 'shop_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// PDO DSN
define('DB_DSN', "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET);

// PDO Options
$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// ============================================
// DATABASE CONNECTION
// ============================================
try {
    $conn = new PDO(DB_DSN, DB_USER, DB_PASS, $pdoOptions);
    // Connection successful
} catch (PDOException $e) {
    // Log error in production, display in development
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection failed. Please check your configuration.");
}

// ============================================
// SESSION CONFIGURATION
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// HELPER FUNCTIONS
// ============================================

/**
 * Get the full file path
 * @param string $relativePath - Path relative to project root
 * @return string - Full absolute path
 */
function getPath($relativePath) {
    return BASE_PATH . '/' . ltrim($relativePath, '/');
}

/**
 * Get the URL path
 * @param string $relativePath - Path relative to project root
 * @return string - Full URL path
 */
function getUrl($relativePath) {
    return BASE_URL . '/' . ltrim($relativePath, '/');
}

/**
 * Sanitize user input
 * @param string $data - Input data
 * @return string - Sanitized data
 */
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Check if user is logged in
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Check if user is admin
 * @return bool
 */
function isAdmin() {
    return isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin';
}

/**
 * Redirect to a page
 * @param string $page - Page to redirect to
 */
function redirect($page) {
    header("Location: " . getUrl($page));
    exit;
}

/**
 * Display success message
 * @param string $message
 */
function showSuccess($message) {
    $_SESSION['success_message'] = $message;
}

/**
 * Display error message
 * @param string $message
 */
function showError($message) {
    $_SESSION['error_message'] = $message;
}

/**
 * Get and clear flash messages
 * @return array
 */
function getMessages() {
    $messages = [
        'success' => $_SESSION['success_message'] ?? null,
        'error' => $_SESSION['error_message'] ?? null
    ];
    
    unset($_SESSION['success_message']);
    unset($_SESSION['error_message']);
    
    return $messages;
}

// ============================================
// PROJECT INFORMATION
// ============================================
define('PROJECT_NAME', 'Grocery Store');
define('PROJECT_VERSION', '1.0.0');
define('PROJECT_DRIVE', 'E:'); // Your project is on E: drive
define('PHP_DRIVE', 'C:'); // PHP is on C: drive

// ============================================
// TIMEZONE
// ============================================
date_default_timezone_set('Asia/Kolkata'); // Set to your timezone

?>
