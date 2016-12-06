
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
        <h4>Shipping Details</h4>
        <p><?php echo $custRow['firstname']; ?></p>
        <p><?php echo $custRow['email']; ?></p>
        <p><?php echo $custRow['phone']; ?></p>
        <p><?php echo $custRow['address']; ?></p>
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
