<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>View Users</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/animate.css">

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
		 
		 	$con=mysqli_connect("localhost","id4871014_tsftasks","12345","id4871014_dummy_database");
            $sql="SELECT * FROM users";
			$result=mysqli_query($con,$sql);
			if($result->num_rows >0)
			{
				echo "<br><div class='container table-responsive'><table class='table table-hover'>
						<tr>
							<th>Sl. No</th>
							<th>User Name</th>
							<th>E-mail</th>
							<th>Credit</th>
					   </tr>";
				while($row= $result->fetch_assoc())
				{
					echo	 "<tr>
								<td>".$row['no']."</td>
								<td>".$row['name']."</td>
								<td>".$row['email']."</td>
								<td>".$row['credit']."</td>
							</tr>";
				}
				/*
				echo "<form  class='' method='post' action='profiles.php'>
						<h4>Select User Name</h4>
						<select name='name' class='form-control'>";
				
				$result=mysqli_query($con,$sql);		
				while($row=$result->fetch_assoc())
				{
					echo "<option value='".$row['name']."'>".$row['name']."</option>";
				}
                   
				echo	"</select>
					<br>
					<div class='container-fluid text-center'>
						<button type='submit' name='view' class='btn btn-default btn-danger'>View User Profile</button>
					</div>
				</form><br>";
			*/
				
			}
			    /*?><tr>
                	<td>10</td>
                	<td>ROHIT kundu</td>
                    <td>kundu.rohit06@gmai.com</td>
                    <td>2000</td>
                    
                </tr>
                </a>
                <tr>
                	<td>1</td>
                	<td>ROHIT kundu</td>
                    <td>kundu.rohit06@gmai.com</td>
                    <td>2000</td>
                    
                </tr>
                <tr>
                	<td>1</td>
                	<td>ROHIT kundu</td>
                    <td>kundu.rohit06@gmai.com</td>
                    <td>2000</td>
                    
                </tr>
                <tr>
                	<td>1</td>
                	<td>ROHIT kundu</td>
                    <td>kundu.rohit06@gmai.com</td>
                    <td>2000</td>
                    
                </tr>
                <tr>
                	<td>1</td>

                	<td>ROHIT kundu</td>
                    <td>kundu.rohit06@gmai.com</td>
                    <td>2000</td>
                    
                </tr>
                <tr>
                	<td>1</td>
                	<td>ROHIT kundu</td>
                    <td>kundu.rohit06@gmai.com</td>
                    <td>2000</td>
                    
                </tr>
            
			
			
            </table>*/
            ?>
            </div>
    	
    
            
            
    	</div>        
    </div>
    
    
    
</body>
</html>