<?php
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="outline.css">
</head>
<body>
    <div class="heading">
        <h1>ADMIN LOGIN</h1>

    </div>

<!-- <div class="sidebar">
  <a  href="vehicle_category.php">Vehicle Category</a>
  <a href="add-vehicle.php">Vehicle Entry</a>
  <a href="#contact">In Vehicles</a>
  <a href="#about">Out Vehicles</a>
  <a href="#income">Income</a>
</div> -->
<a href="register.php" style="position : absolute ; border : solid 10px black; margin-left:80em">Register</a>
<a href="setting.php" style="position : absolute ; border : solid 10px black; margin-left:80em;margin-top:2em">SETTINGS</a>

<div class="parking_heading" style="font-size: 2em">PARKING MANAGEMENT</div>
<div class="container">
  <form method="POST" action="" >
    <label for="username"><b>Username</b></label></br></br>
    <input type="text" placeholder="Enter Username" name="username" required></br></br>

    <label for="password"><b>Password</b></label></br></br>
    <input type="password" placeholder="Enter Password" name="password" required></br></br></br>
        
    <input type="submit" name="submit">Login</button>
  </form>
  </div>

  <?php 
    if(isset($_POST['submit'])) 
    {
      $username=$_POST['username'];
      $password=$_POST['password'];

      $query=mysqli_query($mysqli,"SELECT ID FROM admin where username='$username' AND password='$password'");

      $row=mysqli_fetch_array($query);

      if($row>0)
      {
        header("Location: invehicles.php");
        exit();
      }
    
      

    }

 
?>
    
</body>
</html>