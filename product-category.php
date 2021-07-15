<?php
	session_start();
	if(isset($_SESSION["user_id"])  && !empty($_SESSION['user_type'])){
		if($_SESSION['user_type'] == "admin"){		
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
				if($_SESSION['user_type'] == "admin"){		
				
					$con=mysqli_connect("localhost", "root", "" , "auction-online");
					$userID = $_SESSION['user_id'];
					$result = mysqli_query($con,"SELECT * FROM users WHERE user_id='$userID'");
					while($row = mysqli_fetch_array($result))
					{
						$user_name = $row['first_name'];
						$user_name .= ' '.$row['last_name'];
					}
					mysqli_close($con);
					
			?>
				<li class="nav-item">
					<a class="nav-link" href="seller-logout.php" style="color:white" >Logout</a>
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


 
<div class="container" style="margin-top:50px; margin-bottom:110px;">
	
	<div class="card">
	  <div class="card-header"  style="display:inline-block;" >
			<H5 style="text-align: center; display: inline-block;">Product-Category-Details</H5>
			<Button type="button" style="float: right;" name ="addNewProduct"  id="addNewProduct" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-plus"> Add Product-Category</i></button>
	  </div>
	  <div class="card-body">
			<div  style="display:none" class="alert alert-success" id="addSuccessDiv">
				<strong>Success!</strong> Product-Category Added successfully.
			</div>
			<div  style="display:none" class="alert alert-success" id="updateSuccessDiv">
				<strong>Success!</strong> Product-Category Updated successfully.
			</div>
			<div  style="display:none" class="alert alert-success" id="deleteSuccessDiv">
				<strong>Success!</strong> Product-Category Deleted successfully.
			</div>
			
		
			
		<div class="table-responsive">
		

			<table id="dataTable" class="table table-striped table-bordered" style="width:100%; text-align: center;">
					<thead>
						<tr>
							<th>S.no</th>
							<th style="display:none;">Product cat ID</th>
							<th>Product Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="tbodyDataTable">
						 <?php
							$con=mysqli_connect("localhost", "root", "" , "auction-online");
						
							$userID = $_SESSION['user_id'];
							$query = "SELECT * FROM product_category ORDER BY prod_cat_id DESC";
							$result = mysqli_query($con,$query);
							$counter = 1;
							while($row = mysqli_fetch_array($result))
							{
							echo "<tr>";
							echo "<td>" . $counter++ . "# </td>";
							echo "<td style='display:none;'>" . $row['prod_cat_id'] . "</td>";
							echo "<td>" . $row['prod_cat_name'] . "</td>";
							echo '<td> <div class="btn-group" role="group" >';
							echo "<button id='editTableBtn' class='btn btn-warning btn-sm'><i class='fa fa-pencil-square-o ' > Edit</i></button>";
							echo "<button id='deleteTableBtn' class='btn btn-danger btn-sm'><i class='fa fa-trash' > Delete</i></button>";
							echo "</div></td>";
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
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="POST" class="needs-validation" novalidate >
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Product-Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
			  
				<div class="form-row">
					
					<label for="uname">Product Category Name<span style="color:red;">*</span></label>
					<input type="text" class="form-control" id="prod_cat_name" name="prod_cat_name" required>							
					<input type="hidden" class="form-control" id="prod_cat_id" name="prod_cat_id" >							
				
				</div>
				
			  </div>
			  <div class="modal-footer btn-group" role="group" id="alertBtn" >
				
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
				<input type="hidden" id="prod_cat_id_hidden" name="prod_cat_id_hidden" >
			  </div>
			  <div class="modal-footer btn-group" role="group">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
				<input type="submit" id="deleteProductCat" name="deleteProductCat" class="btn btn-danger btn-sm" value="Delete Product-Category"/>
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
			if(isset($_POST['addProductCat'])){
				$product_cat_name = $_POST['prod_cat_name'];
			
				$con=mysqli_connect("localhost", "root", "" , "auction-online");
			
				$sql = "INSERT INTO product_category (prod_cat_name) VALUES ('$product_cat_name')";
				
				if ($con->query($sql) === TRUE) {
						
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
			
			
			//update Data
			if(isset($_POST['updateProductCat'])){
				$prod_cat_name = $_POST['prod_cat_name'];
				$prod_cat_id = $_POST['prod_cat_id'];
			
				$con=mysqli_connect("localhost", "root", "" , "auction-online");
				$sql = "UPDATE product_category SET prod_cat_name ='$prod_cat_name' WHERE prod_cat_id='$prod_cat_id' ";
				
				if ($con->query($sql) === TRUE) {
						
					  echo "<script type='text/javascript'>
								$(document).ready(function(){ 
									$('#updateSuccessDiv').show().delay(5000).fadeOut(); 
								});
							</script>" ;
				} else {
					echo 'Error: ' + $sql . '<br>' . $con->error;
				}
				
				$con->close();
				
			}//End Of if
			
			//Delete Data
			if(isset($_POST['deleteProductCat'])){
				$product_cat_id = $_POST['prod_cat_id_hidden'];
			
				$con=mysqli_connect("localhost", "root", "" , "auction-online");
				$sql = "DELETE FROM product_category WHERE prod_cat_id='$product_cat_id'";
			
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
			
			
			
			
			$("#addNewProduct").on('click',function(){
				$("#alertBtn").html('<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button><input type="submit" id="addProductCat" name="addProductCat" class="btn btn-success btn-sm" value="Add Product-Category"/>');
				$("#prod_cat_id").val("");
				$("#prod_cat_name").val("");
			});
			
			
			$("#tbodyDataTable").on('click','#editTableBtn',function(){
				$("#exampleModal").modal("show");
				$("#prod_cat_id").val("");
				$("#prod_cat_name").val("");
				
				var currentRow=$(this).closest("tr"); 
			
				$("#prod_cat_id").val(currentRow.find("td:eq(1)").html());
				$("#prod_cat_name").val(currentRow.find("td:eq(2)").html());
				$("#alertBtn").html('<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button><input type="submit" id="updateProductCat" name="updateProductCat" class="btn btn-success btn-sm" value="Update Product-Category"/>');
				
			}); //End of onclick
			
			$("#tbodyDataTable").on('click','#deleteTableBtn',function(){
				var currentRow=$(this).closest("tr");
				$("#prod_cat_id").val("");
				$("#prod_cat_name").val("");				
				$("#prod_cat_id_hidden").val("");				
			
				$("#prod_cat_id_hidden").val(currentRow.find("td:eq(1)").html());
				$("#deleteModal").modal("show");
				
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


