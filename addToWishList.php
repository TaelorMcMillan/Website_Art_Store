<?php
$myarray = array();
$id = $_GET['id'];
$img = $_GET['img'];
$title = $_GET['title'];

session_start();


    if (!empty($id)){
        if(!empty($img)){
            if(!empty($title)){
                if(!isset($_SESSION['wishlist'])){
                    //If it doesn't, create an empty array.
                    $_SESSION['wishlist'] = array();
                }
                $currentarray = $_SESSION['wishlist'];
                $myarray = array('id'=> $id,'img' => $img, 'title' => $title);
                $_SESSION['wishlist'][$id] = $myarray;
                header('Location: view-wish-list.php');
                exit;
            }
        }
    }




?>