<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		  <title>BidBea</title>
		  <link rel="icon" href="assets/img/bidbea3.png">
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
			
		  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">
		  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		  
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
		  
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
		  
		  <script src="assets/js/sweetalert2.min.js"></script>
		  <link href="assets/css/sweetalert2.min.css" rel="stylesheet">
		  
 
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
    <div class="card-header text-center"><b>Product</b></div>
    <div class="card-body">
		
		<div  style="display:none" class="alert alert-success" id="addSuccessDiv">
			<strong>Success!</strong> <span id="bidMsg"></span>
		</div>
		<div  style="display:none" class="alert alert-warning" id="bidAlertDiv">
			<strong>Alert!</strong> <span id="bidAlertMsg"></span>
		</div>
		
		

		<div class="row">
		
		
		<?php
			$con=mysqli_connect("localhost", "root", "" , "auction-online");
			if (isset($_REQUEST['lot_id'])) {
				$id = mysqli_real_escape_string($con,$_REQUEST['lot_id']);
				echo "<input type='hidden' value='$id' name='lotID' id='lotID'>";
			}else {
				header('location: index.php');
			}
			$query = "SELECT * FROM product where lot_id='$id'";
			$result = mysqli_query($con,$query);
			
			while($row = mysqli_fetch_array($result))
			{
				$prod_cat_id = $row['prod_cat_id'];
				$result2 = mysqli_query($con,"SELECT * FROM product_category WHERE prod_cat_id='$prod_cat_id'");
				$prod_cat_name = "";
				while($row2 = mysqli_fetch_array($result2))
				{
			
				$prod_cat_name = $row2['prod_cat_name'];
			
				}
			
			echo '<div class="col-md-6 my-1">';
				// echo '<div class="cours2" style="overflow:hidden;">;';
					// echo '<img class="hover" style="width:400px; height:300px; border:1px solid transparent;transition:1s;" src="assets/img/'. $row['lot_id'] .'_1.png">';
				// echo '</div>';
				
					echo '<a href="assets/img/'. $row['lot_id'] .'_1.png" class="fancybox" rel="ligthbox">';
						echo '<img style="width:400px; height:300px;"   src="assets/img/'. $row['lot_id'] .'_1.png" class="zoom img-fluid "  alt="">';  
					echo '</a>';
				
           
			echo '</div>';
			echo '<div class="col-md-6 my-1">';
				echo '<span><b>'. $row['product_name'] .'</b></span><HR>';
				echo '<span style="text-align:center; font-size:25px; font-weight:bold;" id="demo" ></span><BR><BR>';
				echo '<input type="hidden" id="end_dateHidden" value="'. $row['end_date'] .'">';
				echo '<span><u><b>Address:</b></u><BR>'. $row['address'] .'</span><BR>';
				echo '<span><u><b>Date(s):</b></u><BR>'. $row['start_date'] .' - '. $row['end_date'] .'</span><BR>';
				echo '<span><u><b>Description:</b></u><BR> '. $row['describtion'] .' </span><BR>';
				
				
				if(isset($_SESSION["user_id"])  && !empty($_SESSION['user_type'])){
					if($_SESSION['user_type'] == "buyer"){
						$price = $row['price'];
						$bidPrice = $row['bid_price'];
						
						echo '<span><u><b>Product-Price:</b></u><BR> '. $row['price'] .' $ - '.($price*0.00031).' Bitcoin </span><BR>';
						echo '<span><u><b>Highest-Bid-Price:</b></u><BR> '. $row['bid_price'] . ' $ - '.($bidPrice*0.00031).' Bitcoin </span><BR>';
						echo '<input type="hidden" id="bidPrice" value="'. $bidPrice .'">';
						echo '<input type="hidden" id="userIdHidden" value="'. $_SESSION["user_id"] .'">';
						echo '<input type="hidden" id="lotIdHidden" value="'. $row['lot_id'] .'">';
						echo '<Button class="btn btn-info btn-sm" type="button" name="bid_place" id="bid_place"  >Place your Bid hear &rsaquo;&rsaquo;</Button>';
					}
				}
			}
		
			mysqli_close($con);

	  ?>
			<div id="container" class="payBtnClass" style="display:none" ></div>
		
			
		</div>
	</div> 
  </div>
  
  
  
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
					$query = "SELECT * FROM product where prod_cat_id='$prod_cat_id' ORDER BY lot_id DESC LIMIT 9";
					$result = mysqli_query($con,$query);
					$counter = 0;
					echo ' <div class="carousel-item active">';
						echo '<div class="row">';

						while($row = mysqli_fetch_array($result))
						{
							$counter++;
							echo '<div class="col-md-4 mb-3">';
								echo '<div class="card" id="card" style="width:350px;height:500px;">';
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
    
</div>
</div>


	

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Bid-Detail</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
		  
				<div class="form-group">
					  <label for="uname">Bid Price:</label>
					  <input type="text" class="form-control" id="bid_price" name="bid_price">  
				</div>
				<div  style="display:none" class="alert alert-warning" id="bidPalceWarningDiv">
					<strong>Alert!</strong> Bid price can`t be empty!
				</div>
		  </div>
		  <div class="modal-footer btn-group" role="group">
			<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
			<button type="submit" name="placeBid" id="placeBid" class="btn btn-success btn-sm">Place Bid</button>
		  </div>
		</div>
	  </div>
	</div>




<style>
 
#card > .inner{
  transition : all 1.5s ease;
}

#card:hover .inner{
 transform :scale(1.3);
} 
  


#demo {
	height:100%;
	position:relative;
	overflow:hidden;
}


.green{
	background-color:#6fb936;
}
.thumb{
	margin-bottom: 30px;
}

.page-top{
	margin-top:85px;
}


img.zoom {
	width: 100%;
	height: 200px;
	border-radius:5px;
	object-fit:cover;
	-webkit-transition: all .3s ease-in-out;
	-moz-transition: all .3s ease-in-out;
	-o-transition: all .3s ease-in-out;
	-ms-transition: all .3s ease-in-out;
}


.transition {
	-webkit-transform: scale(1.2); 
	-moz-transform: scale(1.2);
	-o-transform: scale(1.2);
	transform: scale(1.2);
}
        

</style>
<script>
/**
 * Define the version of the Google Pay API referenced when creating your
 * configuration
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|apiVersion in PaymentDataRequest}
 */
const baseRequest = {
  apiVersion: 2,
  apiVersionMinor: 0
};

/**
 * Card networks supported by your site and your gateway
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 * @todo confirm card networks supported by your site and gateway
 */
const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];

/**
 * Card authentication methods supported by your site and your gateway
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 * @todo confirm your processor supports Android device tokens for your
 * supported card networks
 */
const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

/**
 * Identify your gateway and your site's gateway merchant identifier
 *
 * The Google Pay API response will return an encrypted payment method capable
 * of being charged by a supported gateway after payer authorization
 *
 * @todo check with your gateway on the parameters to pass
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#gateway|PaymentMethodTokenizationSpecification}
 */
const tokenizationSpecification = {
  type: 'PAYMENT_GATEWAY',
  parameters: {
    'gateway': 'example',
    'gatewayMerchantId': 'exampleGatewayMerchantId'
  }
};

/**
 * Describe your site's support for the CARD payment method and its required
 * fields
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const baseCardPaymentMethod = {
  type: 'CARD',
  parameters: {
    allowedAuthMethods: allowedCardAuthMethods,
    allowedCardNetworks: allowedCardNetworks
  }
};

/**
 * Describe your site's support for the CARD payment method including optional
 * fields
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const cardPaymentMethod = Object.assign(
  {},
  baseCardPaymentMethod,
  {
    tokenizationSpecification: tokenizationSpecification
  }
);

/**
 * An initialized google.payments.api.PaymentsClient object or null if not yet set
 *
 * @see {@link getGooglePaymentsClient}
 */
let paymentsClient = null;

/**
 * Configure your site's support for payment methods supported by the Google Pay
 * API.
 *
 * Each member of allowedPaymentMethods should contain only the required fields,
 * allowing reuse of this base request when determining a viewer's ability
 * to pay and later requesting a supported payment method
 *
 * @returns {object} Google Pay API version, payment methods supported by the site
 */
function getGoogleIsReadyToPayRequest() {
  return Object.assign(
      {},
      baseRequest,
      {
        allowedPaymentMethods: [baseCardPaymentMethod]
      }
  );
}

/**
 * Configure support for the Google Pay API
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|PaymentDataRequest}
 * @returns {object} PaymentDataRequest fields
 */
function getGooglePaymentDataRequest() {
  const paymentDataRequest = Object.assign({}, baseRequest);
  paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
  paymentDataRequest.merchantInfo = {
    // @todo a merchant ID is available for a production environment after approval by Google
    // See {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
    // merchantId: '12345678901234567890',
    merchantName: 'Example Merchant'
  };

  paymentDataRequest.callbackIntents = ["PAYMENT_AUTHORIZATION"];

  return paymentDataRequest;
}

/**
 * Return an active PaymentsClient or initialize
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/client#PaymentsClient|PaymentsClient constructor}
 * @returns {google.payments.api.PaymentsClient} Google Pay API client
 */
function getGooglePaymentsClient() {
  if ( paymentsClient === null ) {
    paymentsClient = new google.payments.api.PaymentsClient({
        environment: 'TEST',
      paymentDataCallbacks: {
        onPaymentAuthorized: onPaymentAuthorized
      }
    });
  }
  return paymentsClient;
}

/**
 * Handles authorize payments callback intents.
 *
 * @param {object} paymentData response from Google Pay API after a payer approves payment through user gesture.
 * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData object reference}
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentAuthorizationResult}
 * @returns Promise<{object}> Promise of PaymentAuthorizationResult object to acknowledge the payment authorization status.
 */
function onPaymentAuthorized(paymentData) {
        return new Promise(function(resolve, reject){
    // handle the response
    processPayment(paymentData)
    .then(function() {
      resolve({transactionState: 'SUCCESS'});
	  deleteProduct();
    })
    .catch(function() {
      resolve({
        transactionState: 'ERROR',
        error: {
          intent: 'PAYMENT_AUTHORIZATION',
          message: 'Insufficient funds',
          reason: 'PAYMENT_DATA_INVALID'
        }
      });
        });
  });
}

/**
 * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
 *
 * Display a Google Pay payment button after confirmation of the viewer's
 * ability to pay.
 */
function onGooglePayLoaded() {
  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
      .then(function(response) {
        if (response.result) {
          addGooglePayButton();
		  	
        }
      })
      .catch(function(err) {
        // show error in developer console for debugging
        console.error(err);
      });
}

/**
 * Add a Google Pay purchase button alongside an existing checkout button
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ButtonOptions|Button options}
 * @see {@link https://developers.google.com/pay/api/web/guides/brand-guidelines|Google Pay brand guidelines}
 */
function addGooglePayButton() {
  const paymentsClient = getGooglePaymentsClient();
  const button =
      paymentsClient.createButton({onClick: onGooglePaymentButtonClicked});
  document.getElementById('container').appendChild(button);
  
}

/**
 * Provide Google Pay API with a payment amount, currency, and amount status
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
 * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
 */
function getGoogleTransactionInfo() {
	var bidPrice = $("#bidPrice").val();
  return {
        displayItems: [
        {
          label: "Subtotal",
          type: "SUBTOTAL",
          price: "11.00",
        },
      {
          label: "Tax",
          type: "TAX",
          price: "1.00",
        }
    ],
    countryCode: 'US',
    currencyCode: "USD",
    totalPriceStatus: "FINAL",
    totalPrice: bidPrice,
    totalPriceLabel: "Total"
  };
}

/**
 * Show Google Pay payment sheet when Google Pay payment button is clicked
 */
function onGooglePaymentButtonClicked() {
  const paymentDataRequest = getGooglePaymentDataRequest();
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.loadPaymentData(paymentDataRequest);
}

/**
 * Process payment data returned by the Google Pay API
 *
 * @param {object} paymentData response from Google Pay API after user approves payment
 * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData|PaymentData object reference}
 */
function processPayment(paymentData) {
        return new Promise(function(resolve, reject) {
        setTimeout(function() {
                // @todo pass payment token to your gateway to process payment
                paymentToken = paymentData.paymentMethodData.tokenizationData.token;

        resolve({});
    }, 3000);
  });
}

		var Toast = Swal.mixin({
			  toast: true,
			  position: 'top-end',
			  showConfirmButton: false,
			  timer: 10000
			});

		function deleteProduct(){
				
				var lot_id = $("#lotIdHidden").val();
				var deleteProduct = "deleteProduct";
				$.ajax({
					url : "user_ajax.php",
					type:"POST",
					data: { 'action': deleteProduct,'lot_id':lot_id},
					success: function (data) {
						if(data.trim().includes("success")){
							var product_name = data.trim().split(":")[1];
							var bid_price = data.trim().split(":")[2];
							  Toast.fire({
								icon: 'success',
								title: "Thank You..\n your payment has been received\n product: "+product_name+" \nBid-Price: "+bid_price+" $"
							  })
		
						}				
					}
				});
			}


</script>
<script async
  src="https://pay.google.com/gp/p/js/pay.js"
  onload="onGooglePayLoaded()"></script>

<script>
		$(document).ready(function(){
			
			BidTimer();
			
		
			
			var Toast = Swal.mixin({
			  toast: true,
			  position: 'top-end',
			  showConfirmButton: false,
			  timer: 10000
			});

			
			
			//images... 
			 $(".fancybox").fancybox({ 
				 openEffect: "none", 
				 closeEffect: "none" 
			 }); 

			 $(".zoom").hover(function(){ 
				 $(this).addClass('transition'); 
			 }, function(){ 
				 $(this).removeClass('transition'); 
			 }); 
					 
			$('.dropdown-toggle').dropdown();
			
			 
			
			$("#placeBid").on('click',function(){
				var bid_price = $("#bid_price").val();
				var lot_id = $("#lotID").val();
				var placeBid = "placeBid";
				if(bid_price != ""){
					$("#exampleModal").modal("hide");	
					$.ajax({
						url : "user_ajax.php",
						type:"POST",
						data: { 'action': placeBid,'bid_price':bid_price,'lot_id':lot_id},
						success: function (data) {
							if(data.trim().includes("success")){
								$('#bidMsg').text('Your Bid has been placed for '+bid_price+' $');
								$('#addSuccessDiv').show().delay(5000).fadeOut();
							}
							else{
								$("#bidAlertMsg").text(data.trim());
								$("#bidAlertDiv").show().delay(5000).fadeOut();
							}						
						}
					});
				}else{
					$('#bidPalceWarningDiv').show().delay(5000).fadeOut();
				}
				
				
			});
			
			$("#bid_place").on('click',function(){
				$("#exampleModal").modal("show");		
			});
			

		    var timer = null;
			interval = 1000;

			if (timer !== null) return;
			timer = setInterval(function() {
				var user_id = $("#userIdHidden").val();
				var lot_id = $("#lotIdHidden").val();
				var buyProduct = "buyProduct";
				$.ajax({
					url : "user_ajax.php",
					type:"POST",
					data: { 'action': buyProduct,'user_id':user_id,'lot_id':lot_id},
					success: function (data) {
						
						if(data.trim().includes("success")){
							var product_name = data.trim().split(":")[1];
							var bid_price = data.trim().split(":")[2];
							clearInterval(timer);
							timer = null;
							
							  Toast.fire({
								icon: 'success',
								title: "You win the bid\n product: "+product_name+"\nBid-Price: "+bid_price+" $"
							  })
							
							$("#bid_place").css("display","none");
							$(".payBtnClass").css("display","");
							
						}
											
					}
				});
			}, interval);
			
			

			
			function BidTimer(){
				
				// Set the date we're counting down to
				var countDownDate = new Date($("#end_dateHidden").val()).getTime();
				// var countDownDate = new Date("July 15, 2021 12:15:25").getTime();

				// Update the count down every 1 second
				var x = setInterval(function() {

				  // Get today's date and time
				  var now = new Date().getTime();

				  // Find the distance between now and the count down date
				  var distance = countDownDate - now;

				  // Time calculations for days, hours, minutes and seconds
				  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

				  // Display the result in the element with id="demo"
				  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
				  + minutes + "m " + seconds + "s ";

				  // If the count down is finished, write some text
				  if (distance < 0) {
					clearInterval(x);
					document.getElementById("demo").innerHTML = "BID TIME OVER";
					$("#bid_place").css("display","none");
				  }
				}, 1000);
							
			}//End of function timmer
				
			
			
		
		});
		
		
			
	</script>
	
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


</body>
</html>


