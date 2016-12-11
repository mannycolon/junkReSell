<?php require_once('../util/main.php'); ?>
<?php include '../view/header.php';
      include 'categoryfunctions.php';
    //get id of product from index.php
    $pID = $_GET['id'];
    //get table for selected product
    $queryProduct = "SELECT *
                     FROM product
                     WHERE abbrvName = '$pID'";
    $result = $db->prepare($queryProduct);
    $result->execute();
    $products = $result->fetchAll();
    $result->closeCursor();
?>

<!--Display details of the product with the specific id-->
<?php foreach ($products as $product) : ?>
  <div class="row" style="padding-left: 60px; padding-right: 60px; padding-top: 30px;">
    <div class="col-sm-6 col-md-6">
    <!--Add picture-->
      <img src="<?php echo $app_path ?>/images/<?php echo $product['abbrvName'].'.png'; ?>"
           alt="<?php echo $app_path ?>/images/<?php echo $product['abbrvName'].'.png'; ?>"
           width="550px"/>
    </div>
    <!--Add product details-->
    <div class="col-sm-4 col-md-6">
      <!--Print product name-->
      <h1><?php echo htmlspecialchars($product['productName']); ?></h1><br /><br />
        <form action="<?php echo $app_path ?>cart/cartAction.php?action=addToCart&id=<?php echo $product['productID']; ?>"
              method="get" id="add_to_cart_form">
          <table class="table">
            <tbody>
              <tr>
                <td><br />
                  <b>Price:</b>
                  <span class="price">
                    <?php echo '$' . $product['productPrice']; ?>
                  </span>
                </td>
                <td><br />
                  <input type="hidden" name="action" value="addToCart" />
                </td>
                <td><br />
                  <input type="hidden" name="id"
                         value="<?php echo $product['productID']; ?>" />
                </td>
                <td><br />
                  <b>Quantity:</b>&nbsp;
                  <input type="text" name="quantity" value="1" size="2" class="quantityBox" />
                </td>
                <td><br />
                  <input type="hidden" name="price" value="<?php echo $product['productPrice']; ?>" />
                </td>
                <td><br />
                  <button type="submit" class="btn btn-success btn-block">
                    <span class="glyphicon glyphicon-shopping-cart"
                          aria-hidden="true"></span> Add to Cart
                  </button>
                </td>
              </tr>
            <tbody>
          </table>
        </form>
        <h2>Description</h2>
          <p>
            <?php echo $product['description'] ?>
          </p>
            <?php endforeach; ?>
    </div>
  </div>
</html>
