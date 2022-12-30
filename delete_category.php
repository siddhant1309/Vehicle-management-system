
<?php
include("config.php");
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Category</title>
    <link rel="stylesheet" href="outline.css">
</head>
<body>
    <div class="heading">
        <h1>DELETE CATEGORY</h1>

    </div>

<div class="sidebar">
  <a  href="vehicle_category.php">Vehicle Category</a>
  <a href="add-vehicle.php">Vehicle Entry</a>
  <a href="out_vehicles.php">In Vehicles</a>
  <a href="#about">Out Vehicles</a>
  <a href="income.php">Income</a>
  <a href="querybox.php">Query box</a>

</div>

<form action ="" method="POST" style="position: absolute; margin-left: 38em;margin-top: 15em">
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
<input type="submit" name="submit">

</form>

<?php 
    if(isset($_POST['submit'])) 
    {
        $catename=$_POST['catename'];
    

    $result=mysqli_query($mysqli,"DELETE FROM vcategory WHERE VehicleCat='$catename'");

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