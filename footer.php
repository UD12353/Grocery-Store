<!-- ============================================ -->
<!-- FOOTER COMPONENT -->
<!-- Displayed at the bottom of all pages -->
<!-- Contains: Links, Contact Info, Social Media, Copyright -->
<!-- @author UD & VV -->
<!-- ============================================ -->

<footer class="footer">

   <!-- Footer Content Grid -->
   <section class="box-container">

      <!-- Quick Links Section -->
      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="shop.php"> <i class="fas fa-angle-right"></i> shop</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="contact.php"> <i class="fas fa-angle-right"></i> contact</a>
      </div>

      <!-- Extra Links Section -->
      <div class="box">
         <h3>extra links</h3>
         <a href="cart.php"> <i class="fas fa-angle-right"></i> cart</a>
         <a href="wishlist.php"> <i class="fas fa-angle-right"></i> wishlist</a>
         <a href="login.php"> <i class="fas fa-angle-right"></i> login</a>
         <a href="register.php"> <i class="fas fa-angle-right"></i> register</a>
      </div>

      <!-- Contact Information Section -->
      <div class="box">
         <h3>contact info</h3>
         <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
         <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
         <p> <i class="fas fa-envelope"></i> shaikhanas@gmail.com </p>
         <p> <i class="fas fa-map-marker-alt"></i> mumbai, india - 400104 </p>
      </div>

      <!-- Social Media Links Section -->
      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </section>

   <!-- Copyright Notice -->
   <!-- Dynamically displays current year using PHP -->
   <p class="credit"> &copy; copyright @ <?= date('Y'); ?> by <span>UD & VV</span> | all rights reserved! </p>

   <!-- ============================================ -->
   <!-- SCROLL TO TOP BUTTON -->
   <!-- Appears when user scrolls down 300px -->
   <!-- Smooth scrolls back to top when clicked -->
   <!-- Positioned fixed in bottom right corner -->
   <!-- ============================================ -->
   <div id="scrollToTop">
      <i class="fas fa-arrow-up"></i>
   </div>

</footer>