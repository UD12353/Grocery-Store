<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once 'config.php';

$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;

if(!$admin_id){
   header('Location: login.php');
   exit;
}

// fetch admin profile
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$admin_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['update_profile'])){

   $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $admin_id]);

   $image = $_FILES['image']['name'] ?? '';
   $image = preg_replace('/[^A-Za-z0-9_.-]/', '', $image);
   $image_size = $_FILES['image']['size'] ?? 0;
   $image_tmp_name = $_FILES['image']['tmp_name'] ?? '';
   $image_folder = 'uploaded_img/'.$image;
   $old_image = $_POST['old_image'] ?? $fetch_profile['image'];

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $admin_id]);
         if($update_image){
            if ($image_tmp_name) move_uploaded_file($image_tmp_name, $image_folder);
            if(!empty($old_image) && file_exists('uploaded_img/'.$old_image)){
               @unlink('uploaded_img/'.$old_image);
            }
            $message[] = 'image updated successfully!';
         }
      }
   }

   $old_pass = $_POST['old_pass'] ?? $fetch_profile['password'];
   $update_pass_raw = $_POST['update_pass'] ?? '';
   $update_pass = $update_pass_raw !== '' ? md5($update_pass_raw) : '';
   $new_pass_raw = $_POST['new_pass'] ?? '';
   $new_pass = $new_pass_raw !== '' ? md5($new_pass_raw) : '';
   $confirm_pass_raw = $_POST['confirm_pass'] ?? '';
   $confirm_pass = $confirm_pass_raw !== '' ? md5($confirm_pass_raw) : '';

   if(!empty($update_pass) && !empty($new_pass) && !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         $update_pass_query = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_pass_query->execute([$confirm_pass, $admin_id]);
         $message[] = 'password updated successfully!';
      }
   }

   // refresh profile
   $select_profile->execute([$admin_id]);
   $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update admin profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="update-profile">

   <h1 class="title">update profile</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
      <div class="flex">
         <div class="inputBox">
            <span>username :</span>
            <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" placeholder="update username" required class="box">
            <span>email :</span>
            <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" placeholder="update email" required class="box">
            <span>update pic :</span>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
            <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <div class="flex-btn">
         <input type="submit" class="btn" value="update profile" name="update_profile">
         <a href="admin_page.php" class="option-btn">go back</a>
      </div>
   </form>

</section>













<script src="js/script.js"></script>

</body>
</html>