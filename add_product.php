<?php 
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    $product_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $product_name = filter_input(INPUT_POST, 'product_name');
    $price = filter_input(INPUT_POST,'price', FILTER_VALIDATE_FLOAT);
    
    if($category_id==false || $category_id==null || $product_id== false || $product_id==null ||
        $price == null || $price==false || $product_name == null || $product_name==false){
            exit("erorr");
    }else{
        require('database.php');
        $query = "insert into book_store.product (id, product_name, price,category_id) 
            values(:product_id, :product_name, :price, :category_id)";
        $statement= $db->prepare($query);
        $statement->bindValue(':product_id',$product_id);
        $statement->bindValue(':product_name',$product_name);
        $statement->bindValue(':price',$price);
        $statement->bindValue(':category_id',$category_id);
        $statement->execute();
        $statement->closeCursor();
        include("index.php");
    }


?>