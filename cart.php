<?php

include("headers_and_footer/header.php");

// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'sa-project');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the product is being added to the cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if the cart session variable is set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // If the product is already in the cart, update the quantity
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        // If the product is not in the cart, add it with the specified quantity
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

// Check if the "Remove" button is clicked
if (isset($_POST['remove_item'])) {
    $product_id_to_remove = $_POST['remove_item'];

    // Check if the product is in the cart
    if (isset($_SESSION['cart'][$product_id_to_remove])) {
        // Remove the product from the cart
        unset($_SESSION['cart'][$product_id_to_remove]);
    }
}


if (isset($_POST['done'])) {

    $customer_id = $_SESSION['customer_id']; 
    // Iterate through the cart items and insert into the database

    $product_name="";
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $total_cart_price = 0;
        // Retrieve product details from the database based on $product_id
        $query = "SELECT name, price, inventory FROM products WHERE id = $product_id";
        $result = $conn->query($query);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $product_name = $row['name'];
            $product_price = $row['price'];
            $current_inventory = $row['inventory'];

            $subtotal = $product_price * $quantity;
            $total_cart_price += $subtotal;

            // Check if there's enough inventory
            if ($current_inventory >= $quantity) {
                // Calculate new inventory after purchase
                $new_inventory = $current_inventory - $quantity;

                // Update the inventory in the products table
                $update_query = "UPDATE products SET inventory = $new_inventory WHERE id = $product_id";
                $conn->query($update_query);

                // Insert into the cart table
                $insert_query = "INSERT INTO cart (customer_id, product_id, quantity, total_price) VALUES ($customer_id, $product_id, $quantity, ($total_cart_price))";
                $conn->query($insert_query);
            } else {
                // Not enough inventory, handle accordingly (e.g., show an error message)

                $_SESSION["error_inventory_$product_name"] = "Not enough inventory for product: $product_name";
            }
        }
    }

    // Clear the session cart after adding to the database
    if(!isset($_SESSION["error_inventory_$product_name"]))
    {$_SESSION['cart'] = array();}
}

?>

<!-- HTML for displaying cart items -->
<div class="account-page">
    <div class="small-container cart-page">
        <form method="post" action="cart.php">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>

                <?php
                $total_cart_price = 0;

                // Loop through cart items in the session
                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                    // Retrieve product details from the database based on $product_id
                    $query = "SELECT name, price FROM products WHERE id = $product_id";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $product_name = $row['name'];
                        $product_price = $row['price'];

                        // Calculate subtotal for the current item
                        $subtotal = $product_price * $quantity;
                        $total_cart_price += $subtotal;
                        ?>
                        <tr>
                            <td>
                                <div class="cart-info">
                                    <?php
                                    $sql = "SELECT photo FROM products WHERE id = $product_id";
                                    $result = $conn->query($sql);
                                    $productphoto; 
                                    // Check if the query was successful
                                    if ($result && $result->num_rows > 0) {
                                        // Fetch the result
                                        $row = $result->fetch_assoc();
                                        
                                        // Get the photo path from the result
                                        $productphoto = $row['photo'];}?>
                                    <img src=<?php echo $productphoto;?> alt="Product Image">
                                    <div>
                                        <p><?php echo $product_name; ?></p>
                                        <small>Price: $<?php echo $product_price; ?></small>
                                    </div>
                                    <div class="red-text" style="color: red;"><?php if(isset($_SESSION["error_inventory_$product_name"])) {echo $_SESSION["error_inventory_$product_name"]; unset($_SESSION["error_inventory_$product_name"]); } ?></div>
                                </div>
                            </td>
                            <td><input type="number" name="quantity[<?php echo $product_id; ?>]" value="<?php echo $quantity; ?>" min="1"></td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td><button type="submit" name="remove_item" value="<?php echo $product_id; ?>" style="background: #ff523b; border-radius: 10px; font-family: 'Roboto', sans-serif;">Remove</button></td>
                        </tr>
                        <?php
                    }
                }
                ?>

            </table>

            <div class="total-price">
                <table>
                    <tr>
                    <td>Delivery is free on orders over $100</td>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td>$<?php echo number_format($total_cart_price, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Delivery Charge</td>
                        <td><?php if($total_cart_price==0 || $total_cart_price>100){$delivery_charge=0;}
                                    else $delivery_charge=40;
                                    echo $delivery_charge;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>$<?php
                        if($total_cart_price>=100) echo number_format($total_cart_price + $delivery_charge, 2);
                        else echo number_format($total_cart_price, 2) 
                        ?>
                        </td>
                    </tr>
                </table>
            </div>

            <button type="submit" name="done"  style="background: #ff523b; border-radius: 10px;">Done</button>
        </form>
    </div>
</div>

<?php $conn->close(); ?>
<?php include("headers_and_footer/footer.php") ?>
