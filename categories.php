<?php include 'view/header.php'; ?>
  <main class="nofloat">
    <br>
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
    <h1>junkReSell Homepage</h1>
    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li>
                <a href="?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>           
    </aside>

</main>    
<footer></footer>
</body>
</html>
        
