<?php
session_start(); // Start the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'sa-project');

    // TODO: Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM customers WHERE username ='$username' AND password='$password'";
    $result = $conn->query($sql);
    $_SESSION["error"] ="";
    if ($result->num_rows == 1) {
        // User found, set session variable and redirect
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $username;
        $_SESSION["customer_id"] = $row["customer_id"]; 
        $_SESSION["admin"]= $row["admin"]; 
        header("Location: index.php");
    } else {
        // User not found or incorrect credentials
        $_SESSION["error_log"] ="Invalid username or password";
        header("Location: account.php");
    }

    $conn->close();
}
?>
