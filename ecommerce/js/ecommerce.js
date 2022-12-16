function validateForm() {
    var usn = document.forms["tab"]["username"].value;
	var x = document.forms["tab"]["email"].value;
	var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");

	if (usn == "") {
		alert("Username must be filled out.");
		return false;
	}
	
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
		alert("Please enter a valid email address.");
		return false;
	}
}
// Adds or Decreases the quantity of products
$(document).ready(function(){	
	$("#plus").click(function() {
		var qty = $('#btn-qty').val(); // Obtains the actual value of the '#btn-qty' field
		qty = parseInt(qty);
		qty = qty + 1; 
		$('#btn-qty').val(qty); 	   // Updates value of '#btn-qty' field
	});
		
	$("#minus").click(function() {
		var qty = $('#btn-qty').val(); // Obtains the actual value of the '#btn-qty' field
		qty = parseInt(qty);
		qty = qty - 1; 
		if(qty < 1) { 
			qty = 1;
		}
		$('#btn-qty').val(qty); 	   // Updates value of '#btn-qty' field
	});
})
// Changes using the DOM
document.getElementById("topSales").style.font = "bold 80px Amatic SC, cursive";
document.getElementById("jumbotronLove").innerHTML = "Who doesn't love cuddly friends?";