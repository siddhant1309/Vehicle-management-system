<?php
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
    <link rel="stylesheet" href="outline.css">
</head>
<body>
    <div class="heading">
        <h1>ADD VEHICLE</h1>
    </div>

<div class="sidebar">
  <a  href="vehicle_category.php">Vehicle Category</a>
  <a href="add-vehicle.php">Vehicle Entry</a>
  <a href="invehicles.php">In Vehicles</a>
  <a href="out_vehicles.php">Out Vehicles</a>
  <a href="income.php">Income</a>
  <a href="querybox.php">Query box</a>

</div>


    <form action ="" method="POST" class="inserting_car" style="position: absolute; margin-left: 38em;margin-top: 15em">

  Registration Number<input type="text" name="RNo"><br>
  Vehicle Company<input type="text" name="company"><br>
  Owner Name<input type="text" name="Owner_name"><br>
  Owner's Contact<input type="mobile" name="mobile"><br>

    <label>Vehicle Category</label>
    <select class="form-control" name="catename" id="catename">
	<option value="0">Select Category</option>
	<?php $query=mysqli_query($mysqli,"select * from vcategory");
	while($row=mysqli_fetch_array($query))
	{
	?>    
    <option value="<?php echo $row['VehicleCat'];?>"><?php echo $row['VehicleCat'];?></option>
    <?php } ?> 
	</select>
  <input type="submit" name="submit" >

    </form>
    <?php 
    if(isset($_POST['submit'])) 
    {
        $parkingnumber=mt_rand(10000, 99999);
        $Rno=$_POST['RNo'];
        $Vehicle_Company=$_POST['company'];
        $Owner_name=$_POST['Owner_name'];
        $Contact=$_POST['mobile'];
        $catename=$_POST['catename'];
        // $enteringtime=$_POST['enteringtime'];


        $result=mysqli_query($mysqli,"INSERT into vehicle_info(ParkingNumber , VehicleCategory , VehicleCompanyname , RegistrationNumber , OwnerName , OwnerContactNumber ) 
         values('$parkingnumber','$catename','$Vehicle_Company','$Rno','$Owner_name','$Contact')");



         //$result1=mysqli_query($mysqli,"INSERT into out_table(ParkingNumber) values('$parkingnumber')");
        
    if($result)
    {
        echo "Success";
    }
    else{
        echo "Failed";
    }
   
    }
    ?>
    
    

    
</body>
</html>