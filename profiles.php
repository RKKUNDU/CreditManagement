<?php
if(isset($_POST['view']))	{
	session_start();
			}
	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Profile</title>
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
    .btn,.btn:focus{background-color:purple;border:0;}
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
                    <li><a href="transfer.php">Transfer Credit</a></li>
                    <li><a href="history.php">Transfer History</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
    	<div class="jumbotron">
        	<?php
			if(isset($_POST['view']))
			{
				 /*?>echo $_POST['name'];
				echo "<br>";<?php */
				$_session['sender']=$_POST['name'];
				$con=mysqli_connect("localhost","id4871014_tsftasks","12345","id4871014_dummy_database");
				$sql="SELECT * FROM users WHERE name LIKE '".$_POST['name']."%';";
				$result=mysqli_query($con,$sql);
				while($row=$result->fetch_assoc())
				{
					echo "<h3>Name : ".$row['name']."</h3><br>";
					echo "<h3>Age : ".$row['age']."</h3><br>";
					echo "<h3>E-mail : ".$row['email']."</h3><br>";
					echo "<h3>Phone : ".$row['phone']."</h3><br>";
					echo "<h3>Address : ".$row['address']."</h3><br>";
					echo "<h3>Credit : ".$row['credit']."</h3><br>";
				}
			}
							
			?>
				<h4>Transfer Credit from this account ?</h4><br>
				<?php
				$con=mysqli_connect("localhost","id4871014_tsftasks","12345","id4871014_dummy_database");
				$sql="SELECT * FROM users";
				$result=mysqli_query($con,$sql);
				if($result->num_rows >0)
				{
									
					echo "<form  class='' method='post' action='profiles.php'>
							<h4>Choose Recipient </h4>
							<select name='recipient' class='form-control'>";
					
					$result=mysqli_query($con,$sql);		
					while($row=$result->fetch_assoc())
					{
						echo "<option value='".$row['name']."'>".$row['name']."</option>";
					}
					   
					echo	"</select>
						<br>
						<h4>Enter number of credits ,you want to transfer</h4> 
						<input type='tel' name='credit' class='form-control' placeholder='Enter Credit point' required><br>
						<div class='container-fluid text-center'>
							<input type='submit' name='send' class='btn btn-default btn-danger' placeholder='Send Credit'>
						</div>
					</form><br>";
					
				} 
			
			?>
            
            <?php 
			echo "<h1>echoing  ".$_session['sender']."</h1><br>";
		if(isset($_POST['send']))
		{
			echo "<h1>echoing  ".$_session['sender']."</h1><br>";
			if($_SESSION["sender"]==$_POST['recipient'])
			{
				echo "<script>alert('Your choosen recipient is this user')</script>";
								return;

			}
            $con=mysqli_connect("localhost","id4871014_tsftasks","12345","id4871014_dummy_database");			
			$sender_credit=$recipient_credit=0;
		    $sql2="SELECT credit FROM users WHERE name LIKE '".$_SESSION["sender"]."%';";
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
				$sql5="UPDATE users SET credit=".$sender_credit." WHERE name LIKE '".$_SESSION['sender']."%';";
				mysqli_query($con,$sql4);
				mysqli_query($con,$sql5);
			    echo "<script>alert('".$_POST['credit']." credit is transferred from ".$_SESSION['sender']." to ".$_POST['recipient']."')</script>";
			    date_default_timezone_set('Asia/kolkata');
			    $dt=time();
			    $date=date("d-m-Y H:i:s",$dt);
			    $sql6="INSERT INTO transfer (fromUser,toUser,credit,dateTimeNow) VALUES ('".$_SESSION['sender']."','".$_POST['recipient']."',".$_POST['credit'].",'".$date."');";
			    mysqli_query($con,$sql6);
			    
			}
			
		}
	?>
        </div>
     </div>   
</body>
</html>