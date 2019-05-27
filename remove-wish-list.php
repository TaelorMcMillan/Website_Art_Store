<?php

session_start();
$id = $_GET['id'];

if ($id == NULL){
    unset($_SESSION['wishlist']);
    $_SESSION['wishlist'] = array();
    header('Location: view-wish-list.php');
    exit;
}
else{
    unset($_SESSION['wishlist'][$id]);
    header('Location: view-wish-list.php');
    exit;
}

?>