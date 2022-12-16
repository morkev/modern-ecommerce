<?php

$title = "Cart"; 
include("conn.php");

$cart = '';
$total = 0;
// Check if was selected Update
if(isset($_POST['update'])) {
	// Receives the products that have been checked for update
	$v_update = $_POST['prod'];
	
	// Loop in the variable data
	foreach($v_update as $key=>$value) { 
		// If the amount value is negative, it excludes the item from the session variable 'cart'
		if($value['amount'] <= 0) { 
			unset($_SESSION['cart'][$key]);
		}else {
			// Updates the quantity of the item in the session variable 'cart'
			$_SESSION['cart'][$key]['amount'] = $value['amount']; 
		}
	}
}

// Check if the 'DELETE' option was selected
if(isset($_GET['delete'])) {
	// Get received products for exclusion
	$delete = $_GET['delete'];
	// Destroy instance of specified variable
	unset($_SESSION['cart'][$delete]);
}

// Check if variable add was sent with product ID to be added
if(isset($_GET['add'])) {
	$v_prod = $_GET['add'];
	$cart = array();
	// Check product data and execute the query
	$query_select = "SELECT * FROM products_db WHERE id = ".$v_prod; 
	$select = mysqli_query($conn, $query_select); 

	// Allocate the product's data in the variable $ row
	if($select) {
		$row = mysqli_fetch_array($select); 
		
		// If there's data in the CART, recover the session values for such variable
		$cart = $_SESSION['cart'];
		// Include products data in the shopping cart matrix
		$cart[$row['id']]['id'] = $row['id'];
		$cart[$row['id']]['product_name'] = $row['product_name'];
		$cart[$row['id']]['image'] = $row['image'];
		$cart[$row['id']]['product_descriptions'] = $row['product_descriptions'];
		$cart[$row['id']]['price'] = $row['price'];
		$cart[$row['id']]['amount'] = 1;
		// Record array of the session
		$_SESSION['cart'] = $cart;
	}
	// Check if the user logged in
	if(!$_SESSION['logged']) {
		$redirect = "products.php";   // Pointer
		header("location:$redirect"); // Redirection
	}
}

// Verify if the product variable was sent with the products ID from the product details page
if(isset($_POST['product'])) {
	$v_prod = $_POST['product'];
	$cart = array();
	// Check products data and execute the query
	$query_select = "SELECT * FROM products_db WHERE id = ".$v_prod; 
	$select = mysqli_query($conn, $query_select); 

	// Allocate the product's data in the variable $ row
	if($select) {
		$row = mysqli_fetch_array($select); 
		
		// If there's data in the CART, recover the session values for such variable
		$cart = $_SESSION['cart'];
		// Include products data in the shopping cart matrix
		$cart[$row['id']]['id'] = $row['id'];
		$cart[$row['id']]['product_name'] = $row['product_name'];
		$cart[$row['id']]['image'] = $row['image'];
		$cart[$row['id']]['product_descriptions'] = $row['product_descriptions'];
		$cart[$row['id']]['price'] = $row['price'];
		$cart[$row['id']]['amount'] = $_POST['qty'];
		// Record array of the session
		$_SESSION['cart'] = $cart;
	}
}
// Check if the user logged in
// If the user is not logged in, redirect to login / registration page
if(!$_SESSION['logged']) { 
	$redirect = "loginRegister.php"; // Pointer
	header("location:$redirect");    // Redirection
} else { // If logged in, let him see the cart
?>
		
<!doctype html>
<html lang="en">
<?php
	include("head.php"); // Head's code
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

<!--TABLE CONTAINING INFO OF THE PRODUCTS ADDED IN THE CART-->
<div class="container-fluid">
	<div class="row">
    	<div class="col-lg-12">
            <table id="cart" class="table table-hover table-condensed">
    			<thead>
					<tr><!--TABLE HEAD-->
						<th  style="font-family:'Open Sans Condensed', sans-serif;width:40%">Product</th>
						<th  style="font-family:'Open Sans Condensed', sans-serif;width:22%">Price</th>
						<th  style="font-family:'Open Sans Condensed', sans-serif;width:10%">Quantity</th>
						<th  style="font-family:'Open Sans Condensed', sans-serif;width:22%" class="text-center">Subtotal</th>
						<th  style="width:6%"></th>
					</tr>
				</thead>

				<tbody>
                    <form action="cart.php" method="post">
                    <input type="hidden" name="update" value="1">

                    <?php
                    if(isset($_SESSION['cart'])) { 
						$cart = $_SESSION['cart'];
						$total = 0;
					foreach($cart as $key => $value) {
						$total += ($value['price']*$value['amount']);
					?>
						<tr>
							<td data-th="Product"> <!--ROW WITH PRODUCT'S DATA-->
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="<?php echo $value['image']; ?>" alt="<?php echo $value['product_name']; ?>"  class="img-responsive"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin" style="font-family: Amatic Sc, cursive; color:SlateBlue; font-weight:bold;"><?php echo $value['product_name']; ?></h4>
										<p style="font-family:'Open Sans Condensed', sans-serif;"><?php echo $value['product_descriptions']; ?></p>
									</div>
								</div>
							</td>
							<td data-th="Price" style="font-family:'Open Sans Condensed', sans-serif; color:FireBrick;">$ <?php echo number_format($value['price'], 2, '.', ''); ?></td>
							<td data-th="Quantity">
								<input type="number" style="font-family:'Open Sans Condensed', sans-serif;" name="prod[<?php echo $key;?>][amount]" class="form-control text-center" value="<?php echo $value['amount']; ?>">
							</td>
							<td data-th="Subtotal" class="text-center" style="font-family:'Open Sans Condensed', sans-serif;">$ <?php echo number_format(($value['price']*$value['amount']), 2, '.', ''); ?></td>
							<td class="actions" data-th="">
								<a href="#" onClick="javascript: document.forms[0].submit();" title="Update amount"><img src="images/refresh.png" width="25" height="25" alt=""/></a>
								<a href="cart.php?delete=<?php echo $key;?>"><img src="images/delete.png" width="25" height="25" alt=""/></a>								
							</td>
						</tr>
					<?php } 
					}
					?>
					</form>
				<!--end of cart's session containg info about products added into it-->
				</tbody>
					<tfoot>
						<tr><!--BUTTONS-->
							<td  style="font-family:'Open Sans Condensed', sans-serif;"><a href="products.php" class="btn btn-outline-primary btn-sm" style="padding:25px 30px"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center" style="font-family:'Open Sans Condensed', sans-serif; font-weight:bold;"><strong>Total $ <?php echo number_format($total, 2, '.', ''); ?></strong></td>
							<td style="font-family:'Open Sans Condensed', sans-serif;"><a href="/ecommerce_project-master/thanks.php" class="btn btn-outline-primary btn-sm" style="padding:25px 30px" >Checkout <i class="fa fa-angle-right"></i></a></td>
						</tr>
				</tfoot>
			</table>
    	</div>
    </div>
</div>
<br><br>

<?php
	include("footer.php"); // Footer's code
	mysqli_close($conn);   // Close connection to database
?>

</body>
</html>
        
<?php
} // Close bracket :: line 94
?>
