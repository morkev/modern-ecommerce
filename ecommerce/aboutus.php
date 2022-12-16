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
                    About Us <br> <small>We love Amigurumis</small></h1>
            </div> 
        </div>  
    </div>  
</div>  
<!--end of jumbotron-->
  
<!--ABOUT THE COMPANY-->  
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-7">	
        <p class="text-justify quote" style="font-size:18px; font-family: 'Open Sans Condensed', sans-serif;">Our company was created by Kevin Mora in 1969, with the intention of spreading love to the community and making big money. Surprisingly enough, things worked out and now we share the amigurumi culture to Utahns, and other humans around the world! One day we'll have a store under the Kachina bridge - stay tuned for that.</p>
        <p class="text-justify quote" style="font-size:18px; font-family: 'Open Sans Condensed', sans-serif;">Also, did you know the word Amigurumi is a portmanteau of two Japanese terms: ami, which means crocheted or knitted; and nuigurumi, a stuffed doll. It often takes the form of an animal, plant, or fantastical creature with an aesthetic that's best described as kawaii or cute. This makes amigurumi ideal for kids, or anyone that likes button noses and rosy cheeks! </p>
        <p class="text-justify" style="font-size:18px; font-family: 'Open Sans Condensed', sans-serif;">Amigurumi can be knitted, though they are usually crocheted out of yarn or thread, using the basic techniques of crochet, such as single crochet stitch, double crochet, invisible decrease. Amigurumi can be worked as one piece or, more usually, in sections which are sewed or crocheted together. In crochet, amigurumi are typically worked in spiral rounds to prevent "striping", a typical feature of joining crochet rounds in a project.</p>
      </div>
      
      <div class="col-lg-5">
        <img src="images\iguana.png" alt="teddy bear" class="img-fluid">
      </div>
    </div>
 </div>
<!--end of text about us/Amigurumis-->

<?php
  include("footer.php"); // Footer's code
?>

</body>
</html>