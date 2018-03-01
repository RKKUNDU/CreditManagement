<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Transfer Credit</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
*{padding:0;border:0;}
	.navbar-inverse{ background-color: coral;border:0;border-radius:0;padding:1%;margin-bottom:0;font-size:1.5em;}
	.navbar .nav li a,.navbar .nav li a:focus{color:white;}
	.navbar .nav li a:hover{color: gray;}
	@media (max-width:600px)
	{
		.navbar-inverse{font-size:1.2em;}
	}
	.container-fluid{padding:0;}
    .btn,.btn:focus{background-color:purple;border:0;color:white}
    .btn:hover{background-color:purple;color:gray;}


</style>
</head>

<body>
	<nav class=" navbar navbar-inverse">
        <div class="container ">
            <div class="navbar-header">
                <button  type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavBar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>    
            </div>
            <div class="navbar-collapse collapse " id="myNavBar">
                <ul class="nav navbar-nav">
                    <li ><a href="index.html">Home</a></li>
                    <li ><a href="users.php">View Users</a></li>
                    <li><a href="#">Transfer Credit</a></li>
                    <li><a href="history.php">Transfer History</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
    	<div class="jumbotron">
        	<div class="container">
        		<form  class='' method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
			<?php
                $con=mysqli_connect("localhost","id4871014_tsftasks","12345","id4871014_dummy_database");
                $sql="SELECT * FROM users";
                $result=mysqli_query($con,$sql);
                if($result->num_rows >0)
                {
                    echo "
                	<h4>Select sender</h4>
					<select  name='sender' class='form-control'>";
					$result=mysqli_query($con,$sql);		
					while($row=$result->fetch_assoc())
					{
						echo "<option value='".$row['name']."'>".$row['name']."</option>";
					}
					 echo "</select><br><h4>Select recipient</h4>
					 <select name='recipient' class='form-control'>";
					 $result=mysqli_query($con,$sql);		
					 while($row=$result->fetch_assoc())
					 {
						echo "<option value='".$row['name']."'>".$row['name']."</option>";
					 }
					 echo "</select>";
           			
                }
                ?>
                <br>
                <h4>Enter number of credits ,you want to transfer</h4> 
                	
                	<input type="tel" name="credit" class="form-control" placeholder="Enter Credit point" required><br>
                    <div class="text-center">
                    	<input type="submit" name="transfer" class="btn btn-default" value="Transfer Credit">
                     </div>   
        	</div>
        </div>
    </div>    
    <?php 
		if(isset($_POST['transfer']))
		{
			if($_POST['sender']==$_POST['recipient'])
			{
				echo "<script>alert('Both sender and recipient is same')</script>";
								return;

			}
			if($_POST['credit']<=0)
			{
				echo "<script>alert('Please Choose value of credit greater than zero')</script>";
								return;

			}
            $con=mysqli_connect("localhost","id4871014_tsftasks","12345","id4871014_dummy_database");			
			$sender_credit=$recipient_credit=0;
		    $sql2="SELECT credit FROM users WHERE name LIKE '".$_POST['sender']."%';";
			$sql3="SELECT credit FROM users WHERE name LIKE '".$_POST['recipient']."%';";
			$sender_result=mysqli_query($con,$sql2);
			$recipient_result=mysqli_query($con,$sql3);
			while($row=$sender_result->fetch_assoc())
			{
				$sender_credit=$row['credit'];
			}
			while($row=$recipient_result->fetch_assoc())
			{
				$recipient_credit=$row['credit'];
			}
			if($sender_credit<$_POST['credit'])
			echo "<script>alert('Sender does not have enough credits')</script>";
			else
			{
			    $recipient_credit=$recipient_credit+$_POST['credit'];
			    $sender_credit=$sender_credit-$_POST['credit'];
			    $con=mysqli_connect("localhost","id4871014_tsftasks","12345","id4871014_dummy_database");
				$sql4="UPDATE users SET credit=".$recipient_credit." WHERE name LIKE '".$_POST['recipient']."%';";
				$sql5="UPDATE users SET credit=".$sender_credit." WHERE name LIKE '".$_POST['sender']."%';";
				mysqli_query($con,$sql4);
				mysqli_query($con,$sql5);
			    echo "<script>alert('".$_POST['credit']." credit is transferred from ".$_POST['sender']." to ".$_POST['recipient']."')</script>";
			    date_default_timezone_set('Asia/kolkata');
			    $dt=time();
			    $date=date("d-m-Y H:i:s",$dt);
			    $sql6="INSERT INTO transfer (fromUser,toUser,credit,dateTimeNow) VALUES ('".$_POST['sender']."','".$_POST['recipient']."',".$_POST['credit'].",'".$date."');";
			    mysqli_query($con,$sql6);
			    
			}
			
		}
	?>
</body>
</html>