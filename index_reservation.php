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
    <title>Confirm Reservation</title>
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
$cust_id = $_SESSION['customer_id'];
$first_name = $_SESSION['first_name'];
$garage_id = $_SESSION['branch_id'];
if(isset($_POST['proceed']))
{
  // echo "here";
  $hrs_entry=$_POST['hrs_entry'];
  $mins_entry=$_POST['mins_entry'];
  $hrs_exit=$_POST['hrs_exit'];
  $mins_exit=$_POST['mins_exit'];
  if($hrs_entry>$hrs_exit){
    echo "<script>alert('Please enter valid entry and exit times.');window.location.href='index_reservation.php'</script>";
  }
  else{
  $diff_hrs = $hrs_exit - $hrs_entry;
  $diff_mins = $mins_exit - $mins_entry;
  if($diff_mins>0)
  {
    $diff_hrs = $diff_hrs + 1;
  }
  $query_res_no = "SELECT MAX(reservation_no) as maxi FROM reservation_service";
  $queryRes=mysqli_query($conn,$query_res_no);
  $fetch = mysqli_fetch_array($queryRes,MYSQLI_ASSOC);
  $reserv_no = $fetch['maxi'];
  $query_service = "SELECT service FROM reservation_service WHERE reservation_no = $reserv_no";
  $queryRes=mysqli_query($conn,$query_service);
  while( $row = mysqli_fetch_array($queryRes,MYSQLI_ASSOC)){
    $service_array[] = $row; // Inside while loop
  }
  $total_fees = 0;
  foreach($service_array as $serv){
    echo $serv['service'] . "\n";
  
  // $fetch = mysqli_fetch_array($queryRes,MYSQLI_ASSOC);
  $reserv_serv = $serv['service'];
  // echo $reserv_serv;
  $query_price = "SELECT price_per_unit FROM service WHERE service_name = '$reserv_serv'";
  $queryRes=mysqli_query($conn,$query_price);
  $fetch = mysqli_fetch_array($queryRes,MYSQLI_ASSOC);
  $price = $fetch['price_per_unit'];
  if ($reserv_serv != "Temporary Parking") {
    $total_fees = $total_fees + $price;
  }
  else{
    $total_fees = $total_fees + ($price * $diff_hrs);
  }
  }
  // echo $price;
  
  
  $_SESSION['reservation_no'] = $reserv_no;
  $_SESSION['hrs_entry'] = $hrs_entry;
  $_SESSION['mins_entry'] = $mins_entry;
  $_SESSION['hrs_exit'] = $hrs_exit;
  $_SESSION['mins_exit'] = $mins_exit;
  $_SESSION['customer_id'] = $cust_id;
  $_SESSION['garage_id'] = $garage_id;
  $_SESSION['total_fees'] = $total_fees;
  header('location: index_payment.php'); 
}
}
// echo $garage_id;

mysqli_close($conn);
?>

<body style="background-image: url('pic.jpeg');background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center; background-size: cover;">
  <br>
  <br>
  
  <h1 style="color: white;"><b><i><span class="badge bg-secondary">Welcome <?php echo htmlspecialchars($first_name) ?>!</span></b></i></h1>
  
  <h4 style="text-align: center;"><b><i ><span class="badge bg-secondary" style="color: rgb(251, 180, 245);text-align: center;" >Please enter the following information to complete your reservation</span></b></i></h4>
<br>
<form action="#" name="myForm" method="post">
<div class="container" style="width:500px;">

  <div class="input-group">
  <div class="input-group-prepend">
  
    <span class="input-group-text">Expected Entry Time</span>
  </div>
  <input type="text" name="hrs_entry" class="form-control" placeholder="Hours">
  <input type="text" name="mins_entry" class="form-control" placeholder="Minutes">
</div>

<br>
  <div class="input-group">
  <div class="input-group-prepend">
  
    <span class="input-group-text">Expected Exit Time  </span>
  </div>
  <input type="text" name="hrs_exit" class="form-control" placeholder="Hours">
  <input type="text" name="mins_exit" class="form-control" placeholder="Minutes">
  </div>
</div>

  <div class="center" style="margin-top: 100px">
            <button type="submit" name="proceed" value="Submit" class="btn btn-primary">Proceed</button>
  </div>
</form>
          
</body>