<?php
    $title = "Products";

    include("conn.php"); // Connect to database

    // Execute the query in the table of products
    $query_select = "SELECT * FROM products_db ORDER BY id ASC"; 
    $select = mysqli_query($conn, $query_select); 
?>

<!doctype html>
<html lang="en">
<?php
    include("head.php");   // Head's code
?>
<body>

<?php
    include("header.php"); // Header's code
?>

<!--JUMBOTRON-->
<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1" style="font-family:'Amatic SC', cursive; color:SlateBlue; font-weight:bold;">
                    Amigurumis <br><small><i>A friend for life</i></small></h1>
            </div>
        </div>
    </div>
</div>
<!--end of jumbotron-->

<!--LIST OF PRODUCTS-->
<div class="container">
    <div class="row">
    <?php
	// Loop through the products database
	    while($row = mysqli_fetch_assoc($select))
    	{ // Leave { by itself; it will close in line 61.
	?>
    <!--PRODUCTS-->
        <div class="col-md-4">
                <div class="thumbnail">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>" class="img-fluid">
                <div class="caption">
                    <h4 class="pull-right" style="font-family:'Open Sans Condensed', sans-serif; color:FireBrick;font-weight:bold; font-size:26px;">$<?php echo number_format($row['price'], 2, '.', ''); ?></h4>
                    <h4><a href="products-details.php?id=<?php echo $row['id']; ?>" style="font-family:'Open Sans Condensed', sans-serif; color:SlateBlue; font-weight:bold; font-size:30px;"><?php echo $row['product_name']; ?></a></h4>
                    <p style="font-family:'Open Sans Condensed', sans-serif; font-size:18px;"><?php echo $row['product_descriptions']; ?></p>
                </div>
				<br>
				<!--BUTTONS-->
                <div class="btn-group text-center">
				    <button type="button" class="btn btn-primary" style="font-family:'Open Sans Condensed', sans-serif;"><i class="fa fa-shopping-cart"></i><a href="cart.php?add=<?php echo $row['id']; ?>" style="color:#fff;"> Add To Cart</a></button>
                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#product_view" style="font-family:'Open Sans Condensed', sans-serif;"><a href="products-details.php?id=<?php echo $row['id']; ?>"><i class="fa fa-search"></i> More Info</a></button>
                </div>
               </div>
            </div>
    <?php
        } // Close while-loop :: all products in database gathered.
    ?>
    </div> <!--div row-->
</div> <!--div container-->
<br><br>

<!--FOOTER-->
<?php
    include("footer.php"); // Footer's code
    mysqli_close($conn);   // Close connection to database
?>

</body>
</html>