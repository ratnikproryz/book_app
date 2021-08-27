<?php
    require('database.php');

    $query = 'select * from book_store.category';
    $statement= $db->prepare($query);
    $statement->execute();
    $category = $statement->fetchAll();
    $statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header><h1>Product Management</h1></header>
    <section>
        <h2>Product List</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach($category as $cate) :?>
                <tr>
                    <td><?php echo $cate['category_name']; ?></td>
                    <td>
                        <form action="handle_category.php" method="post">
                            <input type="hidden" name='category_id' value="<?php echo $cate['category_id']?>">                        
                            <input type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h2>Add category</h2>
        <form action="handle_category.php" method="post">
            <input type="text" name="category">
            <input type="submit" name ="add" value="Add">
        </form>

    </section>
</body>
</html>