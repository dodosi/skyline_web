<?php 
		require_once "php_action/db_connect.php"; 
		if(!empty($_GET["invoice_id"])) {
		$query = "UPDATE invoice_order set state = '2' WHERE order_id='" . $_GET["invoice_id"]. "'";
		$result = $connect->query($query);
			if(!empty($result)) {
				$qe = "SELECT bookingID FROM invoice_order WHERE order_id ='" . $_GET["invoice_id"]. "'";
				$re = $connect->query($qe);
				$rowsd = $re->fetch_assoc();
				
				$query1 = "UPDATE booking set status = 7 WHERE id='" . $rowsd["bookingID"]. "'";
				$connect->query($query1);
				
			echo "<script> 
				var result = confirm('Thanks for your cooperation!'); 
            if (result == true) { 
                //alert('OK was pressed.');
                window.location.href = 'https://www.skylineautoservices.com/';				
            } else { 
                window.location.href = 'https://www.skylineautoservices.com/'; 
            } 
				</script>";
			} else {
				echo "<script>
				confirm('Problem in account activation.');
				
				</script>";
			}
		}
?>