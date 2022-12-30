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
        <h1>SETTINGS</h1>

    </div>

<!-- <div class="sidebar">
  <a  href="vehicle_category.php">Vehicle Category</a>
  <a href="add-vehicle.php">Vehicle Entry</a>
  <a href="#contact">In Vehicles</a>
  <a href="#about">Out Vehicles</a>
  <a href="#income">Income</a>
</div> -->


<a href="delete_admin.php" style="position : absolute ; border : solid 10px black; margin-left:10em ; margin-top:20em">Delete Admin</a>
<a href="changepassword.php" style="position : absolute  ; border : solid 10px black; margin-left:50em ; margin-top:20em">Change Password</a>


  <?php 

    include("config.php");
    if(isset($_POST['submit'])) 
    {
      

      $sql=mysqli_query($mysqli,"SELECT * FROM admin WHERE username=' " . $_POST["username"] . "' AND password=' " . $_POST["password"] ."'  ");
      
      $num = mysqli_num_rows($sql);

      if($num>0)
      {
        $row = mysqli_fetch_array($sql);
        header("location :invehicles.php");
        exit();
      }
      else{
        ?>
        <hr>
        <font color="red"><b>
            <h3>Sorry Invalid Username and Password<br>
              Please Enter Correct Credentials</br></h3>
        </b>
    </font>
    <hr>

    <?php
      }
}
?>

    
    
</body>
</html>