<?php require_once('../util/main.php'); ?>
<?php include '../view/header.php'; ?>
  <main class="nofloat">
    <br>
        <?php include 'categoryfunctions.php'; ?>

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
            <?php echo all_categories() ?>
        </nav>
    </aside>

</main>
<footer></footer>
</body>
</html>
