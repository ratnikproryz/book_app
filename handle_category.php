<?php
    $delete = filter_input(INPUT_POST, 'delete');
    $add = filter_input(INPUT_POST, 'add');
    $category_id= filter_input(INPUT_POST, 'category_id');


    function deleteCategory(){
        $category_id = $GLOBALS['category_id'];
        require('database.php');
        $query = "DELETE FROM book_store.category where category_id= :category_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id',$category_id);
        $statement->execute();
        include('view_category.php');
    }

    function addCategory(){
        $category_name= filter_input(INPUT_POST, 'category');
        require('database.php');
        $query = "insert into book_store.category (category_name) value('" . $category_name . "')";
        $statement = $db->prepare($query);
        // $statement->bindValue(':category_name)',$category_name);
        $statement->execute();
        include('view_category.php');
    }

    if(strcmp($delete,'Delete')==0){
        deleteCategory();
    }
    if(strcmp($add,'Add')==0){
        echo "add";
        addCategory();
    }
?>