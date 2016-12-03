<?php require_once('../util/main.php'); ?>
<?php include '../view/header.php';

    include 'categoryfunctions.php';

    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }

    //get id of category from categories.php
    $cID = $_GET['id'];

    //get tables for selected category
    $queryCategory = "SELECT *
                     FROM category
                     WHERE categoryID = '$cID'";
    $result = $db->prepare($queryCategory);
    $result->bindValue('$cID', $category_id);
    $result->execute();
    $category = $result->fetch();
    $category_name = $category['categoryName'];
    $result->closeCursor();

    //get products for selected category
    $queryProducts = "SELECT * FROM product
                  WHERE categoryID = '$cID'
                  ORDER BY productID";
    $statement3 = $db->prepare($queryProducts);
    $statement3->bindValue('$cID', $category_id);
    $statement3->execute();
    $products = $statement3->fetchAll();
    $statement3->closeCursor();

    ?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>junkReSell Homepage</title>
</head>

<!-- the body section -->
<body>
<main>
    <h1>junkReSell</h1><br>


    <section>
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>
        <table>
        <?php foreach ($products as $product) : ?>
            <tr>
                <th><?php echo $product['productName']; ?></th>
                <th>Description</th>
                <th class="right">Price</th>
            </tr>

            <tr>
                <td><a href="productpage.php?id=<?php echo $product['abbrvName']; ?>" >
                <img src="<?php echo $app_path ?>images/<?php echo $product['abbrvName'].'.png'; ?>"
                    alt="<?php echo $app_path ?>images/<?php echo $product['abbrvName'].'.png'; ?>" width = "50%";/></a> </td>
                <td><?php echo $product['description']; ?></td>
                <td class="right"><?php echo $product['productPrice']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>
<footer></footer>
</body>
</html>
