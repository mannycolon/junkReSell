<?php    //require_once(../util/db.php)

    //Connect to database
    $dsn = 'mysql:host=localhost;dbname=junkReSell_db';
    $username = 'root';
    $password = '';

    try
    {
        $db = new PDO($dsn, $username, $password);
    }
    catch (PDOException $e)
    {
        $error_message = $e->getMessage();
        echo '<p>Not connected to database</p>';
        exit();
    }

    //sets default if no set category_id
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE)
    {
        $category_id = 1;
    }

    // Get all categories and print a list of categories
    $queryAllCategories = 'SELECT * FROM category
                           ORDER BY categoryID';

    $statement2 = $db->prepare($queryAllCategories);
    $statement2->execute();
    $categories = $statement2->fetchAll();
    $statement2->closeCursor();

?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>

    <main>
			<h1>Add Product </h1>
			<form method="POST" action="addproductconfirm.php">

			<h4>Category:</h4>
			<select name="category_id">
        		<?php foreach ($categories as $category) :
            		if ($category['categoryID'] == $product['categoryID'])
            		{
                		$selected = 'selected';
            		}

            		else
            		{
                		$selected = '';
            		}
        		?>
            		<option value="<?php echo $category['categoryID']; ?>"<?php echo $selected ?>>
                		<?php echo htmlspecialchars($category['categoryName']); ?>
            		</option>
        		<?php endforeach; ?>
       		</select><br>

			<h4>Name:</h4>
			<input type="text" name="name"><br>
			<h4>Price:</h4>
			<input type="text" name="price"><br>
			<h4>Quantity:</h4>
			<input type="text" name="quantity"><br><br>
            <h4>Image filename:</h4>
            <input type="text" name="image"><br><br>
            <h4>Description:</h4>
            <textarea rows="10" cols="50" name="description"></textarea>
            <h4>Date Added:</h4>
            <input type="text" name="date" value="<?php echo date("Y-m-d") ?>"><br><br>
			<input id="button" type="submit" name="submit" value="Submit">
			</form>

	   </main>
    </body>
</html>
