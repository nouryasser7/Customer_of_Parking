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
    <title>Payment</title>
    <!-- <script type="text/javascript">
        function validate() {
        if (!(document.getElementById('overnight').checked | document.getElementById('car_polish').checked | document.getElementById('temp_park').checked | document.getElementById('interior_wash').checked | document.getElementById('exterior_wash').checked | document.getElementById('tire_gauge').checked)) {
            alert("Please select at least one of the options.");
        }
    }

</script> -->
</head>

<?php 
$servername = "localhost";
$database = "ParkingGarageSystem";
$user = "root";
$password = "root";

// Create connection

$conn = mysqli_connect($servername, $user, $password, $database);

// Check connection

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

session_start();
$reserv_no = $_SESSION['reservation_no'];
$hrs_entry = $_SESSION['hrs_entry'];
$mins_entry = $_SESSION['mins_entry'];
$hrs_exit = $_SESSION['hrs_exit'];
$mins_exit = $_SESSION['mins_exit'];
$cust_id = $_SESSION['customer_id'];
$garage_id = $_SESSION['garage_id'];
$total_fees = $_SESSION['total_fees'];
if(isset($_POST['checkout']))
{
    // if
    $decrement = "UPDATE garage SET ava_spots = ava_spots-1 WHERE garage_id = $garage_id";
    $decremented1 = mysqli_query($conn, $decrement);
    $insert = "INSERT INTO reservation (reservation_no,cust_id,garage_id,entry_time,exp_exit_time,total_fees) VALUES ('".$reserv_no."',$cust_id,$garage_id,'$hrs_entry:$mins_entry','$hrs_exit:$mins_exit',$total_fees)";
    $inserted1 = mysqli_query($conn, $insert);
    header('location:index_success.php');
}


?>
<body style="background-image: url('payment.png'); height: 100%; background-repeat: no-repeat; background-size: cover;">
<h2 style="color: white;"><b><i><span class="badge bg-secondary">Total Amount to be Payed: <?php echo htmlspecialchars($total_fees) ?> EGP</span></b></i></h2>
<div style="background-color: white;margin: auto;width:320px;">
<small class="form-text text-muted"><b style="color:#E75480 ">*In case of more time spent in the garage, extra fees will be applied</b></small>
<form style="margin:30px" method="post">
  <div class="form-group">
    <label><b><i><h5><span class="badge bg-secondary">Card Number</span></h5></b></i></label>
    <input maxlength="16" class="form-control" placeholder="Enter card number">
    <small class="form-text text-muted">We'll never share your card number with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"><b><i><h5><span class="badge bg-secondary">Expires</span></h5></b></i></label>
    <input  class="form-control" placeholder="MM/YYYY">
  </div>
  <div class="form-group">
    <label style="margin-top: 5px"><b><i><h5><span class="badge bg-secondary">CVV</span></h5></b></i></label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="***">
  </div>
  <button type="submit" name="checkout" style="color:white;background-color: #E75480;
    border-color: #E75480;text-align:center;margin:30px;margin-left:80px" >Check Out</button>
</form>
</div>
</body>
</html>