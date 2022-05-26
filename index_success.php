<?php
session_start();
// $pickup = $_SESSION['new_pickup']; 
$servername = "localhost";
$database = "ParkingGarageSystem";
$user = "root";
$password = "root";

$conn = mysqli_connect($servername, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
// $res = "SELECT * FROM reservation WHERE pickup_date = '$pickup'";
// $qu = mysqli_query($conn,$res);
// $count = mysqli_num_rows($qu);
// if($count == 0){
//      $output = 'No search results';
//  }
// else {
//      while($row = mysqli_fetch_array($Totalquery)){
//          $res_no = $row['reserve_no'];
//      }
// }
?>
<!doctype html>
<html lang="en">

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="mystyles.css"> -->
    <title>Success!</title>
</head>
<div class="alert alert-success" role="alert">
  Reservation Successful!
</div>
<br>
<form action="index.php" method="post">
    <div class="second">
            <button type="submit" name="logout" value="Submit" class="btn btn-primary">Log out & Return to Home Screen</button>
        </div>
</form>
</html>
