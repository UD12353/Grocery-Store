<?php

/**
 * ADMIN DASHBOARD - Statistics and Overview
 * 
 * This page displays key metrics and statistics for the admin:
 * - Total Products
 * - Total Users
 * - Total Orders
 * - Total Revenue
 * - Recent Orders
 * - Low Stock Products
 * 
 * @author UD &VV
 */

session_start();

require_once 'config.php';

// Check if admin is logged in
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;

if (!$admin_id) {
    header('Location: login.php');
    exit;
}

// Fetch Statistics
try {
    // Total Products
    $total_products_query = $conn->prepare("SELECT COUNT(*) as total FROM `products`");
    $total_products_query->execute();
    $total_products = $total_products_query->fetch(PDO::FETCH_ASSOC)['total'];

    // Total Users
    $total_users_query = $conn->prepare("SELECT COUNT(*) as total FROM `users` WHERE user_type = 'user'");
    $total_users_query->execute();
    $total_users = $total_users_query->fetch(PDO::FETCH_ASSOC)['total'];

    // Total Orders
    $total_orders_query = $conn->prepare("SELECT COUNT(*) as total FROM `orders`");
    $total_orders_query->execute();
    $total_orders = $total_orders_query->fetch(PDO::FETCH_ASSOC)['total'];

    // Total Revenue
    $total_revenue_query = $conn->prepare("SELECT SUM(total_price) as revenue FROM `orders`");
    $total_revenue_query->execute();
    $total_revenue = $total_revenue_query->fetch(PDO::FETCH_ASSOC)['revenue'] ?? 0;

    // Pending Orders
    $pending_orders_query = $conn->prepare("SELECT COUNT(*) as total FROM `orders` WHERE payment_status = 'pending'");
    $pending_orders_query->execute();
    $pending_orders = $pending_orders_query->fetch(PDO::FETCH_ASSOC)['total'];

    // Completed Orders
    $completed_orders_query = $conn->prepare("SELECT COUNT(*) as total FROM `orders` WHERE payment_status = 'completed'");
    $completed_orders_query->execute();
    $completed_orders = $completed_orders_query->fetch(PDO::FETCH_ASSOC)['total'];

    // Category Distribution
    $category_query = $conn->prepare("SELECT category, COUNT(*) as count FROM `products` GROUP BY category ORDER BY count DESC LIMIT 5");
    $category_query->execute();
    $categories = $category_query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching statistics: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Grocer Store</title>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin-dashboard.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <!-- Dashboard Section -->
    <section class="dashboard">

        <h1 class="title">Admin Dashboard</h1>

        <!-- Statistics Cards Grid -->
        <div class="stats-container">

            <!-- Total Products Card -->
            <div class="stat-card stat-green">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-content">
                    <h3><?= $total_products; ?></h3>
                    <p>Total Products</p>
                </div>
                <div class="stat-action">
                    <a href="admin_products.php">View All <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Total Users Card -->
            <div class="stat-card stat-blue">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3><?= $total_users; ?></h3>
                    <p>Total Users</p>
                </div>
                <div class="stat-action">
                    <a href="admin_users.php">View All <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Total Orders Card -->
            <div class="stat-card stat-orange">
                <div class="stat-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-content">
                    <h3><?= $total_orders; ?></h3>
                    <p>Total Orders</p>
                </div>
                <div class="stat-action">
                    <a href="admin_orders.php">View All <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Total Revenue Card -->
            <div class="stat-card stat-purple">
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-content">
                    <h3>$<?= number_format($total_revenue, 2); ?></h3>
                    <p>Total Revenue</p>
                </div>
                <div class="stat-action">
                    <a href="admin_orders.php">View Details <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

        </div>

        <!-- Quick Stats Row -->
        <div class="quick-stats">

            <div class="quick-stat-item">
                <i class="fas fa-clock"></i>
                <div>
                    <h4><?= $pending_orders; ?></h4>
                    <p>Pending Orders</p>
                </div>
            </div>

            <div class="quick-stat-item">
                <i class="fas fa-check-circle"></i>
                <div>
                    <h4><?= $completed_orders; ?></h4>
                    <p>Completed Orders</p>
                </div>
            </div>

            <div class="quick-stat-item">
                <i class="fas fa-percentage"></i>
                <div>
                    <h4><?= $total_orders > 0 ? round(($completed_orders / $total_orders) * 100) : 0; ?>%</h4>
                    <p>Success Rate</p>
                </div>
            </div>

        </div>

        <!-- Category Distribution -->
        <div class="category-distribution">
            <h2>Top Categories</h2>
            <div class="category-list">
                <?php foreach ($categories as $cat): ?>
                    <div class="category-item">
                        <div class="category-name">
                            <i class="fas fa-tag"></i>
                            <span><?= ucfirst($cat['category']); ?></span>
                        </div>
                        <div class="category-count">
                            <span class="count-badge"><?= $cat['count']; ?></span>
                        </div>
                        <div class="category-bar">
                            <div class="category-bar-fill" style="width: <?= ($cat['count'] / $total_products) * 100; ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <a href="admin_products.php" class="action-btn btn-green">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Product</span>
                </a>
                <a href="admin_orders.php" class="action-btn btn-orange">
                    <i class="fas fa-list"></i>
                    <span>Manage Orders</span>
                </a>
                <a href="admin_users.php" class="action-btn btn-blue">
                    <i class="fas fa-user-plus"></i>
                    <span>View Users</span>
                </a>
                <a href="admin_contacts.php" class="action-btn btn-purple">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                </a>
            </div>
        </div>

    </section>

    <script src="js/script.js"></script>

</body>

</html>