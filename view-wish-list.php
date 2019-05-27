<?php
//include 'include/config.php';
include 'functions.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CP476 Art Store</title>
        <link href="css\css\reset.css" rel="stylesheet">
        <link href="css\css\styles.css" rel="stylesheet">
        <link rel="stylesheet" href="css\css\assign1.css">

    </head>
    <body>
    <?php include 'include/art-header.php'; ?>
    <div class="column middle">
    <h2>Wish List Items</h2>
    <table stlye="width:100%;">
    <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Action</th>
    </tr>
    <?php

    foreach ( $_SESSION['wishlist'] as $data ){

    ?>

    <tr>
        <th><img src="images/square-medium/<?php echo utf8_encode($data['img'] )?>.jpg"></th>
        <th><a href="single-painting.php?id=<?php echo utf8_encode($data['id'])?>"><?php echo $data['title'] ?></a></th>
        <th><a class = 'removeLinkStyle' href="remove-wish-list.php?id=<?php echo utf8_encode($data['id'])?>">Remove</a></th>
    </tr>
    <?php } ?>
    </table>
    <a class = 'removeLinkStyle' href="remove-wish-list.php?id=">Remove all</a>
</div>
<div class="footer ">
        <div class="p_center">
            <p>All images are copyright to their owners. This is just a hypothetical site © 2014 Copyright Art Store</p>
        </div>
    </div>
    </body>
</html>