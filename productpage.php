<?php
    // Parse data
    $category_id = $product['categoryID'];
    $product_name = $product['productName'];
    $description = $product['description'];
    $product_price = $product['productPrice'];
    $image_name = $product['abbrvName']; //will be used to name the pics

    // Add HMTL tags to the description
    $description_with_tags = add_tags($description);

    // Formats price of product
    $unit_price = number_format($product_price, 2);

    // Get image URL and alternate text
    $image_filename = $image_name . '.png';
    $image_path = $app_path . 'images/' . $image_filename;
    $image_alt = 'Image filename: ' . $image_filename; //sets up alt if pic does not show up
?>
<!--Print product name-->
<h1><?php echo htmlspecialchars($product_name); ?></h1> 
<!--Add picture-->
<div id="left_column">
    <p><img src="<?php echo $image_path; ?>"
            alt="<?php echo $image_alt; ?>" /></p>
</div>

<!--Add product details-->
<div id="right_column">
    <p><b>Price:</b>
        <?php echo '$' . $product_price; ?></p>
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
    <?php echo $description_with_tags; ?>
</div>
