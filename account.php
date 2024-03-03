<?php 

include('headers_and_footer/header.php');

?>

<!-- --------account-page------ -->
<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="images/image1.png" width="100%">
            </div>
            <div class="col-2">
                <div class="form-container">
                    <div class="form-btn">
                        <span onclick="login()">Login</span>
                        <span onclick="register()">Register</span>
                        <hr id="Indicator">
                    </div> 
                    <form id="LoginForm" action="login.php" method="post">
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" class="btn">Login</button>
                        <div class="red-text" style="color: red;"><?php if(isset($_SESSION["error_log"])) {echo $_SESSION["error_log"]; unset($_SESSION["error"]);  } ; ?></div>
                        <!-- <a href="">Forgot Password</a> -->
                    </form>
                    <form id="RegForm" action="register.php" method="post" >
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password"pattern=".{8,}" title="Password must be at least 8 characters long" required>
                        <button type="submit" onclick="" class="btn">Register</button>
                        <div class="red-text" style="color: red;"><?php if(!empty($_SESSION["error_reg"])) {echo $_SESSION["error_reg"]; unset($_SESSION["error_reg"]);  } ; ?></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("headers_and_footer/footer.php") ?>
