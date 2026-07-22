<?php
    require 'db.php';
    $db = new myDB();

    if(isset($_POST['add_product'])){
        unset($_POST['add_product']);

        $db->insert('products', $_POST);
        header('Location: ../index.php');
    }
?>