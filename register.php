<?php 
    session_start();
    $email = $_POST['email'];
    $user_r = $_POST['username'];
    $pass_r = $_POST['password']; 
    
   
    $conn = new mysqli('localhost', 'root', '', 'sa-project');

    // Check if the username already exists
    $check_username_query = "SELECT * FROM customers WHERE username = '$user_r'";
    $check_username_result = mysqli_query($conn, $check_username_query);

    if (mysqli_num_rows($check_username_result) > 0) {
        $_SESSION['error_reg'] = "Username already exists. Please choose a different username.";
        header('location: account.php');
    } else {
        // Username is unique, proceed with registration
        $register_query = "INSERT INTO customers (email, username, password) VALUES ('$email', '$user_r', '$pass_r')";
        mysqli_query($conn, $register_query);
        header('location: account.php');
    }
?>
