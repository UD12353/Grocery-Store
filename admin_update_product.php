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

   if (isset($_POST['update_product'])) {

      $pid = filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_NUMBER_INT);
      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $details = filter_input(INPUT_POST, 'details', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $image = $_FILES['image']['name'] ?? '';
      $image = preg_replace('/[^A-Za-z0-9_.-]/', '', $image);
      $image_size = $_FILES['image']['size'] ?? 0;
      $image_tmp_name = $_FILES['image']['tmp_name'] ?? '';
      $image_folder = 'uploaded_img/' . $image;
      $old_image = $_POST['old_image'] ?? '';

      $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, details = ?, price = ? WHERE id = ?");
      $update_product->execute([$name, $category, $details, $price, $pid]);

      $message[] = 'product updated successfully!';

      if (!empty($image)) {
         if ($image_size > 2000000) {
            $message[] = 'image size is too large!';
         } else {

            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $pid]);

            if ($update_image) {
               if ($image_tmp_name) move_uploaded_file($image_tmp_name, $image_folder);
               if (!empty($old_image) && file_exists('uploaded_img/' . $old_image)) {
                  @unlink('uploaded_img/' . $old_image);
               }
               $message[] = 'image updated successfully!';
            }
         }
      }
   }

   ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>update products</title>

     <!-- font awesome cdn link  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

     <!-- custom css file link  -->
     <link rel="stylesheet" href="css/admin_style.css">

  </head>

  <body>

     <?php include 'admin_header.php'; ?>

     <section class="update-product">

        <h1 class="title">update product</h1>

        <?php
         $update_id = $_GET['update'];
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
         $select_products->execute([$update_id]);
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
              <form action="" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
                 <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                 <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                 <input type="text" name="name" placeholder="enter product name" required class="box" value="<?= $fetch_products['name']; ?>">
                 <input type="number" name="price" min="0" placeholder="enter product price" required class="box" value="<?= $fetch_products['price']; ?>">
                 <select name="category" class="box" required>
                    <option selected><?= $fetch_products['category']; ?></option>
                    <option value="vegetables">vegetables</option>
                    <option value="fruits">fruits</option>
                    <option value="grocery">grocery</option>
                    <option value="dry fruits">dry fruits</option>
                    <option value="dairy">dairy</option>
                    <option value="bakery">bakery</option>
                    <option value="snacks">snacks</option>
                    <option value="beverages">beverages</option>
                 </select>
                 <textarea name="details" required placeholder="enter product details" class="box" cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
                 <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
                 <div class="flex-btn">
                    <input type="submit" class="btn" value="update product" name="update_product">
                    <a href="admin_products.php" class="option-btn">go back</a>
                 </div>
              </form>
        <?php
            }
         } else {
            echo '<p class="empty">no products found!</p>';
         }
         ?>

     </section>

     <script src="js/script.js"></script>

  </body>

  </html>