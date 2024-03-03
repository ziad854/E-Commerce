<?php
session_start();
$fname = $_POST['firstname'];
$pnumber = $_POST['pnumber'];
$concern = $_POST['consern']; 
$subject = $_POST['subject']; 


$conn = new mysqli('localhost', 'root', '', 'sa-project');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO contactus (customer_id, fname, phone_num, concern, subject) VALUES ('$_SESSION[customer_id]', '$fname', '$pnumber', '$concern', '$subject')";
$conn->query($sql);
header('location: contact.php');
$conn->close();
?>