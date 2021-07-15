<?php
	session_start();
	
	if (isset($_POST['action']) ) {
		
		if($_POST['action'] == "getAllProducts"){
		
			$data = "";
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			
			
			if (isset($_POST['page_no']) && $_POST['page_no']!="") {
				$page_no = $_POST['page_no'];
			} else {
				$page_no = 1;
			}
			$total_records_per_page = 3;
			$offset = ($page_no-1) * $total_records_per_page;
			$previous_page = $page_no - 1;
			$next_page = $page_no + 1;
			
			$result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM product");
			$total_records = mysqli_fetch_array($result_count);
			$total_records = $total_records['total_records'];
			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1; // total pages minus 1
			
		
			
		
			
			$data .= '<div class="row">';
				$data .= '<div class="col-md-3 my-1">';
					
					$data .= '<div class="input-group mb-3">';
					  $data .= '<input type="text" id="searchValue" name="searchValue" class="form-control" placeholder="Search..">';
					  $data .= '<div class="input-group-append">';
						$data .= '<button id="searchBtn" name="searchBtn" class="btn btn-success" type="button">Search</button>';
					  $data .= '</div>';
					$data .= '</div>';
				 $data .= '</div>';
				 $data .= '<div class="col-md-3 my-1">';
					$data .= '<select class="form-control" id="priceSort">';
						$data .= '<option disabled selected>Lot #</option>';
						$data .= '<option value="high">Bid (High to Low)</option>';
						$data .= '<option value="low" >Bid (Low to High)</option>';
					$data .= '</select>';
				$data .= '</div>';
				
				 $data .= '<div class="col-md-3 my-1">';
					$data .= '<select class="form-control"  id="prod_cat_id" name="prod_cat_id">';
						$data .= '<option disabled selected>---Product-Category---.</option>';
							$query = "SELECT * FROM product_category ";
							$result = mysqli_query($con,$query);
							$counter = 1;
							while($row = mysqli_fetch_array($result))
							{
						
							$data .= '<option value="'. $row['prod_cat_id'] . '" >'. $row['prod_cat_name'] . '</option>';
						
							}
					$data .= '</select>';
				$data .= '</div>';
				
				$data .= '<div class="col-md-3 my-1">';
				  $data .= '<ul class="pagination"  style="float:right;">';
					
					$data .= '<li ';
					if($page_no > 1){
						$data .= 'class="page-item"';
					}
					$data .= '>';
					
						$data .= '<a class="page-link" ';
							if($page_no > 1){ 
								$data .= 'href="?page_no='.$previous_page.'"';
							}
							$data .= '>Previous</a>';
					$data .= '</li>';
					
					
					for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
						if ($counter == $page_no) {
							$data .= "<li class=' page-item active'><a class='page-link' >$counter</a></li>";
						}else{
							$data .= "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
						}
						
					}
					
					$data .= '<li class="page-item"';
						if($page_no >= $total_no_of_pages){ 
							$data .= 'class="page-link disabled"';
						}
					$data .= '>';
							
							$data .= '<a class="page-link"';
								if($page_no < $total_no_of_pages) {
									$data .= 'href="?page_no='.$next_page.';"';
								}
								$data .= '>Next</a>';
					$data .= '</li>';
					
				  $data .= '</ul>';
				  
				$data .= '</div>';
				
			$data .= '</div>';
			
		
			$result = mysqli_query($con,"SELECT * FROM product LIMIT $offset, $total_records_per_page");
			$data .= '<div class="row">';

			while($row = mysqli_fetch_array($result))
			{
				$data .= '<div class="col-md-4 mb-3">';
					$data .= '<div class="card" id="card"  style="width:350px;height:500px;">';
						$data .= '<div class="card-header bg-info text-white text-center outline-info">Lot '. $row['lot_id'] .'</div>';
						$data .= '<div class="card-body text-center">';
							$data .= '<div class="inner" style= "overflow :hidden;" >';
								$data .= '<img class="img-fluid" style="width:400px; height:200px" src="assets/img/'. $row['lot_id'] .'_1.png">';
							$data .= '</div>';
							$data .= '<h4 class="card-title">'. $row['product_name'] .'</h4>';
						$data .= '</div>';
						$data .= '<span style="text-align:center; font-size:25px; font-weight:bold;" id="demo_'. $row['lot_id'] .'" ></span>';
						$data .= '<script>
									$(document).ready(function(){
										
										  var countDownDate = new Date("'. $row['end_date'] .'").getTime();

										  var x = setInterval(function() {

										  var now = new Date().getTime();
										
										  var distance = countDownDate - now;

										  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
										  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
										  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
										  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
									 
										  document.getElementById("demo_'. $row['lot_id'] .'").innerHTML = days + "d " + hours + "h "
										  + minutes + "m " + seconds + "s ";

										  if (distance < 0) {
											clearInterval(x);
											document.getElementById("demo_'. $row['lot_id'] .'").innerHTML = "BID TIME OVER";
											
										  }
										}, 1000);
														
									});
								</script>';
						
						
						$data .= '<div class="card-footer bg-info text-white text-center outline-info">';
							$data .= '<a href="view-bid.php?lot_id='. $row['lot_id'] .'" class="btn btn-info stretched-link">See Describtion &rsaquo;&rsaquo;</a>';
						$data .= '</div>';
					$data .= '</div>';
				$data .= '</div>';
			}
			$data .= '</div>';
			
			mysqli_close($con);
			

			echo $data;
		}
		

		/////////////////////////////////////-----getProductsByPrice------///////////////////////////////////////////////
		
		if($_POST['action'] == "getProductsByPrice"){
			$data = "";
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			
			
			if (isset($_POST['page_no']) && $_POST['page_no']!="") {
				$page_no = $_POST['page_no'];
			} else {
				$page_no = 1;
			}
			$total_records_per_page = 3;
			$offset = ($page_no-1) * $total_records_per_page;
			$previous_page = $page_no - 1;
			$next_page = $page_no + 1;
			
			$result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM product");
			$total_records = mysqli_fetch_array($result_count);
			$total_records = $total_records['total_records'];
			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1; // total pages minus 1
			
		
			
		
			
			$data .= '<div class="row">';
				$data .= '<div class="col-md-3 my-1">';
					
					$data .= '<div class="input-group mb-3">';
					  $data .= '<input type="text" id="searchValue" name="searchValue" class="form-control" placeholder="Search..">';
					  $data .= '<div class="input-group-append">';
						$data .= '<button id="searchBtn" name="searchBtn" class="btn btn-success" type="button">Search</button>';
					  $data .= '</div>';
					$data .= '</div>';
				 $data .= '</div>';
				 $data .= '<div class="col-md-3 my-1">';
					$data .= '<select style="display:inline-block;" class="form-control" id="priceSort">';
						$data .= '<option disabled selected>Lot #</option>';
						$data .= '<option value="high">Bid (High to Low)</option>';
						$data .= '<option value="low" >Bid (Low to High)</option>';
					$data .= '</select>';
				$data .= '</div>';
				
				 $data .= '<div class="col-md-3 my-1">';
					$data .= '<select class="form-control"  id="prod_cat_id" name="prod_cat_id">';
							$data .= '<option disabled selected>---Product-Category---.</option>';
							$query = "SELECT * FROM product_category ";
							$result = mysqli_query($con,$query);
							$counter = 1;
							while($row = mysqli_fetch_array($result))
							{
						
							$data .= '<option value="'. $row['prod_cat_id'] . '" >'. $row['prod_cat_name'] . '</option>';
						
							}
					$data .= '</select>';
				$data .= '</div>';
				
				$data .= '<div class="col-md-3 my-1">';
				  $data .= '<ul class="pagination"  style="float:right;">';
					
					$data .= '<li ';
					if($page_no > 1){
						$data .= 'class="page-item"';
					}
					$data .= '>';
					
						$data .= '<a class="page-link" ';
							if($page_no > 1){ 
								$data .= 'href="?page_no='.$previous_page.'"';
							}
							$data .= '>Previous</a>';
					$data .= '</li>';
					
					
					for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
						if ($counter == $page_no) {
							$data .= "<li class=' page-item active'><a class='page-link' >$counter</a></li>";
						}else{
							$data .= "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
						}
						
					}
					
					$data .= '<li class="page-item"';
						if($page_no >= $total_no_of_pages){ 
							$data .= 'class="page-link disabled"';
						}
					$data .= '>';
							
							$data .= '<a class="page-link"';
								if($page_no < $total_no_of_pages) {
									$data .= 'href="?page_no='.$next_page.';"';
								}
								$data .= '>Next</a>';
					$data .= '</li>';
					
				  $data .= '</ul>';
				  
				$data .= '</div>';
				
			$data .= '</div>';
			
			if (isset($_POST['priceRange']) && $_POST['priceRange']!="") {
				$price_range = $_POST['priceRange'];
			}
			
		
			if($price_range == 'low')
				$result = mysqli_query($con,"SELECT * FROM product ORDER BY price DESC LIMIT $offset, $total_records_per_page");
			
			if($price_range == 'high')
				$result = mysqli_query($con,"SELECT * FROM product ORDER BY price ASC LIMIT $offset, $total_records_per_page");
			
			$data .= '<div class="row">';

			while($row = mysqli_fetch_array($result))
			{
				$data .= '<div class="col-md-4 mb-3">';
					$data .= '<div class="card" id="card"  style="width:350px;height:500px;">';
						$data .= '<div class="card-header bg-info text-white text-center outline-info">Lot '. $row['lot_id'] .'</div>';
						$data .= '<div class="card-body text-center">';
							$data .= '<div class="inner" style= "overflow :hidden;" >';
								$data .= '<img class="img-fluid" style="width:400px; height:200px" src="assets/img/'. $row['lot_id'] .'_1.png">';
							$data .= '</div>';
							$data .= '<h4 class="card-title">'. $row['product_name'] .'</h4>';
					
						$data .= '</div>';
						$data .= '<span style="text-align:center; font-size:25px; font-weight:bold;" id="demo_'. $row['lot_id'] .'" ></span>';
						$data .= '<script>
									$(document).ready(function(){
										
										  var countDownDate = new Date("'. $row['end_date'] .'").getTime();

										  var x = setInterval(function() {

										  var now = new Date().getTime();
										
										  var distance = countDownDate - now;

										  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
										  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
										  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
										  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
									 
										  document.getElementById("demo_'. $row['lot_id'] .'").innerHTML = days + "d " + hours + "h "
										  + minutes + "m " + seconds + "s ";

										  if (distance < 0) {
											clearInterval(x);
											document.getElementById("demo_'. $row['lot_id'] .'").innerHTML = "BID TIME OVER";
											
										  }
										}, 1000);
														
									});
								</script>';
						
						$data .= '<div class="card-footer bg-info text-white text-center outline-info">';
							$data .= '<a href="view-bid.php?lot_id='. $row['lot_id'] .'" class="btn btn-info stretched-link">See Describtion &rsaquo;&rsaquo;</a>';
						$data .= '</div>';
					$data .= '</div>';
				$data .= '</div>';
			}
			$data .= '</div>';
			
			mysqli_close($con);
			

			echo $data;
			
		}
		
		//////////////////////////////////////----getProductsBySearchValue-----//////////////////////////////////////////////
		
		
		if($_POST['action'] == "getProductsBySearchValue"){
			$data = "";
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			
			
			if (isset($_POST['page_no']) && $_POST['page_no']!="") {
				$page_no = $_POST['page_no'];
			} else {
				$page_no = 1;
			}
			$total_records_per_page = 3;
			$offset = ($page_no-1) * $total_records_per_page;
			$previous_page = $page_no - 1;
			$next_page = $page_no + 1;
			
			$result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM product");
			$total_records = mysqli_fetch_array($result_count);
			$total_records = $total_records['total_records'];
			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1; // total pages minus 1
			
		
			
		
			
			$data .= '<div class="row">';
				$data .= '<div class="col-md-3 my-1">';
					
					$data .= '<div class="input-group mb-3">';
					  $data .= '<input type="text" id="searchValue" name="searchValue" class="form-control" placeholder="Search..">';
					  $data .= '<div class="input-group-append">';
						$data .= '<button id="searchBtn" name="searchBtn" class="btn btn-success" type="button">Search</button>';
					  $data .= '</div>';
					$data .= '</div>';
				 $data .= '</div>';
				 $data .= '<div class="col-md-3 my-1">';
					$data .= '<select style="display:inline-block;" class="form-control" id="priceSort">';
						$data .= '<option disabled selected>Lot #</option>';
						$data .= '<option value="high">Bid (High to Low)</option>';
						$data .= '<option value="low" >Bid (Low to High)</option>';
					$data .= '</select>';
				$data .= '</div>';
				
				 $data .= '<div class="col-md-3 my-1">';
					$data .= '<select class="form-control"  id="prod_cat_id" name="prod_cat_id">';
						$data .= '<option disabled selected>---Product-Category---.</option>';
							$query = "SELECT * FROM product_category ";
							$result = mysqli_query($con,$query);
							$counter = 1;
							while($row = mysqli_fetch_array($result))
							{
						
							$data .= '<option value="'. $row['prod_cat_id'] . '" >'. $row['prod_cat_name'] . '</option>';
						
							}
					$data .= '</select>';
				$data .= '</div>';
				
				$data .= '<div class="col-md-3 my-1">';
				  $data .= '<ul class="pagination"  style="float:right;">';
					
					$data .= '<li ';
					if($page_no > 1){
						$data .= 'class="page-item"';
					}
					$data .= '>';
					
						$data .= '<a class="page-link" ';
							if($page_no > 1){ 
								$data .= 'href="?page_no='.$previous_page.'"';
							}
							$data .= '>Previous</a>';
					$data .= '</li>';
					
					
					for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
						if ($counter == $page_no) {
							$data .= "<li class=' page-item active'><a class='page-link' >$counter</a></li>";
						}else{
							$data .= "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
						}
						
					}
					
					$data .= '<li class="page-item"';
						if($page_no >= $total_no_of_pages){ 
							$data .= 'class="page-link disabled"';
						}
					$data .= '>';
							
							$data .= '<a class="page-link"';
								if($page_no < $total_no_of_pages) {
									$data .= 'href="?page_no='.$next_page.';"';
								}
								$data .= '>Next</a>';
					$data .= '</li>';
					
				  $data .= '</ul>';
				  
				$data .= '</div>';
				
			$data .= '</div>';
			
			if (isset($_POST['searchValue']) && $_POST['searchValue']!="") {
				$searchValue = $_POST['searchValue'];
			}
			
			if(is_numeric($searchValue))
				$result = mysqli_query($con,"SELECT * FROM product WHERE price = '$searchValue'  LIMIT $offset, $total_records_per_page");
			else
				$result = mysqli_query($con,"SELECT * FROM product WHERE product_name like '$searchValue %'  LIMIT $offset, $total_records_per_page");
			
			$data .= '<div class="row">';
			$row = mysqli_num_rows($result); 
			if($row > 0){
				while($row = mysqli_fetch_array($result))
				{
					$data .= '<div class="col-md-4 mb-3">';
						$data .= '<div class="card" id="card"  style="width:350px;height:500px;">';
							$data .= '<div class="card-header bg-info text-white text-center outline-info">Lot '. $row['lot_id'] .'</div>';
							$data .= '<div class="card-body text-center">';
								$data .= '<div class="inner" style= "overflow :hidden;" >';
									$data .= '<img class="img-fluid" style="width:400px; height:200px" src="assets/img/'. $row['lot_id'] .'_1.png">';
								$data .= '</div>';
								$data .= '<h4 class="card-title">'. $row['product_name'] .'</h4>';
							$data .= '</div>';
							$data .= '<span style="text-align:center; font-size:25px; font-weight:bold;" id="demo_'. $row['lot_id'] .'" ></span>';
							$data .= '<script>
										$(document).ready(function(){
											
											  var countDownDate = new Date("'. $row['end_date'] .'").getTime();

											  var x = setInterval(function() {

											  var now = new Date().getTime();
											
											  var distance = countDownDate - now;

											  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
											  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
											  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
											  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
										 
											  document.getElementById("demo_'. $row['lot_id'] .'").innerHTML = days + "d " + hours + "h "
											  + minutes + "m " + seconds + "s ";

											  if (distance < 0) {
												clearInterval(x);
												document.getElementById("demo_'. $row['lot_id'] .'").innerHTML = "BID TIME OVER";
												
											  }
											}, 1000);
															
										});
									</script>';
							$data .= '<div class="card-footer bg-info text-white text-center outline-info">';
								$data .= '<a href="view-bid.php?lot_id='. $row['lot_id'] .'" class="btn btn-info stretched-link">See Describtion &rsaquo;&rsaquo;</a>';
							$data .= '</div>';
						$data .= '</div>';
					$data .= '</div>';
				}
				
			}else{
				$data .= '<span style="display:none;">not-available</span>';
			}
			$data .= '</div>';
			
			mysqli_close($con);
			

			echo $data;
			
		}
		
		
		//////////////////////////////////////----getProductsBySearchCategory-----//////////////////////////////////////////////
		
		
		if($_POST['action'] == "getProductsByCategory"){
			$data = "";
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			
			
			if (isset($_POST['page_no']) && $_POST['page_no']!="") {
				$page_no = $_POST['page_no'];
			} else {
				$page_no = 1;
			}
			$total_records_per_page = 3;
			$offset = ($page_no-1) * $total_records_per_page;
			$previous_page = $page_no - 1;
			$next_page = $page_no + 1;
			
			$result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM product");
			$total_records = mysqli_fetch_array($result_count);
			$total_records = $total_records['total_records'];
			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1; // total pages minus 1
			
		
			
		
			
			$data .= '<div class="row">';
				$data .= '<div class="col-md-3 my-1">';
					
					$data .= '<div class="input-group mb-3">';
					  $data .= '<input type="text" id="searchValue" name="searchValue" class="form-control" placeholder="Search..">';
					  $data .= '<div class="input-group-append">';
						$data .= '<button id="searchBtn" name="searchBtn" class="btn btn-success" type="button">Search</button>';
					  $data .= '</div>';
					$data .= '</div>';
				 $data .= '</div>';
				 $data .= '<div class="col-md-3 my-1">';
					$data .= '<select style="display:inline-block;" class="form-control" id="priceSort">';
						$data .= '<option disabled selected>Lot #</option>';
						$data .= '<option value="high">Bid (High to Low)</option>';
						$data .= '<option value="low" >Bid (Low to High)</option>';
					$data .= '</select>';
				$data .= '</div>';
				
				 $data .= '<div class="col-md-3 my-1">';
					$data .= '<select class="form-control"  id="prod_cat_id" name="prod_cat_id">';
						$data .= '<option disabled selected>---Product-Category---.</option>';
							$query = "SELECT * FROM product_category ";
							$result = mysqli_query($con,$query);
							$counter = 1;
							while($row = mysqli_fetch_array($result))
							{
						
							$data .= '<option value="'. $row['prod_cat_id'] . '" >'. $row['prod_cat_name'] . '</option>';
						
							}
					$data .= '</select>';
				$data .= '</div>';
				
				$data .= '<div class="col-md-3 my-1">';
				  $data .= '<ul class="pagination"  style="float:right;">';
					
					$data .= '<li ';
					if($page_no > 1){
						$data .= 'class="page-item"';
					}
					$data .= '>';
					
						$data .= '<a class="page-link" ';
							if($page_no > 1){ 
								$data .= 'href="?page_no='.$previous_page.'"';
							}
							$data .= '>Previous</a>';
					$data .= '</li>';
					
					
					for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
						if ($counter == $page_no) {
							$data .= "<li class=' page-item active'><a class='page-link' >$counter</a></li>";
						}else{
							$data .= "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
						}
						
					}
					
					$data .= '<li class="page-item"';
						if($page_no >= $total_no_of_pages){ 
							$data .= 'class="page-link disabled"';
						}
					$data .= '>';
							
							$data .= '<a class="page-link"';
								if($page_no < $total_no_of_pages) {
									$data .= 'href="?page_no='.$next_page.';"';
								}
								$data .= '>Next</a>';
					$data .= '</li>';
					
				  $data .= '</ul>';
				  
				$data .= '</div>';
				
			$data .= '</div>';
			
			if (isset($_POST['prod_cat_id']) && $_POST['prod_cat_id']!="") {
				$prod_cat_id = $_POST['prod_cat_id'];
			}
			
			
		     $result = mysqli_query($con,"SELECT * FROM product WHERE prod_cat_id = '$prod_cat_id'  LIMIT $offset, $total_records_per_page");
			
			$data .= '<div class="row">';
			$row = mysqli_num_rows($result); 
			if($row > 0){
				while($row = mysqli_fetch_array($result))
				{
					$data .= '<div class="col-md-4 mb-3">';
						$data .= '<div class="card" id="card"  style="width:350px;height:500px;">';
							$data .= '<div class="card-header bg-info text-white text-center outline-info">Lot '. $row['lot_id'] .'</div>';
							$data .= '<div class="card-body text-center">';
								$data .= '<div class="inner" style= "overflow :hidden;" >';
									$data .= '<img class="img-fluid" style="width:400px; height:200px" src="assets/img/'. $row['lot_id'] .'_1.png">';
								$data .= '</div>';
								$data .= '<h4 class="card-title">'. $row['product_name'] .'</h4>';
							$data .= '</div>';
							$data .= '<span style="text-align:center; font-size:25px; font-weight:bold;" id="demo_'. $row['lot_id'] .'" ></span>';
							$data .= '<script>
										$(document).ready(function(){
											
											  var countDownDate = new Date("'. $row['end_date'] .'").getTime();

											  var x = setInterval(function() {

											  var now = new Date().getTime();
											
											  var distance = countDownDate - now;

											  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
											  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
											  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
											  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
										 
											  document.getElementById("demo_'. $row['lot_id'] .'").innerHTML = days + "d " + hours + "h "
											  + minutes + "m " + seconds + "s ";

											  if (distance < 0) {
												clearInterval(x);
												document.getElementById("demo_'. $row['lot_id'] .'").innerHTML = "BID TIME OVER";
												
											  }
											}, 1000);
															
										});
									</script>';
							$data .= '<div class="card-footer bg-info text-white text-center outline-info">';
								$data .= '<a href="view-bid.php?lot_id='. $row['lot_id'] .'" class="btn btn-info stretched-link">See Describtion &rsaquo;&rsaquo;</a>';
							$data .= '</div>';
						$data .= '</div>';
					$data .= '</div>';
				}
				
			}else{
				$data .= '<span style="display:none;">not-available</span>';
			}
			$data .= '</div>';
			
			mysqli_close($con);
			

			echo $data;
			
		}
		
		////////////////////////////////////////////////////////////////////////////////////
		
		if($_POST['action'] == "placeBid"){
			if (isset($_POST['bid_price']) && $_POST['bid_price']!="") {
				$bid_price = $_POST['bid_price'];
			}
			if (isset($_POST['lot_id']) && $_POST['lot_id']!="") {
				$lot_id = $_POST['lot_id'];
			}
			$user_id = $_SESSION['user_id'];
		
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			
			$result = mysqli_query($con,"SELECT * FROM product WHERE lot_id='$lot_id' AND bid_place_user='$user_id'");
			$row = mysqli_num_rows($result); 
			if($row > 0){
				while($row = mysqli_fetch_array($result)){
					$insertedBidPrice = $row['bid_price'];
				}
				if($bid_price > $insertedBidPrice){
					$sql = "UPDATE product SET bid_price='$bid_price' WHERE lot_id='$lot_id' AND bid_place_user='$user_id'";
					if ($con->query($sql) === TRUE) {
						  echo "success" ;
					} else {
						echo "Error: ' . $sql . '<br>' . $con->error" ;
					}
				}
				else{
					echo "Sorry! You already place your $insertedBidPrice $ bid you should increase amount to place bid THANKS.";
				}
				
				
			}else{
				
				$result2 = mysqli_query($con,"SELECT * FROM product WHERE lot_id='$lot_id'");
				$row2 = mysqli_num_rows($result2); 
				
				while($row2 = mysqli_fetch_array($result2)){
					$insertedBidPricee = $row2['bid_price'];
				}
				if($bid_price > $insertedBidPricee){
					$sql = "UPDATE product SET bid_price='$bid_price' , bid_place_user='$user_id' WHERE lot_id='$lot_id' ";
					if ($con->query($sql) === TRUE) {
						  echo "success" ;
					} else {
						echo "Error: ' . $sql . '<br>' . $con->error" ;
					}
				}
				else{
					echo "Sorry! already $insertedBidPricee $ bid placed by other Customer you should increase amount to place bid THANKS.";
				}
			
				
			}
			
			
			$con->close();
			
		}
		
		
		//////////////////////////////////////////////////////////////////////////
		if($_POST['action'] == "makeProductSaleable"){
			if (isset($_POST['lot_id']) && $_POST['lot_id']!="") {
				$lot_id = $_POST['lot_id'];
			}
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			$sql = "UPDATE product SET is_availabe='yes' WHERE lot_id='$lot_id' ";
			if ($con->query($sql) === TRUE) {
				  echo "success" ;
			} else {
				echo "Error: ' . $sql . '<br>' . $con->error" ;
			}
				
		}
		
		
		//////////////////////////////////////////////////////////////////////////
		if($_POST['action'] == "buyProduct"){
			if (isset($_POST['lot_id']) && $_POST['lot_id']!="") {
				$lot_id = $_POST['lot_id'];
			}
			if (isset($_POST['user_id']) && $_POST['user_id']!="") {
				$user_id = $_POST['user_id'];
			}
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			$result = mysqli_query($con,"SELECT * FROM product WHERE lot_id='$lot_id' AND bid_place_user='$user_id'");
			$row = mysqli_num_rows($result); 
			if($row > 0){
				while($row = mysqli_fetch_array($result)){
					$is_availabe = $row['is_availabe'];
					$product_name = $row['product_name'];
					$bid_price = $row['bid_price'];
				}
				if($is_availabe == 'yes'){
					echo "success:$product_name : $bid_price" ;
					
				}
			}
				
		}
		
		
		//////////////////////////////////////////////////////////////////////////
		if($_POST['action'] == "deleteProduct"){
			if (isset($_POST['lot_id']) && $_POST['lot_id']!="") {
				$lot_id = $_POST['lot_id'];
			}
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			
			
			$result = mysqli_query($con,"SELECT * FROM product WHERE lot_id='$lot_id'");
			$row = mysqli_num_rows($result); 
			if($row > 0){
				while($row = mysqli_fetch_array($result)){
					$product_name = $row['product_name'];
					$bid_price = $row['bid_price'];
				}
				$sql = "DELETE FROM product WHERE lot_id='$lot_id' ";
				if ($con->query($sql) === TRUE) {
					  echo "success:$product_name : $bid_price" ;
				} else {
					echo "Error: ' . $sql . '<br>' . $con->error" ;
				}
			}
				
		}
		
		//////////////////////////////////////////////////////////////////////////
		if($_POST['action'] == "forgotPassword"){
			
			require_once('assets/lib/class.phpmailer.php');
			
			if (isset($_POST['email']) && $_POST['email']!="") {
				$email = $_POST['email'];
			}
			if (isset($_POST['password']) && $_POST['password']!="") {
				$encryptPassword = $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
			}
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			
			
			$home_page = "http://localhost/project/online-auction/";
			$subject= 'Wellcome to Online Auction BidBea (BID.WIN.SAVE.REPEAT)';
			$body = '
			<p>Your Password has been recoverd.</p>
			<p>This is a Verification eMail, This is your new password , '.$_POST['password'].' please login BidBea account by clicking this <a href="'.$home_page.'login.php" target="_blank"><b>link</b></a>.</p>
			<p>In case if you have any difficulty please eMail us.</p>
			<p>Thank you,</p>
			<p>BidBea (BID.WIN.SAVE.REPEAT)</p>
			';
			
			$sql = "UPDATE users SET password='$encryptPassword' WHERE email='$email' ";
			if ($con->query($sql) === TRUE) {
				$mail = new PHPMailer(); // create a new object
					$mail->IsSMTP(); // enable SMTP
					$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
					$mail->SMTPAuth = true; // authentication enabled
					$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
					$mail->Host = "smtp.gmail.com";
					$mail->Port = 587; // or 465
					$mail->IsHTML(true);
					$mail->Username = "";
					$mail->Password = "";
					$mail->SetFrom("bidbea@gmail.com");
					$mail->Subject = $subject;
					$mail->Body = $body;
					$mail->AddAddress($email);

					if (!$mail->send()) {
						echo "Mailer Error: " . $mail->ErrorInfo;
					}
					else {
						 echo "success" ;
					}
				 
			} else {
				echo "Error: ' . $sql . '<br>' . $con->error" ;
			}
				
		}
		
		
		
		
	}//End of if
	
	
	
	
	
?>