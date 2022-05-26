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
    <title>Branch Information</title>
    <script type="text/javascript">
        function validate() {
        if (!(document.getElementById('overnight').checked | 
        document.getElementById('car_polish').checked | document.getElementById('temp_park').checked | document.getElementById('interior_wash').checked | 
        document.getElementById('exterior_wash').checked | document.getElementById('tire_gauge').checked)) {
            alert("Please select at least one of the options.");
        }
    }
    </script>
</head>

<?php  
session_start();
$branch_name = $_SESSION['totalresult']; 
$branch_info = "SELECT * FROM garage WHERE garage_name = '$branch_name'";
$servername = "localhost";
$database = "ParkingGarageSystem";
$user = "root";
$password = "root";

$conn = mysqli_connect($servername, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 

$branchRes=mysqli_query($conn,$branch_info);
$branch = mysqli_fetch_array($branchRes,MYSQLI_ASSOC);
$garage_id = $branch['garage_id'];

if(isset($_POST['reserve'])){
  $ava_spots = "SELECT ava_spots FROM garage WHERE garage_id = $garage_id";
  $spotsRes=mysqli_query($conn,$ava_spots);
  $spots_ava = mysqli_fetch_array($spotsRes,MYSQLI_ASSOC);
  $ava_spots = $spots_ava['ava_spots'];
  if($ava_spots == 0){
     header('location: index_fail.php');
  }
  else {
    if(!empty($_POST['overnight'])) {
      $service_to_provide = $_POST['overnight'];
      $sql1 = "INSERT INTO reservation_service (service) VALUES ('".$service_to_provide."')";
      $inserted1 = mysqli_query($conn, $sql1);
      echo "inserted1:" ."$inserted1";
    }
    if(!empty($_POST['temp_park'])) {
      $service_to_provide = $_POST['temp_park'];
      $sql2 = "INSERT INTO reservation_service (service) VALUES ('".$service_to_provide."')";
      $inserted2 = mysqli_query($conn, $sql2);
      echo "inserted2:" ."$inserted2";
    }
    if(!empty($_POST['car_polish'])) {
      $service_to_provide = $_POST['car_polish'];
      $sql3 = "INSERT INTO reservation_service (service) VALUES ('".$service_to_provide."')";
      $inserted3 = mysqli_query($conn, $sql3);
    }
    if(!empty($_POST['interior_wash'])) {
      $service_to_provide = $_POST['interior_wash'];
      $sql4 = "INSERT INTO reservation_service (service) VALUES ('".$service_to_provide."')";
      $inserted4 = mysqli_query($conn, $sql4);
      echo "inserted4:" ."$inserted4";
    }
    if(!empty($_POST['exterior_wash'])) {
      $service_to_provide = $_POST['exterior_wash'];
      $sql5 = "INSERT INTO reservation_service (service) VALUES ('".$service_to_provide."')";
      $inserted5 = mysqli_query($conn, $sql5);
    }
    if(!empty($_POST['tire_gauge'])) {
      $service_to_provide = $_POST['tire_gauge'];
      $sql6 = "INSERT INTO reservation_service (service) VALUES ('".$service_to_provide."')";
      $inserted6 = mysqli_query($conn, $sql6);
    }
    $reservee = "SELECT MAX(reservation_no) as maxi FROM reservation_service WHERE service = 'Overnight Parking'";
    $reserved=mysqli_query($conn,$reservee);
    $reserve = mysqli_fetch_array($reserved,MYSQLI_ASSOC);
    $reserve_no1 = $reserve['maxi'];
    
    $reservee = "SELECT MAX(reservation_no) as maxi FROM reservation_service WHERE service = 'Temporary Parking'";
    $reserved=mysqli_query($conn,$reservee);
    $reserve = mysqli_fetch_array($reserved,MYSQLI_ASSOC);
    $reserve_no2 = $reserve['maxi'];
    
    $reservee = "SELECT MAX(reservation_no) as maxi FROM reservation_service WHERE service = 'Car Polish'";
    $reserved=mysqli_query($conn,$reservee);
    $reserve = mysqli_fetch_array($reserved,MYSQLI_ASSOC);
    $reserve_no3 = $reserve['maxi'];
  
    $reservee = "SELECT MAX(reservation_no) as maxi FROM reservation_service WHERE service = 'Interior Wash'";
    $reserved=mysqli_query($conn,$reservee);
    $reserve = mysqli_fetch_array($reserved,MYSQLI_ASSOC);
    $reserve_no4 = $reserve['maxi'];
  
    $reservee = "SELECT MAX(reservation_no) as maxi FROM reservation_service WHERE service = 'Exterior Wash'";
    $reserved=mysqli_query($conn,$reservee);
    $reserve = mysqli_fetch_array($reserved,MYSQLI_ASSOC);
    $reserve_no5 = $reserve['maxi'];
  
    $reservee = "SELECT MAX(reservation_no) as maxi FROM reservation_service WHERE service = 'Tire Gauge'";
    $reserved=mysqli_query($conn,$reservee);
    $reserve = mysqli_fetch_array($reserved,MYSQLI_ASSOC);
    $reserve_no6 = $reserve['maxi'];
    
    
    while (1) {
      if ($inserted1) {
        $reserve_no = $reserve_no1;
        break;
      }
      if ($inserted2) {
        $reserve_no = $reserve_no2;
        break;
      }
      if ($inserted3) {
        $reserve_no = $reserve_no3;
        break;
      }
      if ($inserted4) {
        $reserve_no = $reserve_no4;
        break;
      }
      if ($inserted5) {
        $reserve_no = $reserve_no5;
        break;
      }
      if ($inserted6) {
        $reserve_no = $reserve_no6;
        break;
      }
      if(!($inserted6 | $inserted5 | $inserted4 | $inserted3 | $inserted2 | $inserted1))
      {
        break;
      }
    }
    if ($inserted1) {
      $alter = "UPDATE reservation_service SET reservation_no = $reserve_no WHERE reservation_no = $reserve_no1";
      $reserved=mysqli_query($conn,$alter);
    }
    if ($inserted2) {
      $alter = "UPDATE reservation_service SET reservation_no = $reserve_no WHERE reservation_no = $reserve_no2";
      $reserved=mysqli_query($conn,$alter);
    }
    if ($inserted3) {
      $alter = "UPDATE reservation_service SET reservation_no = $reserve_no WHERE reservation_no = $reserve_no3";
      $reserved=mysqli_query($conn,$alter);
    }
    if ($inserted4) {
      $alter = "UPDATE reservation_service SET reservation_no = $reserve_no WHERE reservation_no = $reserve_no4";
      $reserved=mysqli_query($conn,$alter);
    }
    if ($inserted5) {
      $alter = "UPDATE reservation_service SET reservation_no = $reserve_no WHERE reservation_no = $reserve_no5";
      $reserved=mysqli_query($conn,$alter);
    }
    if ($inserted6) {
      $alter = "UPDATE reservation_service SET reservation_no = $reserve_no WHERE reservation_no = $reserve_no6";
      $reserved=mysqli_query($conn,$alter);
    }
    if($inserted6 | $inserted5 | $inserted4 | $inserted3 | $inserted2 | $inserted1){
      $_SESSION['branch_id'] = $garage_id;
      $_SESSION['reserv_no'] = $reserve_no;
      header('location:index_pre_reservation.php');
    } else{
      echo "ERROR: Hush! Sorry $sql1. " 
         . mysqli_error($conn);
    }
  
  }
  
}

?>
<body style="background-image: url('branch.jpeg'); height: 100%; background-repeat: no-repeat; background-size: cover;">

<div style="text-align:center;">
<h3 style="color: aliceblue; margin-top: 30px; text-align:center;"><b><?php echo htmlspecialchars($branch_name);?> Branch</b></h3>
</div>
<br>
<form action="#"  onsubmit="return validate()" method="post" name="search">
<div style="text-align: center;">
<ul>
  <li class="list-group-item"><h5><b>Available slots within the next hour:<i style="color: green;"> <?php echo htmlspecialchars($branch['ava_spots']);?></i></b></h5>
</ul>
</div>
<br>
<h4 style="color: yellow; margin-top: -10px;"><b>What do you need for your car?<br><br><i style="color: rgb(157, 236, 247);">Check Accordingly</i></b></h4>
<br>
<!-- <br> -->
<div class="container">
  <div class="row">
    <div class="col-sm">
      <ul class="list-group">
        <li class="list-group-item">
        <div style="border-bottom: 1px solid gray;" class="form-check">
          <input class="form-check-input" type="checkbox" name="temp_park" value="Temporary Parking" id="temp_park">
            <label class="form-check-label" for="defaultCheck1">
              <h5><b><i>Temporary Parking</i></b></h5>
            </label>
        </div>
        <?php $service = "SELECT * FROM service WHERE service_name = 'Temporary Parking'";
              $serviceRes=mysqli_query($conn,$service);
        $service_name = mysqli_fetch_array($serviceRes,MYSQLI_ASSOC)?>
          <p>Price per hour: <?php echo htmlspecialchars($service_name['price_per_unit']);?> EGP</i></b></h5>
        </li>
      </ul>
    </div>
    <div class="col-sm">
      <ul class="list-group">
        <li class="list-group-item">
        <div style="border-bottom: 1px solid gray;" class="form-check">
          <input class="form-check-input" type="checkbox" name="overnight" value="Overnight Parking" id="overnight">
            <label class="form-check-label" for="defaultCheck1">
              <h5><b><i>Overnight Parking</i></b></h5>
            </label>
        </div>
        <?php $service = "SELECT * FROM service WHERE service_name = 'Overnight Parking'";
              $serviceRes=mysqli_query($conn,$service);
        $service_name = mysqli_fetch_array($serviceRes,MYSQLI_ASSOC)?>
          <p>Price per night: <?php echo htmlspecialchars($service_name['price_per_unit']);?> EGP <b>(12AM - 12PM)</b></p></h5>
        </li>
      </ul>
    </div>
    <div class="col-sm">
      <ul class="list-group">
        <li class="list-group-item">
        <div style="border-bottom: 1px solid gray;">
        <h5><b><i>Car Care Service</i></b></h5>
        </div>
        <?php $service = "SELECT * FROM service WHERE service_name = 'Car Polish'";
              $serviceRes=mysqli_query($conn,$service);
          $service_name = mysqli_fetch_array($serviceRes,MYSQLI_ASSOC)?>
          <h6 style="margin-top:5px"><i>Services Available: </i></h6>
          <div style="background-color: #FFFFFF; margin-bottom: 0px;" class="form-check">
          <input class="form-check-input" type="checkbox" name="car_polish" value="Car Polish" id="car_polish" style="margin-left: -16px;margin-top: 8px; ">
            <label class="form-check-label" for="defaultCheck1" style="margin-bottom: -5px;width:305px; background-color: #FFFFFF;">
              <p style="margin-left: 5px; margin-top: 5px;">Car Polish: <?php echo htmlspecialchars($service_name['price_per_unit']);?> EGP</p>
            </label>
        </div>
         
          <?php $service = "SELECT * FROM service WHERE service_name = 'Interior Wash'";
              $serviceRes=mysqli_query($conn,$service);
          $service_name = mysqli_fetch_array($serviceRes,MYSQLI_ASSOC)?>
          <div style="background-color: #FFFFFF; margin-bottom: 0px;" class="form-check">
          <input class="form-check-input" type="checkbox" name="interior_wash" value="Interior Wash" id="interior_wash" style="margin-left: -16px;margin-top: 8px; ">
            <label class="form-check-label" for="defaultCheck1" style="margin-bottom: -5px;width:305px; background-color: #FFFFFF;">
              <p style="margin-left: 5px; margin-top: 5px;">Interior Wash: <?php echo htmlspecialchars($service_name['price_per_unit']);?> EGP</p>
            </label>
        </div>
          <?php $service = "SELECT * FROM service WHERE service_name = 'Exterior Wash'";
              $serviceRes=mysqli_query($conn,$service);
          $service_name = mysqli_fetch_array($serviceRes,MYSQLI_ASSOC)?>
          <div style="background-color: #FFFFFF; margin-bottom: 0px;" class="form-check">
          <input class="form-check-input" type="checkbox" name="exterior_wash" value="Exterior Wash" id="exterior_wash" style="margin-left: -16px;margin-top: 8px; ">
            <label class="form-check-label" for="defaultCheck1" style="margin-bottom: -5px;width:305px; background-color: #FFFFFF;">
              <p style="margin-left: 5px; margin-top: 5px;">Exterior Wash: <?php echo htmlspecialchars($service_name['price_per_unit']);?> EGP</p>
            </label>
        </div>
          <?php $service = "SELECT * FROM service WHERE service_name = 'Tire Gauge'";
              $serviceRes=mysqli_query($conn,$service);
          $service_name = mysqli_fetch_array($serviceRes,MYSQLI_ASSOC)?>
          <div style="background-color: #FFFFFF; margin-bottom: 0px;" class="form-check">
          <input class="form-check-input" type="checkbox" name="tire_gauge" value="Tire Gauge" id="tire_gauge" style="margin-left: -16px;margin-top: 8px; ">
            <label class="form-check-label" for="defaultCheck1" style="margin-bottom: -5px;width:305px; background-color: #FFFFFF;">
              <p style="margin-left: 5px; margin-top: 5px;">Tire Gauge: <?php echo htmlspecialchars($service_name['price_per_unit']);?> EGP</p>
            </label>
        </div>

          </li>
      </ul>
    
    </div>
  </div>
</div>
</div>
<br>
<div style="text-align: center;">
    <button type="submit" name="reserve" value="Submit" style="background-color: initial;
    background-image: linear-gradient(-180deg, #FF7E31, #E62C03);
    border-radius: 6px;
    box-shadow: rgba(0, 0, 0, 0.1) 0 2px 4px;
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    height: 40px;
    line-height: 40px;
    outline: 0;
    overflow: hidden;
    padding: 0 20px;
    pointer-events: auto;
    position: relative;
    text-align: center;
    touch-action: manipulation;
    user-select: none;
    -webkit-user-select: none;
    vertical-align: top;
    white-space: nowrap;
    width: 150px;
    z-index: 9;
    border: 0;
    transition: box-shadow .2s;"><b>Reserve</b>
    </button>
</div>
</form>
</body>
</html>