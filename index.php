<?php require_once('util/main.php'); ?>
<?php require_once('util/userSession.php'); ?>
<?php include 'view/header.php'; ?>
  <main class="nofloat">
    <br>
    <table>
      <?php include 'category/categoryfunctions.php';
      $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
      if ($category_id == NULL || $category_id == FALSE){
        $category_id = rand(1, 5);
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
    <section style="padding-left: 60px; padding-right: 60px">
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>
        <div class="row">
        <?php foreach ($products as $product) : ?>
            <div class="col-sm-6 col-md-4" style="display: inline-block;">
              <a href="<?php echo $app_path ?>category/productpage.php?id=<?php echo $product['abbrvName']; ?>" >
              <div class="thumbnail" style="min-height: 650px; box-sizing: border-box;">
                <img src="<?php echo $app_path ?>images/<?php echo $product['abbrvName'].'.png'; ?>"
                     alt="<?php echo $app_path ?>images/<?php echo $product['abbrvName'].'.png'; ?>"
                     width = "200px" height="200px"/>
                <div class="caption">
                  <h3><?php echo $product['productName']; ?></h3>
                  <h5>
                    Price: <span class="price">$<?php echo $product['productPrice']; ?></span>
                  </h5>
                  <h5>Description:</h5>
                  <p>
                    <?php echo $product['description']; ?>
                  </p>
                </div>
              </div>
              </a>
            </div>
            <?php endforeach; ?>
            </div>
    </section>
</main>
</body>
</html>
