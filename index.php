<?php require_once('util/main.php'); ?>
<?php require_once('util/userSession.php'); ?>
<?php include 'view/header.php'; ?>
<?php include 'util/dbConfig.php'; ?>
  <main class="nofloat">
    <?php include 'category/categoryfunctions.php';

      // Get all categories
      $queryAllCategories = 'SELECT * FROM category
                             ORDER BY categoryID';
      $statement2 = $db->prepare($queryAllCategories);
      $statement2->execute();
      $categories = $statement2->fetchAll();
      $statement2->closeCursor();
    ?>
    <section style="padding-top: 15px;padding-left: 60px; padding-right: 60px; background-color: #000000; color: #fff">
      <!-- website name and description-->
      <center>
        <img src="./assets/logo.png" alt="junkReSell Logo" width="380px">
      </center>
      <h3 align="center" style="color: #D3D3D3; margin-bottom: 40px;">Sell your products on our site</h3>
      <!--create panel for each category-->
      <div class="row">
      <?php foreach ($categories as $category) : ?>
          <div class="col-sm-4">
            <div class="panel panel-primary" style="border-color:grey;">
              <div class="panel-heading" style="background-color:#009973; font-size:18px;"><?php echo $category['categoryName']; ?></div>
              <div class="img-responsive">
                <a href = "<?php echo $app_path ?>category/categorypage.php?id=<?php echo $category['categoryID']; ?>">
                <img src="<?php echo $app_path ?>images/<?php echo $category['categoryName'].'.png'; ?>" class="img-responsive" style="width:100%;height: 250px;" alt="<?php echo $app_path ?>images/<?php echo $categories['categoryName'].'.png'; ?>"></a></div>
            </div>
          </div>
      <?php endforeach; ?>
      </div>
    </section>
</main>
</body>
</html>
