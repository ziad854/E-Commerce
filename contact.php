
  <?php include("headers_and_footer/header.php") ?>
<!-- ---------ABOUT-------- -->
<div class="account-page">
<div class="container">
  <div style="text-align:center">
    <h2>Contact Us</h2>
    <p>You can ask anything related to our shop.</p>
  </div>
  <div class="row">
    <!--<div class="column">
      <img src="/w3images/map.jpg" style="width:100%">
    </div>-->
    
    <div class="column">
      <form action="action_page.php" method="post">
        <label for="fname">Name</label>
        <input type="text" id="fname" name="firstname" placeholder="Your name..">
        <label for="lname">Number</label>
        <input type="number" id="pnumber" name="pnumber" placeholder="Your Contact Number..">
        <label for="country">Reason</label>
        <select id="country" name="consern">
          <option value="Buy">Buy</option>
          <option value="Sell">Sell</option>
          <option value="Promotion">Promotion</option>
          <option value="Order">Order</option>
        </select>
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height: 170px"></textarea>
        <input type="submit" value="Submit">
      </form>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d221246.23001266512!2d31.250298772387797!3d29.951474109978623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145836f34a58de69%3A0x49853855f032462a!2sHelwan%20University!5e0!3m2!1sen!2seg!4v1700773900329!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>    </div>
</div>
</div>
<?php include("headers_and_footer/footer.php") ?>