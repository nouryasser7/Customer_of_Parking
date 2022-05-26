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
    <title>Welcome Page</title>
</head>
<?php
session_start();
        $servername = "localhost";
        $database = "ParkingGarageSystem";
        $user = "root";
        $password = "root";
        
        $conn = mysqli_connect($servername, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            } 

if(isset($_POST['go']))
{  
$branch = mysqli_real_escape_string($conn,$_POST['Branch']);
if (!$branch) {
  echo "<script>alert('Please select a branch.');window.location.href='index.php'</script>";
}
else {
  $querytot = "$branch";
  $_SESSION['totalresult'] = $querytot;
  header('location: index_branchInfo.php');
}
}
?>
         
<body style="background-image: url('parking-garage-1.jpeg');background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;">
<h1 style="color: rgb(255, 255, 255)"><b><i>Welcome to "Alex" Parking System</i></b></h1>

<form action="#" method="post" class="container w-25">

    <label style="color: rgb(207, 24, 85)"><b>Select Branch</b></label>
    <select name="Branch" class="form-select h-50 w-30" aria-label="Default select example" >
    <option value="0">Any</option>
        <?php 
            $sql = "SELECT DISTINCT garage_name FROM garage";
            $all_parkings = mysqli_query($conn,$sql);
            while ($branch = mysqli_fetch_array($all_parkings,MYSQLI_ASSOC)):; 
        ?>
            <option value="<?php echo $branch["garage_name"];?>">
                <?php echo $branch["garage_name"];?>
            </option>
        <?php 
            endwhile;?>

</select>

<br>
<div >
    <button type="submit" name="go" value="Submit" style="background-color: initial;
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
    width: 100%;
    z-index: 9;
    border: 0;
    transition: box-shadow .2s;"><b>Go</b>
    </button>
</div>
</form>



</body>  

</html>