<?php session_start();
  // initialize shopping cart class
  include 'Cart.php';
  $cart = new Cart;

  // include database configuration file
  include 'dbConfig.php';
  if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
      $productID = $_REQUEST['id'];
      //get product details
      $query = $db->query("SELECT * FROM product WHERE productID = " . $productID);
      $row = $query->fetch_assoc();
      $itemData = array(
        'id' => $row['productID'],
        'name' => $row['productName'],
        'price' => $row['productPrice'],
        'qty' => 1
      );

      $insertItem = $cart->insert($itemData);
      $redirectLoc = $insertItem?'viewCart.php':'../index.php';
      header("Location: " . $redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
      $itemData = array(
        'rowid' => $_REQUEST['id'],
        'qty' => $_REQUEST['qty'],
      );
      $updateItem = $cart->update($itemData);
      echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
      $deleteItem = $cart->remove($_REQUEST['id']);
      header("Location: viewCart.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->totalItems() > 0 && !empty($_SESSION['sessCustomerID'])){
      //insert order details into database
      $insertOrder = $db->query("INSERT INTO
        orders (userID, total_price, created, billingAddressID, shipAddressID, modified)
        VALUES ('".$_SESSION['sessCustomerID']."', '".$cart->totalPrice()."',
        '".date("Y-m-d H:i:s")."', '".$_SESSION['billingAddressID']."',
        '".$_SESSION['shipAddressID']."', '".date("Y-m-d H:i:s")."')");
      if($insertOrder){
        $orderID = $db->insert_id;
        $_SESSION["orderID"] = $orderID;
        $sql = '';
        //get cart Items
        $cartItems = $cart->contents();
        foreach ($cartItems as $item) {
          $sql .= "INSERT INTO orderItems (orderID, productID, quantity)
                   VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
        }
        // insert order items into database
        $insertOrderItems = $db->multi_query($sql);
        if($insertOrderItems){
          $cart->destroy();
          header("Location: paymentInfo.php?id=$orderID");
        }else{
          header("Location: checkout.php");
        }
      }else{
        header("Location: checkout.php");
      }
    }else{
      header("location: ../account/index.php");
    }
  }else{
    header("location: ../index.php");
  }
?>
