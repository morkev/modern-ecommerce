<?php 
	$title = ''; 
	// Start session
	session_start();
	// Destroy session :: start new tests
	session_destroy(); 
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
<div class="jumbotron" id="jumbotronDiv">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 id="jumbotronTeddybear"class="text-center jumbotronTeddybear" style=" font-family:Amatic SC, cursive; color:SlateBlue; text-shadow: 1.5px 1px FireBrick; font-weight=bold">Amigurumis</h1><br>
                <h4 class="text-center" id="jumbotronLove" style="color:SlateBlue;"><i>A friend for life</i></h4><br>
				<p id="jumbotronP" class="text-justify" style="font-size: 19px; font-family: 'Open Sans Condensed', sans-serif;">Amigurumis are friends for life. They are universally accepted as cute and endearing friends! If you ever need to buy a gift for a young kid, or a not so young person... and that gift happens to be some sort of stuffed animal or plant, get an amigurumi.<br> 
				Check our products! There is no way you are not going to fall in love with one, or all of our Amigurumis. Shop our fantastic collection and discover the perfect gift for your inner child. Choose from a stuffed dinosour, or a cute set of trees!</p>
            </div>
            <div class="col-lg-5">
                <img src="images/kk2.png" width=100% class="img-fluid rounded float-right" text-align="right">
            </div>
        </div>
    </div>
</div>
<!--end of jumbotron-->
 
<!--SLIDESHOW--> 
  <h2 class="text-center" id="topSales" style="color: FireBrick;">Top 3 Sellers</h2><br><br>
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-6 offset-md-3">
				<div id="myCarousel" class="carousel slide" data-ride="carousel" data-pause="hover">
					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<a href="products.php"><img class="d-block img-fluid" title="Number 1" src="images\fox.png" width= "600px" alt="First slide"></a>
						</div>
						<div class="carousel-item">
							<a href="products.php"><img class="d-block img-fluid" title="Number 2" src="images\ttt.png" width= "600px"  alt="Second slide"></a>
						</div>
						<div class="carousel-item">
							<a href="products.php"><img class="d-block img-fluid" title="Number 3" src="images\g.png" width= "600px"  alt="Third slide"></a>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
<!--end of slideshow-->
  
<?php
	include("footer.php"); // Footer's code
?>

</body>
</html>