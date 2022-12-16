<?php
  // Connect to database
  $title = "Products";
  include("conn.php");

  // Check if the product code has been sent
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_select = "SELECT * FROM products_db WHERE id = $id"; 
    $select = mysqli_query($conn, $query_select); // Executes the query

    if (mysqli_num_rows($select) > 0) { // Checks if any line was returned from the query
      $productArray = mysqli_fetch_assoc($select); // Stores product data in $ productArray variable
    } else { // If the query did not return anything, it returns an error message
      echo "<script language='javascript' type='text/javascript'>alert('Invalid product code');window.location.href='products.php'</script>";
    }
  } else { // If not sent the variable, id returns an error message
    echo "<script language='javascript' type='text/javascript'>alert('Invalid product code');window.location.href='products.php'</script>";
  }
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
  
<!---PRODUCT-->
<div class="container-fluid" id="product-section">
  <div class="row">
    <div class="col-md-6"> <img src="<?php echo $productArray['image']; ?>" class="img-fluid" width=80%> </div><!--div col-->
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <h3  style="font-family:'Open Sans Condensed', sans-serif; color:SlateBlue; font-weight:bold; font-size:35px;"><?php echo $productArray['product_name']; ?></h3>
          <br>
          <br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="text-justify" style="font-family:'Open Sans Condensed', sans-serif;font-size:20px;"> <?php echo $productArray['product_descriptions']; ?></p>
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="description">
                <p class="text-justify" style="font-family:'Open Sans Condensed', sans-serif;font-size:20px;"> <?php echo $productArray['details']; ?></p>
                <br>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 bottom-rule">
              <h4 class="product-price text-center" style="font-family:'Open Sans Condensed', sans-serif; color:FireBrick;font-weight:bold;font-size:30px;">$ <?php echo number_format($productArray['price'], 2, '.', ''); ?></h4>
              <hr>
            </div>
          </div>
          <br>
          <!--FORM ADD TO CART-->
          <form action="cart.php" method="post">
          <div class="row add-to-cart"> 
            <div class="col-md-4 product-qty">
            	<span class="btn btn-default btn-lg btn-qty" id="plus"> 
            		<span class="fa fa-plus" aria-hidden="true"></span>
                  </span>
                  <input type="hidden" name="product" value="<?php echo $productArray['id']; ?>">
              <input type="text" class="btn btn-outline-primary btn-lg btn-qty pull-right" name="qty" id="btn-qty"  style="font-family:'Open Sans Condensed', sans-serif;" value="1" />
              <span class="btn btn-default btn-lg btn-qty" id="minus"> 
                <span class="fa fa-minus" aria-hidden="true"></span> 
              </span>
            </div>
            <div class="col-md-3">
              <button class="btn btn-lg btn-primary btn-full-width pull-left"  style="font-family:'Open Sans Condensed', sans-serif;" > Add to Cart </button>
            </div>
          </div>
          </form> 
          <div class="row"> 
            <div class="col-md-7 text-center"> <span class="monospaced" style="font-family:'Open Sans Condensed', sans-serif; font-size:18 px;">In Stock</span> </div><!--div col-->
          </div>
          <div class="row">
            <div class="col-md-12 bottom-rule top-10">
			    </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
<!-- end containers -->

<?php
  include("footer.php"); // Footer's code
  mysqli_close($conn);   // Close connection to database
?>

</body>
</html>