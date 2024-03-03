     <!-- -------footer------ -->
     <footer class="footer">
        <div class="container-f">
          <div class="row-f">
            <div class="footer-col">
              <h4>online shop</h4>
              <ul>
                <!-- <li><a href="toys-product.php">Toys</a></li> -->
                <li><a href="Electronics.php">Electronics</a></li>
                <!-- <li><a href="footwear-product.php">Footwear</a></li>
                <li><a href="electronics-product.php">Electronics</a></li>
                <li><a href="gift-product.php">Gift & frams</a></li>
                <li><a href="#">Beauty and Personal care</a></li> -->
              </ul>
            </div>
            <div class="footer-col">
              <h4>get help</h4>
              <ul>
                <!-- <li><a href="#">FAQ</a></li>
                <li><a href="#">shipping</a></li>
                <li><a href="#">returns</a></li> -->
                <?php if(isset($_SESSION["username"])&& $_SESSION["admin"]==0){
                  echo "<li><a href=\"order_status.php\">orders status</a></li>";
                }
                  elseif(isset($_SESSION["username"])&& $_SESSION["admin"]==1) echo "<li><a href=\"admin_report.php\">orders reports</a></li>";
                ?>
              </ul>
            </div> 
              <!-- <div class="footer-col">
                <h4>company</h4>
                <ul>
                  <li><a href="about.php">About Us</a></li>
                  <li><a href="contact.php">Contact Us</a></li>
                  <li><a href="product.php">Our Services</a></li>
                  <li><a href="#">Privacy Policy</a></li>
                </ul>
              </div> -->
              <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                  <a href="#"><i class="fab fa-whatsapp"></i></a>
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                  <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
          <!-- </div>
            <hr><div class="copyright text-center">
              <h5><a href="#">🌐</a> copyright © 2022 SiyaShop.com all rights reserved</h5>
              <br><small>♥ built by <a href="https://www.linkedin.com/in/shubham-choudhary-shubh/" target="_blank">Shubham Choudhary</a>-</small>
            </div>
          </div>   -->
     </footer>
     <!-- -------js for toggle menu----- -->
     <script>
       var MenuItems = document.getElementById("MenuItems");
       var MenuItem = document.getElementById("inneritems");
       MenuItems.style.maxHeight = "0px";

       function menutoggle(){
         if(MenuItems.style.maxHeight == "0px")
         {
          MenuItems.style.maxHeight = "200px";
         }
         else
         {
          MenuItems.style.maxHeight = "0px";
         }
        
       }
       function menutoggl(){
         if(MenuItem.style.display == "block")
         {
          MenuItem.style.display = "none";
         }
         else
         {
          MenuItem.style.display = "block";
         }
        
       }
       var LoginForm = document.getElementById("LoginForm");
var RegForm = document.getElementById("RegForm");
var Indicator = document.getElementById("Indicator");
function register(){
RegForm.style.transform = "translateX(0px)";
LoginForm.style.transform = "translateX(0px)";
Indicator.style.transform = "translateX(100px)";
}
function login(){
RegForm.style.transform = "translateX(300px)";
LoginForm.style.transform = "translateX(300px)";
Indicator.style.transform = "translateX(0px)";
}
     </script>
  </body>
      </html>
