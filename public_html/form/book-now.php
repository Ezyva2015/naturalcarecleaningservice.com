<?php @session_start();?>
<?php

require_once ('infusionsoft/PHP-iSDK-master/src/isdk.php');
require_once ('stripe/init.php');
require_once ('conf.php');

// Important value variables

// connect to the database to grab option values
include('results_table/connect-db.php');

// query db
    $result = mysql_query("SELECT * FROM options")
    or die(mysql_error());
    $row = mysql_fetch_array($result);
    
    // check that the 'id' matches up with a row in the databse
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

\Stripe\Stripe::setAPiKey($conf['stripe_key']);
if (isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['contact_id']))
{
    if ($_SERVER['REQUEST_METHOD']=='POST' && $_POST['_Frequency']!='' && $_POST['_SelectYourDate']!='' && $_POST['_ArrivalWindow']!='' && $_POST['_InitialCleanType']!='' && $_POST['FirstName']!='' && $_POST['City']!='' && $_POST['LastName']!='' && $_POST['Email']!='' && $_POST['Phone1']!='' && $_POST['StreetAddress1']!='' && $_POST['State']!='' && $_POST['PostalCode']!='' && $_POST['credit_card']!='' && $_POST['cvc']!='' && $_POST['expmonth']!='' && $_POST['expyear']!='')
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
		$headers .= 'To: Adam <adamclayd@gmail.com>' . "\r\n";
		$headers .= 'From: ' . $_POST['FirstName'] . ' ' . $_POST['LastName'] . ' <' . $_POST['Email'] . '>' . "\r\n";
		
		$subject = 'Cleaning Confirmation';
		$to = 'kauseway@gmail.com';

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
					'</table>'.
				'</body>'.
			'</html>';
		
			mail($to, $subject, $message, $headers);
		
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
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
        <script src="assets/js/jquery-scrolltofixed.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
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
			function anytime() {
			    $('#daytime').valid();
				document.getElementById('anytime').style.display = "block";
				document.getElementById('morning').style.display = "none";
				document.getElementById('afternoon').style.display = "none";
				$('span[for="daytime"].has-error').css({
                    display: 'none',
                })
			}

			function morning() {
			    $('#daytime').valid();
				document.getElementById('morning').style.display = "block";
				document.getElementById('anytime').style.display = "none";
				document.getElementById('afternoon').style.display = "none";
				$('span[for="daytime"].has-error').css({
                    display: 'none',
                })
			}

			function afternoon() {
			    $('#daytime').valid();
				document.getElementById('afternoon').style.display = "block";
				document.getElementById('morning').style.display = "none";
				document.getElementById('anytime').style.display = "none";
				$('span[for="daytime"].has-error').css({
                    display: 'none',
                })
			}

			function onetime() {
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
			$(function(){

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
	function getTotalBasePrice(totalSquareFootCalculation)
	{
		var J7 = parseInt("2");
		var C3 = parseInt("6");
		var J8 = parseInt("2");
		var D3 = parseInt("14");
		var F3 = parseInt("99");
		//var M3 = parseInt("0");

		var totalBeds = J7;
		var totalBedsPrice = C3;
		var totalBathRoom = J8;
		var totalBathRoOmPrice = D3;
		var totalBaseValue = F3;
		//totalSquareFootCalculation = M3;
		var totalBasePrice = (totalBeds*totalBedsPrice) + (totalBathRoom*totalBathRoOmPrice) + totalBaseValue+totalSquareFootCalculation;

		return parseInt(totalBasePrice);
	}



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
       $('#pvisit1').parent().parent().parent().hide();
       $('#visit2').parent().parent().parent().show();
       $('#pvisit2').parent().parent().parent().show();
    }
    else
    {
      $('#visit1').parent().parent().parent().show();
      $('#pvisit1').parent().parent().parent().show();
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
    $('#pvisit1').parent().parent().parent().hide();
    $('#visit2').parent().parent().parent().hide();
    $('#pvisit2').parent().parent().parent().hide();
    $('#subtotal').parent().hide();
	$('#psubtotal').parent().hide();
	$('#discountR').parent().hide();
	$('#pdiscountR').hide();
	$('#prodisc').hide();
	
	$('#bath, #bed').change(function() {
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
          		$('#pvisit1').parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().show();
        	}
        	else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        	{
          		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().show();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().show();
        	}
        	else if($('#cleantype').val() != 'Keep It Clean')
        	{
        		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().show();
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
          	$('#pvisit1').parent().parent().parent().hide();
          	$('#visit2').parent().parent().parent().hide();
          	$('#pvisit2').parent().parent().parent().hide();
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
	});
	
	$('#footage').keyup(function(e) {
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
          			$('#pvisit1').parent().parent().parent().hide();
          			$('#visit2').parent().parent().parent().show();
          			$('#pvisit2').parent().parent().parent().show();
        		}
        		else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        		{
          			$('#visit1').parent().parent().parent().show();
          			$('#pvisit1').parent().parent().parent().show();
          			$('#visit2').parent().parent().parent().show();
          			$('#pvisit2').parent().parent().parent().show();
        		}
        		else if($('#cleantype').val() != 'Keep It Clean')
        		{
        			$('#visit1').parent().parent().parent().show();
          			$('#pvisit1').parent().parent().parent().show();
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
          		$('#pvisit1').parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().hide();
          		$('#pvisit2').parent().parent().parent().hide();
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


			getclean  = parseFloat("1.25");
			deepclean = parseFloat("1.5");
			moveinout = parseFloat("1.75");



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






			getclean  = parseFloat("1.25");
			deepclean = parseFloat("1.5");
			moveinout = parseFloat("1.75");
			var totalBasePrice = getTotalBasePrice(0);

			if ($(this).text() == 'Keep It Clean')
			{
				firstclean = 1;
			}
			else if ($(this).text() == 'Get it Clean')
			{
				firstclean = getItCleanFunc(totalBasePrice, getclean);
			}
			else if ($(this).text() == 'Deep Clean')
			{
				firstclean = deepCleanFunc(totalBasePrice, deepclean);
			}
			else if ($(this).text() == 'Move In/Out')
			{
				firstclean = moveInOutFunc(totalBasePrice, moveinout);
			}








			$('#visit1').text(firstclean);


			//$('#visit1').text(Math.floor((Math.random() * 10) + 1));
		  	//	 	return;

		$('#cleantype').val($(this).text())
		$('#Ihour').text(hours.toFixed(1) + ' hours')
		$('#hour').text(hours.toFixed(1) + ' hours')
		$('#visit1').text('$' + Math.round(firstclean).toFixed(0));
		$('#pvisit1').text('$' + Math.round(firstclean).toFixed(0));
		
        if($('#repeat').val() && $('#cleantype').val() && $('#footage').val())
		{		
        		if($('#repeat').val() && $('#repeat').val() != "One Time" && ($('#cleantype').val() == 'Keep It Clean' || !$('#cleantype').val()) && $('.addon[value=""]').length == 4)
        	{
          		$('#visit1').parent().parent().parent().hide();
          		$('#pvisit1').parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().show();
        	}
        	else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        	{
          		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().show();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().show();
        	}
        	else if($('#cleantype').val() != 'Keep It Clean')
        	{
        		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().show();
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
          		$('#pvisit1').parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().hide();
          		$('#pvisit2').parent().parent().parent().hide();
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
		}
		else
		{
			console.log("else - no calculation happens");
		}
	})

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
          		$('#pvisit1').parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().show();
        	}
        	else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        	{
          		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().show();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().show();
        	}
        	else if($('#cleantype').val() != 'Keep It Clean')
        	{
        		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().show();
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
          	$('#pvisit1').parent().parent().parent().hide();
          	$('#visit2').parent().parent().parent().hide();
          	$('#pvisit2').parent().parent().parent().hide();
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
	$('.repeat').click(function() {
		$('#repeat').val($(this).text());
		
		if ($('#repeat').val() == 'One Time') {
			recurringDiscount = 0;
			
			if($('#cleantype').val() == 'Keep It Clean')
				$('#cleantype').val('')
				
			$('.cleantype').first().css({
				'border-color': '#FF8604',
				'background-color': '#FFF',
				'color': '#FF8604'
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



		console.log('successfully calculated');
		console.log('visit1 value first clean = ' + firstclean);
		console.log('visit2 value prices = ' + recurringPrice);






		$('#hour').text(hours.toFixed(1) + ' hours');
		$('#Ihour').text(hours.toFixed(1) + ' hours');
	    $('#visit1').text('$' + Math.round(firstclean).toFixed(0));
        $('#pvisit1').text('$' + Math.round(firstclean).toFixed(0));
        if($('#repeat').val() && $('#cleantype').val() && $('#footage').val())
		{		
        	if($('#repeat').val() && $('#repeat').val() != "One Time" && ($('#cleantype').val() == 'Keep It Clean' || !$('#cleantype').val()) && $('.addon[value=""]').length == 4)
        	{
          		$('#visit1').parent().parent().parent().hide();
          		$('#pvisit1').parent().parent().parent().hide();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().show();
        	}
        	else if($('#repeat').val() != 'One Time' && $('#cleantype').val() != 'Keep It Clean')
        	{
          		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().show();
          		$('#visit2').parent().parent().parent().show();
          		$('#pvisit2').parent().parent().parent().show();
        	}
        	else if($('#cleantype').val() != 'Keep It Clean')
        	{
        		$('#visit1').parent().parent().parent().show();
          		$('#pvisit1').parent().parent().parent().show();
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
            $('#pvisit1').parent().prev().text($('#repeat').val() == 'One Time' ? 'Your Clean' : 'First Clean');
       }
       else
       {
       		$('#visit1').parent().parent().parent().hide();
          	$('#pvisit1').parent().parent().parent().hide();
          	$('#visit2').parent().parent().parent().hide();
          	$('#pvisit2').parent().parent().parent().hide();
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

	$('#applyPromoBtn').click(function(e) {
		e.preventDefault();

		$.ajax({
			url : 'get_coupon.php?code=' + $('#promo').val().trim(),
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
					$('#pdiscountP').text('-$' + promodiscount.toFixed(0)).parent().show().parent().show();
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
    .payment-errors {
        display: none;
    }
</style>
	</head>
	<!-- END HEAD -->

	<!-- BEGIN BODY -->
	<body style="background-color: white">
	    <div style="background: #ddd; height: 7px;"></div>				<!-- TOP ROW HEADER -->
	    <div class="row" style="background-color: #444; padding-top: 10px;padding-bottom: 10px;">
            <div class="col-xs-12 col-md-6 col-sm-8 col-lg-5 col-lg-offset-1 col-md-offset-3">
                <a href="https://naturalcarecleaningservice.com/">
                    <img src="https://naturalcarecleaningservice.com/wp-content/uploads/2015/10/new-logo-on-black.png" height="60px" alt="Naturalcare Cleaning Service" id="logo">
                </a>
            </div>
        </div>
        <div style="background: #daeef3; height: 7px;"></div>
		<!-- MAIN WRAPPER -->
		<div class="container-fluid" id="wrap" style="padding: 0px">

			<!--PAGE CONTENT -->

			<div id="form" class="container-fluid" style="min-height:0px; padding:0px"></div>
			<div style="padding:0px" class="panel panel-default" >

				<div class="panel-body container-fluid" style="padding:0px; background: #daeef3">
				    
				    
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="step1" role="form">
						<span class="payment-errors"></span>
						<div class="container-fluid" style="padding:0px">
							<section class="col-xs-12" style="padding:0px">

								<div id="phonetotal" class="summary col-xs-12 hidden-md hidden-lg">

									<div class="summary col-xs-12">
										<div class="summary col-xs-12">
											<!--<div id="psub" style="display:none" class="tablerow col-xs-12">
												<span class="col-xs-10">Subtotal:</span>
												<span class="col-xs-2" style="text-align: right" id="psubtotal" name="subtotal"></span>
											</div>
											<div class="clearfix"></div>-->
											<div class="tablerow col-xs-12" id="disctime" style="display:none">
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

										<div class="psummary row">
											<div class="col-xs-5" style="float:left">
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
														<img style="height: 24px" src="assets/img/Calendar.png">
													</div>
													<div class="col-xs-10">
														<div id="pdate2"> </div>
														<div id="pschedule2"> </div>
													</div>
												</div>
											</div>
											<div class="ptablerow col-xs-5" style="float:right; margin-right:15px">
												<span class="col-xs-7" style="vertical-align: middle">First Clean:</span>
												<b><span style="font-size: 20px; color: #3dafdc" class="col-xs-5" id="pvisit1"></span></b>
												<br><br>
												<span class="col-xs-7" id="ponewk" style="display:none; vertical-align: middle">Every Week</span>
												<span class="col-xs-7" id="ptwowk" style="display:none; vertical-align: middle">Every 2 Weeks</span>
												<span class="col-xs-7" id="pfourwk" style="display:none; vertical-align: middle">Every 4 Weeks</span>
												<b><span style="color:#3dafdc; font-size: 20px" class="col-xs-5" id="pvisit2"></span></b>
											</div><div class="clearfix"></div>
											<div id="pmultvisit" class="ptablerow col-xs-5" style="display:none; float:right; margin-right:15px">
												
											</div>
										</div>
									</div>
								</div><div class="clearfix"></div>
								<div class="col-xs-12 col-md-6 col-sm-12 col-lg-6 col-lg-offset-1 col-md-offset-2" id="bookingContent" style="background:white; padding-left:0%; padding-bottom:25px; padding-top: 1%">
									<h2 class="ip-header">Complete Your Booking:</h2>
									<p>Great! Lets get a few details to complete your booking. tO be updated</p>
										<h3 class="ip-subheader">How Often?</h3>
										<br class="hidden-xs">
										<p>With our flexible scheduling you can cancel or reschedule anytime.</p>
									<div style="padding:0px" class="container-fluid">
									    <div class="row">
											<div class="phone col-xs-12 col-lg-3">
										      <a href="#" name="freq" onclick="onetime()" class="btn  btn-default btn-lg btn-line repeat col-xs-12">One Time</a>
										    </div>
										    <div class="phone col-xs-12 col-lg-3">
										      <a href="#" name="freq" onclick="weekly()" class="btn btn-default btn-lg btn-line repeat col-xs-12">Every Week</a>
										    </div>
										    <div class="phone col-xs-12 col-lg-3">
										      <a href="#" name="freq" onclick="biweekly()" class="btn btn-default btn-lg btn-line repeat col-xs-12">Every 2 Weeks</a>
										    </div>
										    <div class="phone col-xs-12 col-lg-3">
										      <a href="#" name="freq" onclick="monthly()" class="btn btn-default btn-lg btn-line repeat col-xs-12">Every 4 Weeks</a>
										    </div>
										</div>
									</div>
									<center><span style="padding-left:30px; width:50%">
									<input type="hidden" value="" id="repeat" name="_Frequency" />
									</span></center>
									<div class="clearfix"></div>
									<hr>
                                    	<h3 class="ip-subheader">Cleaning Details</h3>
									
									<div style="padding:0px" class="container-fluid">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group" style="padding-left: 0px">
															<label class="col-xs-12 control-label" style="padding-left: 0px; padding-right: 0px; font-size: 20px; font-weight: inherit"></label>
															<div class="col-xs-12 center" style="padding-left: 0px; padding-right: 0px">
                                                        		<select class="form-control" style="color: #555555; font-size: 14px; height:42px; width:100%;" id="bath" name="_baths" required />
                                                        			<option value="1">1 bathroom</option>
                                                        			<option value="1.5">1.5 bathroom</option>
																	
																	<option value="2" selected>2 bathrooms</option>
																	<option value="2.5">2.5 bathroom</option>
																	
                                                        			<option value="3">3 bathrooms</option>
																	<option value="3.5">3.5 bathroom</option>
																	
                                                        			<option value="4">4 bathrooms</option>
																	<option value="4.5">4.5 bathroom</option>
																	
                                                        			<option value="5.5">5.5 bathrooms</option>
																	<option value="1.5">1.5 bathroom</option>
																	
                                                        			<option value="6">6 bathrooms</option>
																	
                                                        		</select>
                                                    		</div>
                                                    	</div>
                                                   </div>
                                                   <div class="col-md-4">
                                                   		<div  class="form-group" style="padding-left: 0px">
                                                   			<label class="control-label col-xs-12" style="font-size: 20px; padding-left: 0px; padding-right: 0px; font-weight: inherit"></label>
                                                   			<div class="col-xs-12 center" style="padding-left: 0px; padding-right: 0px">
                                                        		<select class="form-control" style="color: #555555; font-size: 14px; height:42px; width:100%;" id="bed" name="_Beds" required />
                                                        			<option value="1">1 bedroom</option>
                                                        			<option value="2" selected>2 bedrooms</option>
                                                        			<option value="3">3 bedrooms</option>
                                                        			<option value="4">4 bedrooms</option>
                                                        			<option value="5">5 bedrooms</option>
                                                        			<option value="6">6 bedrooms</option>
                                                        		</select>
                                                    		</div>
                                                    	</div>
                                                   </div>
                                                   <div class="col-md-4">
                                                   		<div class="form-group" style="padding-left: 0px">
                                                   			<label class="control-label col-xs-12" style="font-size: 20px; padding-left: 0px; padding-right: 0px; font-weight: inherit"></label>
                                                   			<div class="col-xs-12" style="padding-left: 0px; padding-right: 0px">
                                                   				<input style="height: 42px" min="500" max="9999" type="number" maxlength="4" id="footage" name="_SquareFootagesize" class="form-control" placeholder="Square Footage" required />
                                                   			</div>
                                                   		</div>
													</div>
                                          		</div>
									    										<p>
										Please select the level of cleaning your house needs.
									</p><div class="row">

									       <div class="col-xs-6 col-md-6 col-lg-3">
									           <a href="#" id="keep" onclick="keepclean()" class="keep btn  btn-default btn-lg btn-line cleantype col-xs-12">Keep It Clean</a>
									        </div>
									        <div class="col-xs-6 col-md-6 col-lg-3">
										      <a href="#" id="clean" onclick="getclean()" class="clean btn btn-default btn-lg btn-line cleantype col-xs-12">Get it Clean</a>
										    </div>
										   <div class="col-xs-6 col-md-6 col-lg-3">
										      <a href="#" id="deep" onclick="deepclean()" class="deep btn  btn-default btn-lg btn-line cleantype col-xs-12">Deep Clean</a>
										    </div>
										    <div class="col-xs-6 col-md-6 col-lg-3">
										      <a href="#" id="move" onclick="moveinout()" class="move btn  btn-default btn-lg btn-line cleantype col-xs-12">Move In/Out</a>
										    </div>
										</div>
									</div>
									<center><span style="padding-left:30px; width: 50%">
									<input type="hidden" value="" id="cleantype" name="_InitialCleanType" />
									</span></center>
									<div class="clearfix" style="height:0px;"></div>
									<div style="padding-left:0px; height: 56px">
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
									<hr>
									<h3 class="ip-subheader">Select Your Extras</h3>
									<p>
										Add these little extras to really complement your first cleaning!
									</p>
									<div class="row-fluid">
										<div style="padding: 0px !important" class="row">
											<input type="hidden" name="_AddOns" id="addon" value="" />
											<div  class="col-xs-3 col-md-3 text-center">
												<input name="Fridge" id="fridge" value="" class="addon" type="image" src="assets/img/33.png"</input>

												</div>
												<div class="col-xs-3 col-md-3 text-center">
												<input name="Stove" id="stove" value="" class="addon" type="image" src="assets/img/22.png"</input>

												</div>

												<div class="col-xs-3 col-md-3 text-center">
												<input name="Window" id="window" value="" class="addon" type="image" src="assets/img/44.png"</input>

												</div>

												<div class="col-xs-3 col-md-3 text-center">
												<input name="BedSteam" id="wall" value="" class="addon" type="image" src="assets/img/55.png"</input>

												</div>

												<!--<div class="col-xs-6 col-md-4" align="center">
												<input name="Laundry" id="laundry" value="" class="addon" type="image" src="assets/img/11.png"</input>
												<p style="text-align:center">Load of laundry</p>
												</div>-->

												</div>
												</div>
												<div class="clearfix"></div>

												<hr>
										
												<h3 class="ip-subheader">When would you like us to come?</h3>
												<p>Pick your cleaning date and choose an arrival window.</p>
												<div class="form-group">
												<div class="row" style="padding: 0px">
												<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
												<input style="text-align: center" type="text" placeholder="mm/dd/yyyy" class="form-control datepicker col-xs-12" name="_SelectYourDate" data-date-format="mm/dd/yyyy" id="datepicker" />
												</div>
												<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
												    <a href="#" id="any" onclick="anytime()" style="margin: 3px 0px 0px 0px; padding: 10px" class="btn btn-default btn-lg btn-line repeat col-xs-12 daytime form-control">Anytime</a>
												</div>
												<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
												    <a href="#" id="morn" onclick="morning()" style="margin:  3px 0px 0px 0px; padding: 10px" class="btn btn-default btn-lg btn-line repeat col-xs-12 daytime form-control">Morning</a>
												</div>
												<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
												    <a href="#" id="after" onclick="afternoon()" style="margin: 3px 0px 0px 0px; padding: 10px" class="btn btn-default btn-lg btn-line repeat col-xs-12 daytime form-control">Afternoon</a>
												</div>
												</div>
										
												<center><span style="padding-left:30px; width:50%">
                                                <input type="hidden" value="" id="daytime" name="_ArrivalWindow" />
                                                </span></center>
												</div>
												
												<div class="clearfix"></div>
												<div style="height: 40px; padding-left: 0px">
												<p style="display:none" id="anytime" >We will arrive between 8:30 am and 4:00 pm. Exact arrival time cannot be guaranteed, but you can opt in for a 30 minute call ahead.</p>
												<p style="display:none" id="morning" >We will arrive between 8:30 am and 12:00 pm. Exact arrival time cannot be guaranteed, but you can opt in for a 30 minute call ahead.</p>
												<p style="display:none" id="afternoon" >We will arrive between 12:00 pm and 4:00 pm. Exact arrival time cannot be guaranteed, but you can opt in for a 30 minute call ahead.</p>
												</div>

												<div class="clearfix"></div>

												<hr>
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
												<input id="number" name="Phone1" value="<?= isset($_SESSION['Phone1'])?$_SESSION['Phone1']:'' ?>" class="form-control" data-mask="(999) 999-9999" placeholder="Phone" />
												</div>
												</div><div class="clearfix"></div><br>
												<hr>
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

												</div><div class="clearfix"></div><br>
												<hr>
												<h3 class="ip-subheader">Payment details</h3>
												<p>
												Enter your card information below.
												<br>
												You will be charged after service has been rendered.
												</p>
												<div class="form-group">
												<div style="padding-left:0px" class="col-xs-8 col-md-5">
												<input id="promo" value="<?= isset($_SESSION['_PromoCode'])?$_SESSION['_PromoCode']:'' ?>" name="_PromoCode" class="form-control" placeholder="Promo code (optional)" />
												</div>
												<a href="#" style="bottom:5px; padding-top:11px" class="btn btn-lg btn-default btn-line col-xs-3 col-md-2" id="applyPromoBtn">Apply</a>
												<div class="clearfix"></div><br>
												<div style="padding-left:0px" class="phone col-xs-12 col-md-6 input-group">
												<input style="border-right:none" value="<?= isset($_SESSION['creditcard'])?$_SESSION['creditcard']:''?>" autocomplete="off" data-stripe="number" id="creditcard" name="credit_card" data-mask="9999-9999-9999-9999" class="form-control" placeholder="Credit Card Number"
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
												<div style="padding-left:0px" class="phone col-xs-12 col-md-2">
																								<input id="expmonth" value="<?= isset($_SESSION['expmonth'])?$_SESSION['expmonth']:''?>" name="expmonth" data-stripe="exp-month" class="form-control" data-mask="99" placeholder="MM" />

												</div>
												<div style="padding-left:0px" class="phone col-xs-6 col-md-2">
																								<input id="expyear" value="<?= isset($_SESSION['expyear']) ? $_SESSION['expyear'] : '' ?>" name="expyear" data-stripe="exp-year" class="form-control" data-mask="9999" placeholder="YYYY" />

												</div>
												<div style="padding-left:0px" class="phone col-xs-6 col-md-2">
												<input id="cvc" value="<?= isset($_SESSION['cvc'])?$_SESSION['cvc']:''?>" name="cvc" data-stripe="cvc" data-mask="999" class="form-control" placeholder="CVC" />
											</div>
											<div class="clearfix"></div>
											
											</div><div class="row">	
											  <div style="padding-left:20px" class="phone col-xs-12 text-center">
                                                    <img id="ccimage" style="width: 350px !important; padding-right: 5px; margin: 0px;" src="assets/img/cc_logo.png"> <br>Safe and secure 256 BIT SSL enctrypted payment.
                                                </div>
											</div><br>
											<div class="row hidden-md hidden-lg">
												<div class="col-xs-2"></div>
												<div class="col-xs-8">
													<div class="row" style="border: 2px solid #ccc; padding-left: 0px">
														<div class="col-xs-6 text-center">
															<table width="135" border="0" style="margin-top: 28px" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications.">
                                                        		<tr>
                                                            		<td width="135" align="center" valign="top"><script type="text/javascript" src="https://seal.websecurity.norton.com/getseal?host_name=naturalcarecleaningservice.com&amp;size=XS&amp;use_flash=NO&amp;use_transparent=NO&amp;lang=en"></script><br />
                                                                		<a href="http://www.symantec.com/ssl-certificates" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a>
                                                            		</td>
                                                        		</tr>
                                                    		</table>
                                                    	</div>
                                                    	<div class="col-xs-6 text-center">
                                                    		<a href="https://ssl.comodo.com">
																<img src="https://ssl.comodo.com/images/comodo_secure_100x85_white.png" alt="SSL Certificate" width="100" height="85" style="border: 0px;"><br>
																<span style="font-weight:bold; font-size:7pt">SSL Certificate</span>
															</a>
                                                    	</div>
                                                   </div>
												</div>
											</div>
											<hr>
											<div >
											<p style="padding: 0px">
											By clicking "Book My Cleaning", you are agreeing to our <a href="https://naturalcarecleaningservice.com/terms-conditions/" target="_blank">Terms of Service</a>.
											</p>
											</div>
											<div>
											<div style="display:none">
											<input name="_promodiscount" id="promodisc5" />
											<input name="_YourFirstClean" id="Ivisit1" />
											<input name="_FirstCleanHours" id="Ihour" />
											<input name="_YourRecurringPrice" id="Ivisit2" />
											<input name="_RecurringDiscount" id="IdiscountR" />
											<input name="_OneTimeAdjustment" id="onetimeadjust" />
											<input name="stripeToken" id="stripetoken" />
											</div>
											<button style="height: 52px; font-size: 24px; color: white;" type="submit" id="continue2" name="continue2" class="btn btn-grad col-xs-12">Book Now</button>
											</div>
											</div>

						<div id="summary" class="col-md-3 hidden-sm" style="width: 278px !important">
											<div class="summary">
											<div class="summary col-sm-12">
											<div class="col-sm-3">
											<img style="height: 24px" src="assets/img/House.png" />
										</div>
										<div class="col-md-9">
										<span id="t-keepclean" style="display:none;white-space:nowrap">Keep It Clean</span>
										<span id="t-getclean" style="display:none; white-space: nowrap" >Get it Clean<br></span>
										<span id="t-deepclean" style="display:none; white-space: nowrap">Deep Clean<br></span>
										<span id="t-move" style="display:none; white-space: nowrap">Move In/Out<br></span>
										<span id="t-fridge" style="display:none; white-space: nowrap">Inside Fridge<br></span>
										<span id="t-stove" style="display:none; white-space: nowrap">Inside Oven<br></span>
										<span id="t-window" style="display:none; white-space: nowrap">Inside Window<br></span>
										<span id="t-wall" style="display:none; white-space: nowrap">Bed Steam<br></span>
										</div>
										</div><div class="clearfix"></div><br>
										<div class="summary col-sm-12">
										<div class="col-md-3">
										<img style="height: 24px" src="assets/img/Calendar.png" />
										</div>
										<div class="col-md-9">
										<span id="date2"></span><br>
										<span id="schedule2"></span>
										</div>
										</div><div class="clearfix"></div><br>
										<div class="summary col-md-12">
										<div class="col-sm-3">
									</div>
								</div>
						</div>
						<div class="clearfix"></div>
						<br>
						<div class="summary col-sm-12" style="border-top:2px solid #DAEEF3">
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
    								<div class="tablerow col-sm-12">
    									<span class="col-sm-8">First Clean:</span>
    									<b><span style="font-size: 20px; color: #3dafdc" class="col-sm-4" id="visit1"> visit 1</span></b>
    									<sub style="float:right">+tax</sub>
    								</div><div class="clearfix"></div>
    								<br>
								</div>
							</div>
						</div><div class="clearfix"></div>
					<div class="summary col-sm-12" style="padding-top:0px">
						<div id="multvisit" class="tablerow col-sm-12" style="display:none; padding:0px; height:58px; color: white; background:#3dafdc">
						    <div style="padding-top: 15px; padding-right: 15px">
                                <span class="col-sm-8" id="onewk" style="color:white; display:none; height:28px; background:#3dafdc">Every Week:</span>
                                <span class="col-sm-8" id="twowk" style="color:white; display:none; height:28px; background:#3dafdc">Every 2 Weeks:</span>
                                <span class="col-sm-8" id="fourwk" style="color:white; display:none; height:28px; background:#3dafdc">Every 4 Weeks:</span>
                                <b><span style="color:red; font-size: 20px; background:#3dafdc" class="col-sm-4" id="visit2"> visit 2 </span></b>
                                <sub style="float:right; background:#3dafdc; color:white">+tax</sub>
                          </div>
                        </div>
                    </div>
                    <div class="summary col-sm-6 text-center">
                        <table width="135" border="0" style="margin-top: 18px" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications.">
                            <tr>
                                <td width="135" align="center" valign="top"><script type="text/javascript" src="https://seal.websecurity.norton.com/getseal?host_name=naturalcarecleaningservice.com&amp;size=XS&amp;use_flash=NO&amp;use_transparent=NO&amp;lang=en"></script><br />
                                    <a href="http://www.symantec.com/ssl-certificates" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="summary col-sm-6 text-center">
                    	<a href="https://ssl.comodo.com">
							<img src="https://ssl.comodo.com/images/comodo_secure_100x85_white.png" alt="SSL Certificate" width="100" height="85" style="border: 0px;"><br>
							<span style="font-weight:bold; font-size:7pt">SSL Certificate</span>
						</a>
						<br>
                    </div>
						<style>
						    .summary {
						        padding-left:0px;
						        padding-right:0px;
						    }
						</style>
				</div>

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
	</body>
<!-- END BODY -->
</html>