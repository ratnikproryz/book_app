<?php 
    include('database.php');

    $query = "select * from book_store.category order by category_id;";
    $statement= $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
</head>
<body>
    <header><h1>Product Management</h1></header>
    <form action="add_product.php" method="post" id='add_product_form'>
        <label >Category</label>
        <select name="category_id">
            <?php foreach ($categories as $category) :?>
                <option value="<?php echo $category['category_id']?>">
                    <?php echo $category['category_name'] ?>
                </option>
            <?php endforeach;?>
        </select><br>
        <label >Code: </label>
        <input type="text" name="id"><br>
        <label >Product name:</label>
        <input type="text" name="product_name"><br>
        <label >Price:</label>
        <input type="text" name= 'price'><br>
        <input type="submit" value="Add product">
    </form>
</body>
</html>