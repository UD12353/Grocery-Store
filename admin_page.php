<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
   session_start();
}

require_once 'config.php';

$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;

if (!$admin_id) {
   header('Location: login.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">

   <section class="dashboard">

      <h1 class="title">dashboard</h1>

      <div class="box-container">

         <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
               $total_pendings += $fetch_pendings['total_price'];
            };
            ?>
            <h3>$<?= $total_pendings; ?>/-</h3>
            <p>total pendings</p>
            <a href="admin_orders.php" class="btn">see orders</a>
         </div>

         <div class="box">
            <?php
            $total_completed = 0;
            $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completed->execute(['completed']);
            while ($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)) {
               $total_completed += $fetch_completed['total_price'];
            };
            ?>
            <h3>$<?= $total_completed; ?>/-</h3>
            <p>completed orders</p>
            <a href="admin_orders.php" class="btn">see orders</a>
         </div>

         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount();
            ?>
            <h3><?= $number_of_orders; ?></h3>
            <p>orders placed</p>
            <a href="admin_orders.php" class="btn">see orders</a>
         </div>

         <div class="box">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount();
            ?>
            <h3><?= $number_of_products; ?></h3>
            <p>products added</p>
            <a href="admin_products.php" class="btn">see products</a>
         </div>

         <div class="box">
            <?php
            $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
            $select_users->execute(['user']);
            $number_of_users = $select_users->rowCount();
            ?>
            <h3><?= $number_of_users; ?></h3>
            <p>total users</p>
            <a href="admin_users.php" class="btn">see accounts</a>
         </div>

         <div class="box">
            <?php
            $select_admins = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
            $select_admins->execute(['admin']);
            $number_of_admins = $select_admins->rowCount();
            ?>
            <h3><?= $number_of_admins; ?></h3>
            <p>total admins</p>
            <a href="admin_users.php" class="btn">see accounts</a>
         </div>

         <div class="box">
            <?php
            $select_accounts = $conn->prepare("SELECT * FROM `users`");
            $select_accounts->execute();
            $number_of_accounts = $select_accounts->rowCount();
            ?>
            <h3><?= $number_of_accounts; ?></h3>
            <p>total accounts</p>
            <a href="admin_users.php" class="btn">see accounts</a>
         </div>

         <div class="box">
            <?php
            $select_messages = $conn->prepare("SELECT * FROM `message`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount();
            ?>
            <h3><?= $number_of_messages; ?></h3>
            <p>total messages</p>
            <a href="admin_contacts.php" class="btn">see messages</a>
         </div>

      </div>

      </div>

   </section>

   <section class="dashboard">
      <h1 class="title">Analytics</h1>
      <div class="box-container">
         <div class="box" style="width: 100%; max-width: 800px; margin: 0 auto;">
            <canvas id="productsChart"></canvas>
         </div>
      </div>
   </section>

   <?php
   // Prepare data for the chart
   $category_counts = [];
   $category_names = [];

   $select_categories = $conn->prepare("SELECT category, COUNT(*) as count FROM `products` GROUP BY category");
   $select_categories->execute();

   while ($row = $select_categories->fetch(PDO::FETCH_ASSOC)) {
      $category_names[] = $row['category'];
      $category_counts[] = $row['count'];
   }

   // Convert to JSON for JS
   $js_category_names = json_encode($category_names);
   $js_category_counts = json_encode($category_counts);
   ?>

   <script>
      const ctx = document.getElementById('productsChart').getContext('2d');
      const productsChart = new Chart(ctx, {
         type: 'bar',
         data: {
            labels: <?= $js_category_names; ?>,
            datasets: [{
               label: 'Number of Products',
               data: <?= $js_category_counts; ?>,
               backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
               ],
               borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
               ],
               borderWidth: 1
            }]
         },
         options: {
            responsive: true,
            scales: {
               y: {
                  beginAtZero: true,
                  ticks: {
                     stepSize: 1
                  }
               }
            },
            plugins: {
               legend: {
                  display: false
               },
               title: {
                  display: true,
                  text: 'Products per Category Distribution'
               }
            }
         }
      });
   </script>













   <script src="js/script.js"></script>

   </body>

</html>