<?php
    require_once('infusionsoft/PHP-iSDK-master/src/isdk.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        session_start();

        {
            $app = new iSDK();
            $app->cfgCon('naturalcare');
        
        
            $_SESSION['_CallAhead'] = $_POST['_CallAhead'];
            $_SESSION['_Access'] = $_POST['_Access'];
            $_SESSION['_GateCode'] = $_POST['_GateCode'];
            $_SESSION['_AlarmCode'] = $_POST['_AlarmCode'];
            $_SESSION['_Pets'] = $_POST['_Pets'];
            $_SESSION['_Referer'] = $_POST['_Referer'];
            $_SESSION['_Comments'] = $_POST['_Comments'];
            
            $contact = [
                '_CallAhead' => $_POST['_CallAhead'],
                '_Access' => $_SESSION['_Access'],
                '_GateCode' => $_SESSION['_GateCode'],
                '_AlarmCode' => $_SESSION['_AlarmCode'],
                '_Pets' => $_SESSION['_Pets'],
                '_Referer' => $_SESSION['_Referer'],
                '_Comments' => $_SESSION['_Comments'],
                
            ];
            
            $app->updateCon($_SESSION['contact_id'], $contact_data);
            $app->grpAssign($_SESSION['contact_id'], 93);
        
            
            $to = $_SESSION['Email'];
            $subject = 'Natural Care Cleaning Services';
            $headers =  'From: admin@natrualcarecleaningservice.com\r\n';
            $message = 
                "<div>".
                    "<div style=\"width: 50%; float: left\"><b>First Name:</b></div>".
                    "<div style=\"width: 50%; float: left\">$_SESSION[firstname]</div>".
               "</div>".
               "<div>".
                    "<div style=\"width: 50%; float: left\"><b>Last Name:</b></div>".
                    "<div style=\"width: 50%; float: left\">$_SESSION[LastName]</div>'". 
               "</div>".
               "<div>".
                    "<div style=\"width: 50%; float: left\"><b>Email:</b></div>".
                    "<div style=\"width: 50%; float: left\">$_SESSION[Email]</div>'". 
               "</div>".
               "<div>".
                    "<div style=\"width: 50%; float: left\"><b>Address:</b></div>".
                    "<div style=\"width: 50%; float: left\">".
                        $_SESSION[StreetAddress1] . ' ' . $_SESSION[StreetAdress2] + '<br>';
                        $_SESSION[City] . ($SESSION[City] ? ', ' : ' ') . $_SESSION[State]. $_SESSION[PostalCode].
                        $_SESSION[Country].
                    "</div>". 
               "</div>".
               "<div>".
                    "<div style=\"width: 50%; float: left\"><b>Date Scheduled:</b></div>".
                    "<div style=\"width: 50%; float: left\">$_SESSION[_SelectYourDate]</div>'". 
               "</div>".
               "<div>".
                    "<div style=\"width: 50%; float: left\"><b>Initial Clean Type:</b></div>".
                    "<div style=\"width: 50%; float: left\">$_SESSION[_InitialCleanType]</div>'". 
               "</div>".
               "<div>".
                    "<div style=\"width: 50%; float: left\"><b>Frequency:</b></div>".
                    "<div style=\"width: 50%; float: left\">$_SESSION[_Frequency]</div>'". 
               "</div>".
               "<div>".
                    "<div style=\"width: 50%; float: feft\"><b>Square Footage Size</b></div>".
                    "<div style=\"width: 50%; float: left\">$_SESSION[_Squarefootagesize]</div>".
                "/div>". 
                "<div>".
                    "<div style=\"width: 50%; float: feft\"><b>Beds</b></div>".
                    "<div style=\"width: 50%; float: left\">$_SESSION[_Beds]</div>".
                "/div>". 
                "<div>".
                    "<div style=\"width: 50%; float: feft\"><b>Baths</b></div>".
                    "<div style=\"width: 50%; float: left\">$_SESSION[_baths]</div>".
                "/div>". 
                "<div>".
                    "<div style=\"width: 50%; float: left\"><b>Arival Window:</b></div>".
                    "<div style=\"width: 50%; float: left\">$_SESSION[_ArrivalWindow]</div>'". 
               "</div>";
               
               if(mail($to, $subject, $message, $headers))
               {
                    $redirect = '<script type="text/javascript">window.top.location.href = "/index.php"; </script>';
               }
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
		<meta charset="UTF-8" />
		<title>Naturalcare Form</title>
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />

		      <!-- GLOBAL STYLES -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/theme.css" />
        <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
        <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
        <!--END GLOBAL STYLES -->

        <!-- PAGE LEVEL STYLES -->
        <link href="assets/css/booknow.css" rel="stylesheet" />
        <link href="assets/css/jquery-ui.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css" />
        <!-- END PAGE LEVEL  STYLES -->

        <!-- GLOBAL SCRIPTS -->
        <script src="assets/plugins/jquery-2.0.3.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!-- END GLOBAL SCRIPTS -->
        <!-- PAGE LEVEL SCRIPTS -->
        <script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/plugins/validVal/js/jquery.validVal.min.js"></script>
        <script src="assets/js/bootstrap-datepicker.js"></script>
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
					marginTop : 10
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#phonetotal').scrollToFixed({
					marginTop : 10
				});
			});
		</script>
		<script type="text/javascript">
			// When the document is ready
			$(document).ready(function() {

				$('.datepicker').datepicker({
					daysOfWeekDisabled : "0,6"
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
	</head>
	<body>
		<!-- MAIN WRAPPER -->
		<div class="panel panel-default" style="padding-left:0px" >
			<div class="panel-body container-fluid" style="padding:0px; background: #daeef3">
				<form action="#" method="post" id="step2" role="form">
					<div class="container-fluid">

						<section class="col-xs-12" style="padding-top:10px; padding-bottom:10px; padding-left: 0px; padding-right:0px">
								<div class="form-group col-md-6 col-md-offset-3 col-xs-12" style="background:white; padding:20px">
									<div style="color:#666666">
										Awesome! Your information has successfully been recorded and your appointment scheduled.
									</div>
									<br>
									<label style="font-size:14px; color:#5c7427; padding-left: 30px">
										<input name="_CallAhead" type="checkbox" value="0" />
										&nbsp; Please provide a 30 minute call ahead </label>
									<hr>
									<h4 style="padding-left:30px">How do we get in?</h4><br>
									<div class="form-group">
										<input type="hidden" value="" id="access" name="_Access" />

										<a    href="#" id="home" class="btn btn-lg btn-default btn-line access col-xs-4 col-md-3">I'll be home</a><div class="col-md-1"></div>
										<a    href="#" id="leavekey" class="btn btn-lg btn-default btn-line access col-xs-4 col-md-3">I'll leave a key</a><div class="col-md-1"></div>
										<a    href="#" id="other" class="btn btn-lg btn-default btn-line  access col-xs-4 col-md-3">Other</a>

									</div>
									<div class="clearfix"></div>
									<br>
									<div class="form-group">

										<div style="padding-left:0px" class="col-xs-6">
											<input name="_GateCode"   class="form-control" placeholder="Gate Code" />
										</div>
										<div class="col-xs-6">
											<input name="_AlarmCode"   class="form-control" placeholder="Alarm Code" />
										</div>
									</div><div class="clearfix"></div>
									<br>
									<hr>
									<h4>Any pets?</h4><br>
									<div style="padding-left:30px" class="form-group">
										<input type="hidden" value="" id="pets" name="_Pets" />

										<a href="#" id="dogs" class="btn btn-default btn-line pets col-xs-2">Dog(s)</a><div class="col-md-1"></div>
										<a href="#" id="cats" class="btn btn-default btn-line pets col-xs-2">Cat(s)</a><div class="col-md-1"></div>
										<a href="#" id="both" class="btn btn-default btn-line pets col-xs-2">Both</a><div class="col-md-1"></div>
										<a href="#" id="other" class="btn btn-default btn-line pets col-xs-2">Other</a>
									</div><div class="clearfix"></div>
									<br>

									<hr>

									<h4>How did you hear about us?</h4><br>
									<div class="col-xs-6" style="padding-left:30px">
										<select class="form-control" name="_Referer" id="refer" style="background:white; color:#959595">
											<option disabled selected value=""></option>
											<option value="1">Google Search</option>
											<option value="2">Angie's List</option>
											<option value="3">Yelp</option>
											<option value="4">Referred by a friend</option>
											<option value="5">Picked up a brochure</option>
											<option value="6">Facebook</option>
											<option value="7">Saw our car</option>
											<option value="8">Thumbtack</option>
											<option value="9">Homeadvisor</option>
										</select>
									</div><div class="clearfix"></div>
									<br>
									<hr>
									<h4>Additional Comments</h4><br>
									<div class="col-xs-12" style="padding-left:30px; padding-right:30px">
										<textarea class="form-control" name="_Comments" rows="3"></textarea>
									</div><div class="clearfix"></div><br>
									<div style="padding-right:30px;">
									<button style="height: 52px; background: #89C050; font-size: 24px; color: white;" type="submit" id="continue3" name="continue3" class="btn btn-grad col-xs-12">Submit Final Details</button>
                                    <!--<button style="height: 52px" type="submit" id="continue3" class="btn btn-primary btn-grad col-xs-12">Submit Final Details</button>-->
									</div>

								</div>
							</section>
					</div>
			</div>
		</div>
		</div>
		</div>
	</body>
</html>