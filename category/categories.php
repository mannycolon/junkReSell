<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
  <main class="nofloat">
    <br>
        <?php include 'categoryfunctions.php'; ?>
    <aside>
        <!-- display a list of categories -->
        <h2 style="padding-left: 60px; padding-right: 60px">Categories</h2>
        <div class="list-group" style="padding-left: 20px; padding-right: 60px">
            <?php echo all_categories() ?>
        </div>
    </aside>

</main>
</body>
</html>
