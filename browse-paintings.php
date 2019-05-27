<?php
//include 'include/config.php';
include 'functions.php';
session_start();
$db = getDB();
$aID = $_GET['artist'];
$mID = $_GET['museum'];
$sID = $_GET['shape'];


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Assignment 1 - Page 1</title>
        <link href="css\css\reset.css" rel="stylesheet">
        <link href="css\css\styles.css" rel="stylesheet">
        <link rel="stylesheet" href="css\css\assign1.css">

    </head>
    <body>

    <?php include 'include/art-header.php'; ?>

    <div class="column middle">
        <main style="overflow:auto;">

            <section class="leftsection" style="width=600px;  margin-right:100px;">
                <form class="ui form" method="get" action="browse-paintings.php">
                    <h3>Filters</h3>

                    <div >
                        <label style=" padding-right:22px;">Artist</label>
                        <select name="artist">
                            <option value='0'>Select Artist</option>
                            <?php
                            // retrieve the names of the artist from database and use
                            $query = "SELECT LastName, ArtistID FROM Artists";
                            $result = mysqli_query($db, $query);
                            $result = runQuery($db,$query);

                            // them as the values for <option> elements
                            if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    echo utf8_encode("<option value = ".$row["ArtistID"]. ">".$row["LastName"]."</option>");
                                }
                            }

                            ?>
                        </select>
                    </div>
                    <div >
                        <label>Museum</label>
                        <select  name="museum">
                            <option value='0'>Select Museum</option>
                            <?php
                            // retrieve the list of galleries name  from database and use
                            $query = "SELECT GalleryName, GalleryID FROM Galleries";
                            $result = mysqli_query($db, $query);
                            $result = runQuery($db,$query);

                            // them as the values for <option> elements
                            if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    echo utf8_encode("<option value = ".$row["GalleryID"]. ">".$row["GalleryName"]."</option>");
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div >
                        <label style="padding-right:14px;">Shape</label>
                        <select  name="shape">
                            <option value='0'>Select Shape</option>

                            <?php

                            // retrieve the different shapes from database and use
                            $query = "SELECT ShapeName, ShapeID FROM Shapes";
                            $result = mysqli_query($db, $query);
                            $result = runQuery($db,$query);

                            // them as the values for <option> elements
                            if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    echo utf8_encode("<option value = ".$row["ShapeID"]. ">".$row["ShapeName"]."</option>");
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <p> &nbsp; &nbsp;  &nbsp;   &nbsp; </p>
                    <button type="submit" id="buttons"> Filter  </button>

                </form>    </section>


            <section class="rightsection" >
                <h1>Paintings</h1>
                <h3>All Paintings [Top 20]</h3>
                <ul id="paintingsList">

                    <?php

                // you need to have a while loop here that goes over the result of a query
                if ($aID == 0 && $mID == 0 && $sID == 0){
                    $query = "SELECT t1.*, t2.* FROM Paintings t1 JOIN Artists t2 ON t1.ArtistID = t2.ArtistID limit 20";
                }
                else{
                    if ($aID == 0){
                        if ($mID == 0){
                            $query = "SELECT t1.*, t2.* FROM Paintings t1 JOIN Artists t2 ON t1.ArtistID = t2.ArtistID WHERE t1.ShapeID = " . $sID ." limit 20";
                        }
                        else{
                            if ($sID == 0){
                                $query = "SELECT t1.*, t2.* FROM Paintings t1 JOIN Artists t2 ON t1.ArtistID = t2.ArtistID WHERE t1.GalleryID = " . $mID ." limit 20";
                            }
                            else{
                                $query = "SELECT t1.*, t2.* FROM Paintings t1 JOIN Artists t2 ON t1.ArtistID = t2.ArtistID WHERE t1.GalleryID = " . $mID . " AND t1.ShapeID = ". $sID. " limit 20";
                            }
                        }
                    }
                    else{
                        if ($mID == 0){
                            if ($sID == 0){
                                $query = "SELECT t1.*, t2.* FROM Paintings t1 JOIN Artists t2 ON t1.ArtistID = t2.ArtistID WHERE t1.ArtistID = " . $aID ." limit 20";
                            }
                        }
                        else if ($mID != 0){
                            if ($sID == 0){
                                $query = "SELECT t1.*, t2.* FROM Paintings t1 JOIN Artists t2 ON t1.ArtistID = t2.ArtistID WHERE t1.GalleryID = " . $mID . " AND t1.ArtistID = ". $aID." limit 20";
                            }
                            else{
                                $query = "SELECT t1.*, t2.* FROM Paintings t1 JOIN Artists t2 ON t1.ArtistID = t2.ArtistID WHERE t1.ShapeID = " . $sID . " AND t1.GalleryID = " . $mID . " AND t1.ArtistID = ". $aID. " limit 20";
                            }
                        }
                        else if ($sID == 0){
                            if ($mID != 0){
                                $query = "SELECT t1.*, t2.* FROM Paintings t1 JOIN Artists t2 ON t1.ArtistID = t2.ArtistID WHERE t1.GalleryID = " . $mID . " AND t1.ArtistID = ". $aID." limit 20";
                            }
                        }
                    }
                }

                $result = mysqli_query($db, $query);
                $result = runQuery($db,$query);
                        if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){


		    ?>

                    <li class="item">

                        <div class="figure">
                            <a href="single-painting.php?id=<?php /* you need the 'PaintingID' here */ echo utf8_encode($row["PaintingID"])?>">
                                <img src="images/square-medium/<?php /* you need the 'ImageFileName' here */echo utf8_encode($row["ImageFileName"])
                                ?>.jpg">
                            </a>
                        </div>
                        <div class="itemright">
                            <a href="single-painting.php?id=<?php /* you need the 'PaintingID' here */ echo utf8_encode($row["PaintingID"]) ?>">
                                <?php /* Title  */ echo utf8_encode($row["Title"])?></a>

                            <div><span><?php /* FirstName and LastName */ echo utf8_encode($row["FirstName"]. " ".$row["LastName"])?></span></div>


                            <div class="description">
                                <p><?php /* Excerpt */ echo utf8_encode($row["Excerpt"]) ?></p>
                            </div>

                            <div class="meta">
                                <strong><?php /*  MSRP */ echo utf8_encode($row["MSRP"]) ?></strong>
                            </div>

                            <div class="extra" >
                                <a class="favorites" href="cart.php?id=<?php /* PaintingID */ echo utf8_encode($row["PaintingID"]) ?>">Add to Shopping Cart</a>
                                <span> &nbsp; &nbsp; &nbsp;    </span>
                                <a  class="favorites"   href="addToWishList.php?id=<?php /* PaintingID  */ echo utf8_encode($row["PaintingID"])."&img=". ($row["ImageFileName"]). "&title=".urlencode($row["Title"]) ?>">	Add to Wish List</i>
                                </a>
                                <p>&nbsp;</p>
                            </div>

                        </div>
                    </li>

                    <?php
                }
            }
		    ?>

                </ul>
            </section>

        </main>
</div>
<div class="footer ">
        <div class="p_center">
            <p>All images are copyright to their owners. This is just a hypothetical site © 2014 Copyright Art Store</p>
        </div>
    </div>
    </body>
</html>
