<?php 
	$title = 'About Us'; 
	session_start();
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
                    Thanks for your purchase! <br> <small>You got yourself a new friend</small></h1>
            </div> 
            <div class="col-lg-5">
                <img src="images\frugg.png" alt="teddy bear" class="img-fluid">
            </div>
        </div>  
    </div>  
</div>  
<!--end of jumbotron-->

<?php
  include("footer.php"); // Footer's code
?>

</body>
</html>