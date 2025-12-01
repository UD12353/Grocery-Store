<?php

if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<!-- CSS Variables & Imports -->
<style>
   :root {
      --green: #27ae60;
      --orange: #f39c12;
      --red: #e74c3c;
      --black: #333;
      --white: #fff;
      --light-color: #666;
      --light-bg: #f6f6f6;
      --border: 0.2rem solid rgba(0, 0, 0, 0.1);
      --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
   }
</style>

<!-- Loading Animation CSS -->
<link rel="stylesheet" href="css/loader.css">

<!-- Toast Notification CSS -->
<link rel="stylesheet" href="css/toast.css">

<!-- Loading Animation HTML -->
<div class="loader-container">
   <i class="fas fa-shopping-basket loader-icon"></i>
   <div class="loader"></div>
   <div class="loader-text">Loading...</div>
</div>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Groco<span>.</span></a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="shop.php">shop</a>
         <a href="orders.php">orders</a>
         <a href="about.php">about</a>
         <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <a href="search_page.php" class="fas fa-search"></a>
         <?php
         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_items = $count_cart_items->rowCount();

         $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
         $count_wishlist_items->execute([$user_id]);
         $total_wishlist_items = $count_wishlist_items->rowCount();
         ?>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_items; ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <p><?= $fetch_profile['name']; ?></p>
            <a href="user_profile_update.php" class="btn">update profile</a>
            <a href="logout.php" class="delete-btn">logout</a>
         <?php
         } else {
         ?>
            <div class="flex-btn">
               <a href="login.php" class="option-btn">login</a>
               <a href="register.php" class="option-btn">register</a>
            </div>
         <?php
         }
         ?>
      </div>

   </div>

</header>