
<?php
include("config.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income</title>
    <link rel="stylesheet" href="outline.css">
</head>
<body>
    <div class="heading">
        <h1>INCOME </h1>

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
    <th style=" border: 1px solid black">Parking Number</th>
    <th style=" border: 1px solid black">In Time</th>
    <th style=" border: 1px solid black">Out Time</th>
    <th style="border: 1px solid black">Duration</th>
    </tr>
    <?php
    $conn=mysqli_connect("localhost","root","","parking1");
    if($conn ->connect_error)
    {
        die("Connection Failed:". $conn-> connect_error);
    }

    $sql="SELECT ParkingNumber,InTime,OutTime,Duration from out_table";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        while ($row=$result->fetch_assoc()){
            echo "<tr style='border: 1px solid black'><td style='border: 1px solid black'>". $row["ParkingNumber"] . "</td><td style='border: 1px solid black'>". $row["InTime"] . "</td><td style='border: 1px solid black'>". $row["OutTime"] ."</td><td style='border: 1px solid black'>". $row["Duration"] ."</td></tr>";
        }
        echo "</table";
    }
    else{
        echo "0 result";
    }
     $conn-> close();
?>
</table>
<div style="position : absolute ; margin-left : 33em ; margin-top : 5em">
<form method="$_POST">
<label>Parking Number</label>
    <select class="form-control" name="p_num" id="p_num">
	<option value="0">Select Parking Number</option>
	<?php $query=mysqli_query($mysqli,"select * from out_table");
	while($row=mysqli_fetch_array($query))
	{
	?>    
    <option value="<?php echo $row['ParkingNumber'];?>"><?php echo $row['ParkingNumber'];?></option>
    <?php } ?> 
	</select>

    <input type="submit" name="submit">
</form>
</div>

<?php 
    if(isset($_POST['submit'])) 
    {
        $p_num=$_POST['p_num'];
    

    $result=mysqli_query($mysqli,"SELECT  duration('$p_num') AS duration");
    
    //alert("$result");

    if($result)
    {
        echo "$result";
    }
    else{
        echo "Failed";
    }
}
?>    
  


    
</body>
</html>