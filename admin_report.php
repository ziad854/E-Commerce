<?php

include("headers_and_footer/header.php");

$conn = new mysqli('localhost', 'root', '', 'sa-project');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['customer_id'];

// Retrieve orders for the logged-in user from the cart table
$sql = "SELECT * FROM cart";
$result = $conn->query($sql);
$result1 =$conn->query($sql);
$cnt=0;
$notdeliverd=0;
$deliverd=0;
$total_number_orders=0;
while($buffers = $result1->fetch_assoc()){
    $cnt+=$buffers["total_price"];
    $total_number_orders+=1;
    if($buffers["delivery_status"]==="NOT DELIVERED"){
        $notdeliverd+=1;
    }
    else    $deliverd+=1;
}
?>

<div class="container mt-5">
<div class="row"></div>

    <h2>All Orders</h2>
    <div>total orders money $<?php echo $cnt;?></div>
    <div>total number of orders <?php echo $total_number_orders;?></div>
    <div>total orders Deliverd <?php echo $deliverd;?></div>
    <div>total orders Not Deliverd <?php echo $notdeliverd;?></div>    
    <?php
    $orderCount = 0; // Counter for orders in a row
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Display order details in a div
            if ($orderCount % 2 == 0) {
                // Start a new row for every two orders
                echo "<div class='row'>";
            }

            echo "<div class='col-md-6 mb-4'>";
            echo "<div class='order card'>";
            echo "<h4 class='card-header'>Order ID: " . $row['cart_id'] . "</h4>";
            echo "<div class='card-body'>";
            echo "<p class='card-text'>Product: " . $row['product_id'] . "</p>";
            echo "<p class='card-text'>Quantity: " . $row['quantity'] . "</p>";
            echo "<p class='card-text'>Total Price: $" . $row['total_price'] . "</p>";
            echo "<p class='card-text'>Delivery Status: " . $row['delivery_status'] . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

            $orderCount++;

            if ($orderCount % 2 == 0) {
                // Close the row after every two orders
                echo "</div>";
            }
        }

        // Close the row if there is an odd number of orders
        if ($orderCount % 2 != 0) {
            echo "</div>";
        }
    } else {
        echo "<p>No orders found.</p>";
    }
    ?>
</div>

<?php
include("headers_and_footer/footer.php");
?>
