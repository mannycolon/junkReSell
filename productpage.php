<?php include 'view/header.php';

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
<html>
<!--Display details of the product with the specific id-->
<?php foreach ($products as $product) : ?>
    <!--Print product name-->
    <h1><?php echo htmlspecialchars($product['productName']); ?></h1> 
    <!--Add picture-->
    <div id="left_column">
        <p><img src="images/<?php echo $product['abbrvName'].'.png'; ?>"
            alt="images/<?php echo $product['abbrvName'].'.png'; ?>" /></p>
    </div>

    <!--Add product details-->
    <div id="right_column">
        <p><b>Price:</b>
            <?php echo '$' . $product['productPrice']; ?></p>
        <form action="<?php echo $app_path . 'cart' ?>" method="get" 
              id="add_to_cart_form">
            <input type="hidden" name="action" value="add" />
            <input type="hidden" name="product_id"
                   value="<?php echo $product_id; ?>" />
            <b>Quantity:</b>&nbsp;
            <input type="text" name="quantity" value="1" size="2" />
            <input type="submit" value="Add to Cart" />
        </form>
        <h2>Description</h2>
        <?php echo $product['description'] ?>
        <?php endforeach; ?>
    </div>
</html>
