<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
	<head>
		  <title>BidBea</title>
          <link rel="icon" href="assets/img/bidbea3.png">
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
	  
			
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
        <a class="nav-link"  style="color:white" href="index.php">Home</a>
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
						$user_name = $row['first_name'].' '.$row['last_name'];
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
 
	<div class="container" style="margin-top:50px; margin-bottom:50px;">

		<div class="card">
		  <div class="card-header text-center"><b>Products</b></div>
		  <div class="card-body">
		  
		    <div  style="display:none" class="alert alert-warning" id="warningDiv">
				<strong>Alert!</strong> <span id="warningDivSpan"></span>
			</div>
		  
			<div id="data">
				<!-- fill by ajax-->
			</div>
			</div>
		  </div>  
	</div>
	
	
  
  

<?php include("footer.php");?>

<style>
  #card > .inner{
	  transition : all 1.5s ease;
  }
 
  #card:hover .inner{
	 transform :scale(1.3);
  } 
 </style>
  

	<script>
		$(document).ready(function(){

			
			
			$('.dropdown-toggle').dropdown();
			$.urlParam = function(name){
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                if (results === null) {
                   return 0;
                }
                return decodeURI(results[1]) || 0;
            };
      
            var page_no =  $.urlParam("page_no");
			if(page_no == '0')
				page_no = "";
			
			var getAllProducts = "getAllProducts";
			$.ajax({
				url : "user_ajax.php",
				type:"POST",
				data: { 'action': getAllProducts,'page_no':page_no},
				success: function (data) {
					$("#data").empty();
					$("#data").html(data);
				}
			});
			
			
			$("#data").on('change','#priceSort',function(){
				var value = this.value;
			
				var getProductsByPrice = "getProductsByPrice";
				$.ajax({
					url : "user_ajax.php",
					type:"POST",
					data: { 'action': getProductsByPrice,'page_no':page_no,'priceRange':value},
					success: function (data) {
						$("#data").empty();
						$("#data").html(data);
					}
				});
			});
			
			$("#data").on('click','#searchBtn',function(){
				var searchValue = $("#searchValue").val();
				
				var getProductsBySearchValue = "getProductsBySearchValue";
				if(searchValue != ""){
					$.ajax({
						url : "user_ajax.php",
						type:"POST",
						data: { 'action': getProductsBySearchValue,'page_no':page_no,'searchValue':searchValue},
						success: function (data) {
							// alert(data.trim());
							if(data.trim().includes("not-available")){
								// alert(data.trim());
								$('#warningDivSpan').text("Sorry! Product not available yet..");
								$('#warningDiv').show().delay(5000).fadeOut(); 
							}else{
								$("#data").empty();
								$("#data").html(data);
							}
						}
					});
				}else{
					$('#warningDivSpan').text("Enter Search value please..");
					$('#warningDiv').show().delay(5000).fadeOut(); 
				}
			});
			
			
			$("#data").on('change','#prod_cat_id',function(){
				var prod_cat_id = this.value;
				
				var getProductsByCategory = "getProductsByCategory";
				$.ajax({
					url : "user_ajax.php",
					type:"POST",
					data: { 'action': getProductsByCategory,'page_no':page_no,'prod_cat_id':prod_cat_id},
					success: function (data) {
						// alert(data.trim());
						if(data.trim().includes("not-available")){
							// alert(data.trim());
							$('#warningDivSpan').text("Sorry! Product not available yet..");
							$('#warningDiv').show().delay(5000).fadeOut(); 
						}else{
							$("#data").empty();
							$("#data").html(data);
						}
					}
				});
			});
			
			
						
			
		});
	</script>

	</body>
</html>


