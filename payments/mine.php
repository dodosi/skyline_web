<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> PayPal Smart Payment Buttons Integration | Client Demo </title>
	<script
	  src="https://code.jquery.com/jquery-3.5.1.min.js"
	  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	  crossorigin="anonymous"></script>
	</head>

<body>
    <!-- Set up a container element for the button -->
	<h4 id="label"></h4>
    <div id="paypal-button-container"></div>

    <!-- Include the PayPal JavaScript SDK -->
    <!--<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>-->
    <!--<script src="https://www.paypal.com/sdk/js?client-id=AVN3WzWJ4S7ffSWEa9bo0cYYni4lwNVzmeujoT4nRy0TqMSIrWTSiO3VZEgvQ0GaPS7sFUWzfqdCKywQ&currency=USD"></script>-->
    <script src="https://www.paypal.com/sdk/js?client-id=AQM3Z6EuqCjXxnrId2HsAINXHLdF8OUjyg_i1ZvCmBGx_e8eEeVDJ0y-z24Sg2qYP3x5t4dcOtNVngDC&currency=USD"></script>
    <script>
        // Render the PayPal button into #paypal-button-container
		const queryString = window.location.search;
		const urlParams = new URLSearchParams(queryString);
		const id = urlParams.get('id');
		const amount=urlParams.get('amount');
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value:amount
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
					saveData(details.id,id,amount,details.status);
					console.log(details.id+" "+id+" "+amount+" "+details.status);
					console.log(details);
                    //alert('Transaction completed by ' + details.payer.name.given_name + '!');
                });
            }


        }).render('#paypal-button-container');
		
		function saveData(id,trx,amount,status){
	           
	           $.ajax({
				url : 'http://skylineautoservices.co/admin/payments/pay.php?id='+id+'&status='+status+'&trx='+trx+'&amount='+amount,
				type: 'GET',
				success:function(response) {
					// button loading
					console.log(response);
					if(response=='ok'){
						 $("#label").html("Your payment was successifully processed!");
					}
				}, // /success
				error:function(ts){
					console.log(ts);
				}
			});
}
    </script>
</body>

</html>