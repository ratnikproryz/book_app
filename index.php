<?php 
    require('database.php');
    // get data form user when user click on the links
    if(!isset($category_id)){
        $category_id= filter_input(INPUT_GET,'category_id', FILTER_VALIDATE_INT);
        if($category_id ==null || $category_id == FALSE){
            $category_id= 1;
        }
    }
    $query_category= "select * from book_store.category where category_id=".$category_id;
    // $query_category= "select * from book_store.category where category_id=1";
    $statement = $db->prepare($query_category);
    $statement->execute();

// fetch the data from the resultset
    $category = $statement->fetch();
    $category_name = $category['category_name'];
    $statement->closeCursor();

    // selecte all categories;
    $queryAllCategory = "select * from book_store.category order by category_id";
    $statementAll= $db->prepare($queryAllCategory);
    $statementAll->execute();
    $categoryAll=$statementAll->fetchAll();
    $statementAll->closeCursor();

// select products from categories;
    $query_product= "select * from book_store.product where category_id=:category_id";
    $statement_product= $db->prepare($query_product);
    $statement_product->bindValue(':category_id',$category_id);
    $statement_product->execute();
    $products=$statement_product->fetchAll();
    $statement_product->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Guitar shope</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Products List</h1>
    <aside>
        <h2>Category</h2>
        <nav>
            <ul>
                <?php foreach ($categoryAll as $category) :?>
                    <li>
                        <a href=".?category_id=<?php echo $category['category_id']?>">
                            <?php echo $category['category_name']?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </nav>
    </aside>
    <section>
        <h2><?php echo $category['category_name']?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>&nbsp</th>
            </tr>
            <?php foreach ($products as $product) :?>
                <tr>
                    <td><?php echo $product['id']?></td>
                    <td><?php echo $product['product_name']?></td>
                    <td class='right'><?php echo $product['price']?></td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']?>">
                            <input type="hidden" name="category_id" value="<?php echo $category['category_id']?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach;?> 
        </table>
    </section>
    <a href="add_product_form.php">Add Product</a>
    <a href="view_category.php">View Category</a>
    <footer>
        <p>&copy; <?php echo date("y")?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>