<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BidBea</title>
  <link rel="icon" href="assets/img/bidbea3.png">
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

 

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
</head>

<body>



<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <a class="navbar-brand" href="index.php">
		<img src="assets/img/bidbea3.png" style="width:70px; height:40px;" alt="">
		<span style="color:white; font-size:25px;"><b>BidBea</b><i style="color:white; font-size:15px;"> BID.WIN.SAVE.REPEAT</i></span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#about" style="color:white" >About Us</a>
      </li>
	 
      <li class="nav-item">
        <a class="nav-link" href="#contact" style="color:white" >Contact Us</a>
      </li>
	   <li class="nav-item">
        <a class="nav-link" href="login.php" style="color:white">Login</a>
      </li>
	   <li class="nav-item">
        <a class="nav-link" href="product.php" style="color:white">Products</a>
      </li>
	  <?php
			if(isset($_SESSION["user_id"])  && !empty($_SESSION['user_type'])){
				if($_SESSION['user_type'] == "buyer"){	
				
					$con=mysqli_connect("localhost", "root", "" , "auction-online");
					$userID = $_SESSION['user_id'];
					$result = mysqli_query($con,"SELECT * FROM users WHERE user_id='$userID'");
					while($row = mysqli_fetch_array($result))
					{
						$user_name = $row['first_name'].''.$row['last_name'];
					}
					mysqli_close($con);
					
			?>
				<li class="nav-item">
					<a class="nav-link" href="buyer-logout.php" style="color:white" >Logout</a>
				</li>
			  </ul>
			  
			  <span class="navbar-text" style="font-size:25px; color:white">
				  <span>Hi </span><b><?php echo $user_name; ?></b>
			 </span>
			  
			  
			  
		  
		   <?php
					
				}
				else{
				?>
					</ul>
				 <?php
					
				}
			}
		  ?>
	   
    
    
  </div>
</nav>


 

  
