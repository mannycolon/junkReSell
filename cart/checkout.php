
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
<?php
// include database configuration file
include 'dbConfig.php';
// redirect to home if cart is empty
if($cart->totalItems() <= 0){
    header("Location: ../index.php");
}
// redirect to login page if no user logged in
if(!$_SESSION['user']){
  header("Location: ../account/login.php");
}
//get current user's userID to be used for checkout
$email = $_SESSION['user'];
$userQuery = $db->query("SELECT * FROM users WHERE email='$email'");
$row = $userQuery->fetch_assoc();
// set customer ID in session
$_SESSION['sessCustomerID'] = $row['userID'];
// get customer details by session customer ID
$query = $db->query("SELECT * FROM users WHERE userID = ".$_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc();
$_SESSION['shipAddressID'] = $custRow["shipAddressID"];
$_SESSION['billingAddressID'] = $custRow["billingAddressID"];

//get ship Address
$addressQuery = $db->query("SELECT * FROM addresses WHERE addressID = ".$custRow["shipAddressID"]);
$addressRow = $addressQuery->fetch_assoc();

//get billing Address
$billAddressQuery = $db->query("SELECT * FROM addresses WHERE addressID = ".$custRow["billingAddressID"]);
$billAddressRow = $billAddressQuery->fetch_assoc();
?>
    <main>
<div class="container">
    <h1>Order Preview</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->totalItems() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo '$'.$item["price"].' USD'; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo '$'.$item["subtotal"].' USD'; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>No items in your cart......</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->totalItems() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '$'.$cart->totalPrice().' USD'; ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <div class="shipAddr">
      <div class="row">
        <div class="col-sm-4 col-md-4">
        <h4>Shipping Details</h4>
        <?php if (isset($custRow)) :?>
        <p>
          <?php echo $custRow['firstname']; ?>
          <?php echo $custRow['lastname']; ?>
        </p>
        <?php else: ?>
        <p style="color: red">
          Unable to retrieve user's information, please go to your
          account page and add your personal information.
        </p>
        <?php endif; ?>
        <?php if (isset($addressRow)) :?>
        <p>
          <?php echo $addressRow['address'] . ","; ?>
          <?php echo $addressRow['city'] . ","; ?>
          <?php echo $addressRow['state'] . ","; ?>
          <?php echo $addressRow['zipCode']; ?>
        </p>
        <p>
          <?php echo $addressRow['phone']; ?>
        </p>
        <?php else: ?>
          <p style="color: red">
            No address information found in the database for: <b><?php echo $email ?></b>
          </p>
        <?php endif; ?>
      </div>
      <div class="col-sm-4 col-md-4">
        <h4>Billing address</h4>
        <?php if (isset($addressRow)) :?>
        <p>
          <?php echo $billAddressRow['address'] . ","; ?>
          <?php echo $billAddressRow['city'] . ","; ?>
          <?php echo $billAddressRow['state'] . ","; ?>
          <?php echo $billAddressRow['zipCode']; ?>
        </p>
        <?php else: ?>
          <p style="color: red">
            No address information found in the database for: <b><?php echo $email ?></b>
          </p>
        <?php endif; ?>
      </div>


    </div>
    </div>
    <div class="footBtn">
        <a href="../index.php" class="btn btn-warning">
          <i class="glyphicon glyphicon-menu-left"></i> Continue Shopping
        </a>
        <a href="cartAction.php?action=placeOrder" class="btn btn-success orderBtn">
          Place Order <i class="glyphicon glyphicon-menu-right"></i>
        </a>
    </div>
</div>
</main>
</body>
</html>
