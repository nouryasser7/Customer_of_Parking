<!doctype html>

<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="mystyles.css">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
    <title>Create New Account</title>
</head>
<?php
    
    $servername = "localhost";
    $database = "ParkingGarageSystem";
    $username = "root";
    $password = "root";
    
    // Create connection
    
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    // Check connection
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    session_start();
    $customer_id = $_SESSION['customer_id']; 
    if(isset($_POST['save'])){
        $userin=$_POST['username'];
        $query      = "SELECT * from customer where username = '$userin'";
        $resultSet  = mysqli_query($conn, $query); 
        if(mysqli_num_rows($resultSet) > 0){
            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Username already exists, please pick another one.
            </div>
          </div>';
        }
        else{
        $firstname =  $_REQUEST['first_name'];
        $lastname =  $_REQUEST['last_name'];
        $username = $_REQUEST['username'];
        $license =  $_REQUEST['license'];
        $password = $_REQUEST['confirmedPassword'];
        // $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO customer (first_name, last_name, username, license_no, password) VALUES ('$firstname','$lastname','$username', '$license','$password' )";
      
        if(mysqli_query($conn, $sql)){
        // $_SESSION['name']=$name;
        
        header('location:index_pre_reservation.php');

        } else{
        echo "ERROR: Hush! Sorry $sql. " 
            . mysqli_error($conn);
        }
    }
}

    mysqli_close($conn);

    ?>
<body style="background-image: url('signup.jpeg'); height: 100%; background-repeat: no-repeat; background-size: cover;">
<br>
<br>
<br>    
<h2 style="color:#40adc9b7"><b>Create New Account</b></h2>
    <form action="#" name="myForm" method="post" onsubmit="return validateForm()" style="margin: auto;width:420px;">
    <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">Name</span>
  </div>
  <input type="text" name="first_name" class="form-control" placeholder="First Name">
  <input type="text" name="last_name" class="form-control" placeholder="Last Name">
</div>
<br>

<label  class="form-label">License Number</label>
    <div class="input-group mb-3">
  <input type="text" name="license" class="form-control" placeholder="License Number" aria-label="Username" aria-describedby="basic-addon1">
</div>

    <label  class="form-label">Username</label>
    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">@</span>
  <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
</div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" name="confirmedPassword" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
        </div>
        <form method="post">
    <div class="second" >
            <button type="submit" name="save" value="Submit" class="btn btn-primary">Create Account</button>
        </div>
</form>
        
</form>

  <script>

      function validateForm() {
  var x = document.forms["myForm"]["first_name"].value;
  var p = document.forms["myForm"]["last_name"].value;
  var y = document.forms["myForm"]["username"].value;
  var z = document.forms["myForm"]["password"].value;
  var w = document.forms["myForm"]["confirmedPassword"].value;
  var b = document.forms["myForm"]["license"].value;

  if (w != z){
    alert("Passwords not matching");
        return false;
  }
  if (x == "") {
    alert("Please enter your First Name");
    return false;
  }
  if (y == "") {
    alert("Please enter your username");
    return false;
  }
  if (z == "") {
    alert("Please enter password");
    return false;
  }
  if (w == "") {
    alert("Confirm your password");
    return false;
  }
  if (b == "") {
    alert("Please enter your License Number");
    return false;
  }
  if (p == "") {
    alert("Please enter your Last Name");
    return false;
  }
      }
 
  </script>
    </form>


</html>