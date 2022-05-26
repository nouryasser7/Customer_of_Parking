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
?>
<!doctype html>
<html lang="en">

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="mystyles.css"> -->
    <title>Parking Full!</title>
</head>
<div class="alert alert-danger" role="alert">
  Unfortunately, there's no available spots in our parking.
</div>
<br>
<br><h5 style="text-align: center"> <a href="index.php">Please Select Another Branch.</a></h5>

</html>
