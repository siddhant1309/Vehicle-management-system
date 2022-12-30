
<?php
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="outline.css">
</head>
<body>
    <div class="heading">
        <h1>ADD CATEGORY</h1>

    </div>

<div class="sidebar">
  <a  href="vehicle_category.php">Vehicle Category</a>
  <a href="add-vehicle.php">Vehicle Entry</a>
  <a href="invehicles.php">In Vehicles</a>
  <a href="out_vehicles.php">Out Vehicles</a>
  <a href="income.php">Income</a>
  <a href="querybox.php">Query box</a>

</div>

<form action ="" method="POST" style="position: absolute; margin-left: 38em;margin-top: 15em">
Category :<input type="text" name="category"><br>
<input type="submit" name="submit">

</form>

<?php 
    if(isset($_POST['submit'])) 
    {
       $category=$_POST['category'];
    

    $result=mysqli_query($mysqli,"INSERT into vcategory(VehicleCat)  values('$category')");

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