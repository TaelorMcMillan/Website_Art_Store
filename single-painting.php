<?php
include 'include/config.php';
include 'functions.php';
$db = getDB();
$id = $_GET['id'];

$query = "SELECT A.*, P.* , PS.* , S.* , PG.*, G.*, Ga.* FROM Artists A
            JOIN Paintings P ON P.ArtistID = A.ArtistID
            JOIN PaintingSubjects PS ON P.PaintingID = PS.PaintingID
            JOIN Subjects S ON S.SubjectID = PS.SubjectID
            JOIN PaintingGenres PG ON PG.PaintingID = P.PaintingID
            JOIN Genres G ON  G.GenreID = PG.GenreID
            JOIN Galleries Ga ON Ga.GalleryID = P.GalleryID
            WHERE P.PaintingID = " .$id;

$result = mysqli_query($db, $query);

$result = runQuery($db,$query);
if ($result->num_rows != 0){
    $row = $result->fetch_assoc();
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="css/reset.css" rel="stylesheet">
   <link rel="stylesheet" href="css\css\assign1.css">
</head>

<body>
    <?php include 'include/art-header.php'; ?>

    <div class="column middle">
        <h2><?php /* Title  */ echo utf8_encode($row["Title"])?></h2>
        <p>By <a href="#"><?php echo utf8_encode($row["FirstName"]. " ".$row["LastName"])?></a></p>
        <br>

        <img src="images/medium/<?php /* you need the 'ImageFileName' here */echo utf8_encode($row["ImageFileName"])
                                ?>.jpg">
        <p><?php /* Excerpt */ echo utf8_encode($row["Excerpt"]) ?></p>
        <br>
        <h4><?php /*  MSRP */ echo utf8_encode($row["MSRP"]) ?></h4>
        <div class="boxed">
            <div class="left">
                <a  class="favorites"   href="addToWishList.php?id=<?php /* PaintingID  */ echo utf8_encode($row["PaintingID"])."&img=". ($row["ImageFileName"]). "&title=".urlencode($row["Title"]) ?>">	Add to Wish List</i>
            </div>
            <div class="left">
                <input type="submit" value="Add to Shopping Cart" class="mainpage" />
            </div>
            <div class="clear"></div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <table class="page1table">
            <col style="width:200px">
            <col style="width:200px">
            <col style="width:200px">
            <tr>
                <td colspan="3" style="border-bottom: 1px solid">
                    <div class="left">
                        <h3>Product Details</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="left">
                        <h3>Date:</h3>
                    </div>
                </td>
                <td>
                    <div class="left">
                        <p><?php /*  MSRP */ echo utf8_encode($row["YearOfWork"]) ?></p>
                    </div>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="left">
                        <h3>Medium:</h3>
                    </div>
                </td>
                <td>
                    <div class="left">
                        <p><?php /*  MSRP */ echo utf8_encode($row["Medium"]) ?></p>
                    </div>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="left">
                        <h3>Dimensions:</h3>
                    </div>
                </td>
                <td>
                    <div class="left">
                        <p><?php /*  MSRP */ echo utf8_encode($row["Height"]. " x " .$row["Width"]) ?></p>
                    </div>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="left">
                        <h3>Home:</h3>
                    </div>
                </td>
                <td>
                    <div class="left">
                        <p><a href="#"><?php /*  MSRP */ echo utf8_encode($row["GalleryName"]. ", " .$row["GalleryCity"]. ", " .$row["GalleryCountry"]) ?></a></p>
                    </div>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="left">
                        <h3>Genres:</h3>
                    </div>
                </td>
                <td>
                    <div class="left">
                        <p><a href="#"><?php /*  MSRP */ echo utf8_encode($row["GenreName"]) ?></a>,<a href="#">Rococo</a></p>
                    </div>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="left">
                        <h3>Subjects:</h3>
                    </div>
                </td>
                <td>
                    <div class="left">
                        <p><a href="#"><?php /*  MSRP */ echo utf8_encode($row["SubjectName"]) ?></a>,<a href="#">Arts</a></p>
                    </div>
                </td>
                <td>
                </td>
            </tr>
        </table>
        <div class="clear"></div>
        <table>
            <col style="width:225px">
            <col style="width:225px">
            <col style="width:225px">
            <col style="width:225px">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td colspan="4" style="border-bottom: 1px solid">
                    <div class="left">
                        <h3>Similar Products</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid">
                    <img src="images/square-medium/116010.jpg" alt="Straw Hat" style="margin-left: 40px">
                    <div class="clear"></div>
                    <p><a href="#">Artist Holding a Thistle</a></p>
                    <div class="clear"></div>
                    <div class="left">
                        <input type="submit" value="View" class="panels" />
                    </div>
                    <div class="left">
                        <input type="submit" value="Wish" class="panels" />
                    </div>
                    <div class="clear"></div>
                    <input type="submit" value="Cart" class="panels" />
                </td>

                <td style="border: 1px solid">
                    <img src="images/square-medium/120010.jpg" alt="Straw Hat" style="margin-left: 40px">
                    <div class="clear"></div>
                    <p><a href="#">Portrait of Eleanor of Toledo</a></p>
                    <div class="clear"></div>
                    <div class="left">
                        <input type="submit" value="View" class="panels" />
                    </div>
                    <div class="left">
                        <input type="submit" value="Wish" class="panels" />
                    </div>
                    <div class="clear"></div>
                    <input type="submit" value="Cart" class="panels" />
                </td>
                <td style="border: 1px solid">
                    <img src="images/square-medium/107010.jpg" alt="Straw Hat" style="margin-left: 40px">
                    <div class="clear"></div>
                    <p><a href="#">Girl With A Pearl Earring</a></p>
                    <div class="clear"></div>
                    <div class="left">
                        <input type="submit" value="View" class="panels" />
                    </div>
                    <div class="left">
                        <input type="submit" value="Wish" class="panels" />
                    </div>
                    <div class="clear"></div>
                    <input type="submit" value="Cart" class="panels" />
                </td>

                <td style="border: 1px solid">
                    <img src="images/square-medium/106020.jpg" alt="Straw Hat" style="margin-left: 40px">
                    <div class="clear"></div>
                    <p><a href="#">Girl With A Pearl Earring</a></p>
                    <div class="clear"></div>
                    <div class="left">
                        <input type="submit" value="View" class="panels" />
                    </div>
                    <div class="left">
                        <input type="submit" value="Wish" class="panels" />
                    </div>
                    <div class="clear"></div>
                    <input type="submit" value="Cart" class="panels" />
                </td>
        </table>
    </div>

    <div class="footer ">
        <div class="p_center">
            <p>All images are copyright to their owners. This is just a hypothetical site © 2014 Copyright Art Store</p>
        </div>
    </div>
</body>

</html>
