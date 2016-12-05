
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
<?php
// initializ shopping cart class
include 'Cart.php';
$cart = new Cart;
?>
    <main>
      <div class="container">
        <h1>Shopping Cart</h1>
        <table class="table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>&nbsp;</th>
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
              <td>
                <input type="number" class="form-control text-center"
                value="<?php echo $item["qty"]; ?>"
                onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')">
              </td>
              <td><?php echo '$'.$item["subtotal"].' USD'; ?></td>
              <td>
                <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>"
                  class="btn btn-danger" onclick="return confirm('Are you sure?')">
                  <i class="glyphicon glyphicon-trash"></i>
                </a>
              </td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="5"><p>Your cart is empty.....</p></td>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
              <td>
                <a href="../index.php" class="btn btn-warning">
                  <i class="glyphicon glyphicon-menu-left"></i> Continue Shopping
                </a>
              </td>
              <td colspan="2"></td>
              <?php if($cart->totalItems() > 0){ ?>
              <td class="text-center">
                <strong>Total <?php echo '$'.$cart->totalPrice().' USD'; ?></strong>
              </td>
              <td>
                <a href="checkout.php" class="btn btn-success btn-block">
                  Checkout <i class="glyphicon glyphicon-menu-right"></i>
                </a>
              </td>
              <?php } ?>
            </tr>
        </tfoot>
        </table>
      </div>
    </main>
    <!-- adding jquery library to be used in the script below -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value},
        function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
  </body>
</html>
