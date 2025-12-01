<?php

/**
 * SHOPPING CART PAGE
 * 
 * Displays user's shopping cart with product management
 * 
 * Features:
 * - View all cart items
 * - Update product quantities
 * - Remove individual items
 * - Delete all items at once
 * - Calculate grand total
 * - Proceed to checkout
 * 
 * Security:
 * - User authentication required
 * - User can only access their own cart
 * - Input sanitization on all operations
 * 
 * @author UD & VV
 */

// Start session if not already started
if (session_status() !== PHP_SESSION_ACTIVE) {
   session_start();
}

// Include database connection
require_once 'config.php';

// Get logged-in user ID
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Security: Redirect to login if not authenticated
if (!$user_id) {
   header('Location: login.php');
   exit;
}

// ============================================
// HANDLE DELETE SINGLE ITEM
// ============================================
if (isset($_GET['delete'])) {
   // Sanitize cart item ID
   $delete_id = filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT);

   if ($delete_id) {
      // Delete item only if it belongs to current user (security)
      $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ? AND user_id = ?");
      $delete_cart_item->execute([$delete_id, $user_id]);
   }

   // Redirect to refresh page
   header('Location: cart.php');
   exit;
}

// ============================================
// HANDLE DELETE ALL ITEMS
// ============================================
if (isset($_GET['delete_all'])) {
   // Delete all cart items for current user
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);

   // Redirect to refresh page
   header('Location: cart.php');
   exit;
}

// ============================================
// HANDLE UPDATE QUANTITY
// ============================================
if (isset($_POST['update_qty'])) {
   // Sanitize inputs
   $cart_id = filter_input(INPUT_POST, 'cart_id', FILTER_SANITIZE_NUMBER_INT);
   $p_qty = filter_input(INPUT_POST, 'p_qty', FILTER_SANITIZE_NUMBER_INT);

   // Validate quantity is positive
   if ($cart_id && $p_qty && $p_qty > 0) {
      // Update quantity for this cart item
      // Only if it belongs to current user (security)
      $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ? AND user_id = ?");
      $update_qty->execute([$p_qty, $cart_id, $user_id]);
      $message[] = 'cart quantity updated';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>

   <!-- Font Awesome for icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <!-- ============================================ -->
   <!-- SHOPPING CART SECTION -->
   <!-- ============================================ -->
   <section class="shopping-cart">

      <h1 class="title">products added</h1>

      <div class="box-container">

         <?php
         // Initialize grand total
         $grand_total = 0;

         // Fetch all cart items for current user
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);

         // Check if cart has items
         if ($select_cart->rowCount() > 0) {
            // Loop through each cart item
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
         ?>

               <!-- Cart Item Card -->
               <form action="" method="POST" class="box">
                  <!-- Delete Button -->
                  <a href="cart.php?delete=<?= $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>

                  <!-- View Product Details Button -->
                  <a href="view_page.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>

                  <!-- Product Image -->
                  <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="<?= $fetch_cart['name']; ?>">

                  <!-- Product Name -->
                  <div class="name"><?= $fetch_cart['name']; ?></div>

                  <!-- Product Price -->
                  <div class="price">$<?= $fetch_cart['price']; ?>/-</div>

                  <!-- Hidden field for cart item ID -->
                  <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">

                  <!-- Quantity Update Section -->
                  <div class="flex-btn">
                     <!-- Quantity Input -->
                     <input type="number" min="1" value="<?= $fetch_cart['quantity']; ?>" class="qty" name="p_qty">
                     <!-- Update Button -->
                     <input type="submit" value="update" name="update_qty" class="option-btn">
                  </div>

                  <!-- Calculate and display subtotal for this item -->
                  <div class="sub-total">sub total : <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
               </form>

         <?php
               // Add to grand total
               $grand_total += $sub_total;
            } // End while loop
         } else {
            // Cart is empty
            echo '<p class="empty">your cart is empty</p>';
         }
         ?>
      </div>

      <!-- ============================================ -->
      <!-- CART TOTAL AND ACTION BUTTONS -->
      <!-- ============================================ -->
      <div class="cart-total">
         <!-- Display Grand Total -->
         <p>grand total : <span>$<?= $grand_total; ?>/-</span></p>

         <!-- Continue Shopping Button -->
         <a href="shop.php" class="option-btn">continue shopping</a>

         <!-- Delete All Button (disabled if cart empty) -->
         <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">delete all</a>

         <!-- Checkout Button (disabled if cart empty) -->
         <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>
      </div>

   </section>

   <?php include 'footer.php'; ?>

   <!-- JavaScript for interactive features -->
   <script src="js/script.js"></script>

</body>

</html>