
  <main id="main">

    <!-- ======= About Section ======= -->
    <section class="about" id="about">

      <div class="container text-center">
        <h2>
          About BidBea
        </h2>

        <p>
          15% Buyer's Premium. This Auction is ONLINE ONLY. Any reserves are between the consignor & the Auctioneer. All bids are subject to consignor's approval. High bid subject to approval. The Auctioneer reserves the right to reject any bid at their sole discretion.
        </p>

        <div class="row stats-row">
		
		 <?php
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			$result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM product");
			$total_records = mysqli_fetch_array($result_count);
			$total_records = $total_records['total_records'];
			
			$bid_count = mysqli_query($con,"SELECT COUNT(*) As total_bids FROM product WHERE bid_price <= 0");
			$total_bids = mysqli_fetch_array($bid_count);
			$total_bids = $total_bids['total_bids'];
			$total_bids = $total_records-$total_bids;
			
			mysqli_close($con);
		?>
         
		  <div class="col-md-3"></div>
          <div class="stats-col text-center col-md-3">
            <div class="circle">
              <span class="stats-no" data-toggle="counter-up"><?php echo $total_records; ?></span> Total Products
            </div>
          </div>

          <div class="stats-col text-center col-md-3">
            <div class="circle">
              <span class="stats-no" data-toggle="counter-up"><?php echo $total_bids; ?></span> Total Bids
            </div>
          </div>
		  <div class="col-md-3"></div>

          
        </div>
      </div>

    </section><!-- End About Section -->

   

	
   
<section class="pt-5 pb-5" id="latest-product">
  <div class="container">
	<h2 class="text-center">
          Latest Products
        </h2>
    <div class="row">
        
        <div class="col-12 text-right">
            <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                <i class="fa fa-arrow-left"></i>
            </a>
            <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <div class="col-12">
            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">
				<?php
					$con=mysqli_connect("localhost", "root", "" , "auction-online");
					$query = "SELECT * FROM product ORDER BY lot_id DESC LIMIT 9";
					$result = mysqli_query($con,$query);
					$counter = 0;
					echo ' <div class="carousel-item active">';
						echo '<div class="row">';

						while($row = mysqli_fetch_array($result))
						{
							$counter++;
							echo '<div class="col-md-4 mb-3">';
								echo '<div class="card" style="width:350px;height:500px; ">';
									echo '<div class="card-header bg-info text-white text-center outline-info">Lot '. $row['lot_id'] .'</div>';
									echo '<div class="card-body text-center " >';
									
										echo '<div class="inner" style= "overflow :hidden;" >';
											echo '<img class="img-fluid" style="width:400px;height:200px;" src="assets/img/'. $row['lot_id'] .'_1.png">';
										echo '</div>';
									
										echo '<h4 class="card-title">'. $row['product_name'] .'</h4>';
										echo '</div>';
										echo '<span style="text-align:center; font-size:25px; font-weight:bold;" id="demo_'. $row['lot_id'] .'" ></span>';
										echo '<script>
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
									// echo '</div>';
									echo '<div class="card-footer bg-info text-white text-center outline-info">';
										echo '<a href="view-bid.php?lot_id='. $row['lot_id'] .'" class="btn btn-info stretched-link">See Describtion &rsaquo;&rsaquo;</a>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						
						
						if($counter%3 == 0){
							
								echo " </div>";
							echo " </div>";
							echo " <div class='carousel-item'>";
								echo " <div class='row'>";
						}//End of inner if
					
			
					}//End of while
						echo '</div>';
					echo '</div>';
				?>
				
                    
                    
					
                </div>
            </div>
        </div>
    </div>
</div>
</section>
    
	

 <!-- ======= Contact Section ======= -->
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="section-title">Contact Us</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-3 col-md-4">
            <div class="info">
              <div>
                <i class="fa fa-map-marker"></i>
                <p>A108 Adam Street<br>New York, NY 535022</p>
              </div>

              <div>
                <i class="fa fa-envelope"></i>
                <p>info@example.com</p>
              </div>

              <div>
                <i class="fa fa-phone"></i>
                <p>+1 5589 55488 55s</p>
              </div>

            </div>
          </div>

          <div class="col-lg-5 col-md-8">
            <div class="form">
              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validate"></div>
                </div>
                <div class="mb-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section><!-- End Contact Section -->
   

   


  </main><!-- End #main -->
  
  <style>
  .card > .inner{
	  transition : all 1.5s ease;
  }
 
  .card:hover .inner{
	 transform :scale(1.3);
  } 
  </style>
  
  
  
