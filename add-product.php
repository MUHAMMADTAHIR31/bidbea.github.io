<?php
	session_start();
	if(isset($_SESSION["user_id"])  && !empty($_SESSION['user_type'])){
		if($_SESSION['user_type'] == "seller"){		
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>BidBea</title>
      <link rel="icon" href="assets/img/bidbea3.png">
  
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  
	   <!-- Favicons -->
	  <link href="assets/img/favicon.png" rel="icon">
	  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
	  
	  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
	  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
	  
	  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  
	  
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"></script>
	  
	  


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
	  
	  <?php
			if(isset($_SESSION["user_id"])  && !empty($_SESSION['user_type'])){
				if($_SESSION['user_type'] == "seller"){		
				
					$con=mysqli_connect("localhost", "root", "" , "auction-online");
					$userID = $_SESSION['user_id'];
					$result = mysqli_query($con,"SELECT * FROM users WHERE user_id='$userID'");
					while($row = mysqli_fetch_array($result))
					{
						$first_name = $row['first_name'];
						$last_name = $row['last_name'];
					}
					mysqli_close($con);
					
			?>
				<li class="nav-item">
					<a class="nav-link" href="seller-logout.php" style="color:white" >Logout</a>
				</li>
			  </ul>
			  
			  <span class="navbar-text" style="font-size:25px; color:white">
				  <span>Hi </span><b><?php echo $first_name.' '.$last_name; ?></b>
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


 
<div class="container" style="margin-top:50px; margin-bottom:110px;">
	
	<div class="card">
	  <div class="card-header"  style="display:inline-block;" >
			<H5 style="text-align: center; display: inline-block;">Product-Details</H5>
			<Button type="button" style="float: right;" name ="addNewProduct"  id="addNewProduct" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-plus"> Add-Product</i></button>
			
	  </div>
	  <div class="card-body">
			<div  style="display:none" class="alert alert-success" id="addSuccessDiv">
				<strong>Success!</strong> Product Added successfully.
			</div>
			 <div  style="display:none" class="alert alert-warning" id="warningDiv">
				<strong>Alert!</strong> <span id="warningDivSpan"></span>
			</div>
			<div  style="display:none" class="alert alert-success" id="deleteSuccessDiv">
				<strong>Success!</strong> Product Deleted successfully.
			</div>
			
			<div  style="display:none" class="alert alert-success" id="saleSuccessDiv">
				<strong>Success!</strong> <span id="bidMsg"></span>
			</div>
			
			
		<div class="table-responsive">
		

			<table id="dataTable" class="table table-striped table-bordered" style="width:100%; text-align: center;">
					<thead>
						<tr>
							<th>S.no</th>
							<th style="display:none;">Product ID</th>
							<th>Product Category</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>High Bid</th>
							<th>Address</th>
							<th>Description</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="tbodyDataTable">
						 <?php
							$con=mysqli_connect("localhost", "root", "" , "auction-online");
						
							$userID = $_SESSION['user_id'];
							$query = "SELECT * FROM product  WHERE user_id='$userID' ORDER BY bid_price DESC";
							$result = mysqli_query($con,$query);
							$counter = 1;
							while($row = mysqli_fetch_array($result))
							{
								
								$prod_cat_id = $row['prod_cat_id'];
								$result2 = mysqli_query($con,"SELECT * FROM product_category WHERE prod_cat_id='$prod_cat_id'");
								$prod_cat_name = "";
								while($row2 = mysqli_fetch_array($result2))
								{
							
								$prod_cat_name = $row2['prod_cat_name'];
							
								}
							echo "<tr>";
							echo "<td>" . $counter++ . "# </td>";
							echo "<td style='display:none;'>" . $row['lot_id'] . "</td>";
							echo "<td>" . $prod_cat_name . "</td>";
							echo "<td>" . $row['product_name'] . "</td>";
							echo "<td>" . $row['price'] . "</td>";
							echo "<td>" . $row['bid_price'] . "</td>";
							echo "<td>" . $row['address'] . "</td>";
							echo "<td>" . $row['describtion'] . "</td>";
							echo "<td>";
							echo "<button id='deleteTableBtn' class='btn btn-danger btn-sm btn-block'><i class='fa fa-trash' > Delete</i></button>";
							echo "<button id='saleTableBtn' class='btn btn-warning btn-sm btn-block'><i class='fa fa-check-circle-o' ><span> Sale</span></i></button>";
							echo "</td>";
							echo "</tr>";
							}
				
							mysqli_close($con);
						  ?>	
						
					</tbody>
				</table>
			</div>
	  
	  
	  </div>
	</div>
</div>

	

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Product-Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
			  
				<div class="form-row">
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4" style="text-align: center; display: block;">
						<img src='assets/img/bidbea3.png' id="product-img-tag" style='width:150px; height:100px;' class="rounded-circle" >
					</div>
					<div class="form-group col-md-4"></div>
				</div>
				<div class="form-row">
					 <div class="input-group col-md-0 my-1">
						  <div class="custom-file">
							  <input type="file" name="productImage" id="productImage" required class="custom-file-input" accept="image/*" >
							  <label class="custom-file-label" for="productImage">Choose file</label>
						  </div>
					  </div>
				</div>				
				<div class="form-row">
					<div class="col-md-6 my-1">
						<label for="uname">Product Category<span style="color:red;">*</span></label>
						 <select class="form-control" id="prod_cat_id" name="prod_cat_id"  required>
						 <?php
							$con=mysqli_connect("localhost", "root", "" , "auction-online");
						
							$userID = $_SESSION['user_id'];
							$query = "SELECT * FROM product_category ";
							$result = mysqli_query($con,$query);
							$counter = 1;
							while($row = mysqli_fetch_array($result))
							{
						
							echo '<option value="'. $row['prod_cat_id'] . '" >'. $row['prod_cat_name'] . '</option>';
						
							}
				
							mysqli_close($con);
						  ?>	
							
						
					    </select>
 						
					</div>
					<div class="col-md-6 my-1">
						<label for="uname">Product Name<span style="color:red;">*</span></label>
						<input type="text" class="form-control" id="product_name" name="product_name" required>							
					</div>			
				</div>
				<div class="form-row">
					<div class="col-md-2 my-1">
						<label for="uname">Price<span style="color:red;">*</span></label>
						<input type="text" class="form-control" id="price" name="price" required>
					
					</div>
					<div class="col-md-2 my-1">
						<label for="uname">Size/Weight<span style="color:red;">*</span></label>
						<input type="text" class="form-control" id="sizeOrWeight" name="sizeOrWeight" required> 
					
					</div>
					<div class="col-md-2 my-1">
						<label for="uname">Quantity<span style="color:red;">*</span></label>
						<input type="number" class="form-control" id="qty" name="qty" required>  					
					</div>			
				
					<div class="col-md-3 my-1">
						<label for="uname">Start-Date<span style="color:red;">*</span></label>
						<input type="text" class="form-control" id="start_date" name="start_date" required> 					
					</div>
					<div class="col-md-3 my-1">
						<label for="uname">End-Date<span style="color:red;">*</span></label>
						<input type="text" class="form-control" id="end_date" name="end_date" required> 					
					</div>			
				</div>
				<div class="form-row">
					<div class="col-md-6 my-1">
						<label for="exampleFormControlTextarea1">Address<span style="color:red;">*</span></label>
						<textarea class="form-control" id="address" name="address" rows="1" required ></textarea>
					</div>
					<div class="col-md-6 my-1">
						<label for="exampleFormControlTextarea1">Description<span style="color:red;">*</span></label>
						<textarea class="form-control" id="desc" name="desc" rows="1" required ></textarea>
					</div>			
				</div>
			  </div>
			  <div class="modal-footer btn-group" role="group">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
				<input type="submit" id="addProduct" name="addProduct" class="btn btn-success btn-sm" value="Add Product"/>
			  </div>
		  </form>
		</div>
	  </div>
	</div>



	<!-- Modal -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="POST" >
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<H4>Are you sure want to delete product?</H4>
				<p class="text-warning">this action can`t undo.</p>
				<input type="hidden" id="prod_id_hidden" name="prod_id_hidden" >
			  </div>
			  <div class="modal-footer btn-group" role="group">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
				<input type="submit" id="deleteProduct" name="deleteProduct" class="btn btn-danger btn-sm" value="Delete Product"/>
			  </div>
		  </form>
		</div>
	  </div>
	</div>




<!-- ======= Footer ======= -->
  <footer class="site-footer" >
    <div class="bottom">
      <div class="container">
        <div class="row">

          <div class="col-lg-12 text-center">
            <p class="copyright-text">
              &copy; Copyright <strong>BidBea</strong>. All Rights Reserved
            </p>
          </div>
		  
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->
  
  
  <?php
			//Insert Data
			if(isset($_POST['addProduct'])){
				$prod_cat_id = $_POST['prod_cat_id'];
				$product_name = $_POST['product_name'];
				$price = $_POST['price'];
				$sizeOrWeight = $_POST['sizeOrWeight'];
				$qty = $_POST['qty'];
				$start_date = $_POST['start_date'];
				$end_date = $_POST['end_date'];
				$address = $_POST['address'];
				$describtion = $_POST['desc'];
				$userID = $_SESSION['user_id'];
				
				
				$con=mysqli_connect("localhost", "root", "" , "auction-online");
			
				$sql = "INSERT INTO product (user_id,prod_cat_id,product_name,sizeOrWeight,qty,price,start_date,end_date,address,describtion) 
					VALUES ('$userID','$prod_cat_id','$product_name','$sizeOrWeight','$qty','$price','$start_date','$end_date','$address','$describtion')";
				
				if ($con->query($sql) === TRUE) {
						$last_id = $con->insert_id;
						$temp = explode(".", $_FILES["productImage"]["name"]);
						$newfilename = $last_id .'_1.png';
						move_uploaded_file($_FILES["productImage"]["tmp_name"], "assets/img/" . $newfilename);
				
					  echo "<script type='text/javascript'>
								$(document).ready(function(){ 
									$('#addSuccessDiv').show().delay(5000).fadeOut(); 
								});
							</script>" ;
				} else {
					echo 'Error: ' + $sql . '<br>' . $con->error;
				}
				
				$con->close();
				
			}//End Of if
			
			//Delete Data
			if(isset($_POST['deleteProduct'])){
				$productID = $_POST['prod_id_hidden'];
			
				$con=mysqli_connect("localhost", "root", "" , "auction-online");
				$sql = "DELETE FROM product WHERE lot_id='$productID'";
			
				if ($con->query($sql) === TRUE) {
					echo "<script type='text/javascript'>
								$(document).ready(function(){ 
									$('#deleteSuccessDiv').show().delay(5000).fadeOut(); 
								});
							</script>" ;
				} else {
					echo 'Error: ' + $sql . '<br>' . $con->error;
				}
				$con->close();
				
			}//End Of if
	
  ?>
  
  
  
  
	<script type="text/javascript">
		// Disable form submissions if there are invalid fields
		(function() {
		  'use strict';
		  window.addEventListener('load', function() {
			// Get the forms we want to add validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
			  form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
				  event.preventDefault();
				  event.stopPropagation();
				}
				form.classList.add('was-validated');
			  }, false);
			});
		  }, false);
		})();
		$(document).ready(function() {
			$("#dataTable").DataTable();
			$( "#start_date" ).datetimepicker();
			$( "#end_date" ).datetimepicker();
			
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
							$('#product-img-tag').attr('src', e.target.result);
					};
					reader.readAsDataURL(input.files[0]);
				}
			}//End readUrl
			$("#productImage").change(function(){
				   readURL(this);
			});

			$(".custom-file-input").on("change", function() {
			  var fileName = $(this).val().split("\\").pop();
			  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
			});
			
			
			
			$("#tbodyDataTable").on('click','#deleteTableBtn',function(){
				$("#deleteModal").modal("show");
				
				var currentRow=$(this).closest("tr"); 
			
				$("#prod_id_hidden").val(currentRow.find("td:eq(1)").html());
				
				
			}); //End of onclick
			
			$("#tbodyDataTable").on('click','#saleTableBtn',function(){
				var currentRow=$(this).closest("tr"); 
				var lot_id = currentRow.find("td:eq(1)").html();
				var productName = currentRow.find("td:eq(3)").html();
				
				var makeProductSaleable = "makeProductSaleable";
				$.ajax({
					url : "user_ajax.php",
					type:"POST",
					data: { 'action': makeProductSaleable,'lot_id':lot_id},
					// beforeSend:function(){
					  // $('#tbodyDataTable #saleTableBtn').prop('disabled', true);
					  // $('#tbodyDataTable #saleTableBtn span').text('please wait...');
					// },
					success: function (data) {
						// alert(data);
						// $('#tbodyDataTable #saleTableBtn').prop('disabled', false);
						// $('#tbodyDataTable #saleTableBtn span').text('Sale');
						if(data.trim().includes("success")){
							$('#bidMsg').text('Permission granted to customer make payment for '+productName);
							$('#saleSuccessDiv').show().delay(5000).fadeOut();
						}
						else{
							$('#warningDivSpan').text(data.trim());
							$('#warningDiv').show().delay(5000).fadeOut(); 
						}		
					}
				});
				
				
			}); //End of onclick
			
			
			
		});
		
	</script>

<?php
    }
	else{
		header("location:login.php");
		die();
	}
}
else{
	 header("location:login.php");
	 die();
}
?>


</body>
</html>


