<?php include 'view/header.php'; ?>
  <main class="nofloat">
    <br>
	<table>
	    <?php

			$dsn = 'mysql:host=localhost;dbname=junkresell_db';
		    $username = 'root';
		    $password = '';

		    try {
		        $db = new PDO($dsn, $username, $password);
		        echo '<p>Connected to database</p>';
		    } catch (PDOException $e) {
		        $error_message = $e->getMessage();
		        include('database_error.php');
		        exit();
		    }

			$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
			if ($category_id == NULL || $category_id == FALSE) {
			    $category_id = 1;
			}
			// Get name for selected category
			$queryCategory = 'SELECT * FROM category
			                      WHERE categoryID = :category_id';
			$statement1 = $db->prepare($queryCategory);
			$statement1->bindValue(':category_id', $category_id);
			$statement1->execute();
			$category = $statement1->fetch();
			$category_name = $category['categoryName'];
			$statement1->closeCursor();

			// Get all categories
			$queryAllCategories = 'SELECT * FROM category
			                           ORDER BY categoryID';
			$statement2 = $db->prepare($queryAllCategories);
			$statement2->execute();
			$categories = $statement2->fetchAll();
			$statement2->closeCursor();

			// Get products for selected category
			$queryProducts = 'SELECT * FROM product
			              WHERE categoryID = :category_id
			              ORDER BY productID';
			$statement3 = $db->prepare($queryProducts);
			$statement3->bindValue(':category_id', $category_id);
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
    <h1>junkReSell Homepage</h1><br>


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
                <img src="images/<?php echo $product['abbrvName'].'.png'; ?>" 
                	alt="images/<?php echo $product['abbrvName'].'.png'; ?>" width = "50%";/></a> </td>
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
	    