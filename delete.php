<?php 
    require('database.php');
    $product_id =filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $category_id =filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

    if($product_id!= false && $category_id!= false){
        $query = "delete from book_store.product where id = :product_id";
        $statement= $db->prepare($query);
        $statement->bindValue(':product_id',$product_id);
        $result = $statement->execute();
        $statement->closeCursor();
    }
    include('index.php');
?>