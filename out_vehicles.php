<?php
include("config.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OUT VEHICLES</title>
    <link rel="stylesheet" href="outline.css">
</head>
<body>
    <div class="heading">
        <h1>OUT VEHICLES</h1>

    </div>

<div class="sidebar">
  <a  href="vehicle_category.php">Vehicle Category</a>
  <a href="add-vehicle.php">Vehicle Entry</a>
  <a href="invehicles.php">In Vehicles</a>
  <a href="out_vehicles.php">Out Vehicles</a>
  <a href="income.php">Income</a>
  <a href="querybox.php">Query box</a>

</div>

<table style="border: 1px solid black   ;border-collapse : collapse ; position: absolute; margin-left: 17em;margin-top: 9em;width : 60%">
    <tr>
    <th style=" border: 1px solid black">ID</th>
    <th style=" border: 1px solid black">Owner Name</th>
    <th style=" border: 1px solid black">Vehicle Number</th>
    <th style="border: 1px solid black">Parking Number</th>
    <th style=" border: 1px solid black">Vehicle Category</th>

    </tr>
    <?php
    $conn=mysqli_connect("localhost","root","","parking1");
    if($conn ->connect_error)
    {
        die("Connection Failed:". $conn-> connect_error);
    }

    $sql="SELECT ID,VehicleCategory,RegistrationNumber,ParkingNumber,OwnerName from vehicle_info";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        while ($row=$result->fetch_assoc()){
            echo "<tr style='border: 1px solid black'><td style='border: 1px solid black'>". $row["ID"] . "</td><td style='border: 1px solid black'>". $row["OwnerName"] . "</td><td style='border: 1px solid black'>". $row["RegistrationNumber"] ."</td><td style='border: 1px solid black'>". $row["ParkingNumber"] ."</td><td style='border: 1px solid black'>". $row["VehicleCategory"] . "</td></tr>";
        }
        echo "</table";
    }
    else{
        echo "0 result";
    }
     $conn-> close();
?>
</table>
<form action="" method="POST" >
    <div style="position : absolute ; margin-top: 30em ; margin-left: 35em">
<label>Plate Number</label>
    <select class="form-control" name="platenum" id="platenum" >
	<option value="0">Select Plate Number</option>
	<?php $query=mysqli_query($mysqli,"select * from vehicle_info");
	while($row=mysqli_fetch_array($query))
	{
	?>    
    <option value="<?php echo $row['RegistrationNumber'];?>"><?php echo $row['RegistrationNumber'];?></option>
    <?php } ?> 
	</select>
    <br>
    <input type="submit" name="submit" value="Exit Parking" ><br>
    </div>

</form>


<!-- <a href="add_category.php" style="border : 10px solid black ;color : red; background-color : black ; position : absolute ;margin-top : 27em ; margin-left : 43em  ">ADD CATEGORY</a>

<a href="delete_category.php" style="border : 10px solid black ;color : red; background-color : black ; position : absolute ;margin-top : 30em ; margin-left : 43em  ">DELETE CATEGORY</a> -->

<?php 
    if(isset($_POST['submit'])) 
    {
        $platenum=$_POST['platenum'];

        //$result1=mysqli_query($mysqli,"INSERT into out_table(OutTime) values(NOW()) WHERE ParkingNumber = (SELECT ParkingNumber FROM vehicle_info WHERE RegistrationNumber='$platenum' )");

        $result=mysqli_query($mysqli,"DELETE FROM vehicle_info WHERE '$platenum'=RegistrationNumber");
        
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