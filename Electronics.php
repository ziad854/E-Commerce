
  <?php

  include("headers_and_footer/header.php") ;
  
  $conn = new mysqli('localhost', 'root', '', 'sa-project');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  
  $sql = "SELECT price FROM products";
  $result=$conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prices[] = $row['price'];
    }
}

  $conn->close();
  ?>
<div class="small-container">
   <div class="row row-2">
    <h2>All Product</h2>
    <select>
          <option>Default Shorting</option>
          <option>Short by price</option>
          <option>Short by popularity</option>
          <option>Short by rating</option>
          <option>Short by sale</option>
     </select>
     <!-- <button class="btn" aria-colcount="page-btn">
      <span><a href="fashion-child-product.html">•Child Clothes</span></a>
      <span><a href="fashion-saree-product.html">•Saree</span></a>
      <span><a href="gift-product.html">•Gift</span></a>
      <span><a href="toys-product.html">•Toys</span></a>
      <span><a href="footwear-product.html">•Footwear</span></a>
      <span><a href="electronics-product.html">•Electronics</span></a>
    </button> -->
</div>
  <div class="row">
    <div class="col-4">
      <a href="speaker.php">
      <img src="images/speaker.png" style="height: 150px; width:200px;"alt="">
      </a>
      <h4><a href="speaker.php">Speakers</a></h4>
      <p><p><?php echo $prices[0];?>$</p></p>
    </div>
    <div class="col-4">
    <a href="headphone.php">
      <img src="images/headphones.png" style="height: 150px; width:200px;"alt="">
      </a>
      <h4><a href="headphone.php">Headphones</a></h4>
      <p><?php echo $prices[1];?>$</p>
    </div>
    <!-- <div class="col-4">
        <img src="images/clothes/child clothes/cloth3.jpg" alt="">
        <h4>Frog </h4>
      <p>200 rs.</p>
    </div>
    <div class="col-4">
        <img src="images/clothes/child clothes/cloth4.jpg" alt="">
        <h4>Skirt and Top </h4>
      <p>250 rs.</p>
    </div> -->

  <div class="page-btn">
    <span><a href="#">1</span></a>
    <span><a href="#">2</span></a>
    <span>➝</span>
    </div>
  </div>
  <?php include("headers_and_footer/footer.php") ?>