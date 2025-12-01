<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($conn)) {
    require_once 'config.php';
}

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.htmlspecialchars($message).'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <a href="admin_contacts.php">messages</a>
      </nav>

      <?php

      // Ensure session and DB connection are available
      if (session_status() !== PHP_SESSION_ACTIVE) {
          session_start();
      }

      if (!isset($conn)) {
          require_once 'config.php';
      }

      // Safely display any messages (if set)
      if (!empty($message) && is_array($message)){
         foreach($message as $msg){
            echo '<div class="message">'
               . '<span>'.htmlspecialchars($msg).'</span>'
               . '<i class="fas fa-times" onclick="this.parentElement.remove();"></i>'
            . '</div>';
         }
      }

      // Determine admin id (if logged in)
      $admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;

      // If admin is logged in, fetch profile; otherwise leave empty
      $fetch_profile = [];
      if ($admin_id) {
          $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
          $select_profile->execute([$admin_id]);
          $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      }

      ?>

      <header class="header">

         <div class="flex">

            <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

            <nav class="navbar">
               <a href="admin_page.php">home</a>
               <a href="admin_products.php">products</a>
               <a href="admin_orders.php">orders</a>
               <a href="admin_users.php">users</a>
               <a href="admin_contacts.php">messages</a>
            </nav>

            <div class="icons">
               <div id="menu-btn" class="fas fa-bars"></div>
               <div id="user-btn" class="fas fa-user"></div>
            </div>

            <div class="profile">
               <?php if ($admin_id && !empty($fetch_profile)) : ?>
                  <img src="uploaded_img/<?= htmlspecialchars($fetch_profile['image'] ?? 'default.png'); ?>" alt="">
                  <p><?= htmlspecialchars($fetch_profile['name'] ?? ''); ?></p>
                  <a href="admin_update_profile.php" class="btn">update profile</a>
                  <a href="logout.php" class="delete-btn">logout</a>
               <?php else: ?>
                  <div class="flex-btn">
                     <a href="login.php" class="option-btn">login</a>
                     <a href="register.php" class="option-btn">register</a>
                  </div>
               <?php endif; ?>
            </div>

         </div>

      </header>