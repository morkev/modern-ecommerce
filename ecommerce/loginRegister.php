<?php
$title = "Login & Register";

include("conn.php");
// Verify if there is possible to login or if the customer needs to create an account
if (!empty($_POST)) {
  $action = $_POST['action'];
  if ($action == 'login') { // If the 'action' is Login
    // Verify the username and password
    if ($_POST['username'] and $_POST['password']) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      // Verify the username typed in the database
      $query_select = "SELECT * FROM users_db WHERE username = '$username' AND password = '$password'";
      $select = mysqli_query($conn, $query_select); // Send the query to database
      // Check if there is any line returned from query
      if (mysqli_num_rows($select) > 0) {
        // If there is any result returned from query, the results goes into an array
        $usrArray = mysqli_fetch_assoc($select);
        // Create the customer's session
        $_SESSION['logged'] = true;
        $_SESSION['user'] = $usrArray['username'];
        $redirect = "products.php"; // Page pointer
        header("location:$redirect"); // Redirection
      } else { // If there is no error message
        echo "<script language='javascript' type='text/javascript'>alert('Invalid login or password');</script>";
      }
    } else { // If there is an error when the customer tries to login
      echo "<script language='javascript' type='text/javascript'>alert('Enter your username and password, or register');</script>";
    }
  } elseif ($action == 'register') { // If the action is to create an account
    // Check if were sent username, email address and password
    if ($_POST['username'] == '') {
      $msg = 'Please type your username';
    } elseif ($_POST['email'] == '') {
      $msg = 'A valid email address is required';
    } elseif ($_POST['password'] == '') {
      $msg = 'Type your password';
    } else {
      // Retrieves the data passed in the registration form
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      // Query the database to check if that the username already exists
      $query_select = "SELECT username FROM users_db WHERE username = '$username'";
      $select = mysqli_query($conn, $query_select); // Send the query to databaase
      if (mysqli_num_rows($select) > 0) { // Check if there is any line returned from query
        // If there is any result returned from query, the results goes into an array
        $array = mysqli_fetch_assoc($select);
        // Assigns variable usernamedb the value of the username key of the array obtained in the query
        $usernamedb = $array['username'];
      } else {
        $usernamedb = '';
      }
      // If the username variable is empty or is null displays an alert
      if ($username == "" || $username == null) {
        echo "<script language='javascript' type='text/javascript'>alert('Username field must be filled in');window.location.href='loginRegister.php'</script>";
      } else {
        // If the username variable is not empty, but is equal to a value found in the database, it issues an alert
        if ($usernamedb == $username) {
          echo "<script language='javascript' type='text/javascript'>alert('This Username already exists');window.location.href='loginRegister.php'</script>";
          die();
        } else {
          // If the typed variable does not match any value in the database, then it writes to the database
          $query = "INSERT INTO users_db (username,password,email) VALUES ('" . $username . "','" . $password . "','" . $email . "')";
          $insert = mysqli_query($conn, $query); // Sends the sql command to the database
          // Creates the user's Session - create an account
          $_SESSION['logged'] = true;
          $_SESSION['user'] = $username;
          // If the insert command was accepted by the database it issues a successful message and refers the user to the products page
          if ($insert) {
            echo "<script language='javascript' type='text/javascript'>alert('Username registered successfully!');window.location.href='products.php'</script>";
          } else {
            // Otherwise it issues an error alert
            echo "<script language='javascript' type='text/javascript'>alert('Could not register this user');</script>";
          }
        }
      }
    }
  }
}

mysqli_close($conn); // Close the connection with database
?>
<!doctype html>
<html lang="en">
<?php include("head.php"); // Head's code 
?>

<body>
  <?php include("header.php"); // Header's code 
  ?>
  <!--JUMBOTRON-->
  <div class="jumbotron jumbotron-sm">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-lg-12">
          <h1 class="h1" style="font-family:'Amatic SC', cursive; color:SlateBlue; font-weight:bold;">
            Amigurumis <br><small><i>You need an account to buy our products</small></i></h1>
        </div>
      </div>
    </div>
  </div>
  <!--end of jumbotron-->
  <!--LOG IN OR REGISTRATION-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <div class="span12">
          <div class="" id="loginModal">
            <div class="modal-body">
              <div class="well">

                <!--nav login and create account options-->

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item"><a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true" style="font-family:'Open Sans Condensed', sans-serif; color:FireBrick; font-size:22px;">Login</a></li>
                  &nbsp &nbsp
                  <li class="nav-item"><a class="nav-link" id="register-tab" data-toggle="tab" href="#create" role="tab" aria-controls="register" aria-selected="false" style="font-family:'Open Sans Condensed', sans-serif; color:FireBrick; font-size:22px;">Create Account</a></li>
                  <br>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab"> <br>
                    <!--LOGIN FORM-->
                    <form action="loginRegister.php" method="POST" class="form-horizontal" id="login">
                      <fieldset>
                        <div id="legend">
                          <legend class="" style="font-family:'Open Sans Condensed', sans-serif; color:SlateBlue; font-weight:bold;">Login</legend>
                        </div>
                        <br>
                        <div class="control-group">
                          <!-- Username -->
                          <label class="control-label" for="username" style="font-family:'Open Sans Condensed', sans-serif; color:SlateBlue; font-size:18px;">Username</label>
                          <div class="controls">
                            <input name="username" type="text" required class="input-xlarge" id="username" placeholder="username">
                            <input name="action" value="login" type="hidden">
                          </div>
                        </div>
                        <br>
                        <div class="control-group">
                          <!-- Password-->
                          <label class="control-label" for="password" style="font-family:'Open Sans Condensed', sans-serif; color:SlateBlue; font-size:18px;">Password</label>
                          <br>
                          <div class="controls">
                            <input name="password" type="password" required class="input-xlarge" id="password" placeholder="password">
                          </div>
                        </div>
                        <br>
                        <div class="control-group">
                          <!-- Login Button -->
                          <div class="controls">
                            <button class="btn btn-success" style="font-family:'Open Sans Condensed', sans-serif; ">Login</button>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                    <!--end login form-->
                  </div>
                  <br>
                  <div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="register-tab">
                    <!-- CREATE ACCOUNT FORM-->
                    <form id="tab" method="post" action="loginRegister.php">
                      <div id="legend">
                        <legend class="" style="font-family:'Open Sans Condensed', sans-serif; color:SlateBlue; font-weight:bold;">Create Account</legend>
                      </div>
                      <br>
                      <!-- Username-->
                      <label for='username' style="font-family:'Open Sans Condensed', sans-serif; color:SlateBlue; font-size:18px;">Username</label>
                      &nbsp &nbsp
                      <input name="username" type="text" required class="form-control" placeholder="username" />
                      <input name="action" value="register" type="hidden">
                      <br>
                      <!---USERNAME VALIDATION FUNCTION JS CALLED VALIDATEFORM-->
                      <!-- email-->
                      <label for='email' style="font-family:'Open Sans Condensed', sans-serif; color:SlateBlue; font-size:18px;">Email</label>
                      &nbsp &nbsp &nbsp &nbsp &nbsp
                      <input type="email" id="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="email" required />
                      <br>
                      <!--INFO REQUIRED AND PATTERN OF EMAIL ADDRESS-->
                      <!-- Password-->
                      <label for='password ' style="font-family:'Open Sans Condensed', sans-serif; color:SlateBlue; font-size:18px;">Password</label>
                      &nbsp &nbsp
                      <input type="password" id="password-register" name="password" class="form-control" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Eight characters (must contain a number)" onkeyup="validate();" placeholder="password" required />
                      <label id="msg" style="color: red;"></label>
                      <br>
                      <!--INFO REQUIRED AND PATTERN OF PASSWORD-->
                      <!-- Address-->
                      <!-- Create account button-->
                      <input type="submit" class="btn btn-primary col-md-4 col-md-offset-10" style="font-family:'Open Sans Condensed', sans-serif;" value="Submit" />
                      <input type="reset" class="btn btn-primary col-md-4 col-md-offset-10" style="font-family:'Open Sans Condensed', sans-serif;" value="Reset" />
                    </form>
                    <!--ed of create account form-->
                  </div>
                  <!--div tab-pane-->
                </div>
                <!--div myTabContent-->
              </div>
              <!--div well-->
            </div>
            <!--div modal-body-->
          </div>
          <!--div loginModal-->
        </div>
        <!--div span12-->
      </div>
      <!--div col-->
      <div class="col-md-8"> <br>
        <br>
        <br> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <img src="images\crabs.png" class="img-fluid rounded">
      </div>
      <!--div col-->
    </div>
    <!--div row-->
  </div>
  <!--div container-->
  <?php include("footer.php"); // Footer's code 
  ?>
</body>

</html>

<script>
  var myInput = document.getElementById("password-register");

  function validate() {
    var msg = document.getElementById("msg");
    var regex = new RegExp("^(?=.*[a-z])(?=.*[0-9])(?=.{8,})");
    if (myInput.value.match(regex)) {
      msg.innerHTML = "Password Verified";
    } else {
      msg.innerHTML = "Your password should have a total of eight or more characters, and contain at least one number";
    }
  }
</script>