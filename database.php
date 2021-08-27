<?php 
    $dsn= 'mysql:host=localhost; databasename=book_store';
    $username="root";   
    $password="";
    try{
        $db= new PDO($dsn, $username, $password);
    }catch(PDOException $e){
        echo $e->getMessage();
        exit();
    }
?>