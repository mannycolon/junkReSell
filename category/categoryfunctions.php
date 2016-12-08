<?php

include 'databaseConnect.php';

// Get name for selected category
function get_category($category_id)
{
    global $db;
    $queryCategory = 'SELECT * FROM category
                          WHERE categoryID = :category_id';
    try 
    {
        $statement1 = $db->prepare($queryCategory);
        $statement1->bindValue(':category_id', $category_id);
        $statement1->execute();
        $category = $statement1->fetch();
        $category_name = $category['categoryName'];
        $statement1->closeCursor();
        return $statement1;
    } 
    catch (PDOException $e) 
    {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

// Get all categories and print a list of categories
function all_categories()
{
    global $db;
    $queryAllCategories = 'SELECT * FROM category
                           ORDER BY categoryID';
    try
    {
        $statement2 = $db->prepare($queryAllCategories);
        $statement2->execute();
        $categories = $statement2->fetchAll();
        $statement2->closeCursor();
        //return $statement2;

        //prints categories as a list
        echo "<ul>";
        foreach ($categories as $category)
        {
            echo "<li style='list-style: none;'>";
            echo '<a href="categoryPage.php?id=' . $category['categoryID'] . '" class="list-group-item" 
                style="width: 30%; color: green; font-size: 20px;"">'; 
            echo $category['categoryName'];
            echo "</a>"; 
            echo "</li>";
        }
        echo "</ul>";
    } 
    catch (PDOException $e) 
    {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }

}

// Get products for selected category
function get_products() 
{
    global $db;

    //sets default if no set category_id
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) 
    {
        $category_id = 1;
    }

    $queryProducts = 'SELECT * FROM product
                  WHERE categoryID = :category_id
                  ORDER BY productID';
    try
    {
        $statement3 = $db->prepare($queryProducts);
        $statement3->bindValue(':category_id', $category_id);
        $statement3->execute();
        $products = $statement3->fetchAll();
        $statement3->closeCursor();
        return $statement3;
    } 
    catch (PDOException $e) 
    {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }  

}

?>
