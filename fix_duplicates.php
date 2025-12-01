<?php
// fix_duplicates.php
// Run this file in your browser (e.g., localhost:8000/fix_duplicates.php) to remove duplicate products.

include 'config.php';

echo "<h1>Cleaning up duplicate products...</h1>";

// 1. Select all products
$select_products = $conn->prepare("SELECT * FROM `products` ORDER BY id ASC");
$select_products->execute();

$seen_names = [];
$duplicates_removed = 0;

if ($select_products->rowCount() > 0) {
    while ($row = $select_products->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $name = trim($row['name']); // Trim whitespace to match correctly
        $category = $row['category'];

        // Check if we have seen this name before
        if (isset($seen_names[$name])) {
            // This is a duplicate! Delete it.

            // First, delete from wishlist and cart to avoid foreign key issues (if any)
            $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
            $delete_wishlist->execute([$id]);

            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
            $delete_cart->execute([$id]);

            // Now delete the product
            $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
            $delete_product->execute([$id]);

            echo "<p style='color: red;'>Deleted duplicate: <strong>$name</strong> (ID: $id) from category: $category</p>";
            $duplicates_removed++;
        } else {
            // First time seeing this name, keep it.
            $seen_names[$name] = $id;
            // echo "<p style='color: green;'>Kept original: <strong>$name</strong> (ID: $id)</p>";
        }
    }
}

echo "<hr>";
if ($duplicates_removed > 0) {
    echo "<h2>✅ Success! Removed $duplicates_removed duplicate products.</h2>";
} else {
    echo "<h2>✅ No duplicates found! Your database is clean.</h2>";
}
echo "<a href='home.php'>Go back to Home</a>";
