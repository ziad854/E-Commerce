<?php

include("headers_and_footer/header.php");

// Include your database connection configuration here
$conn = new mysqli('localhost', 'root', '', 'sa-project');

if (isset($_POST['add_to_cart'])) {
    $customer_id = $_SESSION['customer_id'];

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Retrieve product details from the database based on $product_id
    $query = "SELECT name, description, price FROM products WHERE id = $product_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['name'];
        $product_description = $row['description'];
        $product_price = $row['price'];

        // Check if the cart session variable is set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }


        if (isset($_SESSION['cart'][$product_id])) {

            $_SESSION['cart'][$product_id] += $quantity;
        } else {

            $_SESSION['cart'][$product_id] = $quantity;


            $insert_query = "INSERT INTO cart (customer_id, product_id, quantity, product_name, product_description, product_price) VALUES ($customer_id, $product_id, $quantity, '$product_name', '$product_description', $product_price)";
            $conn->query($insert_query);
        }
    }
}
$sql = "SELECT price FROM products";
  $result=$conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prices[] = $row['price'];
    }
}

?>


<div class="small-container single-product">
    <div class="row">
        <div class="col-2">
            <img src="images/speaker.png" width="100%" id="productImg">
            <div class="small-img-row">
            </div>
        </div>

        <div class="col-2">
            <p>Home / Electronics</p>
            <h1>Wireless Portable Bluetooth Speakers</h1>
            <h4><?php echo $prices[0];?>$</h4>
            <?php $is_login = (isset($_SESSION["username"]))? "cart.php": "account.php";?>
            <form method="post" action="<?php echo $is_login?>">
                <input type="hidden" name="product_id" value="1">
                <input type="number" value="1" name="quantity">
                <button type="submit" class="btn" name="add_to_cart">Add To Cart</button>
            </form>
        </div>
    </div>
</div>

<?php
$conn->close();
include("headers_and_footer/footer.php") ?>
