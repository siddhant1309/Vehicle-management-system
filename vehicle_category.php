<?php
include("config.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Category</title>
    <link rel="stylesheet" href="outline.css">
</head>
<body>
    <div class="heading">
        <h1>VEHICLE CATEGORY</h1>

    </div>

<div class="sidebar">
  <a  href="vehicle_category.php">Vehicle Category</a>
  <a href="add-vehicle.php">Vehicle Entry</a>
  <a href="invehicles.php">In Vehicles</a>
  <a href="out_vehicles.php">Out Vehicles</a>
  <a href="income.php">Income</a>
  <a href="querybox.php">Query box</a>

</div>

<table style="border: 1px solid black   ;border-collapse : collapse ; position: absolute; margin-left: 25em;margin-top: 15em;width : 50%">
    <tr>
    <th style="width : 50% ; border: 1px solid black">ID</th>
    <th style="width: 120% ; border: 1px solid black">Category</th>
    </tr>
    <?php
    $conn=mysqli_connect("localhost","root","","parking1");
    if($conn ->connect_error)
    {
        die("Connection Failed:". $conn-> connect_error);
    }

    $sql="SELECT ID,VehicleCat from vcategory";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        while ($row=$result->fetch_assoc()){
            echo "<tr><td style='border: 1px solid black'>". $row["ID"] . "</td><td>". $row["VehicleCat"] . "</td></tr>";
        }
        echo "</table";
    }
    else{
        echo "0 result";
    }
     $conn-> close();
?>
</table>

<a href="add_category.php" style="border : 10px solid black ;color : red; background-color : black ; position : absolute ;margin-top : 27em ; margin-left : 43em  ">ADD CATEGORY</a>

<a href="delete_category.php" style="border : 10px solid black ;color : red; background-color : black ; position : absolute ;margin-top : 30em ; margin-left : 43em  ">DELETE CATEGORY</a>



    
</body>
</html>