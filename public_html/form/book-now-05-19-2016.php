<?php @session_start();?>
<?php
 //require("assets/bootstrap/bootstrap-touchspin-master/demo/demo.php");
//
//
//


?> 


<?php
require_once ('infusionsoft/PHP-iSDK-master/src/isdk.php');
require_once ('stripe/init.php');
require_once ('conf.php');
require_once 'email/PHPMailer-master/PHPMailerAutoload.php'; 


 


function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}


// Use the function
if(isMobile()){
    // Do something for only mobile users

    //echo "<h3> This is a mobile </h3>";
}
else {

	//echo "<h3> This is not a mobile</h3>";
    // Do something for only desktop users
}



//echo "<pre>";
//
//	print_r($_SESSION);
//
//echo "</pre>";

// Important value variables

// connect to the database to grab option values
include('results_table/connect-db.php');

// query db
    $result = mysql_query("SELECT * FROM options")
    or die(mysql_error());
    $row = mysql_fetch_array($result);
	// echo"<pre>";
	// print_r( $row );
	// echo"</pre>";

    
    // check that the 'id' matches up with a row in the databse

    // echo "<pre>";
    // 	print_r($row);
    // echo "</pre>";

  


 
    if($row)
    {
    
        $base = $row['base'];
        $keepclean = ($row['keepclean']/100) + 1;
        $getclean = ($row['getclean']/100) +  1;
        $deepclean = ($row['deepclean']/100) + 1;
        $moveinout = ($row['moveinout']/100) + 1;
        $addon = $row['addon']; 
        $beds = $row['beds'];
        $baths = $row['baths'];
        $sqft = $row['sqft'];
        $week = $row['week']/100;
        $biweek = $row['biweek']/100;
        $month = $row['month']/100;
        $rate = $row['rate'];
        $useDiscount = $row['use_flat_first_time_discount'];
        $discount = $row['first_time_discount'];
    }

$app = new iSDK();

$app->cfgCon('naturalcare');


//floyd code
$returnFields = array('Contact.PostalCode');
$contacts = $app->dsFind('ContactGroupAssign',1000,0,'GroupId',510,$returnFields);


foreach($contacts as $contact){
	
	if($contact['Contact.PostalCode']==$_SESSION['PostalCode']){
		
		
		$totaljoined[] = 1; 
	} 
}







/**
 * Function name
 * what the function does
 *
 * Parameters:
 *     (name) - about this param
 */

  //   if ($_SERVER['REQUEST_METHOD']=='POST' && $_POST['_Frequency']!='' && $_POST['_SelectYourDate']!='' && $_POST['_ArrivalWindow']!='' && $_POST['_InitialCleanType']!='' && $_POST['FirstName']!='' && $_POST['City']!='' && $_POST['LastName']!='' && $_POST['Email']!='' && $_POST['phonenum']!='' && $_POST['StreetAddress1']!='' && $_POST['State']!='' && $_POST['PostalCode']!='' && $_POST['credit_card']!='' && $_POST['cvc']!='' && $_POST['expmonth']!='' && $_POST['expyear']!='')
  //   {
  //   	$addOnDsp = '';
    	
  //   	if($_POST['_AddOns'])
  //   		$_POST['_AddOns'] = substr($_POST['_AddOns'], 1); // trim leading comma
    		
  //   	foreach(explode(',', $_POST['AddOns']) as $addOn)
		// 	$addOnDsp .= $addOn . '<br>';
		
		// $addOnDsp = trim($addOnDsp, '<br>');
    	
  //       $contact_data = [];
  //       foreach ($_POST as $k=>$value)
  //       {
  //           if ($k!='credit_card' && $k!='cvc' && $k!='expmonth' && $k!='expyear' && $k!='continue2' && $k!='stripeToken')
  //           {
  //               $contact_data[$k] = $value;
  //               $_SESSION[$k] = $value;
  //           }
  //       }
  //       $_SESSION['credit_card'] = $_POST['credit_card'];
  //       $_SESSION['cvc'] = $_POST['cvc'];
  //       $_SESSION['expmonth'] = $_POST['expmonth'];
  //       $_SESSION['expyear'] = $_POST['expyear'];
        
      
		// // email form
		// $headers  = 'MIME-Version: 1.0' . "\r\n";
		// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// // $headers .= 'To: Adam <kauseway@gmail.com>' . "\r\n";
		// $headers .= 'To: Adam <mrjesuserwinsuarez@gmail.com>' . "\r\n";
		// $headers .= 'From: ' . $_POST['FirstName'] . ' ' . $_POST['LastName'] . ' <' . $_POST['Email'] . '>' . "\r\n";
		
		// $subject = 'Cleaning Confirmation';
		// // $to = 'kauseway@gmail.com';
		// $to = 'mrjesuserwinsuarez@gmail.com'; 

		// $message = 
		// 	'<html>'.
		// 		'<head>'.
		// 			'<title>Cleaning Confirmation</title>'.
		// 		'</head>'.
		// 		'<body>'.
		// 			'<p>A customer has paid for cleaning services</p><br />'.
		// 			'<span><b>Contact Info</b></span><br />'.
		// 			'<table>'.
		// 				'<tr>'.
		// 					'<td><b>Name</b></td>'.
		// 					'<td>' . $_POST['FirstName'] . ' ' . $_POST['LastName'] . '</td>'.
		// 				'</tr>'.
		// 				'<tr>'.
		// 					'<td><b>Address Line 1</b></td>'.
		// 					'<td>' . $_POST['StreetAddress1'] . '</td>'.
		// 				'</tr>'.
		// 				'<tr>'.
		// 					'<td><b>Address Line 2</b></td>'.
		// 					'<td>' . $_POST['StreetAddress2'] . '</td>'.
		// 				'</tr>'.
		// 				'<tr>'.
		// 					'<td><b>City</b></td>'.
		// 					'<td>' . $_POST['City'] . '</td>'.
		// 				'</tr>'.
		// 				'<tr>'.
		// 					'<td><b>State</b></td>'.
		// 					'<td>' . $_POST['State'] . '</td>'.
		// 				'</tr>'.
		// 				'<tr>'.
		// 					'<td><b>Zip Code</b></td>'.
		// 					'<td>' . $_POST['PostalCode'] . '</td>'.
		// 				'</tr>'.
		// 				'<tr>'.
		// 					'<td><b>Email</b></td>'.
		// 					'<td>' . $_POST['Email'] . '</td>'.
		// 				'</tr>'.
		// 			'</table><br />'.
		// 			'<span><b>Cleaning Info</b></span><br />'.
		// 			'<table>'.
		// 				'<tr>'.
		// 					'<td><b>Clean Type</b></td>'.
		// 					'<td>' . $_POST['_InitialCleanType'] . '</td>'.
		// 				'</tr>'.
		// 				'<tr>'.
		// 					'<td><b>Reccuring Frequency</b></td>'.
		// 					'<td>' . $_POST['_Frequency'] . '</td>'.
		// 				'</tr>'.
		// 				'<tr>'.
		// 					'<td><b>Addons</b></td>'.
		// 					'<td>'. $addOnDsp . '</td>'.
		// 				'</tr>'.
		// 				'<tr>'.
		// 					'<td><b>Appointment Date</b></td>'.
		// 					'<td>' . $_POST['_SelectYourDate'] . '</td>'.
		// 				'</tr>'.
		// 				'<tr>'.
		// 					'<td><b>Time of Day</b></td>'.
		// 					'<td>' . $_POST['_ArrivalWindow'] . '</td>'.
		// 				'</tr>'.
		// 			'</table>'.
		// 		'</body>'.
		// 	'</html>';
		


		// $mail = new PHPMailer; 

		// $mail->setFrom('michael@automationlab.com.au', 'Mailer');
		// $mail->addAddress('mrjesuserwinsuarez@gmail.com', 'Jesus User');     // Add a recipient 

		// $mail->addReplyTo('michael@automationlab.com.au', 'Information'); 

		// $mail->isHTML(true);                                  // Set email format to HTML

		// $mail->Subject = 'Cleaning Confirmation';
		// $mail->Body    = $message; 

		// if(!$mail->send()) {
		//     echo 'Message could not be sent.';
		//     echo 'Mailer Error: ' . $mail->ErrorInfo;
		// } else {
		//     echo 'Message has been sent';
		// }




		// 	// mail($to, $subject, $message, $headers);
		
  //       // $redirect = '<script>window.location = "/form/final.php";</script>';
  //   } else {
  //   	echo "Not send yet<br>";
  //   }




// if (isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['contact_id']))
// {
	// if ($_SERVER['REQUEST_METHOD']=='POST' && $_POST['_Frequency']!='' && $_POST['_SelectYourDate']!='' && $_POST['_ArrivalWindow']!='' && $_POST['_InitialCleanType']!='' && $_POST['FirstName']!='' && $_POST['City']!='' && $_POST['LastName']!='' && $_POST['Email']!='' && $_POST['phonenum']!='' && $_POST['StreetAddress1']!='' && $_POST['State']!='' && $_POST['PostalCode']!='' && $_POST['credit_card']!='' && $_POST['cvc']!='' && $_POST['expmonth']!='' && $_POST['expyear']!='') { 
	// 	print ("Form submitted <br>");  

	//  //    $_SESSION['StreetAddress1']  
	//  //    $_SESSION['City']  
	//  //    $_SESSION['State']   
	//  //    $_SESSION['Country']  
	//  //    $_SESSION['StreetAddress2']  
	//  //    $_SESSION['PostalCode']   
	//  //    $_SESSION['Email'] 
	//  //    $_SESSION['_SquareFootagesize'] 
	//  //    $_SESSION['_Beds']   
	//  //    $_SESSION['_baths']  
	//  //    $_SESSION['FirstName']  
	//  //    $_SESSION['LastName']  
	// 	// $_SESSION['phonenum']  
	// 	// $_SESSION['ServiceType']  




	// 	// $mail = new PHPMailer; 

	// 	// $mail->setFrom('michael@automationlab.com.au', 'Mailer');
	// 	// $mail->addAddress('mrjesuserwinsuarez@gmail.com', 'Jesus User');     // Add a recipient 

	// 	// $mail->addReplyTo('michael@automationlab.com.au', 'Information'); 

	// 	// $mail->isHTML(true);                                  // Set email format to HTML

	// 	// $mail->Subject = 'Here is the subject';
	// 	// $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	// 	// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	// 	// if(!$mail->send()) {
	// 	//     echo 'Message could not be sent.';
	// 	//     echo 'Mailer Error: ' . $mail->ErrorInfo;
	// 	// } else {
	// 	//     echo 'Message has been sent';
	// 	// }


		 


	// } else {
	// 	print("Form not yet submitted <br>");
	// }

// }






\Stripe\Stripe::setAPiKey($conf['stripe_key']);
if (isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['contact_id']))
{
    if ($_SERVER['REQUEST_METHOD']=='POST' && $_POST['_Frequency']!='' && $_POST['_SelectYourDate']!='' && $_POST['_ArrivalWindow']!='' && $_POST['_InitialCleanType']!='' && $_POST['FirstName']!='' && $_POST['City']!='' && $_POST['LastName']!='' && $_POST['Email']!='' && $_POST['phonenum']!='' && $_POST['StreetAddress1']!='' && $_POST['State']!='' && $_POST['PostalCode']!='' && $_POST['credit_card']!='' && $_POST['cvc']!='' && $_POST['expmonth']!='' && $_POST['expyear']!='')
    {
    	$addOnDsp = '';
    	
    	if($_POST['_AddOns'])
    		$_POST['_AddOns'] = substr($_POST['_AddOns'], 1); // trim leading comma
    		
    	foreach(explode(',', $_POST['AddOns']) as $addOn)
			$addOnDsp .= $addOn . '<br>';
		
		$addOnDsp = trim($addOnDsp, '<br>');
    	
        $contact_data = [];
        foreach ($_POST as $k=>$value)
        {
            if ($k!='credit_card' && $k!='cvc' && $k!='expmonth' && $k!='expyear' && $k!='continue2' && $k!='stripeToken')
            {
                $contact_data[$k] = $value;
                $_SESSION[$k] = $value;
            }
        }
        $_SESSION['credit_card'] = $_POST['credit_card'];
        $_SESSION['cvc'] = $_POST['cvc'];
        $_SESSION['expmonth'] = $_POST['expmonth'];
        $_SESSION['expyear'] = $_POST['expyear'];
        
        $app->updateCon($_SESSION['contact_id'], $contact_data);
        $app->grpAssign($_SESSION['contact_id'], 93);

        $token = $_POST['stripeToken'];

        $customer = \Stripe\Customer::create(array(
            "source"=>$token,
            "description"=>$_POST['FirstName'] . ' ' . $_POST['LastName']
        ));

        \Stripe\Charge::create(array(
            "amount"=>$_POST['_YourFirstClean'],
            "currency"=>"usd",
            "customer"=>$customer->id
        ));

        \Stripe\Charge::create(array(
            "amount"=>$_POST['_YourRecurringPrice'],
            "currency"=>"usd",
            "customer"=>$customer->id
        ));
		
		// email form
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 // $headers .= 'To: Adam <kauseway@gmail.com>' . "\r\n";
	     $headers .= 'To: Adam <support@gmail.com>' . "\r\n";
		 
//		$headers .= 'To: Adam <mrjesuserwinsuarez@gmail.com>' . "\r\n";
		$headers .= 'From: ' . $_POST['FirstName'] . ' ' . $_POST['LastName'] . ' <' . $_POST['Email'] . '>' . "\r\n";
		
		$subject = 'Cleaning Confirmation';
		 // $to = 'kauseway@gmail.com';
		 $to = 'support@gmail.com,tim@automationlab.com.au';

		 

 
//		echo "<pre>";
//			print_r($_POST);
//		echo "</pre>";


		$Country              = $_SESSION['Country'];
		$_SquareFootagesize   = $_SESSION['_SquareFootagesize'];
		$_Beds                = $_SESSION['_Beds'];
	    $_baths               = $_SESSION['_baths']; 
	    $phonenum             = $_SESSION['phonenum'];
	    $ServiceType          = $_SESSION['ServiceType'];
	    $contact_id           = $_SESSION['contact_id']; 
	    $phonenum               = $_SESSION['phonenum']; 
	    $_promodiscount       = $_SESSION['_promodiscount'];
	    $_YourFirstClean      = $_SESSION['_YourFirstClean'];
	    $_FirstCleanHours     = $_SESSION['_FirstCleanHours'];
	    $_YourRecurringPrice  = $_SESSION['_YourRecurringPrice'];
	    $_RecurringDiscount   = $_SESSION['_RecurringDiscount'];
	    $_OneTimeAdjustment   = $_SESSION['_OneTimeAdjustment'];
	    $_PromoCode           = $_SESSION['_PromoCode'];
	    $credit_card          = $_SESSION['credit_card'];
	    $cvc                  = $_SESSION['cvc'];
	    $expmonth             = $_SESSION['expmonth'];
	    $expyear              = $_SESSION['expyear'];
		

		$message = 
			'<html>'.
				'<head>'.
					'<title>Cleaning Confirmation</title>'.
				'</head>'.
				'<body>'.
					'<p>A customer has paid for cleaning services</p><br />'.
					'<span><b>Contact Info</b></span><br />'.
					'<table>'.
						'<tr>'.
							'<td><b>Name</b></td>'.
							'<td>' . $_POST['FirstName'] . ' ' . $_POST['LastName'] . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Address Line 1</b></td>'.
							'<td>' . $_POST['StreetAddress1'] . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Address Line 2</b></td>'.
							'<td>' . $_POST['StreetAddress2'] . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>City</b></td>'.
							'<td>' . $_POST['City'] . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>State</b></td>'.
							'<td>' . $_POST['State'] . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Country</b></td>'.
							'<td>' . $Country . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Zip Code</b></td>'.
							'<td>' . $_POST['PostalCode'] . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Email</b></td>'.
							'<td>' . $_POST['Email'] . '</td>'.
						'</tr>'.
					'</table><br />'.
					'<span><b>Cleaning Info</b></span><br />'.
					'<table>'.
						'<tr>'.
							'<td><b>Clean Type</b></td>'.
							'<td>' . $_POST['_InitialCleanType'] . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Reccuring Frequency</b></td>'.
							'<td>' . $_POST['_Frequency'] . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Addons</b></td>'.
							'<td>'. $addOnDsp . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Appointment Date</b></td>'.
							'<td>' . $_POST['_SelectYourDate'] . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Time of Day</b></td>'.
							'<td>' . $_POST['_ArrivalWindow'] . '</td>'.
						'</tr>'.
					'</table><br />'.
					'<span><b>Others</b></span><br />'.
					'<table>'.
						'<tr>'.
							'<td><b>Square Footage</b></td>'.
							'<td>' . $_SquareFootagesize. '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Beds</b></td>'.
							'<td>' . $_Beds . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Baths</b></td>'.
							'<td>'. $_Beds . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Phone Number</b></td>'.
							'<td>' . $phonenum . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Contact Id</b></td>'.
							'<td>' . $contact_id . '</td>'.
						'</tr>'.

						'<tr>'.
							'<td><b>Phone 1</b></td>'.
							'<td>' . $phonenum . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Promo Discount</b></td>'.
							'<td>' .$_promodiscount . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Your first clean</b></td>'.
							'<td>' . $_YourFirstClean . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Your first clean hours</b></td>'.
							'<td>' . $_FirstCleanHours . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Your recurring price</b></td>'.
							'<td>' . $_YourRecurringPrice . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Recurring Discount</b></td>'.
							'<td>' . $_RecurringDiscount . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>One time adjustment </b></td>'.
							'<td>' .  $_OneTimeAdjustment . '</td>'.
						'</tr>'.
						'<tr>'.
							'<td><b>Promo code</b></td>'.
							'<td>' . $_PromoCode . '</td>'.
						'</tr>'.  
					'</table>' .  
				'</body>'.
			'</html>';


//			if(
			mail($to, $subject, $message, $headers);
			//	){
//				echo "mail sent <br>";
//			    $redirect = '<script>window.location = "/form/final.php";</script>';

//			} else {
//				echo "failed to sent email <br>";
//			}
			


//			echo "redirect to /form/final.php now! <br>";
        $redirect = '<script>window.location = "/form/final.php";</script>';
    }
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	    <?php
	    if(isset($redirect))
        echo $redirect;
	    ?>
		<meta charset="UTF-8"/>
		<title>Book Now</title>
		<link rel="icon"
		type="image/png"
		href="assets/img/NC_logo.png">
		<meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />

        <!-- GLOBAL STYLES -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/theme.css" />
        <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
        <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="formstyle.css" />
        <!--END GLOBAL STYLES -->

        <!-- PAGE LEVEL STYLES -->
        <link href="assets/css/1.css" rel="stylesheet" />
        <link href="assets/css/jquery-ui.css" rel="stylesheet" />

        <!-- END PAGE LEVEL  STYLES -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <!-- GLOBAL SCRIPTS -->
        <script src="assets/plugins/jquery-2.0.3.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!-- END GLOBAL SCRIPTS -->
        <!-- PAGE LEVEL SCRIPTS -->
        <script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/plugins/validVal/js/jquery.validVal.min.js"></script>
        <!--<script src="assets/js/bootstrap-datepicker.js"></script>-->
        <script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
        <script src="assets/js/formsInit.js"></script>
        <script src="assets/js/validationInit.js"></script>
        <script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
        <script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.js"></script>
        <script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
        <script src="assets/js/jquery-scrolltofixed.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<!--		<link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">-->
		<link href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.css" rel="stylesheet" type="text/css" media="all">
		<link href="assets/bootstrap/bootstrap-touchspin-master/src/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" media="all">
		<!--		<link href="../src/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" media="all">-->


		<link href="assets/bootstrap/bootstrap-touchspin-master/demo/demo.css" rel="stylesheet" type="text/css" media="all">

<!--		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<!--		<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>-->
		<script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.js"></script>
		<script src="assets/bootstrap/bootstrap-touchspin-master/src/jquery.bootstrap-touchspin.js"></script>
		<!--		<script src="../src/jquery.bootstrap-touchspin.js"></script>-->



		<link href="assets/css/stepper.css"  rel="stylesheet" type="text/css" media="all" >
		<link rel="stylesheet" href="assets/css/booknow2.css" />
		<link rel="stylesheet" href="assets/css/res.css" />

		<link rel="stylesheet" href="assets/css/mobile.css" />





		<!--END PAGE LEVEL SCRIPTS -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#summary').scrollToFixed({
					marginTop : 0,
					dontSetWidth: true
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#phonetotal').scrollToFixed({
					marginTop : 0
				});
			});
		</script>
		<script type="text/javascript">
			//Formula used to check if credit card numbers are valid
			function checkLuhn(input) {
				var sum = 0;
				var numdigits = input.length;
				var parity = numdigits % 2;
				for (var i = 0; i < numdigits; i++) {
					var digit = parseInt(input.charAt(i))
					if (i % 2 == parity)
						digit *= 2;
					if (digit > 9)
						digit -= 9;
					sum += digit;
				}
				return (sum % 10) == 0;
			}
		</script>

        <script>
 
 /** Days to be disabled as an array */
<?php

    //now grabbing the disable dates
    $result = mysql_query("SELECT * FROM disabledates")
    or die(mysql_error());
    // check that the 'id' matches up with a row in the databse
    
    $string = "var disableddates = [";
    while($row = mysql_fetch_array($result))
    {
        $string .= '"'.$row['date'] . '", ';

    }
    $string .= "];";
    echo $string;


?>
//var disableddates = ["6-3-2014", "5-26-2015", "5-25-2015", "5-20-2015"];
 
function DisableSpecificDates(date) {
 
 var m = date.getMonth();
 var d = date.getDate();
 var y = date.getFullYear();
 
 // First convert the date in to the mm-dd-yyyy format 
 // Take note that we will increment the month count by 1 
 var currentdate = (m + 1) + '-' + d + '-' + y ;
 

 
 // We will now check if the date belongs to disableddates array 
 for (var i = 0; i < disableddates.length; i++) {
 
 // Now check if the current date is in disabled dates array. 
 if ($.inArray(currentdate, disableddates) != -1 ) {
 return [false];
 } 
 }
 
 // In case the date is not present in disabled array, we will now check if it is a weekend. 
 // We will use the noWeekends function
 var weekenddate = $.datepicker.noWeekends(date);
 return weekenddate; 
 
}
        
$(function() {
$('#creditcard').focusout(function(){
 
	setTimeout(function(){
 	
    if ( $('#creditcard').hasClass( "has-error" ) ) {
 
        $( '.ccCard .input-group-addon' ).addClass('border2pxred');
 
    }else{
    
    	 $( '.ccCard .input-group-addon' ).removeClass('border2pxred');
    
   
    }
    
    },100); 
 
 }) 
 $('#creditcard').keydown(function(){
 
	setTimeout(function(){
 	
    if ( $('#creditcard').hasClass( "has-error" ) ) {
 
        $( '.ccCard .input-group-addon' ).addClass('border2pxred');
 
    }else{
    
    	 $( '.ccCard .input-group-addon' ).removeClass('border2pxred');
    
   
    }
    
    },100); 
 
 }) 

$( "#continue2" ).click(function() {
 
 	setTimeout(function(){
 	
    if ( $('#creditcard').hasClass( "has-error" ) ) {
 
        $( '.ccCard .input-group-addon' ).addClass('border2pxred');
 
    }else{
    
    	 $( '.ccCard .input-group-addon' ).removeClass('border2pxred');
    
   
    }
    
    },100); 
 
});

 $( "#datepicker" ).datepicker({
 onSelect: function(date) {
        $('#date2').text($(this).val());
        $('#pdate2').text($(this).val());
        $('#datepicker').removeClass('has-error').addClass('has-success');
        $('span[for="datepicker"].has-error').css({
                    display: 'none',
        });
    },
 minDate: 0,
 beforeShowDay: DisableSpecificDates
 });
 });

        </script>
		<script>
			//Google Analytics Script
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] ||
				function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-5358845-3', 'auto');
			ga('send', 'pageview');

		</script>
		<script>
		
			function dayCheck(daytimeCheck){
		
	
		
			if(daytimeCheck=="anytime"){	
			    $('#daytime').valid();
				document.getElementById('anytime').style.display = "block";
				document.getElementById('morning').style.display = "none";
				document.getElementById('afternoon').style.display = "none";
				$('span[for="daytime"].has-error').css({
                    display: 'none',
                })
		
			}
			if(daytimeCheck=="morning"){
			    $('#daytime').valid();
				document.getElementById('morning').style.display = "block";
				document.getElementById('anytime').style.display = "none";
				document.getElementById('afternoon').style.display = "none";
				$('span[for="daytime"].has-error').css({
                    display: 'none',
                })
			}
			if(daytimeCheck=="afternoon"){
			    $('#daytime').valid();
				document.getElementById('afternoon').style.display = "block";
				document.getElementById('morning').style.display = "none";
				document.getElementById('anytime').style.display = "none";
				$('span[for="daytime"].has-error').css({
                    display: 'none',
                })
             }   
		
			}

			function onetime() {



			


     
     			document.getElementById('fcleanmobile').style.display = "block";
				document.getElementById('disctime').style.display = "none";
				document.getElementById('multvisit').style.display = "none";
				document.getElementById('pmultvisit').style.display = "none";
                document.getElementById('border').style.display = "none";
				document.getElementById('sub').style.display = "none";
				document.getElementById('monthdisc').style.display = "none";
				document.getElementById('bidisc').style.display = "none";
				document.getElementById('weekdisc').style.display = "none";
				//document.getElementById('pmonthdisc').style.display = "none";
				//document.getElementById('pbidisc').style.display = "none";
				//document.getElementById('pweekdisc').style.display = "none";
				$('span[for="repeat"].has-error').css({
				    display: 'none',
				})
			}

			function weekly() {
			    $('#repeat').valid();
			    document.getElementById('fcleanmobile').style.display = "none";
			    //document.getElementById('border').style.display = "block";
				document.getElementById('disctime').style.display = "block";
				document.getElementById('multvisit').style.display = "block";
				document.getElementById('pmultvisit').style.display = "block";
				document.getElementById('sub').style.display = "block";
				document.getElementById('monthdisc').style.display = "none";
				document.getElementById('bidisc').style.display = "none";
				document.getElementById('weekdisc').style.display = "block";
				document.getElementById('fourwk').style.display = "none";
				document.getElementById('twowk').style.display = "none";
				document.getElementById('onewk').style.display = "block";
				//document.getElementById('psub').style.display = "block";
				//document.getElementById('pmonthdisc').style.display = "none";
				//document.getElementById('pbidisc').style.display = "none";
				//document.getElementById('pweekdisc').style.display = "block";
				document.getElementById('pfourwk').style.display = "none";
				document.getElementById('ptwowk').style.display = "none";
				document.getElementById('ponewk').style.display = "block";
				$('span[for="repeat"].has-error').css({
                    display: 'none',
                })

				console.log("weekly clicked ");
			}

			function biweekly() {
			    $('#repeat').valid();
			    document.getElementById('fcleanmobile').style.display = "none";
			    //document.getElementById('border').style.display = "block";
				document.getElementById('disctime').style.display = "block";
				document.getElementById('multvisit').style.display = "block";
				document.getElementById('pmultvisit').style.display = "block";
				document.getElementById('sub').style.display = "block";
				document.getElementById('monthdisc').style.display = "none";
				document.getElementById('bidisc').style.display = "block";
				document.getElementById('weekdisc').style.display = "none";
				document.getElementById('fourwk').style.display = "none";
				document.getElementById('twowk').style.display = "block";
				document.getElementById('onewk').style.display = "none";
				/*document.getElementById('psub').style.display = "block";
				 document.getElementById('pmonthdisc').style.display = "none";
				 document.getElementById('pbidisc').style.display = "block";
				 document.getElementById('pweekdisc').style.display = "none";*/
				document.getElementById('pfourwk').style.display = "none";
				document.getElementById('ptwowk').style.display = "block";
				document.getElementById('ponewk').style.display = "none";
				$('span[for="repeat"].has-error').css({
                    display: 'none',
                })
			}

			function monthly() {
			    $('#repeat').valid();
			    document.getElementById('fcleanmobile').style.display = "none";
			    //document.getElementById('border').style.display = "block";
				document.getElementById('disctime').style.display = "block";
				document.getElementById('multvisit').style.display = "block";
				document.getElementById('pmultvisit').style.display = "block";
				document.getElementById('sub').style.display = "block";
				document.getElementById('monthdisc').style.display = "block";
				document.getElementById('bidisc').style.display = "none";
				document.getElementById('weekdisc').style.display = "none";
				document.getElementById('fourwk').style.display = "block";
				document.getElementById('twowk').style.display = "none";
				document.getElementById('onewk').style.display = "none";
				/*document.getElementById('psub').style.display = "block";
				 document.getElementById('pmonthdisc').style.display = "block";
				 document.getElementById('pbidisc').style.display = "none";
				 document.getElementById('pweekdisc').style.display = "none";*/
				document.getElementById('pfourwk').style.display = "block";
				document.getElementById('ptwowk').style.display = "none";
				document.getElementById('ponewk').style.display = "none";
				$('span[for="repeat"].has-error').css({
                    display: 'none',
                })
			}
            
            function keepclean() {
                $('#cleantype').valid();
                document.getElementById('getclean').style.display = "none";
                document.getElementById('deepclean').style.display = "none";
                document.getElementById('moveinout').style.display = "none";
                document.getElementById('t-keepclean').style.display = "table-cell";
                document.getElementById('t-getclean').style.display = "none";
                document.getElementById('t-deepclean').style.display = "none";
                document.getElementById('t-move').style.display = "none";
                $('span[for="cleantype"].has-error').css({
                    display: 'none',
                })
            }
            
			function getclean() {
			    $('#cleantype').valid();
				document.getElementById('getclean').style.display = "block";
				document.getElementById('deepclean').style.display = "none";
				document.getElementById('moveinout').style.display = "none";
				document.getElementById('t-keepclean').style.display = "none";
				document.getElementById('t-getclean').style.display = "table-cell";
				document.getElementById('t-deepclean').style.display = "none";
				document.getElementById('t-move').style.display = "none";
				$('span[for="cleantype"].has-error').css({
                    display: 'none',
                })
			}

			function deepclean() {
			    $('#cleantype').valid();
				document.getElementById('getclean').style.display = "none";
				document.getElementById('deepclean').style.display = "block";
				document.getElementById('moveinout').style.display = "none";
				document.getElementById('t-keepclean').style.display = "none";
				document.getElementById('t-getclean').style.display = "none";
				document.getElementById('t-deepclean').style.display = "table-cell";
				document.getElementById('t-move').style.display = "none";
				//document.getElementById('sub').style.display = "block";
				//document.getElementById('psub').style.display = "block";
				$('span[for="cleantype"].has-error').css({
                    display: 'none',
                })
			}

			function moveinout() {
			    $('#cleantype').valid();
				document.getElementById('getclean').style.display = "none";
				document.getElementById('deepclean').style.display = "none";
				document.getElementById('moveinout').style.display = "block";
				document.getElementById('t-keepclean').style.display = "none";
				document.getElementById('t-getclean').style.display = "none";
				document.getElementById('t-deepclean').style.display = "none";
				document.getElementById('t-move').style.display = "table-cell";
				//document.getElementById('sub').style.display = "block";
				//document.getElementById('psub').style.display = "block";
				$('span[for="cleantype"].has-error').css({
                    display: 'none',
                })
			}

		</script>

		<script>
			Stripe.setPublishableKey('pk_test_Kd3bmaphUVShmURo2ruSYaAd');

			$(function() {
				$('form').submit(function(e) {
				    e.preventDefault()
					Stripe.card.createToken({
						number : $('#creditcard').val(),
						cvc : $('#cvc').val(),
						exp_month : $('#expmonth').val(),
						exp_year : $('#expyear').val()

					}, function(status, response) {
						$form = $('form');
						if (response.error) {
							// Show the errors on the form
							$form.find('.payment-errors').text(response.error.message);
							return false
						} else {
							// response contains id and card, which contains additional card details
							var token = response.id;
							// Insert the token into the form so it gets submitted to the server
							$('#stripetoken').val(token)
							// and submit

							$form.get(0).submit();
						}
					});
				});
			});
		</script>

		<script>
			$(function() {
				formInit();
			});
		</script>
		<script>
			$(function() {
				formValidation();
			});
		</script>

		<script type="text/javascript" language="javascript">
			$(function(global){
 

	// var objData = new object();
	// objData.totalAddOns = 0;
	global.totalAddOns = 0;
	var base = <?php echo $base; ?>;
	var keepclean = <?php echo $keepclean; ?>;
	var getclean = <?php echo $getclean; ?>;
	var deepclean = <?php echo $deepclean; ?>;
	var moveinout = <?php echo $moveinout; ?>;
	var addon = <?php echo $addon; ?>;
	var beds = <?php echo $beds; ?>;
	var baths = <?php echo $baths; ?>;
	var sqft = <?php echo $sqft; ?>;
	var week = <?php echo $week; ?>;
	var biweek = <?php echo $biweek; ?>;
	var month = <?php echo $month; ?>;
	var rate = <?php echo $rate; ?>;
	var useDiscount = <?php echo $useDiscount; ?>;
	var discount = <?php echo $discount; ?>;



	// add to session 
	localStorage.setItem('base', base);
	localStorage.setItem('keepclean', keepclean);
	localStorage.setItem('getclean', getclean);
	localStorage.setItem('deepclean', deepclean);
	localStorage.setItem('moveinout', moveinout);
	localStorage.setItem('addon', addon);
	localStorage.setItem('beds', beds);
	localStorage.setItem('baths', baths);
	localStorage.setItem('sqft', sqft);
	localStorage.setItem('week', week);
	localStorage.setItem('biweek', biweek);
	localStorage.setItem('month', month);
	localStorage.setItem('rate', rate);
	localStorage.setItem('useDiscount', useDiscount);
	localStorage.setItem('discount', discount);


	function numBeds() {
		var ret =  isNaN(parseInt($('#bed').val())) ? 0 : parseInt($('#bed').val());
		return ret;
	}

	function numBaths() {
		var ret = isNaN(parseInt($('#bath').val())) ? 0 : parseInt($('#bath').val());
		return ret;
	}

	function squareFootage() {
		var ret = isNaN(parseInt($('#footage').val())) ? 0 : parseInt($('#footage').val());
		return ret;
	}

	function getItCleanFunc(totalBasePrice, getITcLean)
	{
		return parseFloat(totalBasePrice * getITcLean);
	}

	function deepCleanFunc(totalBasePrice, deepClean)
	{
		return  parseFloat(totalBasePrice * deepClean);
	}

	function moveInOutFunc(totalBasePrice, moveInOut)
	{
		return  parseFloat(totalBasePrice * moveInOut);
	}
	function getTotalBasePrice(totalSquareFootCalculation, totalBeds, totalBathRoom)
	{

		var totalBedsPrice     = parseInt("6");
		var totalBathRoOmPrice = parseInt("14");
		var totalBaseValue     = parseInt("99");
		//totalSquareFootCalculation = M3;
		var totalBasePrice = (totalBeds*totalBedsPrice) + (totalBathRoom*totalBathRoOmPrice) + totalBaseValue+totalSquareFootCalculation;

		return parseInt(totalBasePrice);
	}

		function calculateWeekly() { return basePrice() * weeklyPrice(); }

		function calculateEvery2weeks() { return basePrice() * every2WeeksPrice(); }

		function calculateEvery4weeks() { return basePrice() * every4WeeksPrice(); }



				function weeklyPrice(){ return parseFloat("0.65"); }

	function every2WeeksPrice(){ return parseFloat("0.7"); }

	function every4WeeksPrice(){ return parseFloat("0.75"); }



	function calculate_sqrtFt(SQFTInput)
	{
		var SQFTBase = 1000;
		var multiplier1 = 100;
		var multiplier2 = 3;
		var answer = 0;
		if(SQFTInput > SQFTBase) {
			answer = (SQFTInput - SQFTBase)/multiplier1*multiplier2;
		}
		return answer;
	}

	function basePrice()
	{
		var totalBathRooms = parseFloat($('#bath').val());
		var SQFTInput = parseInt($('#footage').val());
		var totalBedRooms = parseInt($('#bed').val());
		var totalBasePrice = getTotalBasePrice(calculate_sqrtFt(SQFTInput), totalBedRooms, totalBathRooms);

		return totalBasePrice;
	}





	$.fn.getWeeklyPrice = function (text) {

		var repeatValue = 0;
		text = text.toLowerCase(); 
 
		if(text == 'one time') {
			
		} else if (text == 'every week') {
			console.log(" inside every week");
			repeatValue = calculateWeekly(); 
		} else if (text == 'every 2 weeks') {
			console.log(" inside every 2 weeks");
			repeatValue = calculateEvery2Weeks(); 
		} else if(text == 'every 4 weeks'){
			console.log(" inside every 4 weeks");
			repeatValue = calculateEvery4Weeks(); 
		}
 
		console.log(" text " + text + " price " + repeatValue);
		return Math.round(repeatValue);
	}


	function getWeeklyPrice(text) {

		var repeatValue = 0;
		text = text.toLowerCase(); 
 
		if(text == 'one time') {
			
		} else if (text == 'every week') {
			console.log(" inside every week");
			repeatValue = calculateWeekly(); 
		} else if (text == 'every 2 weeks') {
			console.log(" inside every 2 weeks");
			repeatValue = calculateEvery2Weeks(); 
		} else if(text == 'every 4 weeks'){
			console.log(" inside every 4 weeks");
			repeatValue = calculateEvery4Weeks(); 
		}
 
		console.log(" text " + text + " price " + repeatValue);
		return Math.round(repeatValue);
	}



	/**
	 * Caluclate first clean for
	 * Tabs:
	 * Keep It Clean
	 * Get Clean
	 * Move In Out
	 */
	$.fn.calculateFirstCleanByKeepItCleanGetCleanMoveInOut = function (text)
	{




		text = text.toLowerCase();
		// console.log("INITIALIZED");
		// $.fn.initialize();


		var tabClass = '.cleantype';
		var firstCleanId = '#visit1';
		var totalBathRooms = parseFloat($('#bath').val());
		var totalBedRooms = parseInt($('#bed').val());



		// getclean  = parseFloat("1.25");
		// deepclean = parseFloat("1.5");
		// moveinout = parseFloat("1.75");
		var SQFTInput = parseInt($('#footage').val());
		var totalBasePrice = getTotalBasePrice(calculate_sqrtFt(SQFTInput), totalBedRooms, totalBathRooms);


		

		text = text.toLowerCase();
		console.log("get it clean " +  calculateGetItClean());
		console.log("text = " + text);



		if (text == 'keep it clean')
		{
			firstclean = calculateBasePrice();
		//			firstclean = 1;
		}
		else if (text == 'get it clean')
		{
			console.log("inside get it clean")
			firstclean = calculateGetItClean(); //getItCleanFunc(totalBasePrice, getclean);
			//firstclean = getItCleanFunc(totalBasePrice, getclean);
		}
		else if (text == 'deep clean')
		{
			console.log("deep clean");
			firstclean = calculateDeepClean(); //deepCleanFunc(totalBasePrice, deepclean);
		//			firstclean = deepCleanFunc(totalBasePrice, deepclean);
		}
		else if (text == 'move in/out')
		{
			console.log("move in out");
			firstclean = calculateMoveInOut(); //moveInOutFunc(totalBasePrice, moveinout);
			//			firstclean = moveInOutFunc(totalBasePrice, moveinout);
		}


 

		firstclean = Math.round(firstclean); 
	      firstclean = firstclean + parseInt(global.totalAddOns);
		// get addons value selected 

		console.log(" text tab = " + text + " clicked tab " + $(tabClass).text() + "  " + SQFTInput + " totalBasePrice " + totalBasePrice + " firstclean " + firstclean + " total bath room " + totalBathRooms + " total bed rooms " + totalBedRooms );



		// 		$(firstCleanId).text(firstclean);

		return firstclean; 
	}


	/**
	* Auto calculate weekly and cleaning type
	*/
    $.fn.plusAndMinusButtonClickedAutoCalculate = function() {
        //$('#field-bath').val(bathRoomUnit(bed)); 
        var cleanType = $('#cleantype').val().toLowerCase();  
        var firstclean = $.fn.calculateFirstCleanByKeepItCleanGetCleanMoveInOut(cleanType); 
        $('#visit1').text( '$' + Math.round(firstclean));
        $('#pvisit1').text( '$' + Math.round(firstclean)); 

        /**
        * Repeat
        */  
        var repeatText = $('#repeat').val().toLowerCase();  
        var weeklyVal = $.fn.getWeeklyPrice(repeatText);  
        $('#visit2').text('$' +weeklyVal);
        $('#pvisit2').text('$' + weeklyVal);  
    } 

	/**
	 * Caluclate first clean for
	 * Tabs:
	 * Keep It Clean
	 * Get Clean
	 * Move In Out
	 */
	function calculateFirstCleanByKeepItCleanGetCleanMoveInOut(text)
	{




		text = text.toLowerCase();
		// console.log("INITIALIZED");
		// $.fn.initialize();


		var tabClass = '.cleantype';
		var firstCleanId = '#visit1';
		var totalBathRooms = parseFloat($('#bath').val());
		var totalBedRooms = parseInt($('#bed').val());



		// getclean  = parseFloat("1.25");
		// deepclean = parseFloat("1.5");
		// moveinout = parseFloat("1.75");
		var SQFTInput = parseInt($('#footage').val());
		var totalBasePrice = getTotalBasePrice(calculate_sqrtFt(SQFTInput), totalBedRooms, totalBathRooms);


		

		text = text.toLowerCase();
		console.log("get it clean " +  calculateGetItClean());
		console.log("text = " + text);



		if (text == 'keep it clean')
		{
			firstclean = calculateBasePrice();
		//			firstclean = 1;
		}
		else if (text == 'get it clean')
		{
			console.log("inside get it clean")
			firstclean = calculateGetItClean(); //getItCleanFunc(totalBasePrice, getclean);
			//firstclean = getItCleanFunc(totalBasePrice, getclean);
		}
		else if (text == 'deep clean')
		{
			console.log("deep clean");
			firstclean = calculateDeepClean(); //deepCleanFunc(totalBasePrice, deepclean);
		//			firstclean = deepCleanFunc(totalBasePrice, deepclean);
		}
		else if (text == 'move in/out')
		{
			console.log("move in out");
			firstclean = calculateMoveInOut(); //moveInOutFunc(totalBasePrice, moveinout);
			//			firstclean = moveInOutFunc(totalBasePrice, moveinout);
		}

		firstclean = Math.round(firstclean);

		console.log(" text tab = " + text + " clicked tab " + $(tabClass).text() + "  " + SQFTInput + " totalBasePrice " + totalBasePrice + " firstclean " + firstclean + " total bath room " + totalBathRooms + " total bed rooms " + totalBedRooms );



		// 		$(firstCleanId).text(firstclean);

		return firstclean; 
	}



 
			// $.fn.loadData  = function() {
			// 	 console.log("initialized : beds " +  memberInputBeds() + " bath " + memberInputBath() + " sqft " + memberInputSqft() );
			// 	console.log(" admin input beds " + adminInputBeds());
			// 	console.log("square foot calculation " + Math.round(calculateSqftCalc()));
			// 	console.log("calculate Base Price " +  calculateBasePrice());
			// 	console.log("calculate weekly " +  calculateWeekly());
			// 	console.log("calculate 2 weeks " + calculateEvery2Weeks());
			// 	console.log("calculate 4 weeks " + calculateEvery4Weeks());

			// 	console.log("Get it clean " + calculateGetItClean());
			// 	console.log("Deep clean " + calculateDeepClean());
			// 	console.log("Keep Clean " +  calculateMoveInOut());

			// 	console.log(" memberInputBeds() = " +memberInputBeds());
			// 	console.log(" memberInputBath() = " +memberInputBath());
			// 	console.log(" memberInputSqft() = " +memberInputSqft());
			// 	console.log(" adminInputBeds() = " +adminInputBeds());
			// 	console.log(" adminInputBath() = " +adminInputBath());
			// 	console.log(" adminInputSqftBase() = " +adminInputSqftBase());
			// 	console.log(" adminInputBaseValue() = " +adminInputBaseValue());
			// 	console.log(" adminInputWeekly() = " +adminInputWeekly());
			// 	console.log(" adminInputEvery2Weeks() = " +adminInputEvery2Weeks());
			// 	console.log(" adminInputEvery4Weeks() = " +adminInputEvery4Weeks());
			// 	console.log(" adminInputGetItClean() = " +adminInputGetItClean());
			// 	console.log(" adminInputDeepClean() = " +adminInputDeepClean());
			// 	console.log(" adminInputMoveInOut() = " +adminInputMoveInOut());
			// 	console.log(" calculateSqftCalc() = " +calculateSqftCalc());
			// 	console.log(" calculateBasePrice() = " +calculateBasePrice());
			// 	console.log(" calculateWeekly() = " +calculateWeekly());
			// 	console.log(" calculateEvery2Weeks() = " +calculateEvery2Weeks());
			// 	console.log(" calculateEvery4Weeks() = " +calculateEvery4Weeks());
			// 	console.log(" calculateGetItClean() = " +calculateGetItClean());
			// 	console.log(" calculateDeepClean() = " +calculateDeepClean());
			// 	console.log(" calculateMoveInOut() = " +calculateMoveInOut());
			// }



				/**
				 * New coding
				 */

				$.fn.initialize = function() {

					console.log("initialized : beds " +  memberInputBeds() + " bath " + memberInputBath() + " sqft " + memberInputSqft() );
					console.log(" admin input beds " + adminInputBeds());
					console.log("square foot calculation " + Math.round(calculateSqftCalc()));
					console.log("calculate Base Price " +  calculateBasePrice());
					console.log("calculate weekly " +  calculateWeekly());
					console.log("calculate 2 weeks " + calculateEvery2Weeks());
					console.log("calculate 4 weeks " + calculateEvery4Weeks());

					console.log("Get it clean " + calculateGetItClean());
					console.log("Deep clean " + calculateDeepClean());
					console.log("Keep Clean " +  calculateMoveInOut());

					console.log(" memberInputBeds() = " +memberInputBeds());
					console.log(" memberInputBath() = " +memberInputBath());
					console.log(" memberInputSqft() = " +memberInputSqft());
					console.log(" adminInputBeds() = " +adminInputBeds());
					console.log(" adminInputBath() = " +adminInputBath());
					console.log(" adminInputSqftBase() = " +adminInputSqftBase());
					console.log(" adminInputBaseValue() = " +adminInputBaseValue());
					console.log(" adminInputWeekly() = " +adminInputWeekly());
					console.log(" adminInputEvery2Weeks() = " +adminInputEvery2Weeks());
					console.log(" adminInputEvery4Weeks() = " +adminInputEvery4Weeks());
					console.log(" adminInputGetItClean() = " +adminInputGetItClean());
					console.log(" adminInputDeepClean() = " +adminInputDeepClean());
					console.log(" adminInputMoveInOut() = " +adminInputMoveInOut());
					console.log(" calculateSqftCalc() = " +calculateSqftCalc());
					console.log(" calculateBasePrice() = " +calculateBasePrice());
					console.log(" calculateWeekly() = " +calculateWeekly());
					console.log(" calculateEvery2Weeks() = " +calculateEvery2Weeks());
					console.log(" calculateEvery4Weeks() = " +calculateEvery4Weeks());
					console.log(" calculateGetItClean() = " +calculateGetItClean());
					console.log(" calculateDeepClean() = " +calculateDeepClean());
					console.log(" calculateMoveInOut() = " +calculateMoveInOut());

				}



				// User input
				function memberInputBeds() { return convertNumber($('#bed').val()); }

				function memberInputBath() { return convertNumber($('#bath').val()); }

				function memberInputSqft() { return convertNumber($('#footage').val()); }

				// Admin Input
				function adminInputBeds() { return beds; /*convertNumber('6.1');*/ }

				function adminInputBath() { return baths; /*convertNumber('14');*/ }

				function adminInputSqftBase() { return sqft; /*convertNumber('1000');*/ }

				function adminInputBaseValue() { return base; /*convertNumber('99');*/ }

				function adminInputWeekly() { return week; /*convertNumber('0.65');*/ }

				function adminInputEvery2Weeks() { return biweek; /*convertNumber('0.7');*/ }

				function adminInputEvery4Weeks() { return month; /*convertNumber('0.75');*/ }

				function adminInputGetItClean() { return getclean; /*convertNumber('1.4');*/ }

				function adminInputDeepClean() { return deepclean; /*convertNumber('1.5');*/ }

				function adminInputMoveInOut() { return moveinout; /*convertNumber('1.75'); */ }

				// Calculation
				function calculateSqftCalc() {
					var multiplier1 = 100;
					var multiplier2 = 3;
					var answer = 0;
					if(memberInputSqft() > adminInputSqftBase()) {
						answer = (memberInputSqft() - adminInputSqftBase())/multiplier1*multiplier2;
					}
					return answer;
				}

				function calculateBasePrice() {

					var totalBedsPrice     = adminInputBeds();
					var totalBathRoOmPrice = adminInputBath();
					var totalBaseValue     = adminInputBaseValue();
					var totalSquareFootCalculation = calculateSqftCalc();
					var totalBathRoom = memberInputBath();
					var totalBeds = memberInputBeds();
					//totalSquareFootCalculation = M3;
					var totalBasePrice = (totalBeds*totalBedsPrice) + (totalBathRoom*totalBathRoOmPrice) + totalBaseValue+totalSquareFootCalculation;
					return convertNumber(totalBasePrice);
				}

				function calculateWeekly() {
					return convertNumber(calculateBasePrice() * adminInputWeekly());
				}

				function calculateEvery2Weeks() {
					return  convertNumber(calculateBasePrice() * adminInputEvery2Weeks() );
				}

				function calculateEvery4Weeks() {
					return convertNumber(calculateBasePrice() * adminInputEvery4Weeks() );
				}

				function calculateGetItClean() {
					return convertNumber(calculateBasePrice() *  adminInputGetItClean());

				}

				function calculateDeepClean() {
					return convertNumber(calculateBasePrice() *  adminInputDeepClean());
				}

				function calculateMoveInOut() {

					return convertNumber(calculateBasePrice() *  adminInputMoveInOut());
				}

				// Helper
				function convertNumber(number) { return parseFloat(number) }



















				subtotal = base + (numBeds() * beds) + (numBaths() * baths) + (((squareFootage() - sqft > 0 ? squareFootage() - sqft : 0) / 100) * 3);

	var adjustment = subtotal;
	var recurringPrice = base;
	var recurringDiscount = 0;
	var firstclean = adjustment;
	var promodiscount = 0;
	var hours = adjustment / rate;

	var total = (subtotal - ($('.addon:not([value=""])').length * (addon)))
	if($('#repeat').val() && $('#repeat').val() != "One Time" && ($('#cleantype').val() == 'Keep It Clean' || !$('#cleantype').val()) && $('.addon[value=""]').length == 4)
    {
       $('#visit1').parent().parent().parent().hide();
       $('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
       $('#visit2').parent().parent().parent().show();
       $('#pvisit2').parent().parent().parent().parent().parent().parent().show();
    }
    else
    {
      $('#visit1').parent().parent().parent().show();
      $('#pvisit1').parent().parent().parent().parent().parent().parent().show();
    }
	$('#visit1').text('$' + Math.round(firstclean).toFixed(0))
    $('#pvisit1').text('$' + Math.round(firstclean).toFixed(0))
	$('#Ivisit1').val(Math.round(firstclean))
	$('#Ivisit2').val(Math.round(total))
	$('#visit2').text('$' + Math.round(total).toFixed(0))
	$('#pvisit2').text('$' + Math.round(total).toFixed(0))
	$('#subtotal').text('$' + subtotal.toFixed(0))
	$('#psubtotal').text('$' + subtotal.toFixed(0))
	$('#onetimeadjust').text('$' + subtotal.toFixed(0))
	$('#hour').text(hours.toFixed(1) + ' hours')
	$('#Ihour').text(hours.toFixed(1) + ' hours')
	
	$('#visit1').parent().parent().parent().hide();
    $('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
    $('#visit2').parent().parent().parent().hide();
    $('#pvisit2').parent().parent().parent().parent().parent().parent().hide();
    $('#subtotal').parent().hide();
	$('#psubtotal').parent().hide();
	$('#discountR').parent().hide();
	$('#pdiscountR').hide();
	$('#prodisc').hide();
	

	$('#field-bath').change(function(){
      alert("change field value now");
	})


	$('#bath, #bed').change(function() {



		/*
		console.log("change button");


		recurringDiscount /= adjustment;
		adjustment -= subtotal;
		
		recurringDiscount *= adjustment;
		
		subtotal = base + (numBeds() * beds) + (numBaths() * baths) + (((squareFootage() - sqft > 0 ? squareFootage() - sqft : 0) / 100) * 3);
		
		adjustment += subtotal;

		
		if(useDiscount)
		  firstclean = adjustment - discount - promodiscount;
		else
		  firstclean = adjustment - recurringDiscount - promodiscount;
		  
		  
		hours = adjustment / rate;

		$('#cleantype').val($(this).text());
		$('#Ihour').text(hours.toFixed(1) + ' hours');
		$('#hour').text(hours.toFixed(1) + ' hours')







		$('#visit1').text('$' + Math.round(firstclean).toFixed(0));
		$('#pvisit1').text('$' + Math.round(firstclean).toFixed(0));
		
		if($('#repeat').val() && $('#cleantype').val() && $('#footage').val())
		{		
        	if($('#repeat').val() && $('#repeat').val() != "One Time" && ($('#cleantype').val() == 'Keep It Clean' || !$('#cleantype').val()) && $('.addon[value=""]').length == 4)
        	{
          		$('#visit1').parent().parent().parent().hide();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        	}
        	else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        	{
          		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        	}
        	else if($('#cleantype').val() != 'Keep It Clean')
        	{
        		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
        	}
        	
        	$('#subtotal').parent().show();
			$('#psubtotal').parent().show();
			
			if(promodiscount <= 0)
			{
				$('#sub').hide();
			}
			else
			{
				$('#sub').show();
			}
			
			if(recurringDiscount <= 0 || $('#cleantype').val() == 'Keep It Clean')
			{
		    	$('#discountR').parent().hide();
            	$('#pdiscountR').hide();
			}
			else if($('#cleantype').val() != 'Keep It Clean')
			{
		    	$('#discountR').parent().show();
            	$('#pdiscountR').show();
			}
			
			$('#discountR').parent().hide();
            $('#pdiscountR').hide();
       }
       else
       {
       		$('#visit1').parent().parent().parent().hide();
          	$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          	$('#visit2').parent().parent().parent().hide();
          	$('#pvisit2').parent().parent().parent().parent().parent().parent().hide();
       		$('#subtotal').parent().hide();
			$('#psubtotal').parent().hide();
			$('#discountR').parent().hide();
			$('#pdiscountR').hide();
			$('#prodisc').hide();
       }
        
		$('#visit2').text('$' + Math.round(recurringPrice).toFixed(0));
		$('#pvisit2').text('$' + Math.round(recurringPrice).toFixed(0));
		$('#Ivisit1').val(Math.round(firstclean));
		$('#Ivisit2').val(Math.round(recurringPrice));
		$('#IdiscountR').val(Math.round(recurringDiscount));
		$('#subtotal').text('$' + adjustment.toFixed(0));
		$('#psubtotal').text('$' + adjustment.toFixed(0));
		$('#discountR').text('-$' + Math.round(recurringDiscount).toFixed(0));
		$('#pdiscountR').text('-$' + Math.round(recurringDiscount).toFixed(0)); 
		$('#onetimeadjust').val('$' + adjustment.toFixed(0))

		*/
			


		/**
		* Issue is that javascript won't recognize the decimal so need to change to a text field
		*/ 




		// var bathTotal = parseFloat($('#field-bath').val());

		// alert("total bath " + bathTotal);

		
  
	});











	$.fn.detectHideShowPriceContainer = function () { 
 
		if($('#footage').val() == '') {

			// alert("footage is emoty")
			// $('.right-container-price1').css('display', 'none');
		} else { 
			//che
			if($('#visit1').text() == '') {
				// $('.right-container-price1').css('display', 'none'); 
				// alert("footage is not empty");
			} else {
				// alert("footage is not empty and has price");
				// $('.right-container-price1').css('display', 'block');
			} 
		} 
	} 



	/**
	* Show hide right side container 
	*
	*/
	global.footage1 = 'empty';  
	global.weekly = '';  	
	global.clean = '';  



	$('.cleaning-container').click(function(){
		global.weekly = 'clicked'; 
		$.fn.hideShowPrice(); 
	});  
	$('.phone').click(function(){
	 	global.clean = 'clicked';  
		$.fn.hideShowPrice();
	}) 



	$.fn.hideShowPrice = function() {
		if(global.weekly  == 'clicked' && global.clean == 'clicked' && global.footage1 == 'not empty'){
			//display price 
			$('.right-container-price1').css('display', 'block');
		} else {
			$('.right-container-price1').css('display', 'none');
		} 
		// alert("price = " + global.showPrice)
	} 


	$('#footage').bind("keyup change", function(e) {
	//$('#footage').keyup(function(e) { 
		/**
		* if the footage field is empty
		* if not empty then show this field
		*/  
		// $.fn.detectHideShowPriceContainer(); 
		if($('#footage').val() == "") {
			global.footage1 = 'empty';  	
		} else {
			global.footage1 = 'not empty';  
		}
		$.fn.hideShowPrice();
		





		if(e.keyCode != 13)
		{
			recurringDiscount /= adjustment;
			adjustment -= subtotal;
			console.log(subtotal);
			
		
			subtotal = base + (numBeds() * beds) + (numBaths() * baths) + (((squareFootage() - sqft > 0 ? squareFootage() - sqft : 0) / 100) * 3);
		
			adjustment += subtotal;
			recurringDiscount *= adjustment;

		
			if(useDiscount)
		  		firstclean = adjustment - discount - promodiscount;
			else
		  		firstclean = adjustment - recurringDiscount - promodiscount;
		  
		  
			hours = adjustment / rate;
			
			$('#Ihour').text(hours.toFixed(1) + ' hours');
			$('#hour').text(hours.toFixed(1) + ' hours')
			$('#visit1').text('$' + Math.round(firstclean).toFixed(0));
			$('#pvisit1').text('$' + Math.round(firstclean).toFixed(0));
		
        	if($('#repeat').val() && $('#cleantype').val() && $('#footage').val())
			{		
        		if($('#repeat').val() && $('#repeat').val() != "One Time" && ($('#cleantype').val() == 'Keep It Clean' || !$('#cleantype').val()) && $('.addon[value=""]').length == 4)
        		{



          			$('#visit1').parent().parent().parent().hide();
          			$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          			$('#visit2').parent().parent().parent().show();
          			$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        		}
        		else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        		{
          			$('#visit1').parent().parent().parent().show();
          			$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
          			$('#visit2').parent().parent().parent().show();
          			$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        		}
        		else if($('#cleantype').val() != 'Keep It Clean')
        		{
        			$('#visit1').parent().parent().parent().show();
          			$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
        		}
        	
        		$('#subtotal').parent().show();
				$('#psubtotal').parent().show();
			
				if(promodiscount <= 0)
				{
					$('#sub').hide();
				}
				else
				{
					$('#sub').show();
				}
			
				if(recurringDiscount <= 0  || $('#cleantype').val() != 'Keep It Clean')
				{
		    		$('#discountR').parent().hide();
            		$('#pdiscountR').hide();
				}
				else if($('#cleantype').val() != 'Keep It Clean')
				{
		    		$('#discountR').parent().show();
            		$('#pdiscountR').show();
				}
				
				$('#discountR').parent().hide();
            	$('#pdiscountR').hide();
       		}
       		else
       		{
       			$('#visit1').parent().parent().parent().hide();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().hide();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().hide();
       			$('#subtotal').parent().hide();
				$('#psubtotal').parent().hide();
				$('#discountR').parent().hide();
				$('#pdiscountR').hide();
				$('#prodisc').hide();
       		}
        
			$('#visit2').text('$' + Math.round(recurringPrice).toFixed(0));
			$('#pvisit2').text('$' + Math.round(recurringPrice).toFixed(0));
			$('#Ivisit1').val(Math.round(firstclean));
			$('#Ivisit2').val(Math.round(recurringPrice));
			$('#IdiscountR').val(Math.round(recurringDiscount));
			$('#subtotal').text('$' + adjustment.toFixed(0));
			$('#psubtotal').text('$' + adjustment.toFixed(0));
			$('#discountR').text('-$' + Math.round(recurringDiscount).toFixed(0));
			$('#pdiscountR').text('-$' + Math.round(recurringDiscount).toFixed(0));
		
			$('#onetimeadjust').val('$' + adjustment.toFixed(0))
		}
	})
	
	var oldcleantype = null;
	$('.cleantype').click(function() {



		console.log("clean type clicked");


	    if(($(this).text() == 'Keep It Clean' && $('#repeat').val() != 'One Time') || $(this).text() != 'Keep It Clean')
	    {


			// getclean  = parseFloat("1.25");
			// deepclean = parseFloat("1.5");
			// moveinout = parseFloat("1.75");
			var textTab  = $(this).text();


			console.log(' first clean ' + firstclean + " price " + recurringPrice);

			console.log("get clean " + getclean + "deep clean " + deepclean + " move in out " +moveinout );

			console.log(" text == " + $(this).text());

			console.log("base price " + base);














			console.log("this not Keep It Clean || repeat not One Time  ||this Keep It Clean ");

		total += recurringDiscount;
		
		recurringDiscount /= adjustment;


		if(oldcleantype == 'Keep It Clean')
		{
		    adjustment /= keepclean;
		    total /= keepclean;
		}
		else if (oldcleantype == 'Get it Clean') 
		{
		    adjustment /= getclean;
		    total /= getclean; 
		}
		else if (oldcleantype == 'Deep Clean') {
			adjustment /= deepclean;
			total /= deepclean;
			total -= recurringDiscount;
		} else if (oldcleantype == 'Move In/Out') {
			adjustment /= moveinout;
			total /= moveinout
		}

		if ($(this).text() == 'Keep It Clean')
		{
		    adjustment *= keepclean;
		    recurringDiscount *= adjustment;
		    total *= keepclean;
		    total -= recurringDiscount;
		}
		else if ($(this).text() == 'Get it Clean')
		{
		    adjustment *= getclean;
		    recurringDiscount *= adjustment;
		    total *= getclean;
		    total -= recurringDiscount;
		}
		else if ($(this).text() == 'Deep Clean') 
		{
			adjustment *= deepclean;
			recurringDiscount *= adjustment;
			total *= deepclean;
			total -= recurringDiscount;
		} 
		else if ($(this).text() == 'Move In/Out') 
		{
			adjustment *= moveinout;
			recurringDiscount *= adjustment;
			total *= moveinout;
			total -= recurringDiscount;
		}









		if(useDiscount)
		  firstclean = adjustment - discount - promodiscount;
		else
		  firstclean = adjustment - recurringDiscount - promodiscount;


		hours = adjustment / rate;

		// Calculate keep it clean, deep clean and move in out
			firstclean =  $.fn.calculateFirstCleanByKeepItCleanGetCleanMoveInOut(textTab);
//	    calculateFirstCleanByKeepItCleanGetCleanMoveInOut(textTab);


			//$('#visit1').text(Math.floor((Math.random() * 10) + 1));
		  	//	 	return;


			console.log("cleaning total = " + firstclean);

		$('#cleantype').val($(this).text());
		$('#Ihour').text(hours.toFixed(1) + ' hours');
		$('#hour').text(hours.toFixed(1) + ' hours');
		$('#visit1').text('$' + Math.round(firstclean).toFixed(0));
		$('#pvisit1').text('$' + Math.round(firstclean).toFixed(0));
		
        if($('#repeat').val() && $('#cleantype').val() && $('#footage').val())
		{		
        		if($('#repeat').val() && $('#repeat').val() != "One Time" && ($('#cleantype').val() == 'Keep It Clean' || !$('#cleantype').val()) && $('.addon[value=""]').length == 4)
        	{
          		$('#visit1').parent().parent().parent().hide();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        	}
        	else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        	{
          		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        	}
        	else if($('#cleantype').val() != 'Keep It Clean')
        	{
        		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
        	}
        	
        		$('#subtotal').parent().show();
				$('#psubtotal').parent().show();
			
				if(promodiscount <= 0)
				{
					$('#sub').hide();
				}
				else
				{
					$('#sub').show();
				}
			
				if(recurringDiscount <= 0 || $('#cleantype').val() == 'Keep It Clean')
				{
		    		$('#discountR').parent().hide();
            		$('#pdiscountR').hide();
				}
				else if($('#cleantype').val() != 'Keep It Clean')
				{
		    		$('#discountR').parent().show();
            		$('#pdiscountR').show();
				}
				
				$('#discountR').parent().hide();
            	$('#pdiscountR').hide();
       		}
       		else
       		{
       			$('#visit1').parent().parent().parent().hide();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().hide();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().hide();
       			$('#subtotal').parent().hide();
				$('#psubtotal').parent().hide();
				$('#discountR').parent().hide();
				$('#pdiscountR').hide();
				$('#prodisc').hide();
       		}
       		
			$('#visit2').text('$' + Math.round(recurringPrice).toFixed(0))
			$('#pvisit2').text('$' + Math.round(recurringPrice).toFixed(0))
			$('#Ivisit1').val(Math.round(firstclean))
			$('#Ivisit2').val(Math.round(recurringPrice))
			$('#IdiscountR').val(Math.round(recurringDiscount))
			$('#subtotal').text('$' + adjustment.toFixed(0))
			$('#psubtotal').text('$' + adjustment.toFixed(0))
			$('#discountR').text('-$' + Math.round(recurringDiscount).toFixed(0))
			$('#pdiscountR').text('-$' + Math.round(recurringDiscount).toFixed(0))
			$('#pcleantype').text($('#cleantype').val());
			
			$('#onetimeadjust').val('$' + adjustment.toFixed(0))
			oldcleantype = $('#cleantype').val()
			
			 $('#visit1').parent().prev().text($('#repeat').val() == 'One Time' ? 'Your Clean' : 'First Clean');
            $('#pvisit1').parent().parent().prev().children().text($('#repeat').val() == 'One Time' ? 'Your Clean' : 'First Clean');
            
            
           
		}
		else
		{
			console.log("else - no calculation happens");
		}
	})


/*

	$('.addon').click(function() {


		recurringDiscount *= 1 / adjustment;
		if ($(this).val() == 0) {
			adjustment -= addon;
			total -= addon;
			
			if($(this).is('#fridge'))
				$('#pfridge').hide();
			else if($(this).is('#stove'))
				$('#pstove').hide();
			else if($(this).is('#window'))
				$('#pwindow').hide();
			else if($(this).is('#wall'))
				$('#pbedsteam').hide();
				
		} else {
			adjustment += addon;
			total += addon;
			
			if($(this).is('#fridge'))
				$('#pfridge').show();
			else if($(this).is('#stove'))
				$('#pstove').show();
			else if($(this).is('#window'))
				$('#pwindow').show();
			else if($(this).is('#wall'))
				$('#pbedsteam').show();
		}

		recurringDiscount *= adjustment;

		if(useDiscount)
          firstclean = adjustment - discount - promodiscount;
        else
          firstclean = adjustment - recurringDiscount - promodiscount;
          
		hours = adjustment / rate;


		$('#hour').text(hours.toFixed(1) + ' hours')
		$('#Ihour').text(hours.toFixed(1) + ' hours')
		$('#visit2').text('$' + Math.round(recurringPrice).toFixed(0))
		$('#pvisit2').text('$' + Math.round(recurringPrice).toFixed(0))
		$('#visit1').text('$' + Math.round(firstclean).toFixed(0));
        $('#pvisit1').text('$' + Math.round(firstclean).toFixed(0));
        if($('#repeat').val() && $('#cleantype').val() && $('#footage').val())
		{		
        	if($('#repeat').val() && $('#repeat').val() != "One Time" && ($('#cleantype').val() == 'Keep It Clean' || !$('#cleantype').val()) && $('.addon[value=""]').length == 4)
        	{
          		$('#visit1').parent().parent().parent().hide();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        	}
        	else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        	{
          		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        	}
        	else if($('#cleantype').val() != 'Keep It Clean')
        	{
        		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
        	}
        	
        	$('#subtotal').parent().show();
			$('#psubtotal').parent().show();
			
			if(promodiscount <= 0)
			{
				$('#sub').hide();
			}
			else
			{
				$('#sub').show();
			}
			
			if(recurringDiscount <= 0 || $('#cleantype').val() == 'Keep It Clean')
			{
		    	$('#discountR').parent().hide();
            	$('#pdiscountR').hide();
			}
			else if($('#cleantype').val() != 'Keep It Clean')
			{
		    	$('#discountR').parent().show();
            	$('#pdiscountR').show();
			}
			
			$('#discountR').parent().hide();
            $('#pdiscountR').hide();
       }
       else
       {
       		$('#visit1').parent().parent().parent().hide();
          	$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          	$('#visit2').parent().parent().parent().hide();
          	$('#pvisit2').parent().parent().parent().parent().parent().parent().hide();
       		$('#subtotal').parent().hide();
			$('#psubtotal').parent().hide();
			$('#discountR').parent().hide();
			$('#pdiscountR').hide();
			$('#prodisc').hide();
       }
		$('#Ivisit1').val(Math.round(firstclean).toFixed(0))
		$('#Ivisit2').val(Math.round(recurringPrice).toFixed(0))
		$('#IdiscountR').val(Math.round(recurringDiscount).toFixed(0))
		$('#discountR').text('-$' + Math.round(recurringDiscount).toFixed(0))
		$('#pdiscountR').text('-$' + Math.round(recurringDiscount).toFixed(0))
		
		$('#onetimeadjust').val('$' + adjustment.toFixed(0))
		$('#subtotal').text('$' + adjustment.toFixed(0))
		$('#psubtotal').text('$' + adjustment.toFixed(0))
	})

*/


	



	

	$('.addon').click(function() {



		// alert("addons clicked  addons " + addon);



		 //$('#field-bath').val(bathRoomUnit(bed)); 
        // var cleanType = $('#cleantype').val().toLowerCase();  
        // var firstclean = $.fn.calculateFirstCleanByKeepItCleanGetCleanMoveInOut(cleanType);    
        // $('#visit1').text( '$' + Math.round(firstclean));
        // $('#pvisit1').text( '$' + Math.round(firstclean)); 
 		
 		var countaddon = '';
 
 		$('.addon').each(function(){
 		
 			if($(this).val()!=""){
 				countaddon = 1;
 			}
 		
 		})	
 	
 		if(countaddon==1){
 		
 			$('.right-container-price1 .summary div b.priceHolderfclean').css('display','inline')
 		
 		}else{
 		
 			$('.right-container-price1 .summary div b.priceHolderfclean').css('display','none')
 			
 		}

	
		// recurringDiscount *= 1 / adjustment;
		if ($(this).val() == 0) {
		 	


			 global.totalAddOns-= addon;


			
			if($(this).is('#fridge'))
				$('#pfridge').hide();
			else if($(this).is('#stove'))
				$('#pstove').hide();
			else if($(this).is('#window'))
				$('#pwindow').hide();
			else if($(this).is('#wall'))
				$('#pbedsteam').hide();
				
		} else {

			  global.totalAddOns+= addon;


			 
			if($(this).is('#fridge'))
				$('#pfridge').show();
			else if($(this).is('#stove'))
				$('#pstove').show();
			else if($(this).is('#window'))
				$('#pwindow').show();
			else if($(this).is('#wall'))
				$('#pbedsteam').show();
				
				
		}	 
		// alert(" global addons " + global.totalAddOns);  
		$.fn.plusAndMinusButtonClickedAutoCalculate(); 
		/*
		recurringDiscount *= adjustment;

		if(useDiscount)
          firstclean = adjustment - discount - promodiscount;
        else
          firstclean = adjustment - recurringDiscount - promodiscount;
          
		hours = adjustment / rate;

		
		$('#hour').text(hours.toFixed(1) + ' hours')
		$('#Ihour').text(hours.toFixed(1) + ' hours')
		$('#visit2').text('$' + Math.round(recurringPrice).toFixed(0))
		$('#pvisit2').text('$' + Math.round(recurringPrice).toFixed(0))
		$('#visit1').text('$' + Math.round(firstclean).toFixed(0));
        $('#pvisit1').text('$' + Math.round(firstclean).toFixed(0));
        if($('#repeat').val() && $('#cleantype').val() && $('#footage').val())
		{		
        	if($('#repeat').val() && $('#repeat').val() != "One Time" && ($('#cleantype').val() == 'Keep It Clean' || !$('#cleantype').val()) && $('.addon[value=""]').length == 4)
        	{
          		$('#visit1').parent().parent().parent().hide();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        	}
        	else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        	{
          		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        	}
        	else if($('#cleantype').val() != 'Keep It Clean')
        	{
        		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
        	}
        	
        	$('#subtotal').parent().show();
			$('#psubtotal').parent().show();
			
			if(promodiscount <= 0)
			{
				$('#sub').hide();
			}
			else
			{
				$('#sub').show();
			}
			
			if(recurringDiscount <= 0 || $('#cleantype').val() == 'Keep It Clean')
			{
		    	$('#discountR').parent().hide();
            	$('#pdiscountR').hide();
			}
			else if($('#cleantype').val() != 'Keep It Clean')
			{
		    	$('#discountR').parent().show();
            	$('#pdiscountR').show();
			}
			
			$('#discountR').parent().hide();
            $('#pdiscountR').hide();
       }
       else
       {
       		$('#visit1').parent().parent().parent().hide();
          	$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          	$('#visit2').parent().parent().parent().hide();
          	$('#pvisit2').parent().parent().parent().parent().parent().parent().hide();
       		$('#subtotal').parent().hide();
			$('#psubtotal').parent().hide();
			$('#discountR').parent().hide();
			$('#pdiscountR').hide();
			$('#prodisc').hide();
       }
		$('#Ivisit1').val(Math.round(firstclean).toFixed(0))
		$('#Ivisit2').val(Math.round(recurringPrice).toFixed(0))
		$('#IdiscountR').val(Math.round(recurringDiscount).toFixed(0))
		$('#discountR').text('-$' + Math.round(recurringDiscount).toFixed(0))
		$('#pdiscountR').text('-$' + Math.round(recurringDiscount).toFixed(0))
		
		$('#onetimeadjust').val('$' + adjustment.toFixed(0))
		$('#subtotal').text('$' + adjustment.toFixed(0))
		$('#psubtotal').text('$' + adjustment.toFixed(0))

		*/
	})










	$('.repeat').click(function() {
		$('#repeat').val($(this).text());
		
		if ($('#repeat').val() == 'One Time') {
			recurringDiscount = 0;
			
			if($('#cleantype').val() == 'Keep It Clean')
				$('#cleantype').val('')
				
			$('.cleantype').first().css({
				'border-color': '#b4d0c2',
				'background-color': '#FFF',
				'color': '#000'
			}).hide();
			
		} else {


			console.log("repeat clicked as one time but else");
		  $('.cleantype').first().show();
		  
		  if ($('#repeat').val() == 'Every Week') {
			  console.log("clicked is every week");
			recurringDiscount = (1 - week) * adjustment;
			recurringPrice = subtotal * week;
			console.log(recurringPrice);
		  } else if ($('#repeat').val() == 'Every 2 Weeks') {

			  console.log("clicked is every 2 weeks");
			recurringDiscount = (1 - biweek) * adjustment;
			recurringPrice = subtotal * biweek;
		  } else if ($('#repeat').val() == 'Every 4 Weeks') {

			  console.log("clicked is every 4 weeks");
			recurringPrice = subtotal * month;
			recurringDiscount = (1 - month) * adjustment;
		  }
        }


        
        

		if(useDiscount)
          firstclean = adjustment - discount - promodiscount;
        else
          firstclean = adjustment - recurringDiscount - promodiscount;
          
		hours = adjustment / rate;













		var $weekTab = $('#repeat').val();

		console.log('successfully calculated');
		console.log('visit1 value first clean = ' + firstclean);
		console.log('visit2 value prices for weekly = ' + recurringPrice);

		console.log('visit1 repeat  = ' + $('#repeat').val());
		console.log('base ' + base);
		console.log('rate  ' + biweek);
		console.log("member input bed " + memberInputBeds());


		console.log("new");



		//		console.log("weekly " + calculateWeekly());
		//		console.log("every 2 weeks " + calculateEvery2weeks());
		//		console.log("every 4 weeks " + calculateEvery4weeks());
		//
		//		calculateEvery2weeks();
		//		if ($weekTab == 'Every Week') {
		//			recurringPrice = calculateWeekly();
		//		} else if ($weekTab == 'Every 2 Weeks') {
		//			recurringPrice = calculateEvery2weeks();
		//		} else if ($weekTab == 'Every 4 Weeks') {
		//			recurringPrice = calculateEvery4weeks();
		//		}
		//
		//

//		console.log("weekly " + calculateWeekly());
//		console.log("every 2 weeks " + calculateEvery2weeks());
//		console.log("every 4 weeks " + calculateEvery4weeks());
//

//		if ($weekTab == 'Every Week') {
//			recurringPrice = calculateWeekly();
//		} else if ($weekTab == 'Every 2 Weeks') {
//			recurringPrice = calculateEvery2weeks();
//		} else if ($weekTab == 'Every 4 Weeks') {
//			recurringPrice = calculateEvery4weeks();
//		}
//
//


		var repeatText = $('#repeat').val().toLowerCase();


		console.log("repeat text " + repeatText);












		console.log("repeat text " + repeatText);



		$('#hour').text(hours.toFixed(1) + ' hours');
		$('#Ihour').text(hours.toFixed(1) + ' hours');

//
//		if ($('#repeat').val() == 'One Time') {
//			$('#visit1').text('$' + basePrice());
//		} else {
//
//		}

		console.log("week tab " + repeatText);

		if(repeatText == 'every week') {
				console.log("every week");
			recurringPrice = calculateWeekly();
		} else if (repeatText == 'every 2 weeks'){
			console.log("every 2 weeks");
			recurringPrice = calculateEvery2Weeks();
		} else if (repeatText == 'every 4 weeks') {
			console.log("every 4 weeks");
			recurringPrice =  calculateEvery4Weeks();
		}





		console.log("recurring price " + recurringPrice);

		if (repeatText == 'one time') {
			$('#visit1').text('$' + calculateBasePrice());
			$('#pvisit1').text('$' + calculateBasePrice());

		} else {

		}


//			$('#pvisit1').text('$' + Math.round(firstclean).toFixed(0));
        if($('#repeat').val() && $('#cleantype').val() && $('#footage').val())
		{		
        	if($('#repeat').val() && $('#repeat').val() != "One Time" && ($('#cleantype').val() == 'Keep It Clean' || !$('#cleantype').val()) && $('.addon[value=""]').length == 4)
        	{
          		$('#visit1').parent().parent().parent().hide();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        	}
        	else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        	{
          		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().parent().parent().parent().show();
        	}
        	else if($('#cleantype').val() != 'Keep It Clean')
        	{
        		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().parent().parent().parent().show();
        	}
        	
        	
        	
        	$('#subtotal').parent().show();
			$('#psubtotal').parent().show();
			
			if(promodiscount <= 0)
			{
				$('#sub').hide();
			}
			else
			{
				$('#sub').show();
			}
			
			if(recurringDiscount <= 0 || $('#cleantype').val() == 'Keep It Clean')
			{
		    	$('#discountR').parent().hide();
            	$('#pdiscountR').hide();
			}
			else if($('#cleantype').val() != 'Keep It Clean')
			{
		    	$('#discountR').parent().show();
            	$('#pdiscountR').show();
			}
			
			$('#discountR').parent().hide();
            $('#pdiscountR').hide();
            
            $('#visit1').parent().prev().text($('#repeat').val() == 'One Time' ? 'Your Clean' : 'First Clean');
            $('#pvisit1').parent().parent().prev().children().text($('#repeat').val() == 'One Time' ? 'Your Clean' : 'First Clean');
       }
       else
       {
       		$('#visit1').parent().parent().parent().hide();
          	$('#pvisit1').parent().parent().parent().parent().parent().parent().hide();
          	$('#visit2').parent().parent().parent().hide();
          	$('#pvisit2').parent().parent().parent().parent().parent().parent().hide();
       		$('#subtotal').parent().hide();
			$('#psubtotal').parent().hide();
			$('#discountR').parent().hide();
			$('#pdiscountR').hide();
			$('#prodisc').hide();
       }




		$('#visit2').text('$' + Math.round(recurringPrice).toFixed(0));
		$('#pvisit2').text('$' + Math.round(recurringPrice).toFixed(0));
		$('#Ivisit1').val(Math.round(firstclean));
		$('#Ivisit2').val(Math.round(recurringPrice));
		$('#IdiscountR').val(Math.round(recurringDiscount));
		$('#discountR').text('-$' + Math.round(recurringDiscount).toFixed(0));
		$('#pdiscountR').text('-$' + Math.round(recurringDiscount).toFixed(0));
		
		$('#onetimeadjust').val('$' + adjustment.toFixed(0));
	})
	

	// Desktop
	$('.applyPromoBtn-desktop').click(function(e) {
		e.preventDefault();

		$.ajax({
			url : 'get_coupon.php?code=' + $('.promo-desktop').val().trim(),
			type : 'get',
			dataType : 'json',
			success : function(data) {
				if (data) {
					if (data.percent_off) {
						promodiscount = (data.percent_off / 100) * adjustment;
						firstclean = adjustment - recurringDiscount - promodiscount;
					} else if (data.amount_off) {
						promodiscount = data.amount_off / 100;
						firstclean = adjustment - recurringDiscount - promodiscount;
					}

					if(useDiscount)
                        firstclean = adjustment - discount - promodiscount;
                    else
                        firstclean = adjustment - recurringDiscount - promodiscount;

					$('#discountP').text('-$' + promodiscount.toFixed(0)).parent().show().parent().show();
					$('#pdiscountP').text('-$' + promodiscount.toFixed(0)).parent().show().parent().show().parent().show().parent().show().parent().show().parent().show().parent().show();
					document.getElementById('sub').style.display = "block";
					$('#Ivisit1').val((firstclean * 100).toFixed(0));
					$('#visit1').text('$' + firstclean.toFixed(0));
					$('#pvisit1').text('$' + firstclean.toFixed(0));
					$('#promomobile').show();
				} else {
					alert("Invalid promo code");
				}
			},
			error : function(xhr) {
				xhr = JSON.parse(xhr.responseText);
				alert(xhr.Message);
			}
		})
	});

	// Mobile 
	$('.applyPromoBtn-mobile').click(function(e) {
		e.preventDefault();

		$.ajax({
			url : 'get_coupon.php?code=' + $('.promo-mobile').val().trim(),
			type : 'get',
			dataType : 'json',
			success : function(data) {
				if (data) {
					if (data.percent_off) {
						promodiscount = (data.percent_off / 100) * adjustment;
						firstclean = adjustment - recurringDiscount - promodiscount;
					} else if (data.amount_off) {
						promodiscount = data.amount_off / 100;
						firstclean = adjustment - recurringDiscount - promodiscount;
					}

					if(useDiscount)
                        firstclean = adjustment - discount - promodiscount;
                    else
                        firstclean = adjustment - recurringDiscount - promodiscount;

					$('#discountP').text('-$' + promodiscount.toFixed(0)).parent().show().parent().show();
					$('#pdiscountP').text('-$' + promodiscount.toFixed(0)).parent().show().parent().show().parent().show().parent().show().parent().show().parent().show().parent().show();
					$('#promomobile').show();
					document.getElementById('sub').style.display = "block";
					$('#Ivisit1').val((firstclean * 100).toFixed(0));
					$('#visit1').text('$' + firstclean.toFixed(0));
					$('#pvisit1').text('$' + firstclean.toFixed(0));

				} else {
					alert("Invalid promo code");
				}
			},
			error : function(xhr) {
				xhr = JSON.parse(xhr.responseText);
				alert(xhr.Message);
			}
		})
	}); 
 
	});
		</script>
<style>
	.border2pxred{
		border:2px solid red !important;
	}
    .payment-errors {
        display: none;
    }
    
   .input-group-addon:last-child {
    border-left: 0 none;
	}
	.input-group .form-control:last-child, .input-group-addon:last-child, .input-group-btn:last-child > .btn, .input-group-btn:last-child > .dropdown-toggle, .input-group-btn:first-child > .btn:not(:first-child) {
		border-bottom-left-radius: 0;
		border-top-left-radius: 0;
	}
	.input-group-addon2 {
		border: 1px solid #dcdcdc !important;
	}
	.input-group-addon2 {
		border-bottom: 3px solid #ccc;
		border-radius: 0;
		border-right: 3px solid #ccc;
		border-top: 3px solid #ccc;
	}
	.input-group-addon2 {
		background-color: #ffffff;
		border-bottom: 1px solid #cccccc;
		border-radius: 4px;
		border-right: 1px solid #cccccc;
		border-top: 1px solid #cccccc;
		color: #555555;
		font-size: 14px;
		font-weight: normal;
		line-height: 1;
		padding: 6px 12px;
		text-align: center;
	}
	.input-group-addon2, .input-group-btn {
		vertical-align: middle;
		white-space: nowrap;
		width: 1%;
	} 
	.input-group-addon2, .input-group-btn, .input-group .form-control {
		display: table-cell;
	}
	.ccCard span.has-error{
		bottom: -21px;
		left: 0;
		position: absolute;
	}    
	#continue2{
	  font-size: 28px;
	}
	.btn-line.btn-default{
		height:60px !important;
	}	
</style>




<script type="text/javascript"> 

	$(document).ready(function(){
		var explode = function(){
	 	// 	$('.display-container').css('display','block');
			// $('.container-cover').css('display', 'none'); 
			console.log('set time out is working');
		};
		setTimeout(explode, 5000); 	
	});


    $( document ).ready(function() {
        console.log( "1 document loaded" );
    });
 
    $( window ).load(function() {
        console.log( "2 window loaded" );
        $('.display-container').css('display','block');
		$('.container-cover').css('display', 'none'); 
		console.log('set time out is working');
    });
  
</script>


 
	<script type="text/javascript" src="assets/js/buttons.js"></script>


	</head>
	<!-- END HEAD -->

	<!-- BEGIN BODY -->
	<body style="background-color: white" onload="init();"> 
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
	<!--FSHEEN-->
	<div class="modal_body_faq">
		<div class="modal_content_faq">
		<div class="triagle"><img src="assets/img/triangleft.png" class="triangleft"></div>
		<a class="close" id="close1">&times;</a>
		<h2>FOR ASK AND QUESTION</h2>
			<div class=" et_pb_row et_pb_row_0">
				
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_0">
				<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_0">
									
					<p><strong>Why Us?</strong></p>
					<p><strong>Our Advanced&nbsp;</strong><strong>Cleaning Approach</strong></p>
					<p>Naturalcare Cleaning Service takes a smarter approach to cleaning your home. Conventional cleaning methods merely mask dirt and bacteria and leave a residue that can actually attract dust and grime. Naturalcare’s high-temperature cleaning system and scientifically-balanced cleaning products, on the other hand, eliminate bacteria and prevent future build-up.</p>
					<p>We start by applying advanced steam technology to all your hard surfaces, including kitchen and bathroom counters, sinks, faucets, toilets, tubs, and floors. Our dry steam vapor system:</p>
					<ul>
					<li>kills bacteria and germs;</li>
					<li>removes grease and oil;</li>
					<li>deodorizes surfaces on contact;</li>
					<li>eliminates dirt and grime;</li>
					<li>wipes out mold, mildew, dust, and other allergens;</li>
					<li>uses less than one quart of water to clean an entire home;</li>
					<li>is safe for all flooring and hard surfaces; and</li>
					<li>leaves no residue.</li>
					</ul>
					<p>The superheated LadyBug Dry Steam Vapor System penetrates deep into all hard surfaces to completely remove dirt and odors instead of spreading them around or covering them up like conventional chemical cleaners. An EPA-certified disinfectant, our steam vapor system cleans more effectively than chemical alternatives and prevents future build-up better than any other cleaning method.</p>
					<p>For heavier build-up and stains, we apply a powder peroxide in hot water, adding citric acid and natural oils as needed. Our microfiber cloths eliminate 99% of all bacteria, compared to the 33% that regular cloths remove. And because we color-code our cloths, bathroom cloths will only be used in the bathroom, not in the kitchen or on other surfaces, preventing cross-contamination.</p>
					<p>Get a smarter clean today.&nbsp;<a href="https://naturalcarecleaningservice.com/estimate/">Contact us for a quote</a>&nbsp;or to&nbsp;<a href="https://naturalcarecleaningservice.com/contact-us/">learn more about what we do</a>&nbsp;. We are more than happy to explain our processes and the technology behind Naturalcare’s advanced clean.</p>
					<p><strong>Our Customer Service Pledge</strong></p>
					<p>Naturalcare does not stop with a superior clean. We also deliver superior customer service. After every clean, you will receive an e-mail through which you can review your latest cleaning. We follow up for details about any complaints and call all of our customers who do not respond via e-mail.</p>
					<p>We average the rankings for each of our cleaners and post them for our employees so that they know how well they are doing and what they can do to improve. Due to these efforts, we’ve been the highest-rated cleaning service in Houston on Angie’s List since ____.</p>
					<p><a href="https://naturalcarecleaningservice.com/contact-us/">Contact us today to schedule your first cleaning.</a></p>

			</div> <!-- .et_pb_text -->
			</div> <!-- .et_pb_column -->
					
			</div>
		</div>
	</div>
	
	
	
	
	<div class="modal_body">
		<div class="modal_content">
		<?php
			if(isset($_POST['name']) OR isset($_POST['address'])){
				print_r($_POST['name']);
			}

		?>
		<div class="triagle"><img src="assets/img/triangleft.png" class="triangleft"></div>
		<a class="close"id="close">&times;</a>
		<h2>Edit your Information</h2>
			<div style="padding-left:0px;" class="error-success-wrapper"></div>
			<form role="form"  id="idForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<div class="form-group" style="padding-left:0px !important;">
					<label for="Name">Name:</label>
					<input type="text" name="fname" class="form-control" value="<?= isset($_SESSION['FirstName'])?$_SESSION['FirstName']:'' ?> <?= isset($_SESSION['LastName'])?$_SESSION['LastName']:'' ?>" required>
				</div>
				
				<div class="form-group" style="padding-left:0px !important;">
					<label for="phone">Phone Number:</label>
					<input id="numberEdit" name="phonenum" value="<?= isset($_SESSION['phonenum'])?$_SESSION['phonenum']:'' ?>" class="form-control phonenum" data-mask="(999) 999-9999" placeholder="Phone" />
				</div>
				
				<div class="form-group" style="padding-left:0px !important;">
					<label for="address">Address:</label>
					<input type="text" id="locationTextField" name="Address" class="form-control"  value="<?= isset($_SESSION['Address'])?$_SESSION['Address']:'' ?>" required>
					
				</div>
				 <table id="address" style="display:none">
					  <tr>
						
						<td class="label">Street address</td>
						<td class="slimField"><input value="<?= isset($_SESSION['street_number'])?$_SESSION['street_number']:'' ?>" class="field" id="street_number" name="street_number"
							  ></input>
							  
					 <input name="Email2" value="<?= isset($_SESSION['Email'])?$_SESSION['Email']:'' ?>"  class="form-control" placeholder="Email" />
							  </td>
						<td class="wideField" colspan="2"><input name="route"  value="<?= isset($_SESSION['route'])?$_SESSION['route']:'' ?>"  class="field" id="route" name="route"
							  ></input></td>
					  </tr>
					  <tr>
						<td class="label">City</td>
						<td class="wideField" colspan="3"><input name="city" value="<?= isset($_SESSION['city'])?$_SESSION['city']:'' ?>" class="field" name="locality" id="locality"
							  ></input></td>
					  </tr>
					  <tr>
						<td class="label">State</td>
						<td class="slimField"><input name="State" value="<?= isset($_SESSION['State'])?$_SESSION['State']:'' ?>" class="field" name="State"
							  id="administrative_area_level_1" ></input></td>
						<td class="label">Zip code</td>
						<td class="wideField"><input name="PostalCode" value="<?= isset($_SESSION['PostalCode'])?$_SESSION['PostalCode']:'' ?>" class="field" name="PostalCode" id="postal_code" /></td>
					  </tr>
					  <tr>
						<td class="label">Country</td>
						<td class="wideField" colspan="3"><input name="country" value="<?= isset($_SESSION['Country'])?$_SESSION['Country']:'' ?>" class="field"
							  id="country" ></input></td>
					  </tr>
					</table>
				<input type="submit" class="btn btn-default" value = "Update">
			</form>
		</div>
	</div>
	
	
	
	
	
	
	
	
	
	
	
		<!-- Session here for recurring: <br> -->
		<?php  
			//echo " Service Type = " . $_SESSION['ServiceType'] . '<br>';
			// name=
			// value= Recurring 
		?> 
		<center>
			<div class="container-cover">
			      <p> 
			        <img src="http://naturalcarecleaningservice.com/wp-content/uploads/2016/04/spinner.gif">
			   	 </p>
		     </div> 
		</center>




		
 

		<div style="display:none; padding-left:0px;" class="display-container">




	    <div style="background: #ddd; height: 7px; display: none"></div>		

	    		<!-- TOP ROW HEADER -->
	    <div class="row" style="background-color: #444; padding-top: 10px;padding-bottom: 10px; display:none">


            <div class="col-xs-12 col-md-6 col-sm-8 col-lg-5 col-lg-offset-1 col-md-offset-3" style="display:none">
                <a href="https://naturalcarecleaningservice.com/">
                    <img src="https://naturalcarecleaningservice.com/wp-content/uploads/2016/01/new-logo-all-white-line-on-black.png" height="60px" alt="Naturalcare Cleaning Service" id="logo">
    
                </a>
            </div>



        </div>

        <div style="background: #daeef3; height: 7px;"></div>


        
		<!-- MAIN WRAPPER -->
		<div class="container-fluid container-header-menu" id="wrap" style="padding: 0px ">



		<div class="container container-content"> 
		    <div class="testing-logo">
			    <div class="row">

				    <div class="col-sm-6"> 
 
					    <a class="header-logo-desktop" href="https://naturalcarecleaningservice.com/" style=" ">
							<img src="https://naturalcarecleaningservice.com/wp-content/uploads/2016/01/new-logo-all-white-line-on-black.png" height="60px" alt="Naturalcare Cleaning Service" id="logo"> 
						</a>

						<a class="header-logo-mobile" href="https://naturalcarecleaningservice.com/" style=" ">
							<img src="https://naturalcarecleaningservice.com/wp-content/uploads/2016/01/header-logo-mobile.png" height="60px" alt="Naturalcare Cleaning Service" id="logo"> 
						</a>
				   	</div> 


				    <div class="col-sm-6"> 
					    <div class="menu-link"> 


							&nbsp; &nbsp; 
					        <a id="modal_form_faq-desktop" class="desktop header-faq-desktop" target="_blank" style="float:right; padding-left:20px;">
					          FAQ
					        </a> 


							<a href="#" id="modal_form_faq" class="mobile header-faq-mobile" style="float:right; padding-left:20px;">
					          FAQ
					        </a> 
					  		&nbsp; &nbsp; 
							<a href="tel:281-531-0544" >
								<span class="glyphicon glyphicon-earphone menu-phone" aria-hidden="true" ></span>
							</a> 
							&nbsp; &nbsp; 
					        <a  class="menu-phone-contact-us" href="tel:281-531-0544" >
					       		281-531-0544
					        </a> 
					      </div>
				      </div>
			      </div>
		      </div>
	      </div>
 	<!-- 
			<div class="container container-content" style="display:none"> 
				<div class="testing-logo">
					<div class="row" style="padding-left:0px !important;">
						<div class="col-md-6" >
							<a href="https://naturalcarecleaningservice.com/" style="/* border: 1px solid red; */">
								<img src="https://naturalcarecleaningservice.com/wp-content/uploads/2016/01/new-logo-all-white-line-on-black.png" height="60px" alt="Naturalcare Cleaning Service" id="logo">
							</a>
						</div>
						<div class="col-md-2  col-md-offset-4 link" >
							<div class="col-md-4">
								<a href="#" class="desktop">FAQ<span class="glyphicon glyphicon-earphone menu-phone" aria-hidden="true"></span></a>
								<a href="#" class="mobile" id="modal_form_faq">FAQ<span class="glyphicon glyphicon-earphone menu-phone" aria-hidden="true"></span></a>
							</div>
							<div class="col-md-8">
								<a href="#">Contact us</a>
							</div>
						</div> 
					</div>
				</div> 
		 
 -->



		 	<div class="page-padding"> </div>


			<!--PAGE CONTENT -->

			<div id="form" class="container-fluid" style="min-height:0px; padding:0px"></div>
			<div style="padding:0px" class="panel panel-default" >

				<div class="panel-body container-fluid" style="padding:0px;">
				    
				    
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="step1" role="form">
						<span class="payment-errors"></span>
						<div class="container-fluid" style="padding:0px">
							<section class="col-xs-12" style="padding:0px">

								<div id="phonetotal" class="summary col-xs-12 hidden-md hidden-lg">




									<div class="summary col-xs-12 header2-mobile-pricing-and-info"> 

					

										<div class="psummary row">
											<div class="col-xs-5" style="float:left;padding-right: 0px;/* border: 1px solid red; */width: 44%;">

											<?php //if(isMobile()): ?>
											 	<!-- Start Mobile -->
		 											<div class="header2-left-container-1" >


		 											
														<table border="0" cellpadding="0" cellspacing="0"> 
															<tr> 
																<td> 
																	<img style="height: 24px" src="assets/img/street.png" />
																</td>
																
																<td> 
																	<span class="name-edit"><?= isset($_SESSION['FirstName'])?$_SESSION['FirstName']:'' ?></span>
																</td>
																
																<td> 
																	<a href="#" id = "modal_form_mobile" >
																		<input type="image" src="assets/img/edit.png" alt="Submit" id="edit-button" >
																		<!-- <img style="height: 24px" src="assets/img/edit.png" /> -->
																	</a>
																</td> 
														</table>  
													</div> 

													<div class="header2-left-container-2" >
														<table border="0" cellpadding="0" cellspacing="0"> 
															<tr>
																<td> 
																	<img style="height: 23px" src="assets/img/location.png" />
																</td>

			 													<td> 
			 														<span class="location-edit"><?= isset($_SESSION['StreetAddress1'])?$_SESSION['StreetAddress1']:'' ?></span>
																</td>
														</table>
													</div> 
										 		<!-- End Mobile -->
										 	<?php //endif; ?> 
<!-- 
											<div class="summary" style="padding-left:15px;">



												<div class="summary row">
													<div class="col-md-1">
														<img style="height: 24px" src="assets/img/street.png" />
													</div>
													<div class="col-md-5">
														<span class="name-edit"><?= isset($_SESSION['FirstName'])?$_SESSION['FirstName']:'' ?></span>
													</div>
													<div class="col-md-1 col-md-offset-2">
														<a href="#" id = "modal_form" ><img style="height: 24px" src="assets/img/edit.png" /></a>
													</div>
												</div>
												
												<div class="summary row">
													<div class="col-md-1">
														<img style="height: 23px" src="assets/img/location.png" />
													</div>
													<div class="col-md-8">
														<span class="location-edit"><?= isset($_SESSION['StreetAddress1'])?$_SESSION['StreetAddress1']:'' ?></span>
													</div>
													
												</div>
												
												
												<br/><br/>
												
											</div> -->


											<!-- 
												<div class="row">
													<div class="col-xs-2">
														<img style="height: 24px" src="assets/img/House.png">
													</div>
													<div class="col-xs-10">
														<div id="pcleantype"></div>
														<div id="pfridge" style="display: none">Inside Fridge</div>
														<div id="pstove" style="display: none">Inside Stove</div>
														<div id="pwindow" style="display: none">Inside Window</div>
														<div id="pbedsteam" style="display: none">Bed Steam</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-xs-2">
														<img style="height: 23px" src="assets/img/Calendar.png">
													</div>
													<div class="col-xs-10">
														<div id="pdate2"></div>
														<div id="pschedule2"> </div>
													</div>
												</div> -->
											</div>


											<div class="ptablerow col-xs-5  header2-right-container" > 

												<div class="header2-right-firstclean" style="display:none">

													<table border="0" cellspacing="0" cellpadding="0" > 
												 		<tr> 

												 			<td>  
												 				<img src="assets/img/loading.png" style="visibility:hidden">
												 			</td> 

												 			<td>
				

																<div class="summary col-xs-12">
																	<!--<div id="psub" style="display:none" class="tablerow col-xs-12">
																		<span class="col-xs-10">Subtotal:</span>
																		<span class="col-xs-2" style="text-align: right" id="psubtotal" name="subtotal"></span>
																	</div>
																	<div class="clearfix"></div>-->
																	<div class="tablerow col-xs-12">
																		<span id="pweekdisc" class="col-xs-10" style="display:none">35% Recurring Discount</span>
																		<span id="pbidisc" class="col-xs-10" style="display:none">30% Recurring Discount</span>
																		<span id="pmonthdisc" class="col-xs-10" style="display:none">25% Recurring Discount</span>
																		<span id="pdiscountR" class="col-xs-2"></span>
																	</div>
																	<div class="clearfix"></div>
																	<div id="pprodisc" class="tablerow col-xs-12" style="display:none">
																		<span class="col-xs-10">Promo Discount</span>
																		<span style="white-space: nowrap" class="col-xs-2" id="pdiscountP"></span>
																	</div>
																	<div class="clearfix"></div>
																</div>
																<div class="clearfix"></div>														
												 			</td>  

												 			<td> 
												 				
												 			</td>

												 		</tr> 
													</table> 

													<div class="header2-arrow-down-div">
														<img src="assets/img/arrow-down-white.png">
													</div> 
												</div>

												<div class="header2-right-firstclean" id="fcleanmobile">

													<table border="0" cellspacing="0" cellpadding="0" > 
												 		<tr> 

												 			<td>  
												 				<img src="assets/img/loading.png" style="visibility:hidden">
												 			</td> 
												 			<td>
	 															<span  style="vertical-align: middle">First Clean:</span>		
												 			</td>
												 			<td>
														
												 				<b><span style="margin-left: 10px; vertical-align: middle;" id="pvisit1"></span></b> 
												 			</td>  

												 			<td> 
												 				<b><span>+ tax</span></b>
												 			</td>

												 		</tr> 
													</table> 

													<div class="header2-arrow-down-div">
														<img src="assets/img/arrow-down-white.png">
													</div> 
												</div>  
												<div class="header2-right-weeks">
												 	<table border="0" cellspacing="0" cellpadding="0" > 
												 		<tr> 
												 			<td> 
												 				<img src="assets/img/loading.png">
												 			</td>

												 			<td>
															 	<span id="ponewk" style="display:none; vertical-align: middle">Every Week</span>
																<span id="ptwowk" style="display:none; vertical-align: middle">Every 2 Weeks</span>
																<span id="pfourwk" style="display:none; vertical-align: middle">Every 4 Weeks</span>		
												 			</td> 

												 			<td> 
												 				<b><span class="col-xs-5" id="pvisit2"></span></b> 
												 				
												 			</td> 

												 			<td> 
												 				<b><span >+ tax</span></b>
												 			</td>
												 		</tr>
												 		<tr> 
  													 		<td> 

													 		</td>

													 		<td> 
													 			<span style="color:white !important;font-size: 13px;"> (After 1st Clean) </span> 
													 		</td>	 

													 		<td> 

													 		</td> 

													 		<td> 

													 		</td>
														</tr>  
													</table>
												</div>
											</div>

											<div class="clearfix">
												
											</div>
											<div id="pmultvisit" class="ptablerow col-xs-5" style="display:none; float:right; margin-right:15px">
												
											</div>
										</div>
									</div>
								</div><div class="clearfix"></div>
								
								<div class="col-xs-12 col-md-6 col-sm-12 col-lg-6 col-lg-offset-1 col-md-offset-2" id="bookingContent" style="background:white; padding-left:0%;">
									<div class="before_main">
										<h4>Schedule Your Home Cleaning</h4>
										<p 
										style="padding: 0px;margin: 0px;"><span><?php echo count($totaljoined); ?> neighbors</span> in <?php  echo $_SESSION['PostalCode']; ?> already use naturalcare cleaning. Join them today. </p>
										
									</div>
								<div class="logotrigle">
									<img src="assets/img/logotrigle.png" style="margin-top:-1px;">
									</div>
										
                                    	<h3 class="ip-subheader about-home-title">Tell us about your home?</h3>
									
									<div style="padding:0px" class="container-fluid container-fluid-mobile">
												<div class="row baths-bdes-sqrft-container">
													<div class="col-md-4">
														<div class="form-group" style="padding-left: 0px">
														
															<div class="form_btn_back">
															<label class="col-xs-12 control-label" style="padding-left: 0px; padding-right: 0px; font-size: 20px; font-weight: inherit"></label>
															<div class="col-xs-12 center" style="padding-left: 0px; padding-right: 0px">


<!--																<select class="form-control" style="color: #555555; font-size: 14px; height:42px; width:100%;" id="bath" name="_baths" required />-->

																<input
																		class="form-control has-success bed-rooms"
																		id="bed"
																		name="_Beds"
																		required=""
																		type="text"
																		>

<!--                                                        		<select class="form-control" style="color: #555555; font-size: 14px; height:42px; width:100%;" id="bath" name="_baths" required />-->
<!--                                                        			<option value="1">1 bathroom</option>-->
<!--                                                        			<option value="1.5">1.5 bathroom</option>-->
<!--																	-->
<!--																	<option value="2" selected>2 bathrooms</option>-->
<!--																	<option value="2.5">2.5 bathroom</option>-->
<!--																	-->
<!--                                                        			<option value="3">3 bathrooms</option>-->
<!--																	<option value="3.5">3.5 bathroom</option>-->
<!--																	-->
<!--                                                        			<option value="4">4 bathrooms</option>-->
<!--																	<option value="4.5">4.5 bathroom</option>-->
<!--																	-->
<!--                                                        			<option value="5.5">5.5 bathrooms</option>-->
<!--																	<option value="1.5">1.5 bathroom</option>-->
<!--																	-->
<!--                                                        			<option value="6">6 bathrooms</option>-->
<!--																	-->
<!--                                                        		</select>-->
																</div>
															</div>
														</div>
                                                   </div>
                                                   <div class="col-md-4">





                                                   		<div  class="form-group beedroom-container" style="padding-left: 0px">
                                                   			  
                                                   			<div class="col-xs-12 center" style="padding-left: 0px; padding-right: 0px">

																	<input
																		class="form-control has-success bed-rooms"
																		id="bath"
																		name="_baths"
																		required=""
																		type="text"
																		> 
																	
<!--																    <input class="form-control" style="color: #555555; font-size: 14px; height:42px; width:100%;" id="bed" name="_Beds" required />-->
<!---->




<!---->
<!--                                                        		<select class="form-control" style="color: #555555; font-size: 14px; height:42px; width:100%;" id="bed" name="_Beds" required />-->
<!--                                                        			<option value="1">1 bedroom</option>-->
<!--                                                        			<option value="2" selected>2 bedrooms</option>-->
<!--                                                        			<option value="3">3 bedrooms</option>-->
<!--                                                        			<option value="4">4 bedrooms</option>-->
<!--                                                        			<option value="5">5 bedrooms</option>-->
<!--                                                        			<option value="6">6 bedrooms</option>-->
<!--                                                        		</select>-->
                                                    		</div>
                                                    	</div>
                                                   </div>
                                                   <div class="col-md-4">
                                                   		<div class="form-group" style="padding-left: 0px">
                                                   			<label class="control-label col-xs-12" style="font-size: 20px; padding-left: 0px; padding-right: 0px; font-weight: inherit"></label>
                                                   			<div class="col-xs-12" style="padding-left: 0px; padding-right: 0px">
                                                   				<input style="height: 42px" min="500" max="9999" type="number" maxlength="4" id="footage"  name="_SquareFootagesize" class="form-control square-foot-field" placeholder="Square Footage" required />
                                                   			</div>
                                                   		</div>
													</div>
                                          		</div>
									 
									<hr>	
									<div class="triaglelogo2"><img src="assets/img/trilaglelogo2.png"></div>
									
									
									
									<h3 class="ip-subheader about-home-often">How often would you like your home cleaned?</h3>
										<br class="hidden-xs">
									<div style="padding:0px" class="container-fluid weekly-container">
									    <div class="row">
											<div class="phone col-xs-12 col-lg-3"> 
												<div class="circle-design-non-clicked circle-design" id="circle-design-1" ></div> 
										        <a id="one-time" href="#" name="freq" onclick="onetime()" class="form-control btn  btn-default btn-lg btn-line repeat col-xs-12">One Time</a>
										    </div>
										    <div class="phone col-xs-12 col-lg-3">
										    	<div class="circle-design-non-clicked circle-design" id="circle-design-2" ></div> 
										      	<a id="every-week" href="#" name="freq" onclick="weekly()" class="form-control btn btn-default btn-lg btn-line repeat col-xs-12">Every Week</a>
										    </div>
										    <div class="phone col-xs-12 col-lg-3">
										    	<div class="circle-design-non-clicked circle-design" id="circle-design-3" ></div> 
										        <a id="every-2-weeks" href="#" name="freq" onclick="biweekly()" class="form-control btn btn-default btn-lg btn-line repeat col-xs-12">Every 2 Weeks</a>
										        <div class="every2weeks-most-popular weekly-most-popular"> -- Most Popular -- </div>
										    </div>
										    <div class="phone col-xs-12 col-lg-3">
										    	<div class="circle-design-non-clicked circle-design" id="circle-design-4" ></div> 
										      	<a id="every-4-weeks" href="#" name="freq" onclick="monthly()" class="form-control btn btn-default btn-lg btn-line repeat col-xs-12">Every 4 Weeks</a>
										    </div>

										</div>
									</div>


									<div class="weeks-frequency-container" >
									<center><span style="padding-left:30px; width:50%">
									<input type="hidden" value="" id="repeat" name="_Frequency" />
									</span></center>
									</div>



									<div class="clearfix"></div>
									<hr>
									<div class="triaglelogo2"><img src="assets/img/trilaglelogo2.png"></div>
									
									 <h3 class="ip-subheader pick-level-first-clean">Pick the level for your first cleaned?</h3>
										


										<div class="row cleaning-container">
										<?php if( $_SESSION['ServiceType'] == 'Recurring'):  
											$keepCleanStyle = 'display:block';
										else : 
											$keepCleanStyle = 'display:none';
										endif;  ?>  	

									       <div class="col-xs-12 col-lg-3" id="keepCleanContainer" style="<?php echo $keepCleanStyle; ?>">
									       		<div class="circle-design-non-clicked circle-design" id="circle-design-5" ></div> 
									            <a style="background:#ebedec" href="#" id="keep" onclick="keepclean()" class="form-control keep btn  btn-default btn-lg btn-line cleantype col-xs-12">Keep It Clean</a>
									        </div>  


									        <div class="col-xs-12 col-lg-3">
									        	<div class="circle-design-non-clicked circle-design" id="circle-design-6" ></div> 
										       	<a href="#" id="clean" onclick="getclean()" class="form-control clean btn btn-default btn-lg btn-line cleantype col-xs-12">Get it Clean</a>
										    </div>
										   <div class="col-xs-12 col-lg-3">
										   		<div class="circle-design-non-clicked circle-design" id="circle-design-7" ></div> 
										        <a href="#" id="deep" onclick="deepclean()" class="form-control deep btn  btn-default btn-lg btn-line cleantype col-xs-12">Deep Clean</a>
										    </div>
										    <div class="col-xs-12 col-lg-3">
										    	<div class="circle-design-non-clicked circle-design" id="circle-design-8" ></div> 
										        <a href="#" id="move" onclick="moveinout()" class="form-control move btn  btn-default btn-lg btn-line cleantype col-xs-12">Move In/Out</a>
										    </div>
										</div>
									</div>
									<center><span style="padding-left:30px; width: 50%">
									<input type="hidden" value="" id="cleantype" name="_InitialCleanType" />
									</span></center>
									<div class="clearfix" style="height:0px;"></div>
									<div class="cleaning-message-container" style="padding-left:0px;">
										<p style="display:none" id="getclean" class="getclean">
											A maintenance clean recommended for returning clients or homes that have been cleaned and maintained within the last 30 to 60 days.
										</p>
										<p style="display:none" id="deepclean" class="deepclean">
											Recommended for extremely thorough cleaning where everything is hand wiped from the ceiling fans down to the baseboards. Ex: Yearly Spring Clean
										</p>
										<p style="display:none" id="moveinout" class="moveinout">
											An extremely thorough cleaning where everything is hand wiped from the ceiling fans down to the baseboards. Also includes cleaning inside empty cabinets and drawers.
										</p>
									</div>
									<div class="triaglelogo2-line-mobile">
										<hr>
									</div>
									<div class="triaglelogo2 triaglelogo2-mobile"><img src="assets/img/trilaglelogo2.png"></div>
									
									<h3 class="ip-subheader cleaning-date-arrival-title">Select your cleaning date and arrival window</h3>
												
										<div class="form-group">
										<div class="row cleaning-date-arrival-field-container">
										<div class="col-xs-12 col-lg-6">
											<input style="text-align: center" type="text" placeholder="mm/dd/yyyy" class="form-control datepicker col-xs-12" name="_SelectYourDate" data-date-format="mm/dd/yyyy" id="datepicker" />
											<span class="glyphicon glyphicon-calendar"></span>
											<img src="assets/img/down.png" class="triangle">
										</div>


										
										<div class="col-xs-12 col-lg-6 time-inner">
											<div class="time-wrapper">
												<select class="form-control" onchange="dayCheck(this.value)" id="timers">
													<option> </option>
													<option value="anytime">Anytime</option>
													<option value="morning">Morning</option>
													<option value="afternoon">Afternoon</option>
												</select>
												<span class="glyphicon glyphicon-time timer" style="font-size:24px;"></span>
												<img src="assets/img/down.png" class="triangle-time">
											</div>
										</div>
									<!-- 	<div class="col-xs-12 col-lg-3">
										    <a href="#" id="any" onclick="anytime()" style="margin: 3px 0px 0px 0px; " class="btn btn-default btn-lg btn-line repeat col-xs-12 daytime form-control">Anytime</a>
										</div>
										<div class="col-xs-12 col-lg-3">
										    <a href="#" id="morn" onclick="morning()" style="margin:  3px 0px 0px 0px;" class="btn btn-default btn-lg btn-line repeat col-xs-12 daytime form-control">Morning</a>
										</div>
										<div class="col-xs-12 col-lg-3">
										    <a href="#" id="after" onclick="afternoon()" style="margin: 3px 0px 0px 0px;" class="btn btn-default btn-lg btn-line repeat col-xs-12 daytime form-control">Afternoon</a>
										</div> -->
										</div>
								
										<center><span style="padding-left:30px; width:50%">
                                        <input type="hidden" value="" id="daytime" name="_ArrivalWindow" />
                                        </span></center>
										</div>
										
										<div class="clearfix"></div>
										<div style="padding-left: 0px" class="cleaning-message-container" >



										 

										<p style="display:none" id="anytime" >We will arrive between 8:30am and 4:00pm on the day of your clean. We can also provide you a 30 minute call or text ahead.</p>
										<p style="display:none" id="morning" >Morning arrival: We will arrive between 8:30am and 12:00pm on the day of your clean. We can also provide you a 30 minute call or text ahead.</p>
										<p style="display:none" id="afternoon" >Afternoon arrival: We will arrive between 12:00pm and 4:00pm on the day of your clean. We can also provide you a 30 minute call or text ahead.</p>
										</div>


										<div class="service-address-and-contact-info" >	 
											<div class="contact-information-container" style="display:none" > 
												<div class="clearfix"></div> 
												<hr>
												<div class="triaglelogo2"><img src="assets/img/trilaglelogo2.png"></div> 
											 	<h3 class="ip-subheader">Contact Information</h3>
												<p>
												We will use this to send you information about your cleanings.
												</p>
												<div class="form-group">
												<div style="padding-left:0px" class="phone col-xs-12 col-sm-6 col-md-6">
													<input id="firstname" name="FirstName" value="<?= isset($_SESSION['FirstName'])?$_SESSION['FirstName']:'' ?>" class="form-control" placeholder="First Name" />
												</div>
												<div style="padding-left:0px" class="phone col-xs-12 col-sm-6  col-md-6">
													<input id="lastname" name="LastName" value="<?= isset($_SESSION['LastName'])?$_SESSION['LastName']:'' ?>"  class="form-control" placeholder="Last Name" />
												</div>
												</div>
												<div class="clearfix"></div><br>
												<div class="form-group">
												<div style="padding-left:0px" class="phone col-xs-12 col-md-6">
													<input id="email2" name="Email" value="<?= isset($_SESSION['Email'])?$_SESSION['Email']:'' ?>"  class="form-control" placeholder="Email" />
												</div>
												<div style="padding-left:0px" class="phone col-xs-12 col-md-6">
													<input id="number" name="phonenum" value="<?= isset($_SESSION['phonenum'])?$_SESSION['phonenum']:'' ?>" class="form-control" data-mask="(999) 999-9999" placeholder="Phone" />
												</div>
												</div><div class="clearfix"></div><br>
												<hr> 
												<div class="triaglelogo2"><img src="assets/img/trilaglelogo2.png"></div>
										
												<h3 class="ip-subheader">Service Address</h3>
												<p>
												Hope we are not being too forward, but we do need to know where to go!
												</p>
												<div class="form-group">
												<div style="padding-left:0px" class="phone col-xs-12 col-md-6">
												<input id="street_address" name="StreetAddress1" value="<?= isset($_SESSION['StreetAddress1'])?$_SESSION['StreetAddress1']:'' ?>" class="form-control" placeholder="Street Address" />
												</div>
												<div style="padding-left:0px" class="phone col-xs-12 col-md-6">
												<input id="address_2" name="StreetAddress2" value="<?= isset($_SESSION['StreetAddress2'])?$_SESSION['StreetAddress2']:'' ?>" class="form-control" placeholder="Apt # (optional)" />
												</div>
												<div class="clearfix"></div><br>

												<div style="padding-left:0px" class="phone col-xs-12 col-md-4">
												<input id="city" name="City" value="<?= isset($_SESSION['City'])?$_SESSION['City']:'' ?>" class="form-control" placeholder="City" />
												</div>
												<div style="padding-left:0px" class="phone col-xs-12 col-md-4">
												<select id="state" class="form-control" name="State">
												<option value="AL" <?= $_SESSION['State'] == 'AL' ? 'selected' : '' ?>>Alabama</option>
												<option value="AK" <?= $_SESSION['State'] == 'AK' ? 'selected' : '' ?>>Alaska</option>
												<option value="AZ" <?= $_SESSION['State'] == 'AZ' ? 'selected' : '' ?>>Arizona</option>
												<option value="AR" <?= $_SESSION['State'] == 'AR' ? 'selected' : '' ?>>Arkansas</option>
												<option value="CA" <?= $_SESSION['State'] == 'CA' ? 'selected' : '' ?>>California</option>
												<option value="CO" <?= $_SESSION['State'] == 'CO' ? 'selected' : '' ?>>Colorado</option>
												<option value="CT" <?= $_SESSION['State'] == 'CT' ? 'selected' : '' ?>>Connecticut</option>
												<option value="DE" <?= $_SESSION['State'] == 'DE' ? 'selected' : '' ?>>Delaware</option>
												<option value="DC" <?= $_SESSION['State'] == 'DC' ? 'selected' : '' ?>>District Of Columbia</option>
												<option value="FL" <?= $_SESSION['State'] == 'FL' ? 'selected' : '' ?>>Florida</option>
												<option value="GA" <?= $_SESSION['State'] == 'GA' ? 'selected' : '' ?>>Georgia</option>
												<option value="HI" <?= $_SESSION['State'] == 'HI' ? 'selected' : '' ?>>Hawaii</option>
												<option value="ID" <?= $_SESSION['State'] == 'ID' ? 'selected' : '' ?>>Idaho</option>
												<option value="IL" <?= $_SESSION['State'] == 'IL' ? 'selected' : '' ?>>Illinois</option>
												<option value="IN" <?= $_SESSION['State'] == 'IN' ? 'selected' : '' ?>>Indiana</option>
												<option value="IA" <?= $_SESSION['State'] == 'IA' ? 'selected' : '' ?>>Iowa</option>
												<option value="KS" <?= $_SESSION['State'] == 'KS' ? 'selected' : '' ?>>Kansas</option>
												<option value="KY" <?= $_SESSION['State'] == 'KY' ? 'selected' : '' ?>>Kentucky</option>
												<option value="LA" <?= $_SESSION['State'] == 'LA' ? 'selected' : '' ?>>Louisiana</option>
												<option value="ME" <?= $_SESSION['State'] == 'ME' ? 'selected' : '' ?>>Maine</option>
												<option value="MD" <?= $_SESSION['State'] == 'MD' ? 'selected' : '' ?>>Maryland</option>
												<option value="MA" <?= $_SESSION['State'] == 'MA' ? 'selected' : '' ?>>Massachusetts</option>
												<option value="MI" <?= $_SESSION['State'] == 'MI' ? 'selected' : '' ?>>Michigan</option>
												<option value="MN" <?= $_SESSION['State'] == 'MN' ? 'selected' : '' ?>>Minnesota</option>
												<option value="MS" <?= $_SESSION['State'] == 'MS' ? 'selected' : '' ?>>Mississippi</option>
												<option value="MO" <?= $_SESSION['State'] == 'MO' ? 'selected' : '' ?>>Missouri</option>
												<option value="MT" <?= $_SESSION['State'] == 'MT' ? 'selected' : '' ?>>Montana</option>
												<option value="NE" <?= $_SESSION['State'] == 'NE' ? 'selected' : '' ?>>Nebraska</option>
												<option value="NV" <?= $_SESSION['State'] == 'NV' ? 'selected' : '' ?>>Nevada</option>
												<option value="NH" <?= $_SESSION['State'] == 'NH' ? 'selected' : '' ?>>New Hampshire</option>
												<option value="NJ" <?= $_SESSION['State'] == 'NJ' ? 'selected' : '' ?>>New Jersey</option>
												<option value="NM" <?= $_SESSION['State'] == 'NM' ? 'selected' : '' ?>>New Mexico</option>
												<option value="NY" <?= $_SESSION['State'] == 'NY' ? 'selected' : '' ?>>New York</option>
												<option value="NC" <?= $_SESSION['State'] == 'NC' ? 'selected' : '' ?>>North Carolina</option>
												<option value="ND" <?= $_SESSION['State'] == 'ND' ? 'selected' : '' ?>>North Dakota</option>
												<option value="OH" <?= $_SESSION['State'] == 'OH' ? 'selected' : '' ?>>Ohio</option>
												<option value="OK" <?= $_SESSION['State'] == 'OK' ? 'selected' : '' ?>>Oklahoma</option>
												<option value="OR" <?= $_SESSION['State'] == 'OR' ? 'selected' : '' ?>>Oregon</option>
												<option value="PA" <?= $_SESSION['State'] == 'PA' ? 'selected' : '' ?>>Pennsylvania</option>
												<option value="RI" <?= $_SESSION['State'] == 'RI' ? 'selected' : '' ?>>Rhode Island</option>
												<option value="SC" <?= $_SESSION['State'] == 'SC' ? 'selected' : '' ?>>South Carolina</option>
												<option value="SD" <?= $_SESSION['State'] == 'SD' ? 'selected' : '' ?>>South Dakota</option>
												<option value="TN" <?= $_SESSION['State'] == 'TN' ? 'selected' : '' ?>>Tennessee</option>
												<option value="TX" <?= $_SESSION['State'] == 'TX' ? 'selected' : '' ?>>Texas</option>
												<option value="UT" <?= $_SESSION['State'] == 'UT' ? 'selected' : '' ?>>Utah</option>
												<option value="VT" <?= $_SESSION['State'] == 'VT' ? 'selected' : '' ?>>Vermont</option>
												<option value="VA" <?= $_SESSION['State'] == 'VA' ? 'selected' : '' ?>>Virginia</option>
												<option value="WA" <?= $_SESSION['State'] == 'WA' ? 'selected' : '' ?>>Washington</option>
												<option value="WV" <?= $_SESSION['State'] == 'WV' ? 'selected' : '' ?>>West Virginia</option>
												<option value="WI" <?= $_SESSION['State'] == 'WI' ? 'selected' : '' ?>>Wisconsin</option>
												<option value="WY" <?= $_SESSION['State'] == 'WY' ? 'selected' : '' ?>>Wyoming</option>
												</select>
												</div>
												<div style="padding-left:0px" class="phone col-xs-12 col-md-4">
												<input id="zip" class="form-control" value="<?= isset($_SESSION['PostalCode'])?$_SESSION['PostalCode']:'' ?>" placeholder="Zipcode" name="PostalCode" />
												</div> 
									 		</div>
										</div>


									</div>

										<div class="mobile-hidden" >
											<div class="clearfix"></div><br>
										</div>

										<div class="mobile-height">

										</div>


										<hr>
										<div class="triaglelogo2"><img src="assets/img/trilaglelogo2.png"></div> 
 
									<h3 class="ip-subheader cleaning-date-arrival-title">Select any add-ons for your first clean</h3>
									



									<div class="container add_ons_container">
										<div class="row add_ons full-window-width">

											<input type="hidden" name="_AddOns" id="addon" value="" />
	
											<center>
												<ul> 
													<li>
														<div class="addons-container">
															<div class="circle-addons circle-design-non-clicked circle-design" id="circle-design-9" ></div> 
															<input name="Window" id="window" value="" class="addon" type="image" src="assets/img/44.png"></input>
														</div>
													</li>
													<li>
														<div class="addons-container">
															<div class="circle-addons circle-design-non-clicked circle-design" id="circle-design-10" ></div> 
															<input name="BedSteam" id="wall" value="" class="addon" type="image" src="assets/img/55.png"></input>
														
													</li>
													<li>
														<div class="addons-container">
															<div class="circle-addons circle-design-non-clicked circle-design" id="circle-design-11" ></div> 
															<input name="Fridge" id="fridge" value="" class="addon" type="image" src="assets/img/33.png"></input>
														</div>		
													</li>
													<li>
														<div class="addons-container">
															<div class="circle-addons circle-design-non-clicked circle-design" id="circle-design-13" ></div> 
															<input name="Stove" id="stove" value="" class="addon" type="image" src="assets/img/22.png"></input>
														</div>
													</li>
												</ul>
											</center>

											<!-- <br><br>

											<table border="1" cellpadding="0" cellspacing="0" > 
												<tr>
													<td> 
														<input name="Window" id="window" value="" class="addon" type="image" src="assets/img/44.png"></input>
													</td>

													<td>  
														<input name="BedSteam" id="wall" value="" class="addon" type="image" src="assets/img/55.png"></input>
													</td> 

													<td> 
														<input name="Fridge" id="fridge" value="" class="addon" type="image" src="assets/img/33.png"></input>
													</td>

													<td> 
														<input name="Stove" id="stove" value="" class="addon" type="image" src="assets/img/22.png"></input>
													</td>
											</table>

											<br><br>


											<input type="hidden" name="_AddOns" id="addon" value="" />

												<div class="addons-left-content col-xs-6 .col-sm-3 text-center">
												
													<input name="Window" id="window" value="" class="addon" type="image" src="assets/img/44.png"></input>
													<input name="BedSteam" id="wall" value="" class="addon" type="image" src="assets/img/55.png"></input>
												</div> 

												<div  class="addons-right-content col-xs-6 .col-sm-3 text-center">
													<input name="Fridge" id="fridge" value="" class="addon" type="image" src="assets/img/33.png"></input>
													<input name="Stove" id="stove" value="" class="addon" type="image" src="assets/img/22.png"></input>
												</div>

												<div class="col-xs-6 .col-sm-3 text-center"> 
												</div>  
												<div class="col-xs-6 .col-sm-3 text-center"> 
												</div> 
											

											 -->

										</div>
									</div>

									 





												<div class="clearfix"></div>

												<hr>
												<div class="triaglelogo2"><img src="assets/img/trilaglelogo2.png"></div>
												
												<!--<h3 class="ip-subheader">Service Address</h3>
												<p>
												Hope we are not being too forward, but we do need to know where to go!
												</p>
												<div class="form-group">
												<div style="padding-left:0px" class="phone col-xs-12 col-md-6">
												<input id="street_address" name="StreetAddress1" value="<?= isset($_SESSION['StreetAddress1'])?$_SESSION['StreetAddress1']:'' ?>" class="form-control" placeholder="Street Address" />
												</div>
												<div style="padding-left:0px" class="phone col-xs-12 col-md-6">
												<input id="address_2" name="StreetAddress2" value="<?= isset($_SESSION['StreetAddress2'])?$_SESSION['StreetAddress2']:'' ?>" class="form-control" placeholder="Apt # (optional)" />
												</div>
												<div class="clearfix"></div><br>

												<div style="padding-left:0px" class="phone col-xs-12 col-md-4">
												<input id="city" name="City" value="<?= isset($_SESSION['City'])?$_SESSION['City']:'' ?>" class="form-control" placeholder="City" />
												</div>
												<div style="padding-left:0px" class="phone col-xs-12 col-md-4">
												<select id="state" class="form-control" name="State">
												<option value="AL" <?= $_SESSION['State'] == 'AL' ? 'selected' : '' ?>>Alabama</option>
												<option value="AK" <?= $_SESSION['State'] == 'AK' ? 'selected' : '' ?>>Alaska</option>
												<option value="AZ" <?= $_SESSION['State'] == 'AZ' ? 'selected' : '' ?>>Arizona</option>
												<option value="AR" <?= $_SESSION['State'] == 'AR' ? 'selected' : '' ?>>Arkansas</option>
												<option value="CA" <?= $_SESSION['State'] == 'CA' ? 'selected' : '' ?>>California</option>
												<option value="CO" <?= $_SESSION['State'] == 'CO' ? 'selected' : '' ?>>Colorado</option>
												<option value="CT" <?= $_SESSION['State'] == 'CT' ? 'selected' : '' ?>>Connecticut</option>
												<option value="DE" <?= $_SESSION['State'] == 'DE' ? 'selected' : '' ?>>Delaware</option>
												<option value="DC" <?= $_SESSION['State'] == 'DC' ? 'selected' : '' ?>>District Of Columbia</option>
												<option value="FL" <?= $_SESSION['State'] == 'FL' ? 'selected' : '' ?>>Florida</option>
												<option value="GA" <?= $_SESSION['State'] == 'GA' ? 'selected' : '' ?>>Georgia</option>
												<option value="HI" <?= $_SESSION['State'] == 'HI' ? 'selected' : '' ?>>Hawaii</option>
												<option value="ID" <?= $_SESSION['State'] == 'ID' ? 'selected' : '' ?>>Idaho</option>
												<option value="IL" <?= $_SESSION['State'] == 'IL' ? 'selected' : '' ?>>Illinois</option>
												<option value="IN" <?= $_SESSION['State'] == 'IN' ? 'selected' : '' ?>>Indiana</option>
												<option value="IA" <?= $_SESSION['State'] == 'IA' ? 'selected' : '' ?>>Iowa</option>
												<option value="KS" <?= $_SESSION['State'] == 'KS' ? 'selected' : '' ?>>Kansas</option>
												<option value="KY" <?= $_SESSION['State'] == 'KY' ? 'selected' : '' ?>>Kentucky</option>
												<option value="LA" <?= $_SESSION['State'] == 'LA' ? 'selected' : '' ?>>Louisiana</option>
												<option value="ME" <?= $_SESSION['State'] == 'ME' ? 'selected' : '' ?>>Maine</option>
												<option value="MD" <?= $_SESSION['State'] == 'MD' ? 'selected' : '' ?>>Maryland</option>
												<option value="MA" <?= $_SESSION['State'] == 'MA' ? 'selected' : '' ?>>Massachusetts</option>
												<option value="MI" <?= $_SESSION['State'] == 'MI' ? 'selected' : '' ?>>Michigan</option>
												<option value="MN" <?= $_SESSION['State'] == 'MN' ? 'selected' : '' ?>>Minnesota</option>
												<option value="MS" <?= $_SESSION['State'] == 'MS' ? 'selected' : '' ?>>Mississippi</option>
												<option value="MO" <?= $_SESSION['State'] == 'MO' ? 'selected' : '' ?>>Missouri</option>
												<option value="MT" <?= $_SESSION['State'] == 'MT' ? 'selected' : '' ?>>Montana</option>
												<option value="NE" <?= $_SESSION['State'] == 'NE' ? 'selected' : '' ?>>Nebraska</option>
												<option value="NV" <?= $_SESSION['State'] == 'NV' ? 'selected' : '' ?>>Nevada</option>
												<option value="NH" <?= $_SESSION['State'] == 'NH' ? 'selected' : '' ?>>New Hampshire</option>
												<option value="NJ" <?= $_SESSION['State'] == 'NJ' ? 'selected' : '' ?>>New Jersey</option>
												<option value="NM" <?= $_SESSION['State'] == 'NM' ? 'selected' : '' ?>>New Mexico</option>
												<option value="NY" <?= $_SESSION['State'] == 'NY' ? 'selected' : '' ?>>New York</option>
												<option value="NC" <?= $_SESSION['State'] == 'NC' ? 'selected' : '' ?>>North Carolina</option>
												<option value="ND" <?= $_SESSION['State'] == 'ND' ? 'selected' : '' ?>>North Dakota</option>
												<option value="OH" <?= $_SESSION['State'] == 'OH' ? 'selected' : '' ?>>Ohio</option>
												<option value="OK" <?= $_SESSION['State'] == 'OK' ? 'selected' : '' ?>>Oklahoma</option>
												<option value="OR" <?= $_SESSION['State'] == 'OR' ? 'selected' : '' ?>>Oregon</option>
												<option value="PA" <?= $_SESSION['State'] == 'PA' ? 'selected' : '' ?>>Pennsylvania</option>
												<option value="RI" <?= $_SESSION['State'] == 'RI' ? 'selected' : '' ?>>Rhode Island</option>
												<option value="SC" <?= $_SESSION['State'] == 'SC' ? 'selected' : '' ?>>South Carolina</option>
												<option value="SD" <?= $_SESSION['State'] == 'SD' ? 'selected' : '' ?>>South Dakota</option>
												<option value="TN" <?= $_SESSION['State'] == 'TN' ? 'selected' : '' ?>>Tennessee</option>
												<option value="TX" <?= $_SESSION['State'] == 'TX' ? 'selected' : '' ?>>Texas</option>
												<option value="UT" <?= $_SESSION['State'] == 'UT' ? 'selected' : '' ?>>Utah</option>
												<option value="VT" <?= $_SESSION['State'] == 'VT' ? 'selected' : '' ?>>Vermont</option>
												<option value="VA" <?= $_SESSION['State'] == 'VA' ? 'selected' : '' ?>>Virginia</option>
												<option value="WA" <?= $_SESSION['State'] == 'WA' ? 'selected' : '' ?>>Washington</option>
												<option value="WV" <?= $_SESSION['State'] == 'WV' ? 'selected' : '' ?>>West Virginia</option>
												<option value="WI" <?= $_SESSION['State'] == 'WI' ? 'selected' : '' ?>>Wisconsin</option>
												<option value="WY" <?= $_SESSION['State'] == 'WY' ? 'selected' : '' ?>>Wyoming</option>
												</select>
												</div>
												<div style="padding-left:0px" class="phone col-xs-12 col-md-4">
												<input id="zip" class="form-control" value="<?= isset($_SESSION['PostalCode'])?$_SESSION['PostalCode']:'' ?>" placeholder="Zipcode" name="PostalCode" />
												</div>

												</div><div class="clearfix"></div><br>
												<hr>
												<div class="triaglelogo2"><img src="assets/img/trilaglelogo2.png"></div>-->
												
										

											<center> 
												<div class="container-fluid payment-information-container" >

												    <div class="mobile-promo-code-container" >  
														<table border="0" cellspacing="0" cellpadding="0">
															<tr> 
																<td> 
																	<div style="padding-left:0px" >
																		<input id="promo"  value="<?= isset($_SESSION['_PromoCode'])?$_SESSION['_PromoCode']:'' ?>" name="_PromoCode" class="form-control promo-mobile" placeholder="Promo code (optional)" />
																	</div>
																</td> 
																<td>
																	<div>
																		<a href="#" style="bottom:5px;padding-top:11px;width: 87px;margin-left: 0px;height: 46px;margin-top: 7px;" class="btn btn-lg btn-default btn-line col-xs-3 col-md-3 applyPromoBtn-mobile" id="applyPromoBtn"  >Apply</a>
																	</div>
																</td> 
														</table> 
													</div>
													





													<div class="header-title payment-information-title"> 
														<h3 class="ip-subheader cleaning-date-arrival-title">Payment Information</h3>  
														<span class="payment_sub_text">You will not be charged untill after your services is complete.</span> 
													</div>

													<div class="payment_label row"> 
														<h3 class="credit_label">Credit card</h3> <img id="ccimage" style="width: 200px !important; padding-right: 5px; margin: 0px;" src="assets/img/cc_logo.png"> 
														</div>
													<div class="payment row" >

												
													<div class="form-group" style="padding-left:0px;">
													<div class="clearfix"></div> 

													<div class="container">
														
														<div style="padding-left:0px" class="ccCard phone col-xs-12 col-md-6 input-group">
														<input style="border-right:none; max-width:299px;" value="<?= isset($_SESSION['creditcard'])?$_SESSION['creditcard']:''?>" autocomplete="off" data-stripe="number" id="creditcard" name="credit_card" data-mask="9999-9999-9999-9999" class="form-control" placeholder="Credit Card Number"
														onblur="creditcard_saved = this.value;
														this.value = this.value.replace(/[^\d]/g, '');
														if(!checkLuhn(this.value)) {
														alert('Sorry, that is not a valid number - please try again!');
														this.value = '';
														}"
														onfocus="
														if(this.value != cc_number_saved) this.value = cc_number_saved;"/>
														<span class="input-group-addon">
														<i class="icon-lock"></i>
														</span>
														</div>

														<!-- credit card information -->
														<div style="padding-left:0px" class="phone col-xs-12 col-md-2">
															<input id="expmonth" value="<?= isset($_SESSION['expmonth'])?$_SESSION['expmonth']:''?>" name="expmonth" data-stripe="exp-month" class="form-control" data-mask="99" placeholder="MM" /> 
														</div>
														<div style="padding-left:0px" class="phone col-xs-12 col-md-2">
															<input id="expyear" value="<?= isset($_SESSION['expyear']) ? $_SESSION['expyear'] : '' ?>" name="expyear" data-stripe="exp-year" class="form-control" data-mask="9999" placeholder="YYYY" /> 
														</div>
														<div style="padding-left:0px" class="phone col-xs-12 col-md-2">
														<input id="cvc" value="<?= isset($_SESSION['cvc'])?$_SESSION['cvc']:''?>" name="cvc" data-stripe="cvc" data-mask="999" class="form-control" placeholder="CVC" />
														</div>
 														<div style="clear:both;"></div>	
														<!-- customer information -->
														<div class="customer-information-mobile" style="padding-top:0; margin-top:10px;">
															<div style="padding-left:0px" class="phone col-xs-12 col-md-2">
																<input id="firstnameCredit" name="FirstName" value="<?= isset($_SESSION['FirstName'])?$_SESSION['FirstName']:'' ?>" class="form-control" placeholder="Name" />
															</div>
															<div style="padding-left:0px" class="phone col-xs-12 col-md-2">
																<input id="lastnameCredit" name="LastName" value="<?= isset($_SESSION['LastName'])?$_SESSION['LastName']:'' ?>"  class="form-control" placeholder="Last Name" />
															</div>
															<div style="padding-left:0px" class="phone col-xs-12 col-md-2">
																<input id="number" name="phonenum" value="<?= isset($_SESSION['phonenum'])?$_SESSION['phonenum']:'' ?>" class="form-control" data-mask="(999) 999-9999" placeholder="Phone Number" />
															</div>  
															<div style="clear:both;"></div>
														</div>


													</div> 
													<!--<div class="container ">
														<div style="padding-left:0px" class="phone col-xs-12 col-sm-6 col-md-4">
														<input id="firstname" name="FirstName" value="<?= isset($_SESSION['FirstName'])?$_SESSION['FirstName']:'' ?>" class="form-control" placeholder="First Name" />
														</div>
														
														<div style="padding-left:0px" class="phone col-xs-12 col-sm-6  col-md-4">
														<input id="lastname" name="LastName" value="<?= isset($_SESSION['LastName'])?$_SESSION['LastName']:'' ?>"  class="form-control" placeholder="Last Name" />
														</div>
														
														<div style="padding-left:0px" class="phone col-xs-12 col-md-4">
														<input id="number" name="phonenum" value="<?= isset($_SESSION['phonenum'])?$_SESSION['phonenum']:'' ?>" class="form-control" data-mask="(999) 999-9999" placeholder="Phone" />
														</div>
													</div>-->
													
													<div class="clearfix"></div>
													
													</div>
													  
													
													
													</div>
													<div class="containter" style="padding-left:0px; border:1px solid #dcdcdc; border-radius:0px 0px 5px 5px;">	
														<div  class="phone col-xs-12 text-center payment-info-secure-text">
		                                                	 All tracsactions are safe and secure with 256 BIT SSL encryption via Stripe.</p>
														</div>
													</div>
												</div>
											</center>
											<div class="container">
												<div style="display:none">
												<input name="_promodiscount" id="promodisc5" />
												<input name="_YourFirstClean" id="Ivisit1" />
												<input name="_FirstCleanHours" id="Ihour" />
												<input name="_YourRecurringPrice" id="Ivisit2" />
												<input name="_RecurringDiscount" id="IdiscountR" />
												<input name="_OneTimeAdjustment" id="onetimeadjust" />
												<input name="stripeToken" id="stripetoken" />
												</div> 
												<div class="container-continue2">  
													<button type="submit" id="continue2" name="continue2" class="btn btn-grad col-xs-12">Book My Cleaning</button>  
												</div> 
											</div>
											<div class="footer-book-cleaing" > 
												<p style="padding: 0px">
													By clicking "Book My Cleaning", you are agreeing to our <a href="https://naturalcarecleaningservice.com/terms-conditions/" target="_blank">Terms of Service</a>.
												</p>
											</div>
											<div class="row">
												<div class="col-xs-2"></div>
												<div class="col-xs-12">  
												<div>
													<ul class="mobile-view-footer-security" >
														<li>  
															<table style="margin-top:29px;" width="100%" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications." style="display:table; margin:0 auto;">
	                                                    		<tr>
	                                                        		<td width="135" align="center" valign="top"><script type="text/javascript" src="https://seal.websecurity.norton.com/getseal?host_name=naturalcarecleaningservice.com&amp;size=XS&amp;use_flash=NO&amp;use_transparent=NO&amp;lang=en"></script><br />
	                                                            		<a href="http://www.symantec.com/ssl-certificates" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center;">ABOUT SSL CERTIFICATES</a>
	                                                        		</td>
	                                                    		</tr>
	                                                		</table>
														</li> 
														<li> 
															<a href="https://ssl.comodo.com">
																<img src="https://ssl.comodo.com/images/comodo_secure_100x85_white.png" alt="SSL Certificate" width="100" height="85"><br>
																<span style="font-weight:bold; font-size:7pt">SSL Certificate</span>
															</a> 
														</li> 
													</ul>	 
												</div>		 
													<div class="row desktop-view-footer-security">  
														<div class="col-md-2 col-sm-12 col-md-offset-2 text-center">
															<table style="margin-top:29px;" width="100%" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications." style="display:table; margin:0 auto;">
	                                                    		<tr>
	                                                        		<td width="135" align="center" valign="top"><script type="text/javascript" src="https://seal.websecurity.norton.com/getseal?host_name=naturalcarecleaningservice.com&amp;size=XS&amp;use_flash=NO&amp;use_transparent=NO&amp;lang=en"></script><br />
	                                                            		<a href="http://www.symantec.com/ssl-certificates" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center;">ABOUT SSL CERTIFICATES</a>
	                                                        		</td>
	                                                    		</tr>
	                                                		</table>
	                                                	</div>
	                                                	<div class="col-md-2 col-md-offset-1 col-sm-12  text-center">
	                                                		<a href="https://ssl.comodo.com">
																<img src="https://ssl.comodo.com/images/comodo_secure_100x85_white.png" alt="SSL Certificate" width="100" height="85"><br>
																<span style="font-weight:bold; font-size:7pt">SSL Certificate</span>
															</a>
	                                                	</div> 
	                                               </div>
												</div>
											</div>
											
											</div>




							<!--start-->

							
							<div id="summary" class="col-md-3 hidden-sm jsummary" style="width: 278px !important; margin-top:0px !important;">
							<div class="triagle"><img src="assets/img/triangleft.png" class="triangleft"></div>
							
							<div class="summary" style="padding-left:15px;">

 
								<?php //if(!isMobile()): ?>
									<!-- Start desktop -->
									<div class="summary row">
										<div class="col-md-1">
											<img style="height: 24px" src="assets/img/street.png" />
										</div>
										<div class="col-md-5">
											<span class="name-edit"><?= isset($_SESSION['FirstName'])?$_SESSION['FirstName']:'' ?> <?= isset($_SESSION['LastName'])?$_SESSION['LastName']:'' ?></span>
										</div>
										

										<div class="col-md-1 col-md-offset-2">


											<a href="#" id = "modal_form_desktop" >
												<input type="button" src="assets/img/edit.png" alt="Submit" id="edit-button" >
												<!-- <button>Edit</button> -->
												<!-- <img style="height: 24px" src="assets/img/edit.png" /> -->
											</a>
										</div>

									</div>
									
									<div class="summary row">
										<div class="col-md-1">
											<img style="height: 23px" src="assets/img/location.png" />
										</div>
										<div class="col-md-8">
											<span class="location-edit"><?= isset($_SESSION['Address'])?$_SESSION['Address']:'' ?></span>
										</div> 
									</div>
								<div class="summary row">
										<div class="col-md-1">
											<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
											
										</div>
										<div class="col-md-8">
											<span class="phone-edit"><?= isset($_SESSION['phonenum'])?$_SESSION['phonenum']:'' ?></span>
										</div> 
									</div>									
									
									<br/><br/>
									<!-- End desktop  -->
								<?php //endif; ?>
















							
						</div>
						<div class="clearfix"></div>
						
						<div id="summary" class="jsummary" style="width: 278px !important; margin-top:0px !important;">
							<div class="triagle"><img src="assets/img/triangleft.png" class="triangleft"></div>
						</div>
						
							<div class="summary" style="padding-bottom:5px;">
								<div class="summary col-sm-12">
								<div class="col-md-1">
								<img style="height: 24px" src="assets/img/House.png" />
								</div>
								<div class="col-md-8">
								<span id="t-keepclean" style="display:none;white-space:nowrap">Keep It Clean</span>
								<span id="t-getclean" style="display:none; white-space: nowrap" >Get it Clean<br></span>
								<span id="t-deepclean" style="display:none; white-space: nowrap">Deep Clean<br></span>
								<span id="t-move" style="display:none; white-space: nowrap">Move In/Out<br></span>
								<span id="t-fridge" style="display:none; white-space: nowrap">Inside Fridge<br></span>
								<span id="t-stove" style="display:none; white-space: nowrap">Inside Oven<br></span>
								<span id="t-window" style="display:none; white-space: nowrap">Inside Window<br></span>
								<span id="t-wall" style="display:none; white-space: nowrap">Bed Steam<br></span>
								</div>
								</div>
								<div class="clearfix"></div>
								<div class="summary col-sm-12">
									<div class="col-md-1">
									<img style="height: 23px" src="assets/img/Calendar.png" />
									</div>
									<div class="col-md-8">
									<span id="date2"></span>
									<span id="schedule2"></span>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="summary col-md-12">
									<div class="col-sm-3"></div>
								</div>
							</div>
						<div class="clearfix"></div>
						
						
						

					<div class="right-container-price1" style="display: none; padding: 0px;" >	
						<!-- starts here -->
						<hr style="width:100%;">

						<div class="triaglelogo2 triaglelogo2_left"><img src="assets/img/trilaglelogo2.png"></div>
						
						<div class="summary col-sm-12">
							<div class="summary col-sm-12" style="padding-right:0px">
						      <div id="border" style="padding-bottom:10px; border-bottom: 2px solid #DAEEF3; display:none;">
								<div id="sub" style="display:none" class="tablerow col-sm-12">
									<span class="col-sm-8">Subtotal:</span>
									<span class="col-sm-4" style="padding-right:15px !important; text-align: right" id="subtotal" name="subtotal"></span>
								</div><div class="clearfix"></div>
								<div class="tablerow col-sm-12" id="disctime" style="display:none">
									<span id="weekdisc" class="col-sm-8" style="display:none">35% Discount:</span>
									<span id="bidisc" class="col-sm-8" style="display:none">30% Discount:</span>
									<span id="monthdisc" class="col-sm-8" style="display:none">25% Discount:</span>
									<span id="discountR" class="col-sm-4" style="padding-right:15px !important; text-align: right"></span>
								</div><div class="clearfix"></div>
								<div id="prodisc" class="tablerow col-sm-12" style="display:none">
									<span class="col-sm-8">Promo Code:</span>
									<span style="white-space: nowrap; padding-right:15px !important; text-align: right" class="col-sm-4" id="discountP"></span>
								</div><div class="clearfix"></div>
							  </div>
							</div><div class="clearfix"></div>
							<br>
							<div class="summary col-sm-12" style="padding-top: 0px">
							    <div>
    								<b class="priceHolderfclean" ><div class="tablerow col-sm-12">
    									<span style="color: #000" class="col-sm-8">First Clean:</span>
    									<b><span style="font-size: 20px; color: #000" class="col-sm-4" id="visit1"> visit 1</span></b>
    									<sub style="float:right">+tax</sub>
    								</div></b><div class="clearfix"></div>
    								<br>
								</div>
							</div> 
						
						</div>
						<div class="clearfix"></div> 
					<!-- end here --> 
					</div>




					<div class="summary col-sm-12" style="padding-top:0px">
						<div id="multvisit" class="tablerow col-sm-12" style="display:none; padding:0px; height:58px; color: white; background:#b4d0c2">
						    <div style="padding-top: 15px; padding-right: 15px">
                                <span class="col-sm-8" id="onewk" style="color:#000; display:none; height:28px; background:#b4d0c2"><b><img src="assets/img/loading.png">&nbsp;Every Week:</b></span>
                                <span class="col-sm-8" id="twowk" style="color:#000; display:none; height:28px; background:#b4d0c2"><b><img src="assets/img/loading.png">&nbsp;Every 2 Weeks:</b></span>
                                <span class="col-sm-8" id="fourwk" style="color:#000; display:none; height:28px; background:#b4d0c2"><b><img src="assets/img/loading.png">&nbsp;Every 4 Weeks:</b></span>
                                <b><span style="color:#000; font-size: 20px; background:#b4d0c2" class="col-sm-4" id="visit2"> visit 2 </span></b>
                                <sub style="float:right; background:#3dafdc; color:#000">+tax</sub>
                          </div>
                        </div>
                    </div>




					
					
					
					
					<div class="container-fluid" style="background:#EEEEEE; overflow:hidden; padding-left:0px; padding-top:12px;"> 
						<div style="padding-left:0px" class="col-md-8">
							<input id="promo"   value="<?= isset($_SESSION['_PromoCode'])?$_SESSION['_PromoCode']:'' ?>" name="_PromoCode" class="form-control promo-desktop" placeholder="Promo code (optional)" />
						</div>
						<a href="#" style="bottom:5px;padding-top:11px;width: 87px;margin-left: 0px;height: 46px;margin-top: 7px;" class="btn btn-lg btn-default btn-line col-xs-3 col-md-3 applyPromoBtn-desktop" id="applyPromoBtn"   >Apply</a>
					</div>
					
					
					
					
					<div class="col-md-3 hidden-sm jsummary" style="width: 278px !important;" >
				<div class="triagle"><img src="assets/img/triangleft.png" class="triangleft"></div>
					<div class="last_sammary">
						<h3>Frequently asked questions</h3>
						<p>What's include is a cleaning service.?</p>
						<p>We all cleaned all your house and more. you will love it to get the detail of the different types of cleans click here</p>
						<p>What's include is a cleaning service.?</p>
					</div>
				
				
				</div>
                    
						<style>
						    .summary {
						        padding-left:0px;
						        padding-right:0px;
						    }
						</style>
						
					
					
					
					
				<div>  
						asdasd
				</div>
				<!--end summar-->
				
				
				

			</div>

			</section>
		</div>

		</div>
		</div>
		</form>
		</div>
		</div>

		</div>
		</div>
		<!--END PAGE CONTENT -->
		</div>

		<!--END MAIN WRAPPER -->
		<!--<footer id="main-footer">
                

        
                <div id="footer-bottom">
                    <div class="container clearfix">
                        <ul class="et-social-icons">

                            <li class="et-social-icon et-social-facebook">
                                <a href="https://www.facebook.com/NaturalcareCleaningService" class="icon">
                                    <span>Facebook</span>
                                </a>
                            </li>
                            <li class="et-social-icon et-social-twitter">
                                <a href="#" class="icon">
                                    <span>Twitter</span>
                                </a>
                            </li>
                            <li class="et-social-icon et-social-google-plus">
                                <a href="https://plus.google.com/+Naturalcarecleaningservice/about" class="icon">
                                    <span>Google</span>
                                </a>
                            </li>
                            <li class="et-social-icon et-social-rss">
                                <a href="https://naturalcarecleaningservice.com/feed/" class="icon">
                                    <span>RSS</span>
                                </a>
                            </li>

                        </ul>
                        <p id="footer-info">Designed by <a href="http://www.elegantthemes.com" title="Premium WordPress Themes">Elegant Themes</a> | Powered by <a href="http://www.wordpress.org">WordPress</a></p>
                    </div>
                </div>
    </footer>-->


		
		<!--fsheen-->
		<script>
			prettyPrint();
		</script>

		<script src="assets/js/stepper.js" ></script>
		<script>
		
            var placeSearch,
                autocomplete;
            var componentForm = {
                street_number : 'short_name',
                route : 'long_name',
                locality : 'long_name',
                administrative_area_level_1 : 'short_name',
                country : 'long_name',
                postal_code : 'short_name'
            };
            function init() {
                var input = document.getElementById('locationTextField');
                autocomplete = new google.maps.places.Autocomplete(input);
				autocomplete.addListener('place_changed', function() {

				fillInAddress();
				})	
				
            }
			//google.maps.event.addDomListener(window, 'load', init);

			function fillInAddress() {
				// Get the place details from the autocomplete object.
				
				//$('#realaddress').val($('#autocomplete').val())
			
				var place = autocomplete.getPlace();

					console.log(place.address_components)
				
				for (var component in componentForm) {
				 document.getElementById(component).value = '';
				 document.getElementById(component).disabled = false;
				 }

				 // Get each component of the address from the place details
				 // and fill the corresponding field on the form.
				 for (var i = 0; i < place.address_components.length; i++) {
				 var addressType = place.address_components[i].types[0];
				 if (componentForm[addressType]) {
				 var val = place.address_components[i][componentForm[addressType]];
				 document.getElementById(addressType).value = val;
				 
				 }
				 }
				// $('#street_address').val(place.address_components[0]['short_name'] + ' ' + place.address_components[1]['long_name']);
				// $('#city').val(place.address_components[2]['long_name']);
				// $('#state').val(place.address_components[5]['short_name']);
				// $('#zip').val(place.address_components[7]['short_name']);
				
				addrFilled = true;
			}			
			
        </script>
		
		
		
		<script type="text/javascript">
			$(" #modal_form_mobile, #modal_form_desktop").click(function(){
				$('.error-success-wrapper').html("");
				$(".modal_body").slideDown(200, function(){
					$("#close").click(function(){
						$(".modal_body").slideUp(200);
					});
				});
			});
			
			$("#modal_form_faq").click(function(){
				$(".modal_body_faq").slideDown(200, function(){
					$("#close1").click(function(){
						$(".modal_body_faq").slideUp(200);
					});
				});
			});

			$("#modal_form_faq-desktop").click(function(){
				$(".modal_body_faq").slideDown(200, function(){
					$("#close1").click(function(){
						$(".modal_body_faq").slideUp(200);
					});
				});
			});
		 </script>
		 
		 <script type="text/javascript">
			$(document).ready(function(){
			
				$('.triangle-time').click(function(){
					
					  $("#timers").focus();
					
				
				
				})	
				$('.triangle').click(function(){
					
					  $("#datepicker").focus();
					
				
				
				})	
						
				$("#idForm").submit(function() {
					
						$('.error-success-wrapper').html("");
						
						
						var that = $(this),
						url = that.attr('action'),
						type = that.attr('method'),
						data={};

						that.find('[name]').each(function(index, value){
						   var that=$(this),
								name = that.attr('name'),
								value = that.val();
								data[name] = value;
						});


						  $.ajax({
							url:'inc/book-nowajax.php',
							type:'post',
							data:data,
							success:function(datus){
							
								$('.error-success-wrapper').html(datus);
									
								if(datus.match('Sorry')){
								
								
								}else{

									var fnmehndler = $('#idForm input[name=fname]').val();
									var fullname = fnmehndler.split(' ')
					
									$('.name-edit').html($('#idForm input[name=fname]').val());
						
									$('#firstname').val(fullname[0]);						
									$('#lastname').val(fullname[1]);
									$('#firstnameCredit').val(fullname[0]);						
									$('#lastnameCredit').val(fullname[1]);						
						
									$('.location-edit').html($('#idForm input[name=address]').val());
									$('#street_address').val($('#idForm input[name=address]').val());
									$('#city').val($('#idForm table #locality').val());
									$('#zip').val($('#idForm table #postal_code').val());
									$('.phone #number').val($('#idForm #numberEdit').val());
									$('span.phone-edit').html($('#idForm #numberEdit').val());
									$('#state').val($('#idForm table #administrative_area_level_1').val());								
													
								setTimeout(function(){
								
								
								
									$('.modal_body').hide(500);
									
									
									
								},2000); 
								
								}
							}
							
						  }); 
					
						return false;

				});
				 
			});
		 </script>

		 <style type="text/css">
		 	/*css*/
			 #timers{
					border: none !important;	
					width: 120% !important;
					box-shadow: none !important;
					text-indent: 30px !important;
					text-align: left !important;

				}

		 </style>
		
		


	</body>
<!-- END BODY -->
</html>