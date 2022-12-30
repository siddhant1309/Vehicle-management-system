<?php $conn = new mysqli('localhost','root','','parking1');?>
<?php
$insert = false;
if(isset($_POST['query'])){

    // Collect post variables
    $query = $_POST['query'];

    $sql = "$query;";
    // echo $sql;
    $res = mysqli_query($conn,$sql);
    // Execute the query
    if($conn->query($sql) == true){;
        echo("<table class='container' style=width:60%>");
        $first_row = true;
        while ($row = mysqli_fetch_assoc($res)) {
        if ($first_row) {
            $first_row = false;
            // Output header row from keys.
            echo '<tr class="tbl-header"">';
            foreach($row as $key => $field) {
                echo '<th style=padding:10px>' . htmlspecialchars($key) . '</th>';
            }
            echo '</tr>';
        }
    echo '<tr class="tbl-row">';
    foreach($row as $key => $field) {
        echo '<td style=padding:10px>' . htmlspecialchars($field) . '</td>';
    }
    echo '</tr>';
}
echo("</table>");
    }
    else{
        echo "ERROR: $sql <br> $conn->error";
        $_SESSION['add'] = "Query Failure";
        header("location:",SITEURL.'QueryBox.php');
    }
    
    // Close the database connection
    $conn->close();
}
?>

<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<style>
    <?php include "style.css" ?> 
    <?php include "Pages/All.css" ?> 

        .container{
        max-width: 80%; 
        padding: 34px; 
        margin: auto;
        }
		.nav_bar a{
		color: black;
		text-decoration: none;
		padding: 25px 10px;
		}
		.nav_bar a:hover{
		color: rgb(0, 138, 251);
		text-decoration: none;
		}
		.nav_bar{
			margin-top: 30px;
    		font-size: 0px;
		}
		.nav_bar a:hover{
		color: rgb(0, 138, 251);
		}
		header{
    	margin-top: -20px;
    	background-color: black;
    	height: 100px;
		}
		.left img{
		width: 100px;
		}
		.left{
		display: inline-block;
		left: 10px;
		top: 10px;
		position: absolute;
		}

	.left div{
		text-align: center;
		line-height: 15px;
		font-size: 20px;
	}
	.right{
	display: block;
	margin: 10px auto;
	}
	.btnSub{
    color: white;
    background: #cd5c5c;
    padding: 8px 12px;
    font-size: 20px;
    border: 2px solid white;
    border-radius: 10px;
    cursor: pointer;
	}
	


.imgC {
  /* The image used */
  /* Full height */
	width:50%;
	margin-right: 0px;
    margin-left: 700px;
}

header{
    margin-top: -10px;
    background-color: transparent;
    height: 100px;
}
.leftContainer{
	width: 1000px;
}
a{
    text-decoration: none;
    
}
</style>
<!-- <div class="container" style="float:left; width:50%; "> -->
<div class="container">
        <h1>SELECT Query Box</h1>
        <p>Only Select SQL query</p>
        <?php
        if($insert == true){
        echo "<p class='submitMsg'>Thanks for submitting your form.</p>";
        }
        ?>
        <form action="querybox.php" method="post">
            <textarea id="query" name="query" rows="8" cols="50">
            </textarea>
            <br>
            <button class="submitBtn">Submit</button> 
            <br/>
        </form>
    </div>
    <!-- <div style="float:right; width:50%;margin-top:150px">
		<img style="width:100%" src="images/emp.jpg" />
	</div> -->
</div>