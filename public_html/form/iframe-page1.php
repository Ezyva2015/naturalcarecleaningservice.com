<?php
    require_once('infusionsoft/PHP-iSDK-master/src/isdk.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['FirstName'] != '' && $_POST['Address'] != '' && $_POST['Email'] != '')
    {
        @session_start();

        $address = explode(',', $_POST['Address']);
        if(count($address) == 4)
        {
            $app = new iSDK();
            $app->cfgCon('naturalcare');
        
        
            $_SESSION['StreetAddress1'] = $address[0];
            $_SESSION['City'] = $address[1];
            $_SESSION['State'] = $_POST['State'];
            $_SESSION['Country'] = $address[3];
            $_SESSION['StreetAddress2'] = $_POST['StreetAddress2'];
            $_SESSION['PostalCode'] = $_POST['PostalCode'];
            $_SESSION['Email'] = $_POST['Email'];
            $_SESSION['_SquareFootagesize'] = $_POST['_SquareFootagesize'];
            $_SESSION['_Beds'] = $_POST['_Beds'];
            $_SESSION['_baths'] = $_POST['_baths'];
            $_SESSION['FirstName'] = $_POST['FirstName'];
            $_SESSION['LastName'] = $_POST['LastName'];
			$_SESSION['phonenum'] = $_POST['phonenum'];
			$_SESSION['ServiceType'] = $_POST['ServiceType'];
            
            $allowed_zips = file('/home/natural/etc/zipcodes', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                if(!in_array($_POST['PostalCode'], $allowed_zips)){
                    $message = "
                    <div style='background:#daeef3; width: 100%; padding-left:20px; padding-right: 20px'>
                    <span style='color:red; font-weight: 300'>Sorry, based on your zip code, we don't serve your area</span>
                    </div>
                    ";
                }
                else{
					
						$pieces = explode(" ", $_SESSION['FirstName']);
											
					
                    $contact = [
                        'Email' => $_POST['Email'],
                        'StreetAddress1' => $_SESSION['StreetAddress1'],
                        'StreetAddress2' => $_SESSION['StreetAddress2'],
                        'City' => $_SESSION['City'],
                        'State' => $_SESSION['State'],
                        'Country' => $_SESSION['Country'],
                        'PostalCode' => $_SESSION['PostalCode'],
						'Phone1' => $_SESSION['phonenum'],
                        'FirstName' => $pieces[0],
                        'LastName' => $pieces[1]
                    ];
                    
                    $contacts = $app->findByEmail($_SESSION['Email'], array('Id'));
                    if(count($contacts))
                        $contact_id = $app->updateCon($contacts[0]['Id'], $contact);
                    else
                        $contact_id = $app->addCon($contact);
                    
                    $app->grpAssign($contact_id, 510);
                    $_SESSION['contact_id'] = $contact_id;

                    $redirect = '<script type="text/javascript">window.top.location.href = "/form/book-now.php"; </script>';
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
<?php if(isset($redirect))
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
		<link rel="stylesheet" href="formstyle.css" />
		<link rel="stylesheet" href="assets/css/res.css" />
        <!--END GLOBAL STYLES -->

        <!-- PAGE LEVEL STYLES -->
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





        <script src="assets/js/bootstrap-formhelpers-phone.format.js"></script>
        <script src="assets/js/bootstrap-formhelpers-phone.js"></script>
        <!--END PAGE LEVEL SCRIPTS -->
        <style>
            /*input {
                display: inline !important
            }
            select {
                display: inline !important;

            }
			
			*/
			.et_pb_column{
				width:46% !important;
				border:1px solid red !important;
			}
            select.form-control {
              -moz-appearance: none;
               -webkit-appearance: none;
               appearance: none;
            }
            #continue:hover {
                opacity: .90;
            }
            #wrap {
                float: left;
            }
            .center {
                margin: 0 auto;
                margin-bottom: 15px;
            }
            .recurring {
            	font-size: 9px;
            	background-color: #dbdbdb;
            	font-weight: bold;
            }
            .recurring:hover {
            	background-color: #c6c6c6;
            }
            .recurring.active {
            	background-color: #c6c6c6;
            }
            body {
                font-family: helvetica;
            }
			
			.btn:hover, .btn:focus{
				
				background:#b4d0c2 !important;
							
			}
			.btn-group{
			
				width:100%;
				
			}
			.ipbtn {
				padding: 10px 6px !important;
				width:33.5%;
			}
			
        </style>

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
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
          ga('create', 'UA-5358845-3', 'auto');
          ga('send', 'pageview');
        
        </script>
        <script>
            // This example displays an address form, using the autocomplete feature
            // of the Google Places API to help users fill in the information.

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

            function initialize() {
				
				var firstResult='';
                // Create the autocomplete object, restricting the search
                // to geographical location types.
                autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */(document.getElementById('autocomplete')), {
                    types : ['geocode']
                });
                
                google.maps.event.addDomListener(document.getElementById('autocomplete'), 'keydown', function(e) {
						
						var incase = document.getElementById('autocomplete');

						var firstResult = $(".pac-container .pac-item").length;
						
						if(firstResult==1){
							
							if(e.keyCode===8 || e.keyCode===37 || e.keyCode===39 || e.keyCode===46){		

								
									
							}else{
								
							
							var firstResult = $(".pac-container .pac-item:first").text();
							var stringMatched = $(".pac-container .pac-item:first").find(".pac-item-query").text(); 
							firstResult = firstResult.replace(stringMatched, stringMatched + " ");
							
							
							//google.maps.event.trigger($('#autocomplete'),'keydown',{keyCode:40}) 
							//google.maps.event.trigger($('#autocomplete'),'keydown',{keyCode:13,triggered:true}) 
							//e.preventDefault();							
							
							
							
/* 							$('.pac-container').remove();
							
							setTimeout(function(){
								
							$('#autocomplete').val(firstResult);
							
							},200); */
							
							
							//$('#address_2').focus();
							
							//$('#address_2').focus();					
							
							autocomplete = new google.maps.places.Autocomplete(
							/** @type {HTMLInputElement} */(document.getElementById('autocomplete')), {
								types : ['geocode']
							});							
								
								
								
							}
							
							
							

						}
							
						if(e.keyCode===13 && !e.triggered){ 
						google.maps.event.trigger(this,'keydown',{keyCode:40}) 
						google.maps.event.trigger(this,'keydown',{keyCode:13,triggered:true}) 
						e.preventDefault();
						
						}
						
						if(e.keyCode===9){

                            //console.log("keydown and trigger google maps event key code 40 from 9");
						    google.maps.event.trigger(this,'keydown',{keyCode:40})
						}




                        //console.log("keycode " + e.keyCode)
						
						google.maps.event.addListener(autocomplete, 'place_changed', function() {
								fillInAddress();
						});	
	
						
						
                });
				

				$('#autocomplete').focusout(function(autocomplete){
					
					 google.maps.event.trigger(this,'keydown',{keyCode:40})

				
					
					
				})				
				
				

                
                setTimeout(function() {
                    document.getElementById('autocomplete').autocomplete = 'off';
                }, 1000);
                
                // When the user selects an address from the dropdown,
                // populate the address fields in the form.
                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    fillInAddress();
                });
            }
            
            var addrFilled = false;

            // [START region_fillform]
            function fillInAddress() {
                // Get the place details from the autocomplete object.
				
				$('#realaddress').val($('#autocomplete').val())
				
                var place = autocomplete.getPlace();

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

            // [END region_fillform]

            // [START region_geolocation]
            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        var circle = new google.maps.Circle({
                            center : geolocation,
                            radius : position.coords.accuracy
                        });
                        autocomplete.setBounds(circle.getBounds());
                    });
                }
            }
            
            
            
            $(function() {
            	$('.recurring').click(function() {
            		$('.recurring').removeClass('active');
            		$(this).addClass('active');
            		
            		$('#recurring').val($(this).text());
            	});
            	
            	$('form').submit(function(e) {
                	if(!addrFilled)
                	{
                    	e.preventDefault();
                    	alert('Google api did not fill in address');
                	}
            	});
				
				var checker;
				
				$('.needs-value').each(function(){
					
					if($(this).val()==""){
						checker = 1;
						
					}
						
				})	

					
				
				if(checker==1){
						
					$('#continue').attr('disabled','disabled').css('opacity','0.5');
						
					
				}else{
					
					$('#continue').removeAttr('disabled').css('opacity','1');
				}

				
				$('.needs-value').keyup(function(){
					var checker = 0;
					$('.needs-value').each(function(){
						
					if($(this).val()==""){
						checker = 1;						
					}	
					/* if($('#bfh-phone').val().length<14){
						checker = 1;						
					}					
						 */					
						
					})
					
					if(checker==1){
							
						$('#continue').attr('disabled','disabled').css('opacity','0.5');
							
						
					}else{
						
						$('#continue').removeAttr('disabled').css('opacity','1');
					}	
						
					
				})
				
				$('input[type=text],input[type=tel],input[type=email],input[type=search]').keyup(function(){
					
					if($(this).val()!=""){
						
					$(this).prev('.appended-label').remove();
					$(this).before("<p class='appended-label'>"+$(this).attr("placeholder")+":</p>");
					$('body').css('height',$('#wrap').height()+'px');
					
					
					}else{
						
					$(this).prev('.appended-label').remove();	
					$('body').css('height',$('#wrap').height()+'px');
					
					
					
					}
					
					
				})

/* 				$('.ipbtn').click(function(){
					var checker = 0;
					
					if($('#recurring').val()==""){
						checker = 1;						
					}	
					
					if(checker==1){
							
						$('#continue').attr('disabled','disabled').css('opacity','0.5');
							
						
					}else{
						
						$('#continue').removeAttr('disabled').css('opacity','1');
					}						
					
				}) */


            });
            // [END region_geolocation]

            function exec_clicked()
            {
                $( '#autocomplete' ).attr( 'autocomplete', 'off' );
            }
			
	
        </script>
    </head>

    <body onload="initialize()" style="min-height:532px">
<?php 
if(!isset($redirect)):
?>
        <!-- MAIN WRAPPER -->
        <div id="wrap" style="width: 100%">

            <!--PAGE CONTENT -->
            <div id="content2" style="margin-left:0px; margin-right:0px; padding: 0px; height:100%; background:#dddddd;">
                    <div class="row-fluid" style="height:100%;">
                        
                        <div class="col-lg-12" style="padding: 0px; height:100%; ">
                            
                            <div style="margin-bottom:0px !important; height:100%;" class="panel panel-default">

                                <div class="panel-body" style="background:#daeef3; height:100%; min-height:530px;">
                                    <?php if (isset($message))
                                              echo $message;
                                       ?>
                                    <div id="page1">                                        
                                        <section>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="start" id="start" role="form" autocomplete="off">
                                                <div>
                                                    
                                                    <div align="center">
                                                        <h2>Get an Instant Price</h2>
                                                    </div>


                                                    <div id="locationField" class="form-group center">

														
														
                                                        <input onclick="exec_clicked()" autocomplete="false" style="height: 42px; border-radius:0 !important;" placeholder="Enter your street address�" tabindex="10" g-places-autocomplete="" force-selection="true" required type="text" class="form-control google-addresses-autocomplete needs-value" id="autocomplete" name="Address" placeholder="Enter your address" value=""    >
                                                        </input>
														
														
                                                    </div>
                                                    <table id="address" style="display:none">
                                                          <tr>
                                                            <td class="label">Street address</td>
                                                            <td class="slimField"><input class="field" id="street_number"
                                                                  readonly></input></td>
                                                            <td class="wideField" colspan="2"><input class="field" id="route"
                                                                  readonly></input></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="label">City</td>
                                                            <td class="wideField" colspan="3"><input class="field" id="locality"
                                                                  readonly></input></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="label">State</td>
                                                            <td class="slimField"><input class="field" name="State"
                                                                  id="administrative_area_level_1" readonly></input></td>
                                                            <td class="label">Zip code</td>
                                                            <td class="wideField"><input class="field" name="PostalCode" id="postal_code" readonly/></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="label">Country</td>
                                                            <td class="wideField" colspan="3"><input class="field"
                                                                  id="country" readonly></input></td>
                                                          </tr>
                                                        </table>
                                                        <div class="form-group center">
                                                                    <input autocomplete="off" type="text" id="address_2" name="StreetAddress2" class="form-control" placeholder="Apt # (optional)" />
                                                                    </div>
                                                   <!-- <div class="col-xs-12">
                                                        <p style="font-size:16; text-align: center; color: #434348">Tell us about your home.</p>
                                                    </div>-->
                                                    
            
                                                   <div class="form-group center">
                                                        <div style="padding-left:0px; padding-right: 0px" class="col-xs-12 col-md-12">
                                                        <input autocomplete="off" type="text" required id="firstname" name="FirstName" class="form-control needs-value" placeholder="Your Name" />
                                                        </div>
                                                    </div>
													<div class="form-group center">
													<!--<div style="padding-left:0px; padding-right: 0px" class="col-xs-12 col-md-12">
													<input id="lastname" name="LastName"  class="form-control" placeholder="Last Name" />
													</div>-->
													</div>
													<div class="form-group center">
													<div style="padding-left:0px; padding-right:0px" class="col-xs-12 col-md-12">
													<input autocomplete="off" id="email2" name="Email" type="email"  class="form-control needs-value" placeholder="Email" required />
													</div>
													</div>

													<div class="form-group center">
														<div style="padding-left:0px; padding-right:0px" class="col-xs-12 col-md-12">
															<input name="phonenum" autocomplete="off" type="tel" placeholder="Phone Number" id="bfh-phone" class="input-medium bfh-phone" data-format="(ddd) ddd-dddd" style="padding: 10px 10px 10px 9px;color: grey;width: 100%;border: 3px solid #CCCCCC;">
														</div>
													</div>													

													
														<div class="clearfix"></div>
                                                    <div class="form-group center">
                                                    	<div class="btn-toolbar">	
															<p>What type of cleaning?</p>
                                                    		<div class="btn-group">
                                                    			<a class="ipbtn btn btn-default recurring" href="javascript:void(0)">One Time</a>
                                                    			<a class="ipbtn btn btn-default recurring" href="javascript:void(0)">Recurring</a>
                                                    			<a class="ipbtn btn btn-default recurring" href="javascript:void(0)">Move In/Out</a>
                                                    		</div>
                                                    	</div>
                                                    </div>
                                                    <input type="hidden" value="" name="ServiceType" id="recurring">
                                                    <div align="center">
                                                    <button type="submit" style="height: 42px; background: #FD7F23; color: white; font-size: 20px" id="continue" name="continue" class="btn2 btn-grad col-xs-12 center">Get Your Price</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </section>
<?php
else:
?>
<center>
<img src="data:image/gif;base64,R0lGODlh6wDrAPMPAFdXV3V1dWhoaCAgIIKCgpiYmKmpqbW1tczMzM7OztTU1OHh4e7u7vf39/r6+v///yH5BAkKAA8AIf8LTkVUU0NBUEUyLjADAQAAACwAAAAA6wDrAAAE/vDJSau9OOvNu8/FIALFZ55oqq5s676YIM5DAN94ru98a9C0Q29ILBqPHABwJkA6n9CoajkDSK/YbJQ603q/4BtXFC6bz5vxAM1um9XuuFziOAQCh4URXlzY8Q5zgh0OAQCHAHhFag1EdoiJgYOTFoWQhwF6Q2qSPAuGlwGdlJQLl4g2m2NEoKeapJQHp5hEfDyWs0KwsbO0PbY7rae6u4OfvaK/q7fCkJnFlM2QxDrAObLI0LzZPNY40ojU2nK4p8873jDHs8njg+C+1cs68Inuk+WhrzjpLuvmo+7JqScORr8W2NgJnPQvFLp535DtWziwF4CCLg6uSGiO4iSO/g5zaFRB0OOgfM4mZoT4oqEzkx8tphLD0kVJmIJcolLJYuQJnZh44mRz02BNFiBfDs0Jr90Lnx9Q7lz6ziLGKUdVJEVF1ZjMgCugEqontOsJB2VvSEWU1oRYDqaQgdWxYK6xA3jxOpJplAuMojzy4m3Lxg+BwwT09gCaiHCHtxoYnwt8AHFix2YqW0589S/flX5tfqa8ObHdwqUPK94h+WlWE2sb98CbmgBmMAtqc+4BGGtopKN10K59+0tu3atzxGV32gPkC7EBFDcxnDg+zbWTR+w13cJzC8sB7qie+kBzNIaRdwbOLexrD71hkC+dB1b67OtVxJ6c4juF1sJh/lded2HcV15+KdQzU3/vcaBggLpdpo2B9CH4U1PnaeAfHU0RqMF8m9U3DoUhWmjCg75RsQKKN4BomYjukPiiiR5IliEGG+7nIQYuIgbjPTL6SGMH8TnXYAZbxfNCj6rt6EaQqg25QZL2MPjbCUVqJSB9TsYB5W4v6GiliijYKN+WIXYpx5fabRTcB/5liQKTElLFppQYmHnCd2K6QOePS935AotwHmkBoRuh+aKapSgqpD8Y7mkoBX0i5WiTZlUgaAty4jjpBFQuqGWEgGb6wKZutmfklURahdCldZqqKaxtwtahW5+eGmmipDI6Iq14UhAqrqxu0CkHf/oaI7Ar/kh221vO8oqcskAyS5Krq5LZwbCjTitrjdaWuSsHb92aQrLffoAqltiSOym3c9JKrUnrfgBvGpMey6O86ZYZblRNWQjVI8zF22u/5/7rwb0ZQKWvBX8Gi/CpCnNQacNcWLGBnvbyO7EK9TrYLghcEIDsm8h6/DHIFUc2LsZLWGzuwiqvzDKpQ5JlMRAab4zyhzXDEogDNy7Wcp4SeeBAAQU00gFjt6F7BdFEs7DAAgYYcHXRrB1dCTii5gB2xwdLgRbWWnt4ddZsby1FyDw2o8hscpsodRRrs512mWjrnfXVdUEB9wUEJyIxda3MnXLZTpzdt99X/+T35Hs/MTh4/nlx3UIdg9HMOBJ5U9625KJDrofmLVz+UdBEnF065KS/bjrqzXotyN2thy776LA9vvvfgfdhexy49+D673oHb4LuyKc97wWqt1E8a8wjH3kKxzcPvPJdk0q7FnV8roPj2rfNPcjV/369J7B+n4UD4uOQvfaAK5f+7oC7v/Glz/fh7fiAK9/2jHc//J2vJYoyDyXCxyUA+q55bisC+QS4Nf1BD02HywIGqUW0Ar4uf4Lz4AepdR+8WBALnPMRCR9ovfVdQYSlc6GfOgcNP5gQBvOjX/9WkEMIytBmNwigANN2wlv0UH0RBKI/YEi5yBVRgkxs4gGVqLQoTi6JObFi/vKwSMUMTLB89SvGEZH4xK5ocYtl9MIYDbjDGJ3RfGkMQwdZyMY4juiNRLTjGdYoOy5+i48j1KMbABnDNq6JjgYUpCAIeUVDtuGNFbQZI5P3R0SK7odAFKL6ZGVJ002Riox05Bk6CTxFwgSQpmxDHz/ZRehoMnmpRANapMjKVm7scbXEySzNZ0sXOC6XQ/llLHtJzGIa85jITKYyl8nMZjrzmdCMpjSnSc1qWvOa2BSIAxrAzW5685vgDKc4x0lOcBKznOhMpzrL2YltNgAB8IynPOdJz3ra8574nGc3u9jNfPrznwDFJzcD8c6AGvSgAeWmErmJ0IY6tJ6NKOhD/ifqUKfZTKIUzWhCMarRjubToivjqEdHStKSAhSkHxOpSUvqgJW6FKUTU6lLNdrNBMyUpAoFIkNvOtKhcdOmPJ3oPqnYz6A+NAHbbGcD3LnOpjp1nOd8qlSn2s1hZvOqWM2qVrfK1a569atgDatYx0rWspr1rGi9BQPWygCrssEBbG1rNuHKAHnK9Y91jeda3boUuuZ1nnfNFFzryVa+UoSu+TTsF1qKz70uE7H+ZICs/trYwPbSrwGVrKkom8/CthKymVWsGjkbWcsijGhrReha05Xag+5VtGAArWs1y1rSAtSxgm2tak2LV9v+E7e6lG1mgbsyzO62aofV7Wxp/ttKtjqUuNAQ7nBhSwrp3pa3J3HubrFbTOMul7o8VK5BodtM6/6Wu3I0b2fJC03vjret4NWAetfLXGxq97ixFe90cQi4+pKCASAMk36vG98H3He2aQRwPP04h7Mt2L/h9W1pIdy6A083jg1QAD1F6QmgPlh+872nZyU44PPqUcH0VECBsafhDVOYBSEWMXpdYOHrzngFKCYsJSS8AJgKuMT0lV+NTdyDHNdzxShgrD0V8GJfArmyN7bYk2UcZRYYecNIPssC8LmAJjt5yvZkbwfATNjVEuHK88TkIbns5RcMubRJlrCMrYpmeap5DldjsxFiTM8qU0DOZXZrhrnM/mEi5PmeXT4Cn+16AkDrFb5IYIACEuDheSqg0H3YMqLbrJZFc/rPpVVsnReMGQAzeAeO+/Sh65kAJj8hxp+eQIlH7IRRw/POmmoxAi7dB13z+mmapqdNE/3qN5vZBOIVcxFsjQBc/0fX8Py1J6CNgARg5mqVTnOscyDcYzc6r8pedrDr6ewJOIDa0R4CunddtAWse8E+VnRrvZ1kqmGB2eWW9ZI/nWEFxNsCkg6zusad4m2Pz97QwHdx3o2ANis5nhmSsAKWR3BtS1PhyH63ijlgT4tpfNurJrfBiTppRE+H4YTROFzuOXGK67mZGIfNxzl+Tw4EvJ4bd/mmmRly/nlSOt+aYnkH8NkBlPON0MqUdLblKe2oaNwxRIeLxml36Xu2euSsrbidCaT1dA+95kVHdAp6Hs9h/1unXb+1h4z+9Y4/TehjT/vVz8nwZnvo5ikuWtQ9vm/0vbyLMU8B29teT3XBPe5/B2LgUYB3S8d67zafud93rvi0291qhyc8PU0w+LHXndgfW3ySJe8ByEd+yRYku52xvpDGb7hLaW/5B0zPgc4jnvJZp7Q9ga4B29Pc7YZf8hLx6epvNcDyvM+A6+OZ89mD3el9T13Xf876Ygya5YxaOvNRQPvaZ75ZyK/+f5HPqOvnnfvPhz7OxT8B1X+YKkrX/uVb8v3S/qf/A76f/O7P7g7R85D0JtB9p4dzZeR+1VZ8JjFqw6YssacCAuh9uxdE4ZeActd0LiB/zeaA9xd8OIcDVYd79+B/VjZ1Ggh8ZwGAwweC2rB8W5cDDCd76GeCJ/CC9pN41rcAukdu88KC7LYCD8h361eDLMd/cmB+OqgDNOiDG8h59ZeCu8d+WcBsFhgmKHgCPziA5yeE+wcLSmdyrNGEAbiETBiBdFGBUAgFaIF048Nw7HeFNsdygpRn8gdMZSBnyYdscNgCbrgB5yZi04aBZ1hrXsgD+WeFYrg8YNgSbDgJDaB9d5hxqOcCe8iHVSiBAncS6PaIY9iBkniIm5hi/kNAdnRYBsdXdpr4ATyIgCwwiRuQioGYJ+MGepNgau7mSA34Aqy4AYUogf0VXa/oRYuIi56Ih5F4ZlkmBxJXRrkoX8GYVg+wizFYeOqQiGKVimm0jMwYfWgFjdG4eUFEjV/lijiAjRogjmd1izdAjr0ndmbVh0E4jsPIeCRYVuiYjvGIAty4VfnYjfNEF+CoVdaoA+ooX/KnimC1j/woT18ofGLljgW3AwNZjvN4kP9YgtKoAxgIg13lkI7HAxGpAUbIdMdoRhVpkd64AwhZTRjYRh8ZGSVJTQHpkfeoH5V4VfUokDOpAikpTV3XfBCZkyxGhlzlWxqJkzKIhJfIWFUcGW2/eAEt2Yro5pNcBW1TaJQXuRhUOZJdgRYKcGlNiQFPaXPudmlaiVVh6YxhcJZo+QVquZZa0JZuiQVwGZdSIH8JQJfjoHJ4qQ3at5fuQJV+GZhIEAEAIfkECQoACwAsAAAAAOsA6wCDV1dXcHBwISEhgoKCl5eXq6urzMzMycnJw8PD19fX5+fn/////v7+/Pz8+fn58/PzBP5wyUmrvTjrzbt1j6J4ZGmeaKqubJs6ClLMyeh2zq3vfO+XjwIhMBgQEI+f5JEwBGZJpXRKrWKCxOLgWVAqCgGAGDCIWs/oNMtB0GoJXZ8DPB4j1Pi8PvNou4sFZjt9dWMDNnuJimdfWW4FiDsJYYUAAQmLmZo/Dwh/RQiYPQWVY5GbqKkoDgefAzM+pKUBp6q2txoJQ3+wPAqUlXG4w8QVup9wPrOWxc3FCn68OTsGpWKiztmqX64ItStz1rTa5KhBrgXYN7KV4+Xvig9OnwUGktYAwvD7Ew4wD4J+HNNCpMAdHZOsHeDHcEmChwaQSBnoJpmOarPsNdwnb4bHQP5KKL7Rt4aAtTIb9yX4CCfdtB7n6AVUAc0ayZTavnz0+M0Flk+hbiTAdxNnMxg7ZxBIMNOFA0/0NLYYKgaYmIVTkhgw0NMoCp1KPzZ1YcBNll4tTJZCOaXAADECino94cBAy501fOhyVMRiC3aFCIy98WCAgMOICcxtEYSlxwMvEUYb6dNqHcVSCiDeLADz4hcHkvLs0YieC6qlpPowwHkzgM8rQoT9iCCyT7d/Anj7a6ldVxcBWm/+DXvDSsdQeHRCpzrF21lK+gjfrK54CRGik+tgtaWiQRYP8HnugWA6YgDErfPJXuDAYBRl6cklkbBqnfksFAAwf/igerrHif5WHQsi9YVfB0NZJkZ6KQTHHwDv/adBY6LVpgM3f8BhmwmAFbKhC5o9yKCEGAToUUsD0oQbLyNe4MBzlRDwIYH8HXYgiROCtZOFt6HTogUPKCjGADPSVGNnOK5g4l2Q/KhBK/T4dwJqlWC1AwE1opekCkhl52QG8RVx1o0YsFEHMAEUmUKI/H25JQWd3HUXU6dNZqAKHY7hzg0KHFmAmm9u0CVyKZ4AjZiPvEDUIPvxl2agsbEnEQsGrPhIhBj8Yk1zLGApIqCQajBoUpxOaakWQZ3gxCyFosCmeaWGaoIMs80w6QphPtKqBnmaQlij5skoK3iVJnWEmxTkqgVaJf7AaB8zTjloXgDDuqAjXpTaycUJQSq0zpG7VusBEyfuhGkudhpBpjFCAjCeCqzVuK64G1w75woY8nIuBb0uyBiw0wlLL3i0lmsQsgvkqysQarWzrwaemvcabKD6QG52XEL5R6okNBzYwxi8KhwAsabEBAxpXPuRAiAni868C1BZiJUpJOAnxU1sdQCdVjhwHJM0pGCXIwXBjAA+4W4QZI0BtKxNAgdsJbUBTqtocNAoFBiAXx0ABswhK0Q8HYQVv+Pz1FMnUDZ4Js7m5qEZzkuINSuILBzNczGBdtpV08Uez9edCsqI9QVDE8DCvbtYznsbELUCa9NEK9CAjwsVX/7peHBAuyULKu3YSTdUF9pR801F2x5xZQJ3UWmO9JpZIkwO441vlZcUOrYER+UdKAsImYVZo7gHNsuLowK1ow35ROw5WeArZGpayp90Id7aAHgwIULkOuidfNS876CyR7cTry3XfCx6gmEP9s3lDFvMwP0NMJSevOpyjC/Ej/k6AgkHBxBH6Cpgt9YMkH4z6M0YhmcFedzPdvPzQMGEkLqHzQEZmdvA0WbRsqEYr2cJOJqQZLcGqD0wfD6RAdBmMKKnMMdzwlud9ThDrQYiIADtAoCU8IC8Bx6AhCXayV0eUDbfQa9e6vOAAz43MvcBoVI5HFI8aFc7tfkiNF4yH/5f1LWBVempKnjr4pF2+ING4OM+izjb/XYGRGOwh4gImgwR0GeBDbYjjBnwIH8YKL7CRfESmlAAFRu3PD6hzlZWrJfgXqGmfmnJA0xsDQAieB1nndESBGhj9wa5NxSqQIVJYRkHYuKdVknPcB4ooGs06aJDXbIQ/0MFDHR2P1a27S7pcSE9iqQAS44BMgi6GSc8ocBX0nETgnygATy5umKJJj2T+MRvglcKBumnRtiTAxRfqSeY6cF792NmCQ7JQkCdow1bA4kG7HgZD4itiT1ACjfv4w9n9PCBQPRZrUajSAraA1DQsMpSugYuHiDFY6+EhBPzAM7a7YySEyBnOv4wBRDIle0LnoBDITXQpw/uQAjzFIN23sFJqYFPdiDYZzpYWYEcMMWakaThDs4WUjJ48xb3pGUnwTFB8rE0bFk6IAfqEsVCbEGc2mhoFd1nL2btoXj8ASZjCvdKHD5kLjmtIrLqkhQeJaI8e+QTDkMagGXCJpknjCDyPsIViErCUW6VQC/RlFChwkOpjSvfE9m40EHwp3MIIuY8cUg1EmW1cT9chSocYJ6bUkCQCL2kbn7aDLx2Mq6acID1+DhKNvjyjLF8kxrDSdnsESBiT3gBGxw5Pbt+5rB5xewiBJk5ZIE0pKcdmGWntrO+8gMG7DzTWjLpW6PM0nG1DJQZQ/56iOIuRpD2q50ocbSXwQ4AfwP7ABWjuzMcheaL7TiTOrObAdhObaOw2aZ1p0veCZV0K861hTzGOthEthdBVZTtLbBAVr2mIgcsK20f9xbfVOiiphm8BQya0ARBBnixD8mZgDXBWliOd7/SrUGAc6DfNVQUjq8d7IX3+16dMTgEROTwfXVwQ8kmmBgA0en3GKxhG3Q4u1QNhgFuTAUQKFPGtlsmVwCygHqu+AT9YmQ5zPvjtHElLzyG1CmrElpyMCG6Ta4lV0RQ4CSxYgg4BBs/mMBg3mY5eRHmcpT/I0hvdFl8s3yIka8QgmTSDsv2w3IVa/DSNR95O0tI2EMwiv5FISRWUAuoc4TP/OMTswzEf95DEnwmAgSEwjF+GIJGleiPikKkxE2O2s6EzJQo+DnSE5i0CBRwgJ3ZioJt8MMWURVBf7CMz6BmNI1XjWqnyNXHy3w1HE5rhO58Ytav8K2nkZfrLI9awwA59ZsePWgZVKolr0gXsl2xrOLm4MPMZvQJhYzeXvfDZzUIjTOFcNp0meXd3OaFEkAgghqIW5lIrRYcH9KRJbHbCNuOt8BzMwDX0qXI2iO1kO8N3+xOg8sRCaFB2C2EYhOcIPAeOEGIsLW+3KpnAKZ0zvSszAlb+WxQm7juLI5Ojbtc4Kf1CAJ+KG0cEBHXzZaaybPxFP4E6K7dAH+50BH1hpjPYGeDjvYmvg2QReN7WBd098CJJvSOM+mkj5ZAzQnzYT47eZlvJofGXBFwgSPb6I4bNMv8sfUqJMHBEX5ptRZZ9oHH+i5Yn3Tb9VDPD+8dxkO/+NaMPoNlcpnI5qaYrMlO9L4YHQHLrEHTE58ku2w8Q+o6euQrqnXKK1cIczRCS2ZueICE3fMqkXnk1fx31L8jCdFuvetnT/va2/72uM+97ne/B9nzHhdsNz20f+9lhFe03k43PPGLw+E6I7/MyFWe75cfzyKDoOuLhgiQ83p66s+70ygWZNxNGH1G7zwbpi+y+q0zDdOvOu5B/nHpSK58Wf75GHlsVNv50dB+Ir4/+QzXaNMnS+SUdClGDtd3fOKXMzkXgNI3LOwhc6HQVgM4VNbnfAuofQ54ZuOXb/9BIcghIFQjAommCNcHd07XgN/TaJE3aPxGgtWiEytEQVfDE+5BZN13BQC4gcpkP3EnfnVGRDn4ehGoUtkxgRa1flIwWjwYTrbjgi+1diCghO3VCaIxg0X4EdAGaaTRhGg2fiHAFDCgYpRHW1eYhUVYKTsGRzfGZNvnhD8oSB9GhbRHZk3QU2coRBEoAwyGMtaygWnmYCiWaBWoHhzmY5A3cWhYg9mxEqumdF/RgIEoeWvHhd53Bbc2PlhohEcYClJYAv5qVDoMOH6rBjlEVogr9m3phodZiIWU81L7smCkKIfXZ32XCBP0tm6LuIsH82hqEoaPNgJzJkuwR3koRmaTE4KuuIf14IHDIIuDNnu2FkIrwYqMuIhDiDtoZTv7x34wsFa6GIFysk/OiAr1lle69w8QcY00GIFXhX67tRXduCU3FxGFxovYRQz+sF07RX1CyDLe0FNMwiQGhwfo9mPzyFDDmAjLBnnWaBDZuAbbeEIJqQYHyQQRSQLL9kzEIAIciIpTkFX+lQn+t4DbgwvxmFfliICsho7P+IwaOG4j6RVMtpL0IotZJmfeiE+JBwLQJ4AZmQhM6JKRFoaSaInMx/4KK2iTONJpKih5W3JcPNleB9lkGgaSkpZr9qVvE2lmnYQwkMgQQ1l+pVOR+5WShNQ3etNgWwkPbqgz5ZYkaLk3MFgzdLkRY9lJQbkJc6k8JFRSWMknCIkjYUg6pNUCNbl0nBeJ9Cc1bbkYPsmBYrgG4aQJawl2q6CVZpkGC9aYaMNvvlViBQkTVMSUclV+0gWZ0JWT7EUgJ5QJsIWU46KVgUkY4meYe3NSzuVA97OXZcKbpvMCmrkRZCZ/mzdTJaeRIVk7C9WVhvmY6OecaNZWPABqAwSMTvIw2+iDsqmRtFkOwHZmrSmYlTlUOcVvOFCKFPVeCzVLrZZc6BeTJf5XWsDJnB3gnEnjkaSGKdJJNZjVn2lzFPJJkT/gM55JOPaZC/1oHMnjW3n5mZt5HU9pciOHWNfZBHo2TXqWb/3JSm8pj7XZD8VplaZJAm95QP25K7A1k0DSoJuEb75ZL0+JeJwAai3CZO8xoCxaAf0ZXw+aNhHqIpIYlwZVYoeGAyUFnRMgnSOyW0qaAgCqc1hZn4h1nFRwoiaQpDJKSBXzoCXKBxgaTjHKo/g2mVfqmTv2RLlpVjmCmstUNg9KpPmBpvmYPSW3dz8qjybAZMQhlWkDp+zpA6sZToVYS0FJfrQ0f19iXk8aUXnVIiGQX3IwnHnASTtaRifUMl6KIP6DdKktKl1+9qF1igYpaJZUujfz46T3yUk/4qdoc2po2VsMtWrTN0jR9TZotqpump1o1n3NNqZP5ZUB+hUuOkqwNZ6Csp1Tk4NvCT4hupwm1Ti1pqVIyn2rc6qYKQVXhk/PygnK5D5JWjYxCT5OA1tRk40n2q16MZUogK1sqqsQyi3Y+qVAgKgL+lqvqQLv1SIDOqod4KTZ+KPA2kDfii+4WVgewKSrMK/zaF5B6nbJySXUmrArGkFO+neXuUxRAxvWyTZVBATHqpbJk5Aip38PC625SiyPCoorCq6Syn8lCBvuKjV9FajXsbIpsFvISnt56q9TUqz0wargMLK6Z/6dmIVXj8M9aHWrsZGkA2sUM7sVF4FYi3pYNBcbRGt7owOfiAm03kmUORuutdeztrRUxKqXEvmxtJeuCGG2U9KpQOSu3Rlp+Hc/N5a1b9tJo5lqjHqyKsFdyjMI9IcsCssYg4t6nDR/e3sBfQulx+oUjZt4WFqd9EdJkXqvsdGSdKmuGPZABbapYWut1mKpfpsNNtqFbuqzxNOp3uawT+sMHYu6hKQkcHshpMu5yJRW65qgUCq09GOuqqtvEdsDE9u7s/uix0uVsUuaaksT92Q/O/sC7lq6tqC5zSu7d5m5otu2adleonl6kcslLascJRW9ocKuu4ua9CoBD4Flnv56tnT5uqpQnjX6srT7lcy7veLCqCFZvqObvOLjteLCSTnoQBlqLdarc13mpbi7B1l1fu9FGJYadv5LXpRWl9FRvOAwvoIqXfIbKhdLnp95eqz6wVKGt1Phux18WbfIUQKMLypMmrRTAw1siP3aqHv6uBkciDVsiA61uC3FqtJma8XYwuWFwi3gqrYzhD1sWLb6vlmKs0acCE7rC7U7xVR8vUIRw1isBnxKGjrcxXaqxf/LwmKsBvzYcOQbW2fMmWJLvKzbxvz3xlaMv3J8BhUMxwB8x/3rvmEnnSZ8iWHKjaHKxXw8BZ9Gw/PWlUB8yCYAe1vXdHEXyI4ME1lXyQjMh8maTAURAAAh+QQJCgALACwAAAAA6wDrAINXV1dvb28gICCCgoKXl5erq6vMzMzJycnDw8PX19fn5+f////+/v78/Pz5+fnz8/ME/nDJSau9OOvNu//TcxRFoihgqq5s675w7D4KaR+PrO987/+vR4FgswGPyKRy2akVjcyodNpyLBxYpfNZsFK/4DDlYTolHYkikSRuu5cO8sFgSDy8PxFpTUrg34CBMQ8Gc3R0OUBoXAUGf4KQkR8Oh5UJRwppNmuJkp6fGA4KlYd+QA8IjAqPoK2eIoeGBp09ekNFB6w8uq69k6SGKHmMBcI/cQnJd77MHwmkhZfDaiS0PQkEAwEECNLN3xmjsofWOltPyz7YAQPtAwTl4PJosgdzxjznN/GDBe7uBOzIG0jhWSV7pnZt4dPFB5ps/941JEhwFLRZtTRtIsHrRY2I/u4K8KPYixC0A/hkiLpVBOM1iBE5kiRokJQ3HYsYjWwhBOS2YjMrnnSpwxZLoLuwgRzAJuhAShdTxniyxhGPngHY/UPqVF5NS1eJ7WShFGQBBF2FXhybQsjRamGXMpWa1pdJaHR5UiOxCmfZmAXq0jx5E4YThkT7yeUqWCUTi9DYguBCJO8KNIvRNo6B5YFnyTBg4dWhkSHoJv60xbS8GQSNZyayHEFzsbALfSRw6DAAc6vm1jMy2asjEImCcYc6gnCw0QYC5a5Tmz0NHAONOYZQpsuDnA7rD2Qof5+UYHHg6lXu2oQOIwECaLZZnFuT0KP0mNTRW7A47oCd/Ckc/ncRexw4kIpOMGC21Fn63VZIbePNMBwpEW6AiioxfARSZQ3yBBl8AJLXXXxtMUKAVS4oaNZvHV6WzEX+heiBgDbJKMFKCNq3FBE2tnjFV7HUUaEKqKwVBDFDhlJeO1q105SPHsJYh2w70AYfgRm4RVWPC2gYEY9QpmjlWkl+8GElWGJQA0NwVWFARFoxOJsmBPRFkigX0WFCD3EcRE6aFmj5RJkVePkPj4CqgEAAADQKgEgzeZankFxaMCZYLRgglpuZHfHAAI46uk1QZAB5CALbyaDAe3QYUtwKhxWBagsaNilRouQVEOqudpIkDmG9DgKjjBdy8VwLB3Sax667/gZAIjiXBvmqDHk+a6GmXBA6AQk7QuqDAVkxK6q135ARZCy6kVYbrhLs8URi4CW74AE/KMCouKJq+0kmkwYbRHfwesCcuzZ4But9AE3Eg674inpeV30OpYxK7sG3glEsaYuKslUi0HCoA1QqCb95GhyDqVOqMDAX5KqJMDtEsKuBEB87Wp9gJAPjn8wVqBcLgLEWAeDGtjrZcoD3fsxOdZ4lAPC0bp5EqJYMEapAbyF5qyoBNTd69J30VCsykAgB6sAIxuYnApMxGbDDA0kDEHej7KCI3nVih+bnHPkFnVvfCLdDBE72dg2AvgSZe240XPpcCErLCSq0awgs5jZn/os2zOg2iBMUx6p5KsAlyjdvcDZlD3vw16Gpp6hN14z5KNq6Dp5E3ZoE211g5Qt+zQHDNSscZqkP1sgzVKN5ILkNpWuwesI8T+AAqHPvylT0XZ0Zy54tmLqz8hoVMeTGC16eHvAf+363CE+nCgJk44C2fB+gXd0t9nB3PQCLYQZaUz2IYJfiKDQjgtnAX9bhnVnUd4HM1WwACOzfGFCmJxmRTnloG5TqsOak1qkgAdVjVsgkaLrZgQhWQ2FLHKjShw6Qzx1xYmAF0NcweIDCM6ITmcqEAzCTuSZ0qGHEBhfkQfD4A3atEIVBTOA+LZCtEAjQ1gU5oA9OcOCFMZHh/o24VrMAaM0TOdOT6KSAjKdFUAPaQ4Tp0MaQWW3geR2UDw3F5UVXyAE+TMReCl6kM8j9MCqmC98Bx8KcfzSpBCtYRxe1SIU0tioZotNjB+JgQkuYzVSXgM7yohhIiNjqSe8TleY6J4UB+ok4eTwDIb7iKqhtII3swdEgLRS4dnQjBZQAldICoMMl3BFgw1GGD49hyoOMUXnsC6b8VhUjDsCRKUXcgAG6+KgmfoIGdZgUhY7pKadVC0tWeJEy0mQFKmlAXguknOECcMZrZsIgAMQjN/NAwYlNEoe9vMCnfALKKxYghLsiwFNew68JTUqYR3jiIZIkSVouaHwADZUX/hsaBhq8k4LjgKQ1QyOOEW30CwjAmkw6oEjNPaorr+EjwB4pTIpKj49GAgQZDOlGKkbUUQNg5A1PAFNtCmmeKqERfEiZFG7Eznk3pVvznNK0ZABTWv/JhyPtKQjQiGJu1QuASyPRGZ4+aKWlyGFR7lg8xm2VCcwx3FFbY1Gn5qkeGjUHBdt5zX8qDQAhOysosPDOx2WnWlENjeOaCQ6GRTQA6XqDe4bpKZ72dKVl0ONrDsAqlOjVOLpUWjSpUDkBCKBRA6CXEj6XDAraBKEe4aErk2hXpZkvDIvyrGxly8sooCGMk5oDE3v0GTOAo3D42lw+V/DP2RpXtps9xUXB/mqJSCbIK7skqsoWIIQAHPe6ngXAcF2Y0rJqc7dQAmENpdsWrmH3vJ/dLnhOUIf+tOogkW2RAjIr0ZyitQYAQK9+AaBTzqTUtNnR6GW5Kl6JfhETutKvggVQ2zaQ4Z32YC6lBgwJf9zLWRSWwNXyu+AF8w8MXS1tPIEx4bs5gZOnKA+HO6zgk1b1wfCUMHj1M2BsrJjFCh7AayHhWNO2yj+pJCFZGIXjDiOWsZHA4Ysi/N3ACtmFbyryguUm2maIwqvMDcaTOXAAIksZvXgNWDPa6uNSZJggXf5yjvvLVRj7dLUkjK2azwuAgLTmyiKOinqZ4QXmWHfO2MUrm5nR/lSn1cOPEqwuoAMNwTDh+ceEhZKiF33cOpOXIkp+BlBpnGBKG7eaW6aAKO6w51YgwNOz9WKpQ00QVDMYKWdmNZ8HQOmJyvrWIfjzlwPwYRAbLB6xxvUFCCDl0Fb1oqU9gegiabBHmFPYMvgUiwOw4zeEzbvRQGWyc5jDckLbHLSms30lgafcZsdVAS4tJO1wAs9goc/f9kABrovXKnuCHn/1aZCYC5t3Krvdq4iDqK/wbSuES9C+cOTinqpNg35V3etWtruRzGrfElrC+s74SfqjW5ZG/ATBjvcLoqVxKb215O91OJBXLXJVGTrfKG84iX0KVqq2nKt9LStYYT6U/pif/McGuPTN85CJUqnbP9nGts9PubjvhnzoM7hCDizq2Itmc+lKz7g9hA51KniB1Djk6Sj46E2sa5OuXX/KFazgbmWbQNvtNflBWZ52cncGn2WA+KmAVXdZf/0zVDeBuj/ad79L4A7PfrLABb6MpxfeK/9kikRK8OAxJoLuj78hF5l1YVClJqQmQNWeRuL4zCfBgYbjfFbaAYA3dYPdUzd9V+aY+q5tjgBZ8cczUEUDgVPX27L/BH1tT006SlRuqrmF0yCJhhtJL/hhmG/tp099iTJKG9vwYhq4B30q0Mz41Q//9Nmx1O4nQcXiT7/67Wx+MpYnqZxfZ/HHP4D2/jcSAd0gwuo3p/7+B5frSkBxQlZOU3cCZ/EmQ8B6B+d/1NdoJWERTDR0Uzd1dkBZIxBSXpQV8Jd+9dcKpRJPpVcXX4cFdvAeGuFFcnNh4geAb6NSHmV/PUNdYlcDB4B7uBcuhyVQSVZ2pyQLyQCDlqJP1JUDQlIMBKB/76BjITgzPOhe0IBiQFgFMtglLMgT/4NyiBaFQaFEWadxiaWFnhNGGCclgwaGFYVbPnduX9ghU1dtT/Ya+sZw6EIcmBcJNfATlEdCbCccS4ccsrBpHbIOgkMECLCGDQKHudV0PgWILfIAHORFfFGHbjBZKzViQ/GHktgKhvJJJ1J+pGIR/qxido9DKbf2TKyDSEvoEB+oiO9VchEobIIoF1nTDYRnR0uWiCj3it8mBLgni6xzS3wmdQDWh7EBdYRQS+YhErXoBsgginMoRqmIaatiYb6YNTYXCM3ojAcRIwMGfMBBBqmwFFphK2tQhTNQZj5nBxnmdpl4hiFVjQnTCHBGBfDEdCXHjUlAA6wyTuiBDO/oEzuCf2WoN2lYI2jVU0LChsfBQbJIAjX1BQo3c351jUjAhafkiYKBDAkIj+9ABD/4BY6jbxQZgKY1j3fmHgyZjMv4LVoXdO1IAWhoCS8Zbc53GTSwkfBIH2h3DQ2ni14Xk5YEDiIAeyzAdmnwiHDS/pH4Z4769B5qGGRhgI7cR2jiw2Z8hZO+iIc4EGzEQ4rMiJB6VlhP0A3Yo5EpuSFEkIWzQQMzmSURuVDygDvooEf+yJFZkwuS9gz8xpSzQQwtNAjugZO2UjQ62SFASUDzUEXOIYC4RF1HaZdMsZR3k3EmWQHe+Abzwzy9REmPyZH0sZJxyYM9WJnSkwlFFwjhQQwBsVVxMAK9mJMHyJcQ+VVkiCVhpI6BMB9PYIgJkglY6Yv0EY082XO6xYgXcJtT6WCKWTDq1SfI2C3dIJv5KJXqw4fGNFpYUizEgJEpMgpDUDRsc4p4ORBl5h8M5VbwtZZipTp+eRaJVxS+aUgA/ik4bdIMhxlWgHICDqdGBbJDerkn2bkXi1mRxyGYsniEYnZNhtaFswAok3VCFvJOjGmZ/4Ob94QtjGChypUGdnlgNzSKMMKP7zNXmiQg/dYE2OFXtyOgBaNK03iW2uCh5HafdEgk1imTJSSaxul8gDQJmckX0imD4QieghOkI3ej3wQreplRaIdNBqkBJJcyICBIfECLcHAdyMibVRVj/RIiiIgupElWlTAeaaSlWaIpfGAaIfc54cg27KegMhd0tCKa0bCTv4KjprNxU9Oea6WeNWg0HoieG1eMFzNVkjFAriIZdCqlPkqlN7CjefAabdmoSlcPPYKkD7KMUfo1/h8iCyGCG+jwBcIJPjLGWzkTYPXTowUCI/pSGowwqjgHdHlzG4uqoTNTTHUAGt7DnRkgSE/Aqz5Co/7BUaxUQaR6JTMyc8SCG3ywk4G4n8VzD1xikfCVJJUUdOAERCyQmtu5ZV15ctLlpHhxGrhqWc5QGyniq0VAmsARpUwqSbiFEM56eJh0OyUzA80Rqv2Dq8BAqEGAMpFWIMV0D3+UPLRyIBnaPzSakC6HSWVyrcBaEOj6Ar7KELAqBW9prNGmPQihNmTDrjDZiq0yrT/aCJM6BV96UDxwi9szNHqJLmqjrRQbUmzSB+9ZF+iIrS2IMpB6nCOSKJuqKiZSANrR/q5gmXIjSasQcjG1ATT3Ghr5Kj5stah4sVXi+qTLQTq4EpJymiDHGLX+ilJXB1agOQkxmZxmElO49LKYkiEI+6p1wa82wYJ4k6Le4aW4ykj8QQq9JDlsYqRLQKMg+0Gkoy/4llECNCyEo5ommz2WqLG1wLEMu0NSwy5Bu7gseixBEZEDeQHU2rJWqKoq4EgUFQdvmy0Xaxg855IpFjo2IqaQSyTDET8ulRNIkrrpKjXGUbjnaDtVUKu7wK17UbYK6lTmiQT8WrS08rO1A6bbZSBR+5ck0VQ9e6S8mx60U5SVZA/PmwzRa28zEWvX0R3Vi0bQGj3Ik558UrKDu2Uw/uWDRJVGERsOIvs9GcFCzIO7N+Q95hoETZsiXFtqoHoLuvNtaHi8I+dN41C+GXC5DqGb69py+kliDNzAneodJ/OCeYChBiSjsoapuSosossT3fGQPWCASBJv5cq6ofGxOsSza+mXJ+sKYBmwHkHBMsC2xVORXys+MwwKE1y10bao5HUc8UR38wGFuKZEMNe+FiKaNvy7Ezsb0NsHgPsNIMzCgAlATuw82espTeN7wsbEQ0U4+9nFWeKHZmqG+1Gm8wo+EMoZPKu//YMGZBPFweE9K/vFbBwOF3y3VWLE67ED8FMJP6x4YJm0M4BHLuUzWtbHbhk6rOk9b6w6mETH2i1ix6FYCtt1tY9MyN2xxmaIqfdwVlwLgOkbC1csaynLyT6Qt+q1q5isH986pnoVwGd1JoZwyMNTq3sWkhUMHjILyYcnVHBJT+eCxiQ1xcRMr1hbCxdhwubwtM18BX2Fj/Wyn5VcsIhZzVJnUasmCk1cY8zszXBAyQNWyORgzhiru6cwLLNsftrjk0mBHJ3LzpMEJFaKCXQaz92HNxRCYZLyIM6FzwEIrXSHZ0ps0Mhbr0zwYAztSz2EVhH90ClXyhUtGF0ZI7yc0VXyX9vs0XbxGf4s0iNnfxEAACH5BAkKAAsALAAAAADrAOsAg1dXV25ubiAgIIKCgpeXl6urq8zMzMnJycPDw9fX1+fn5/////7+/vz8/Pn5+fPz8wT+cMlJq7046827V49iJKBnnmiqrmzrvmmYGLRRwniu73y/18DEw0csGo/IlAMIVCSf0KgUFqIdmtOsdst1zJg2pGJM4prP0Ad4ZHQsvrSHG02v6+DYohrstPv/KntMY0UiYEOAiYoagkFzPUtrfYuUlA6Gg488jXmVniiXY3J6awaIPZhMp5+sG2Q1kz0PeDRCRLS1rbobtGU+nLCaOcA0sbvHCzJ8qzupsD7ONczIu9HFRGtCwji4bNTUXqU3O5HLm+Lf3wrdYZvW0zDWpunUVZLwLuF82/ndCfTg1qE7ByYBvxblBgGsJ28cjkvZ8LGQJ3GhJRLiDrIgNu9OKYv+DEvZ0kFs5MOBII8JLGjsxSxJOiimRPbyHklrLVtY+zcT2RiUVLJpjAG0Zyt7fHKuqKkQR0MxsxQMNXriEjulKiDyyeEPyRIEBQr4ouoCKROT/bKdlDTVZdi3BRySXbHyLFaiBdt24HiXSgK4YW3onZtBX8GKJrSq4vZRzwHAb+USRvGTLQx/gzUk7ITqAeS3Bia3MBsEcQcHJTNn4GhaZ1gCrwvALhBa9MSGqjHsbM2rVO7Eaj6HRWsbFDviWbvxLiySiALhkYvrxF221HLd1mUpAAt4dsd0Dn4rOX79Al8X8sRvQP04NtzvyFCTGKPeROUaV9pt7NZ3fVGnz0H+V94fZpFQ32kJ+NMfI7ggd8J55Pwl22fwqRRRIdQtxZ9O+eVHw4EXXPLZbJLpslkQC7JwVYoh4lRfc83ANRtoIKLBUQ01ZnBfJioKtdR/Lvw1o4y10VNXNiyioAxLG9mkgjzNtCfcgIkwVYp+zWQISnorwIiDZ929hUCSlcjTFDnyOMiBVWuIx5oOBsw242w8WWTYlTZQ6YqWDzYongIeApFjMgZAF5dRZpaGpkhkSrCbCl4iFIKhJS6UIJ616Kkjnx5Y+YySQMbA3VtD1klVojWoqaKCeJ01oCGBVrgUpY2qdCmmml6wI2ce3JlqCl3lI4JwBByAmmieIhkTo1v+wvRgqM+SCphgxSXrbDwNXWdteTK5Rql0EpCWjapVHZlqkr4Wo1qwLHgxYgEHSAXuBOzw+IK5n/bqYmLQnlbohJDVChKbmBoUD6v2XfhBdiuEZyiW8zqKaab3ZmsCMZVegEd+BicH2YzGRqxrvUDkKsGtdunLMAcQPjkqbDMSIrJ5JNci8ATiFtOafNe6sjJl0kJmslHpWjYRwizjIm8H7Cr5blg3E1b0VkeL01q3/vV8caFzwrX0zL0V/HUK+I6QonIdYH1CgMKZCsUYIAztFaq50GXxBi1rwA6khrqNRBUFDBAAbZ+gfCW5GpQNMXb74N0vzTICNsrbXA8guOX+flc5sdlPXoVYzv2pvaYCQ04rt8qyWa664Id6ovhiZCO9KRhtFV1VcJEHFjVlQq7u+wBFVjJLzQYq6TnLKNauNd5glR6dGJX/HoDqBGSuyNRn2nfV6AlmbAEtMnMfZlhjDlrYOqmvPv3vrbNirTkXPwVJTQlWJSVkB1hPUu+/9w/b7lqgG7VMYLhUnQ4DIUgSoMYXFvPp5jkEuFz/VkcA2OiPEjk7TPwUVoR1GaoAB6yAVdI3QQoG5gEhnIIAEUcBfAFQB5e4n5zEkkKcSaiEqpteBREwpoW87lydcob3pAAm5xWgh+SYhWwIsD4cemdsRqoZ5z5AgrGgYQa5OyH+DJORgANEEIfUe0sN6yDFxRVmAQ4MCnS88ZBJfTGHE6wgbS4IkB/+6hgiCpoYDzgLBLzRd01UHfmGaJEyQrFwADMdDFADrz+WsIKwYSMkLjGENOpkc4cUnnAyGYPtVDCQcZRNnjDUhDHSRYos/IOE3jO0WXgRjCZsXxEOZ0reTeyFRGyeWOi4pkmlD5S+k+MIakmBG8EClw2zoxVZEQdCMugxsBQk1IhZgTLaTAvGvMYuwlOWAKlvggEQZvCSsDkmTaFey5xMCB7jyP5Nb5DI3Fo5kWRJBomEmn54SeCiOYBiEU4L1sRT8ZKwr8lARDYBAGYwI5nOKAiwnAPtoBD+kTUsd36zn9O84jwh6szRwA2FhAEcE0u4PnHikzIP3WhENyGaEUpvgpGJpzs2Os+Ogk1XXFPoQgNTz1+kdKM2vekCnsNPjIpFpl5Jxk9ritSZkBCM3ulpFJZEU0wFtVoFUGggKzhFi2Swqq4Sagv3+cjhNLUOBANrrI4p1gccoKw8PCkd0grWe96UrLE0o0Fft1aOiox0fzyhVFlhlb7W9Zrg8ozliqVXsNmxqmfFYCiumtiATkysmD3fUtWS2c6aZ7N39KxoK/A+gY6WC4hwQggU8dU2nbYNyRiCCDxjgAMMTnBylOtGUNXQ1yoBjfP5SVjCycQAACChAEiucpX+OwDdenRDvu2UbPcQIAOEM6HGPe5yt8vd7RbAfYZIEDeji7PwmOI5/wpcVpHb3fa6173O/VJ8P+EGEITiMQmYjeWMy9/svne5/v2vewMwTvLaQQ0IEBIBAMBEATv4wRBOLgIMDIjnBDjCGM5wewMQWQpPpAAaDrGIAVxgD5vBACNOsYYDcID5mlgzIO7uhVUMYePu95P5XemLz4CAEc94xhve74RS9Y8SuHjHHkAxjQGcXBsveEIJGFMIQuCGIyO5BQkYgI+P++ThtJgQxxrslaWQVe76d3oMVm9YHoAAGaAxPFYes0OzitEBhCVeJFjtm+NMXwmI+RhyQA2co1v+SRSiEG4JSnRv5dyTIQQaBOtYB0YKmBdGgydcaDw0GURwKcua09KLmIMcDA23n9zK0/PsGKi7gOkEIlrSqD5sQVatBfmQodO1kLWuOUjrJzx218BO1Z97XcxYBxusiyY2Ko7NbFoOW9lobDazvxBp+kD7CaWV9llGoOhSB/oUz3YfL1Wp7VRxO7iiMLIbwg2erApAAMBzn647XUVvj6KS7O6JAt7Nb34T2BMkm4HAE13quFXy2o4qQL8X/u7BUQLWNuheugc9gXwLVeEMz7gABmfxizl63QhXkcZHvnEQhtwoBiC5ygEgy5PTIwEqj7kAWN5hl0MBADKXOYNrTg/+SiZjXg/Aec5zXj00ZhY1ku5qcfI79KEzuMTgCoXhkj0X6zY95wCId8SighmwGWAAV9e51tUpg3qFz+tgD3vMx46oXT1OOkswrtpVzvaFyGCFfFZEfoU+d43/20gQ35yqRTsLAvSd5A7fplUCquPXko7vh1944vO+l8BPLEGU3+bjI59xBmcega/gKCc9/BzIc/7dLLdDeJIu+o6rMDDjHg2IT9/v5tro1hClOkgUwF6W49MBs6f9ALqw+FSLwjZ79y7PJ+DuyAMA6n+z/C1H3+gYmxn6Pmj+3L8rBalbcz6ff9uCN4x9Imi/6dxPAtKrmGqQ5kMlWt4wAA6gBav+Dz3cCaQ0oyhLAdQkMPwnMH4DlkrYsGAqFwBeYRUphXlDE3qyUgnWJWAF4HoUEIGdV35UgHuCl2fYEla6YH3KdWHTk3lfR2JiBjdAxX80szwA52DphwbPMXibMDzfNx+DYiax5wdLEH/vxWEtpYGYZF8PoRhUcwwJ4GB/RxUohBG5J4TD8DoACHIfIIBAllzLlwX5V4NOOAw30nhbsEo5+AACuGGJt3sOeHkquB6vc4VBtESsg4HhMoYb1mIAcWj6xyimhBp4koY98BfB1HI6Umb/ZXvqwHpBODnLVgr5UxVIgAD9c0QnAILuBYj0xX4chYiQgIMsIgd8uCZ09of+1xGB8pdcePRr3GZfg5VtvFFfX8CBSpI2++U7YYECCVCFAJaDc/VQNngEX3V2HGAu46WGCBAHv4hXYVQeD2CLzIWLZ9BaNoOJRUAySYIxo5NeNOQf7TQbW9Jg/8WMqBVwW2gES3hPqmENwYhA1vg/iEFUvwMbA5KMAkZgFNgsSNKJtpQRtOgjjPAZVOcFMPWCFyOI7zVhrtML9jgetAQqLFgBbDMkpmFh7UiJa3IASAiAOtKKxzdVAvUbooMB48NLXvBGTTSLXdKDySWR+SQKFhcKV8J/TbMam5Q2xrhYKOkfPDhgFkluLRkIb0co7nFnehEnjwiQlOFgA+CNtoH+PY3lM2uwM6sEMLHHjn8YNQoQf7bog6KVKDfzkqsxKl7DG0LJPkRJGTfpXg8oMnSlCprSk8lwP28RLx8wk5ZTk2uyAHIoY2M5L/V1ODK4Nj+jGU/pHSeQX49IkC4gie1FAEKVlk1wIHtjAlwjNPZBVk30PzBAkQPGZWxYJSRzICeiTZ0yJYPZToOTlylgXcroeSKDQoezOx2ZOKI5mREESkj0AgLpXgOwmXYgjS/ADpmBGtxRKrQ4UrJomsBSlt1VdyGlONpQHQupI14pRkADU0ipG4jZXXAIEHvJKDXymrDZNRNINu1kZ8YZA3dpZuE5F4e2k5fBWVURncNBNk/+JUjxBHwmmXrqiStB8Zwa8JNrpgKEKZY7IIapeVy66VBmcpBDxZb9Z41w8SpyaWcy5QAIUKAm1xPohEw78Rvukkj/BCwiKU08cAkFCgAHegSGeBYwFCknECcBUytsRp09IIrvRZdHoZUk8ZcE9JMEUJvDOZTQcJ7blZ0At4cO5JvJ4TwGoB6FIqOowF5AhgDzmKMiQYC9wqAi9JQPqiLj2UBEgJzLVZ6fsIYpJD+BEJNL4YiPWJ17cZthCh6lpaAt5Bsf9hlRE6ASRJ5GcJ1YWQ8bOaJYagHBUTpsmgxqyj6F2gFxEoIEcKIRciV61gyBSlrjszt4mkNeGo1vYaX+icCY0gANdNoCI0KkGAB8xLk6YvE3ddiFcloBk0pa8CkWIEI6QGpgd7iU6PGqxYSmo/F1EUmqf1Uv7peItPMC6SidQRI461NS6XlaXZioWTNr/cCPNRKja+pbNzKssqCrDOmh7hgPXdqshMcO1MQlbqFHL6QGcCRIwCod4mJts+SeCKGlw3GD4wkb2IoHuucS3FpNQfOtQQFT7VotKyEVfwYlDxGblyGX/3laq2ewSMCVdfqTyORWCgUvNtcp/WoBDhqfOSCVEgQbU5pZ5rpIemSjVWFd15qxG8Citmmn8QSylwOwLGseGytCxyqrJPFWj0h/NYtTTbkDHgo1aSTqszSZk9Ihsck6tGmkrutqZ4b5s+Fys9/zGSETI/5zoVK7oEEbI3YKqP+4tScjr8OQRU1ltP3koyybNw/BNoDRVDsISHYGrUjmneghJG8LDQzrqDfVdZswPnnoqznUo3w7M2xbtnbaUzJbdFJrt/kQmXBBt4GIW7SBtISBpLIQqwObGJLmi2tLtaW6SkMysif3mWe5SPSqs2L7BF0EBnogIaVCuienNEawHbljuauGdCVDTam7pKtLOVUkBidbuCwbadimsL+bEmASNMSbvESgRJLpvCmRR1sqvfoWGKNkvTMxWdCovcr7WhEAACH5BAkKAAsALAAAAADrAOsAg1dXV29vbyAgIIKCgpeXl6urq8zMzMnJycPDw9fX1+fn5/////7+/vz8/Pn5+fPz8wT+cMlJq7046827/56jOA9onmiqrmyblYvjbo+S3Mo473zv/yFbIgcDihKGZFIBbDqf0FDiQD0Yhk2bUpkoRr/g8Eyx5cp+2rLBK2673xgHUo39zdVMuH7vftzLeT0ialdsfIeIPg+ESQk/NYQKhomUlSp/W44+OVSAZ5agoSBkjIE7nJ1KpqKsrRakhJMsaYCutrcLi4QHqy43kbjBonJWSsUJnzNzxY2yws9wfozIPIN0ztDZYrB4PJB4ydribdLAp5gGvOGCIiXr49nldDy0W73eQzjY8LhyZcf7QNxgpqqJvCtd+MHjluleClIEEwJhuEThOIoFXVgrI1EROgP+OizukPOgJBRd5lpstBcQxUpjkkSOSXLgRksWH6+MmfIvZI+DNA88eCfTBMOaRE9Nu7mhHk2HLL7hYVoUAzoqUGf+q9jCKdceGJNQrXqBkVgnKMG1+FgHX6mxZCuYTZJUJSaALF42E6SAoCq4cSekpZnJSU5qK2r4BQlYA1BVdQNr8Dc366xdQmdhjDmSZzqWklU8roXGrGUOXkFGBiGimN/GoSWE5WKEkboVqU+PyukzNorZjYDY1nRpGRfdQXat8Z2YcKnSjGDrrQn7FVvkzF/MPQvWtAq9hZTGqp59AXCdYHmryBFpdQepHHuXR5GTdg+ziE84tSL/YVjs82n+tx15FhzWmA2LAfjCYDR1FOB6c1lBIAWzNfZLfC5gJKF7Dza1WGE7MJiRfoS0JVpYDnZ4yXYKOsYbhxQoRkeLr5g1lIotiFjGhLl8VBMKUjHD2YnTwIijBucRt5ZZv/WlFpGR8Hhkfeko2dxzRnn2GUiXbSHkkTxQyWVX3plwIWkpjMYYmCFGmGIKw5E445UpsZnhdvmtWOJYfxxDowSj8SKlnZTZ9ieFS4EA318pUObXkGEYmY0D6XyYzqGylenBaP11QIKmUbSDhaTPkOHaP3me8JgVVjZFES9p3rUEqaLdUROmtzhpaatGFflBbi7pOGYUYYVWKJZwfvhmBmz+ASYspE0cm8mgoQg7opwzcojRshuAF95JVOKaK561+srBonuxlsZrxG65p2/n/Skifx6w9+hYJZVCq6JaRsectV/1yoh7uRnprYloXMXRvqLVQG29W+34G6gZAKuoaQx3cF7AoQqB0MOokYttNxycaY+6iQLhh6VmtIHOEBnT59yjqkaMXlMlAvhszBVvx/EXwsIMBqXuqjGWtPZN1m+676FohJi3vmHtDQ7wXG8q/o6S8guwCHmTmtxGRSWrIEM81w2pZsHyzWbXeQF7JL+H8SY+D/uGkz4j3ESfcXs6Da8UbrYpitSqOS0fABsDkrjn4slUOX4BPoHJ1zpGMZn+RdNh9Z11Q/aEqXN9gHRwGjSrMW+Dbqy3HjX4WKLQe4us8eUTbMTM6hboGLaqYn5biR+9c7F7Xj4jhyJU4EH7dk5SbqwaK4sE34jyMwy2WEuj7/5AgpGBPeHo8W3uxCDS8yc+ome3fXJTcyAxfC60864cF2Wr7Py0D4up26Lv9zgE9RXwHuYixDg3wK1zN1DEdmB1uv9RxR2zy1leete/YdRjbVcA4EPqgxRP5SIGKtNR1XBTt049A3iZw8+NxrA2yYkBXb47QWtsVrlxkCA1plnhBFl0CPDAZmWOq0rrOje96sluD7pqEGCmo7jbxGWIRMSdwJC1ByiuSYbniZr+sVAYRXHVp4AzEEEOaLWyFp7PFSWRHqO+k5Mz6qEvBImj3bJzBCKKBTavAmMVKVi/XN2vEWvYFy1soJDEPQ9MB6zbEHRolBH0cWjO0yM/rKhIDfoGiCyrYHluaMfFdSiSbhSJGINXDBPG5VM+e6RF6thFEMbGcI0IZWC4qAa/sEqS1UqLFQiCy3+pcQm9pIThNGmnCrBSkbAjC968ZEpEyNIHR8CgPZ7JB6QFMyokqIENTOKKUUozhkWJXj5UaYKq5UABBThAAdaJAASQUyOwXN8TRzBCxJmHE+hc5zoJoM8CLOcWlKRiMauRi3wpAAH9TGhCEXDNiSzTbQPNCwn+kIBQhCr0ovqcoy3EOI2I5qUkOUgARkdaAH7uswA5mBSCGuLRcsZgoukkqUlPOlICAJCaYUKbFFtqzHtewZ8yDao+ZyoLbZbknY0SAQl4moFshlSdJKVpQmeqUISmYxIhRZsNJEEEbuKUqSuoWusOYNF+UlWqUx0pL7oAQHS5b6tbdRgJvgrWbt3TD/nE6FkVutd+ImGbq7mfVv9HBM4g1aNiBen20tpXvkbVn0SA0Qw7eQWEwHWM3KyrRuCHhJg+Vqr8bKxI9dHMpj6UhvhpxF8v68jDvjKrBvisbBM6BbZqhbJ4QggO4ppS14rSBrN9LFXV+b96ige3EUphPv7+t8iYMJKni5VtaB3bT8s+Nz2VRS5uf7Hcc3K1BL61RV6HSl2SthMpMqCrbM6JNsUR8Zu7aG9IvZvZI423vI4lg1zVa4H0HtW77d2lezsHX0DqlAhsGm9jq7tWSYTXU9kEKXspZ5YPFZil9pXtFI764Kj8V5s65Zt28cNfUfQFowZgaFdXGYOS3HC+3B3xu+zbl86irR105DBz2+sc3DZUGJgtMfQirM2sIuHCltTsfKrWDgDzOH5KJtR/YWyynUY5oon17javzOX+urLLYA6zmMdM5jKb+cxoTrOaRQJe4665mOisbSFc/OYpFWAAARgAAfbMzposMhfprbNvDjD+gEIHIM+FTjSf18mfrrpZ0BZBZ6InTWk86zkAi05nBiP7441KILF2SkClR03qPBNAz/qkAkodNp8SsDek9f3knUlN60ojutB7nulbjypkKER4q3+YQ5J9U4Bb1/rYlL41pjN9Swd3+KN4fbJAH6SAU4/a2JamNbaTbeplmxQBt4osDHrdrRfnwzYQpfY+Q6vnRCPa2NuuNbwrPdNSnpPJb0jvCLogZ8o+mxKi0rRJc31qayM72wd396SZXQj+mtt92e1kMf5dLfOAJLZUGDi7CXBoQyf84MbOdQHSNhIJk+GXeSP3CZnw19jSlOAfT/axb41SdoCUwjKu7LARe0/+YkyBvHtut8Jjfu0BGEAlc402ypO7uMieeYREGG1Z+WxweSO7ALT69VbtiEGInxOCkC6oHIYQW5evO+gIL/qkMxMCc0c85wYWAaAfHfbcyQAHZS/p2Q9ugNU47KmoJbCBC0vxujp4CeuMrcatfWh+QkWx7rtw3nY7FJVDw/JebnIjzMroSeC1ssuQ/DS6el3DAxYU7jgnFZIpGLgbgxdN73RoYpvoAhQeNXH4I7pb7sgvj1nUAAh+8NepjXxp9681mKuaCSD85gNgnbdX1GwiB3pHCzoBAXC+8LPPQFzgMBOF6ELlMU9s7Ts/z1YG+H8Wx+rbD2Xn4jCA+bWPaZL+oz7GlKd7FWEbfTRkf/7ONwAIQEzRcE8O5nuJQBEuBA+L8H8A2HwDwHZmdlqkQxZ+wHEP6Hw21X/QYDjwpw0ilYHaZ1NiFi/k9wUlJYLNt2cc2E0UmAkn+AUkcGcqKHwEcHRKFk//xBwz6IAiGAAj14KVABydUFpkIQfMV4OHZnstBT6H0yFilIQqCIS2F4POFElCKD8E+GmSVoMAAIQHwCbegibjQAAIIAAAIABAmCYKAAAD0Hw+SH/pJxk6uIWhoAACkId6KAAFsB5tGIcPGAB2CA9jOE0K4QBpuId5CADVgQSASH/CNwBGyGYagmEmADyTCAZ4qIh6GAAxg1D+XviFAZCJ41CHgEEG/fSBT1AAnLiHfdgCxRZ8jziCTBgYkdQoZaV3fXcIBNCKexiGebEACDCL5odpqogLkKNCjZJX9YYIBZCIvsiILlADsViDA4BSsqeJPuNEQIJRg+gD0OiLARAi6BSKjmeFYfWCZChDD5BfDcUELZEAvuiK3pCCXkgAC4hGR2Yb1IETI2WEYjUK/mRSHsCK85iH+XiJmEaM2jeA2ZBF3fcduZhQAXFQLqcb6OSD7sQBDjAAB4mG1GIDhxaKGsUKhVhEE/SPkSFpHAeEOKgBz3h+r0gD4diKBOBGIumFh2Z/v5NCHFE9JBUQhFZp2PAAb0h/7iH+jx8JjJtQjcV4fqPYCllUkg/BefrEk4Aya5MmiBpgAD74f1HZAQY5jwBAikbhlD84cvfnJTM2jSqJGncWcrX4NgDIlDQQAB8ZAPWzCEc5hQPwjdD0fZ9xjC6CUQylMVWHazN5AR05fwNwE5t4kAQQLZ/CkDKJCJBgKaXUAyJllVXYAaJGb4vZX1J4fthhAB8pAAnJAilmmZGYjS6yQFjZjSPlHpQyasT3AjFJf1TRiwcpjU+AhK4JAC95NyUETWand/r0NUNJaem0AQlQl6xRk5zoiSdRbaU5f6MZBrB0S48AWuz0NVq5dpahALO4ndCZmuj5CNXGkKu5CRQUSg7+AFUKRZVvM561ZxkPwHyAiHUmMJbR+J5dkQDZuX2+NVlsKU+C0JnKqU8AUm24KZaO2SJ4+ZsvZI8rKGTx1I8TMVLERKCi2QHyV4zFuSnUqYg3uQ0taWquZUhmWU5md1YKImrYlpvQKZ0ncACpaZdAc1ApFSlHkW704KFUcZuV9pyoAYDr2S0A2ooAIKAEFSnbwwyLAZh+440K0o64uZq7aZopUKFk6RsnKXv3dVLHqKVbGYG64QBdCod/0oYfuaSrNH1zqBL/CBcQeqQcMozb13w8CgJN2oolWhXgM5vVw6BSRSMg6nHXKKcVYJ7zN44qAKbRCJvGKaR2cKcoYAD+iYlqolOgw4cbJ7qHkhoX/cY0viZSfUUjRuqcfwqTAFgdcHqQjmpDTLBNL+qPGJWruUBoNSqgCACAUGoBgcqJlio1+jc+yUlV64GfhXaYvxKH2beGLECpTnqssYGKaFVzVTl01PoBDzCLKYobqTmZalamDroCBIpt/HQCs2idOLGjabYI2wqtKbCok2ajH3AAs4gALuCbZJmF0ICoNIUr2HektVogAFhA1lqdAhsM0VVVmOIACJCm1zioHKmkySoQ5WpmuThwEtgozqqmqgKqX8gjZ7iUY1Y126qW/mhrcwmubfqaOwCw0Thm6Jp4BLJOIUofCzsSDauIA4COwSD+Ao3FOJyadu36G5BInDyAmnEKZujKT3W6AUnrnAn7Nhg4gudTrIo4rDhCjRcVkd/RnB7nT5PqmD8RtKR6ZSJgUTJaQCP7Iykws8KHS6Oqh+aqWTmAYpsjaUd6KJBqflkLAjr6kQiwsWwithcFthiQp86JR0r6A16rh09qeCO1i8rQqUurAiZbqvSQt3kIuh5VA1Q1U3pkADKnryhgtyeLBqLLh0yVs0E4EqrLqNf4qoD6iGHpA5Wrh44bGn4wVFQ1KA9QsZTGTxg7Cn3afIV7Ah55kI+JZbQbkiPLreshrlkgumUZUcA1tk0pmuTRjvNHgkCglNFItIcQsQ2KvTv+sK6M2rkr0KZg2UeVCwADNYN9Fbyl06ms+xDn+QRs+7yvRJ8JZZ8rcLtYO43nSU3mWZ3em1bQ9wOtmq/8Wzva+znPiIayO1Bie1YXXDEja68s4Lrd+zknFsKESrDL2aG4ySMHEKkqvCk8xakKZagPwXiKRsBdOYvLW3cBdFH1g687HCImO65AjCQJgADpELM+oMD5ysOwan7mm8QvIEY4tT24+cOtK6xW7EFPcLxb+rRe/MV8ALgKR7ZRccQPu2YZeaQ/0ZcB2MZqRsSmJsUb8Ll0nGZQXHt47BiTa8ZwUMG156/34cOCPMjI65wzTAEOIK3Bh8SJHAZonK+9ZMJUezyBs/ZuAuhGbBqp2DrJRKyYE/GIBJDJZaYAaeepjwCqXDzJBuGsBWDIdpCdpwzLbSAHCmeG9TODxcaCuNwHDGpTjTwZchfM0bBVyLzMzNzMKhABACH5BAkKAA8ALAAAAADrAOsAAAT+8MlJq70468271woiIspnnmiqrmzrvtgoJ3Bt33iut6E8lrugcEgsbnwzo3LJbKqQMqd0Sm1CR9Wsdlu7irjgsPjoHZvPYS8CzW5LHAuFYsEgqomM+Nzh7nccPSJzQ3dCcTJAfooXCUgKdUGFOwyBIwl8i5kPDFeJOpI6lTKQmooLnZifZTuAVwuli6edkauhXq+wfpSoO6A3rVCPuYqiMrg5vjaywcOmXp43yTXFI8fNbcCOpNG1N7vBqddt1IKqV7az4n3ZPsI40i7fjuHqbOQI1l3dNcuO9brkFNB7AY8FO0Tb/tm79W7fi37tFPqBiKjhuRv38kk8c/BHQhf+BVXIazdwoxmKP7hdnMbQpJuRCG2ERAHTo8s+GWU6ZIGy3M2XAUs+2amio6CPP83khDHTRE8SSftw4kWQKAqjIpBGPeFAqw2sCLyeaOphKrghDIRKXcA2jqFnTK2eWLqjLVuxZ/IY02ij5tGqK1n4JYG3BVtjhcPA8ZGAbZB70IYGXgE5yCEfC9SOMduOL4zBAkHK9YDVXY7DUBJz4WypsecXdFeQ3fA0Mr+nqrewxvy6xe4fmjvMzgA29wnUV4xnWXyr94riLYZj+C0ouIo5XhKEVqS3+Wm4LKRfiH1bzYIGmrq7cp6itPIK4iuAto4CORQ6sNTfZ4+isuzRG/j+p8w9JKCXi35IONZXQOEBSFxA79H2FD4RioEgZraxICAK8U2w4UMT4ifOhXstSBWHDl7gnjIhVphXiPx9QN4HHT5QG4vmuYgGidXE2MFTNKRQ44wr2JegjmzwKIKCLqyI4mRlBQWDke0YaNJgS/pIG3hjpVgBkSlQiVhSDcD4wnxPQnEVhCDmuJWSjWU4F5c0eukhnUW2uJUESuKj5XRSmiCekzxNqICVe2LppwtgZiDejYbpuScFZZr3pwWQ1gllgC1RJumkFPTJZHtsaqrmB2jm2YgrSI64QAKrJngpBZkKZ2ejPyoAK6ugZqCoWyKVauumgHbiopgiaNfqP6L+zioBrvB5Wetxn/bqK5CjmpAqB7MRSq15iFp7raXXdUoGsZji+QGySy7rUrNhqhtDitBiwC6F4ppQZqyyrtkJf2RdNk991ebbAXbeHSevBWTxixnB2Q1i8AnwmuDtvOhOsK0H9x46cQoVy2guBg6ntGU66xb8MapmohqoBhm/IeyPIYa7srYte3BPYkhYRx1UKathWikOFE3fJDlzQN3QGjQgh83FprbuPY25W1TRvk3FQFpShLyBUXLCBsUlHL/6DNRFdKV1hVv7sPXRODhtXti0iiKxDgILEuO9IjKhttvvtZ3a20zAmW0GAjc2hMB3S+jmEmpTtzXFamTFtRL+XmuQx+GstKUa32izIrgayv0MONZFZF4K31ZzUPTolZdeORKE45G0JqynDfvsYXFlenKXC6H6RCrn8Dfvo8Ct8e/Atz6doc5W0XHoNWzN/OBF7Y689crThG33yxHYt/HWI396C5GbP0rwOPQJfhUOlIwArOP/oj3v3Pd1/+z5t4/bIgyQH2HIt7/YTU4Hx1Of5d63ARJlZhHMmcF5cJBABdZOCOlTYFjSwsDnJQh32vhKBc3XP8wV0IAdtAAlVtW4WOiqXTUYIQkPKAUZbo99BmkL9dxQJrakkAI2xB8OpxBE/tHwZtU7IemGuJwiLpGJSLRY+TT4th8SwYlLtKL+wbDohQu6IYMW9GIUMQBG9ZUwE1wEnhZ/ksbBrXE5SuziEaM4RSpCMRevux7txJivMs4QdSZp4x7fSLQ4qnFPggScuAzpRmvl0Y69YuT6ANlHSWaFkF/U4wj4ODE/km5SmjzjGB+QRue14XqcHOUblIhJbKBQla6rY/Im1ZXB3RGWKoLdLQPJmVTiMpaiRKT1dvnLYhrzmMhMpjKXycxmOvOZ0IymNKdJzWpa85rYzGYQHNCAbnrzm+AMpzjHSc5yhhOW5kynOtdJTm6mwp0C1KA8kefNKHpznvjUYAK6yYcGxDOfAPVCN2/WzYAaFHn7LOhBF1q5He6pAQyN6BX+ICrRivrAoVuhqEU3ylGLYjQqGu0oQxUq0oV+lEwlHekDQprSfA50ZSRtqUtJGVOZqq+eSLynTTXIzwlwk51ADWo60SnUohrVm63UplKXytSmOvWpUI2qVKdK1apa9apYzapWtWmXpK7DLtiEwwIMQFYDRK8ZYy2rD6Up1rSWlawPRKRb39oWryaFLW/NK1ntagYH6DWva0WmWP+q17PijrCAjSss24rYwk5qro01K+c6idfIApavY4CDZROL2XUMdrN0NezqILtZH3b2DJUFbWjFlVrVwlWxSfmsa197WjTIdraBDeRtVVtXJLZltrStLRNa69q2wPK3wJWscIf+sFvewhaXxHUuHpGL29wek7HA7a0fmgvaySaTu6V9rhiKFt3witeZ2K0uJbcAXssaN5vUVS97yxveNx7gvqKV3n0PsMb2Rta6TYhvcfM7gQUcgAAIvu9yv3JfBBPgAASWAH3d613LTLixplXGgR2cYE1smMMQFuGFEfte5o6YxOc1zIdBvOAXOGDFDg4xDk5M2Aq7QMDdtXGRYMzhCBthARwOsox/gWPzfqXIFLYMjznc4iYFWcg+roB/UZxip5DWvHw18JNZDMElxzjKUkbyf6ssoeSWuC5eTvABPJzmB4MZUzQu7KU0W90iaHnLaoZFg/Hs5ivGma71kS8R7oz+5/sOY8+FfrO9rozh4+R4vUrm84PX3AxEb3nIzJ2yWh095uG22dA/2m9tX4xfD1j6yZj2M6MBbeUaA3jQn6Y0Bw4QAADYOgCy3gGtbQ0AXJv604qWEKN1DGfOOoHQl861BnbN614r+wbM5rWvO3BqKDtht8S+QGWzjbdYf6DWzb51EMAd7gAcrdogDrbrtn1WozW5wN7mWLilHSMHFKAAH10AucPtI3R/mYhGGwayUf1sDew73HQrGgAGwHCGW2cB85a2CfydYHXfNd4cO7i0g+OAhnt8AK7T+K21RPE+N3PgQi64wSNua5VToAAfb3gBZs3yXp+g5Kk+JspB7HL+Moq8185xwMJjznAO6Jvl5r45sJWJ855j4AA1D4DriN7wDvwcAE6/QNORufMYZ90CDvj5tDdA9aLPWuwpwLnFxdH1PKMA6kj3QNlBbvWaf90Cav9l2yetgqvffe6mjroK8q7KvYO6PmI/GuD/IHZnET6Khr/7Bfz+gcVTW/CDX7pvMY54pPvI8kZv/AoeP7HIswDuEZd65ctuAsqPXvMGM/1zRL96qjsl8aeHvbVkP3rM157oJ3D96yWd863wfgXClzvrJ+774fO5+D85vgqOnnoUgN4DtM898dceBun3vfnKt33wwZ/57Ruf80XC/Qmuz3jPv4D0JvH+4MnfAfb+153lkt8A/BUi//Zk3wT2F3pIt0b7pw79l3b0V3/LhwLJ1wIFiFbo1wIN+HsxN39xVwMPCAsHGCbqZ30LyBX/5wIZmAkbmAJXp3opEID3V302MIITEYGG0YEeKH7fl3pR5oJtUIImmIDhB3zIx4POl2gaCIMuEILr94Gdl3qthINjoIMIeIEroILYZ3c5wIRg8GLEl38fEHY1Z1hS+CNRl1Q4FwtZiDdh2AJfGHJdqAMlx33K8Hxa2HpUiIZI+IQsWIVp5ob8UGhxuC4yqAJpqIY2qGtepocwgIUpN25ASIEf9wInGATVxl+xsGKHdxpGmIJ1yIHuR4jphjv7VYn+VbiIjOhxMDCB0PaJhog3zHV1BBaIYDiAi/NuJHiGL+CKKzhvqfhLpgiImWiBd4hV1DdvSQcDtiiIwpiLqrSLvEiD7yeKTRWM5eZjxSiAg3hVqCeMNzCNHKCMTsWF1VgD2kgbfxhV11huOBCOG8CNTKWOmMiMMFCOzYaCUgWN8ZgD6KgB3niMVMWO7eiD0OaM15SP0WiPvRiDsBhVj0iQ7lgDCflUAhmPinaP4giFTgWPEqcDEpmOc+hU/LiM/ogDFiluTkWPG7cDGYmPl4hNIWlzJlmQjriRSxWSw4iRLtkkP9eHzARxv6iQH5kDP4eMvfKQQCcEJzmR5SaLvbJSb2PXkgsJkkqJlEFJa7jGfUVpdFIpiVvFlD2ZlblQlVyZBV75lVQQlmJ5bUO3lWW5CGf5cQCQlrlwAFRnAG6ZCwEQcwIwl8NQAGc5c3jZlzsQAQAh+QQJCgALACwAAAAA6wDrAINWVlZwcHAgICCCgoKXl5erq6vMzMzJycnDw8PX19fn5+f////+/v78/Pz5+fnz8/ME/nDJSau9OOvN+3WLA3pkaZ5oqq5sqz6P8iyza994ru/6k/yGhIxHeThgxKRyydw4FIfEwRBN1HawX/Xa7Hq/LN/UQA4qiAppOcoFu9/wyqNM//F89OnhHO/7v2ljZXY7aXSDbX+Kizd4eXsjOVCCiIyWl2FQhwZDOgmbZZGYo6ROmodWPZ+HU3ylr7AVp3WuNwqgVAqisbyjhqgJPWSUub3GpL+0nmt1x86XjnUJuywOq6ypz9p+0WudNt3N2+Mf1D23mwq1LeibB4nk2jMwSEntVGRCOLOH8PHOaX5I8Wfj3qB1K6wRy0fwH69oB6Y0ZBEIFcIX11A5JJdxmK47/h3z2fq08OLGhwYZggT1jSIuAxNxxDxZ4giulo1ScprZIWTEbESeqANKs8UcUFbMVeOXz+QJNZuCKYHotGhNnUF4mrg3Rp/RkGQ+EnkgKCIbq2HwDSuD04VOQi5ZhVUCNgjahBVRaSXhiFJVD09AnUXz0sDdFTAWDm4U8odSvlBRPa52dO3aA5MPa3jik6iLGKz27L3QV+PKl541k7CJdPQG0On+cjhakggQwXZVpyg9RvQ+pLI33H7k2sMtPe6k6kZxRDHMfR2jBNfAVKWqws+X7/YZJHOJZMPgMq+rHIfCwtO1YxDDkjFL7xnIKk7/fWEd+OrXk2VZnDTYtnzh/gKJJHLdl58KR9QF4AmBpWNECnUZgN9qkcn14IEvhJaVCw1alII1uJRnA0kC0ochaZNQIkR/sgC33U0TdlCdgSci5pxYK4CXj4gB2mfiaxEJmF2NL2CV2gk6zoVCkmSweEGETRJJmWDvxOhfawyS52QF3HUlpVtB5nHkVch5VBxYUViZAVaVfJlJiE4+QcweOHpQWVTgYDekm4iR2I+aFCTp1XcCbikBiOjx+ZmRFy6JFI8coEPMoDliB6mijs5ZJUZRXZqBQmWJZBQzj4yJqQlZhEZpTeytMSBkIQJahFqCGfpKPV7IOec0u/HTyl53rrEqClByIissPlgjhKmF/vj0TnFy0rohCTpFtCWb+RwLixSRDRvUJKD0d5yHJGgRlbZz2GcdWpXpEVGdSYTDFqBvpVeaOB9G2Ipm8lLB7A2shYuCvOK9Jm14CEKZ5mHNCfnjwNG961q/vHLAWa0qYJsbvxr/+1lduNr530wd6vViYbbCYlOYLiYRrYMmlMwWT1qOp24xy3FmnyDw5tBvd1u1DGSIzHUMh7Z9YrdYIS+N9panEwSczsB6Ij2wOuq8IfNNY1U483eNQT3BjN6+pu87YPigxg8pI+n1uXcotqnI7XFAnpp1jfFw0pdFcfTb0rTdolweT9Dvgobf1tvG1B6MLxNqqys4koWZtbcT/mCxbedbE6VbN183Rwl5QInGIQbLeQBNIC6NbqaTOpPldYiJFaJ+OatA3Pzq0RpLlwOiak1R+AL1ChdrCcWKzWEMxQ4zecaA09Fzjm8/K6PQGNRsnKVWm+Kn4+E9z2now3cgNRU/zRSO8Br8XPFslaMdVAyLv1TF9LyHvnQY35cR8nojWxP4pvMztsRLY1FpnSISJCA9lM9sCylbEXSiwCJ0hidG48HF9BQEM3Sva0ISnq1aJaaYjGsQk1nfwuBXmPdJwlype5T4mKYn/JVAhbtbD+k4YUMJ6EiCs8KNkiTxi9DtaIYgrJwLIeaOabkOa+ozxCr+lz3cvEsHQ5GC/hFF+MEvAE+IW4INK7QSoyf4AHEtUtcKwRG5MqEGjbFIEjF6OBvFUNE8IehAsBIok+HEEBhI/MK9sNQrafnGD18Mze3kwCTB/ICOADFL6QaGOsf8gSkqYiN3QgTHbZDQcQ+MmkGA6IXo7W9g9OPg1w5TwCOqiXkCgWQTqiWRFrxMT58QQhdfgS3LASoGFTRdiZaiRUqoq2C6OZ1znBiPjHgpRwhEn3QCWYoO7SyUpPCcWbA5tuOoUVjcpEkjvbFLOCzrE53UYRCW6SorULMXEGliODHxoFeqzTItTKd6dBU6WaLlCLI7WG9W9E55RG+V+WGeGwX0yIKOI5ELueNd/rLQvIM49B8du2gfRICml2TtVLMxpURPoiw9Bcl3IAVMtZhZlA1yEKWjAME8SlFE6bFynPjUZTnNAwMEPFIGI4UDHq6hvHGI8Y/heeROeVqApjq1AMuKxFKLloY0aDRtB6VFMBkxh6YS4KlONQBUdblIgNHgql5MkZAsGccDgPWtT01AAWAA1KkqiklBYhtaoffUr77Vr2BNnxHsSqQ9DgIme+0TXPvqVMC+1apBTand0GcZGRD2DgpYrGMXu9h36EIEkr3hcA6pDQcgwKucBexmC7DaAoiVbZfl2E/zeCvhZFasjOWsbt8aBCEMIbYnMcIMgHuCeQDVt1sNgRFk/oBb3W6WAK2Fa0MTG1rAKJeuWQzIbPWYBSjsVrONXawBEFBVERC3uhYYLj3UoTYpcmsYXdmLTMVw2u+Cl7WLhaxw0atB5YoAmFUVSC5Xgbqy+DO9IpABefGb2t1G11pIOO8+JQADgDJPuwNmhhE9YrUjcCazcr3vdzfr1i3wFzDzvTCG/ahK3BzYfB6ehH0ZPOMC7OHEcqDwcrEmYC1EAZ8txqe7yvop7EqhxqrVLXVjMQJ6xCCLAhZe/ZCqSk3Nc0lAKEB9GRxd1II1uSeqMHureguBdDDIaHagvxoKBhB4WAhuRfJTP+smGWANw2dGM6ncIUlBAGFZdgZzE4Qr/gMh1LipRMaomW+jhg0rbU5rfqRvgTrYQ13ivz9AQJyV/KXAEFjPVGLZKgY8aUq7WcK2POscMgtX+Umpo2m+TAcFDEV6hADVUyGeOjjxiSO4qZUm7UoVfsreCoN2n5FVz36A3EBpALrWF8I1I6SdTS3isik/dfIIqI3jS5KH1sWuJ227/SXY9Bja5iV3dYVial+r+93wjre8503vetv73vjOd2jXSzxu63sR5n2yN71a1H9vBLTLBUJ9oTuAhg8gAAGAqsGtgnB6ZLmxAyCAwze+cQT4e+IcogFQA3KAhTM8AA/nuModToAlW+LjR7v1ej/R2JM7HOUrz/nGC66Z/hQP1s002fZ6A2HyjBMA5zpfOdJVPtdfB5jXQLX0Nv5LV4HUXOkbX3rSkx7xX/spTGSuq8qUK3ItFD3laN+62m+uco0XAOaXBF9XYmlsrlb9yF7NeNrXrnWucxy60HWqWxVl2EcEzp2Cnop3vQrdvrN97UpfegAY/tWv1lcLUefTsvW8LGBWugsOOIDGNe54yPOd8qwlwOVbATsapHTzsU4qco+dhAQc3fR+b7vRHXtkK6TC5b0IjKMLRKtcjhnoOkAA33EPeL8SoORQrarr5U1RxYGaVsP2fBcfUICclx7lSwe8V+McS+INF99HMHI+hu8q+Oajt3a+dUISgPvd/nu1vlFI02/HDXLlDqXM9mM/vZF/HURmyZY9STd6qSd4cmUFWZN4/Wdp6Uc61uZ+oEZq9EB7QFIAk7d7zudT0acPwHdiMQYauURZzKY0gyBpn9c+uPVVbgV16ReBkGNkPrZn7CdlnacLBGGCZyV1AEcDDbhE/BVwd7dOQqRKJ6hUn4IsD/BwAQAAXwV3wUcB81VogRAqAUhle2IMR6BxABCGYRgAhnFvmKZdA1hldHCALwddYviGADAAI1gUR9hoOahPiuADBQCHcBgABxCBAFVVeVZDcxhSHMiHfFgAqjGC5qULZfZj4HNlg6YACBCFiMiHPKcN4fYH82VGy0Iq/rp0K6JniYhIigDQdHcBgOX1ckNnfHjYZsRziJfIhwNAhBuBBwaGCTI1gRp4CT9girM4hgXwYseQSG0SbzFgisDYhwBASvFwVFPzbsm4jMEIVVToMrCXOpn4a90XjIn4h9eoeJZSiKTwBKxFjZdIAMEQjktwPlwjWQB1dN74hgMwV+zYBAykROSYh5k1APMohhFnWYV1QnByj1qzAKz1j2JoY9DCfW4VA/HgUiVikGAgVwoZhkfXHw9AAAAgAB4Jcfu4HaESKpJIDpR4kVIYAGx4ARzpkS4pALboDFujYc5oFbeAkgAQAFeWAC/Zk4lmHr90Nix1GGmQk6VYish0/hUd2ZMuuY0u8wsQaIXGiA0hWQjyqJAR55QW4AABwJQvSQC96Aa3wGDkVTSVM0RW8YvBqIy1aAMF4JUvqYh/0FxPpZEkcTMl+XJpcJX/qHpRKRxw+ZJ/iEghRmPEGDUwZB95uUC2h46liAAryQFLGZgDwIl6CFdOglPvQpF84QDdeJHWCDAEEJgeCQAzUWjTVxN6xGqP5STdoBiL+QYJeZFfpQNvSZoCMJibsZEKWHAgkHkbwGrO51RXpivN9pOltIfeSIoZF5k9MZlw+XaRwpFvqI5OYA2BJ3EcwGn8g4JIwZkWAAU42XJL1ZWkGQAeoJxwKJcawFoNN3rKw31e/kacVnNP9hObY3EA82iK6ig+DjAAuGma5rOMEFcVT8h0szGfdVkQHHSY+HiOFzkAkEkEBoCbAsCewkGNZPgpB4BzSIeK1FGYXiYh4HANxxSSUOCYwBiQdqUA0OmVBEAC6smHTuGZKheQFiOcb9U2DXJMoZiHsviPA+CgJWCegSmgeoSOYNmeGvd3RZUG4vWTOtNEQUKkWKSi9Nh6SXCbR8pzCkCdwLikGeCeKldw8glXZcgYRoSfKoAA/4ijS6AAFoqhkTKLdGoBbrVymKFHzTWcw/g7M8IMyJkCM1qKTcV/d/CiTFmZJVCob/gXcqWnPHGmvLVTn3QwbIoqawmi/krgAKOJmyain6X4F9y3cpxaZJv2WDswlfClOVqDjsN4XlwamNvomZd4p+nVfVlXj1oRA2AFWIRRQ3DgqKHZBQ+gqD2Jq8EJqx3gnuGXiawZXlA1Q8A2lE3gVRE3oV7wAEYKl+h5Am56iUVFphtnnXyho2CllZtDWYpppYjhA3v1qV2KAqJqlG+YphpwWhyHciTKF5zVrzwgR67irsV4ABaKAClAnXyokh0gVns3AAC7mvPpV+oKGcaUQOAJMMj6lYCSAOiIsD2hq2x3qpESrU8VsQGrJ385dRvrkgDwAnYKHw+gfEw3Gk+wZekKORWIsZoxq3BZsYVKirq5nU26/nHaeRXS6lQFZZ9RMai+OKcrgI4Mm55F23CT55TNAVfP51CSoiIZ2wLd6pVyiCCOipGNKrI7lwLoGlfG2j/4ahXyCpcvixh2WgIOu69daCec5WrtCAVq8IrOYLC4ObTEgo6EG5xo63DaiiqsWXnEmSs7hqgnwZO4qaz+yoxxSB+lWrMqkKqOJW1ViQNhy5RTuwIK24ejcY5/dzlk0VlOKyVx65VIihhKaiXkynIVG4utFZPwlgAt65GWWwLhiohv26xoi3MVmyBJa2OviyEuiptgaTUu+oak+CP6arUOx7sywlm5iymj25OzywL+WIpWYg2J23CLCzG/qrT15rNe/ploT5iOrtGPnIsglwlXX1uOz0uaYsoOsPpKt/twR6sCIuplgEt4vysA31oQs7g3AZxxwSsynNW8qhG7TAkAyDm8fejA50sARBatjkWwGOK+TNm9cnC6zLmyE9BU+wqxizLB6nas0FtOUtsfkapyfAs9zzWt5Pa9L7nAN+C74krANMtx0mkUJstgB3wiJPySzWibDfwC3ad1JJsvi/Wj1UW5pAmyOVC2OanCFHC7KOfBtsC9obsIMkyaA7BTXAmQbxjBRNt2JkwBhblZFOwQPuySQCwT/7sC5Ip0xZsjmpWpG6GfuDnHT3KJfsgCeYrDPEqpjnXGfcCtlUsEXozB/ixww0ZcTqKHpiJMh78bvuZxutR7LQdgqs+zvogmyXDQsqIsE+ObiGBsheebcU5bwH7FCSmVx4icPYbrAg9srjLBWenLJwgAlzEaFF4cAESmr+EXyPzDWbPcs+Bbujwwo6RozW1ay3vqM2vLvqfiAwBZxTlAymLIqC0gV1WLcsUMDjB8Km4Gmc5JLLN4uGpby+S8FOFFsaysGx57qzdwvnDaA6lKnzTIARpMvT+puuXayxVgjowFzQdtOOaMkW3zx+/p0A9d0Cg70bLArDdwvRzXzavaW3Ti0dRRtzfQyBzXzoA6UyiNAfVKo/vwwPkc04NW0VIoODbKdHeM0xYTlst9WE61TMZA/QbTi4hcHNC6inTCfNRfELRi6LQsvK8aDdUeIMSIeNUsvXE5jNWdio7oXNN791X9fG/cequWis9nbW8K8Ms7wNC4C9agV9HMfM1Fi3NGTddM8M/rOUNVzXE/zddRs4eWGABlyQNuJXk3Tdhd3FQJ4HFKINK2nL/6dn5LAANNpWnz7Ni84GYC6dminQQRAAAh+QQJCgALACwAAAAA6wDrAINXV1dubm4gICCCgoKXl5erq6vMzMzJycnDw8PX19fn5+f////+/v78/Pz5+fnz8/ME/nDJSau9OOvNu/+U8yjKA55oqq5s676vkhjkY8J4ru98z4ozgyGRUPiOyKRy2RkdhFDDjUmtWq8oRzRqxHq/YAVt4VA6gtHEFMxuJxWHYkL52D7H7rweJxJDbUh+Bnc0ZXuHiFlbQgqGPQ9oUGqJlJUaDoKSjjs2i3iWoKEPhFFrO5lQjaGrlXWeXT2oB3GbrLZ5kYNDPmdCpKo+IyXAt8UZqH89mK9Hrk8ktcbSZJ6fOq6LsJxBs0Pa09O5UNEvvVuTPMvZpuDFyELsLyPMPJCeCeTtrNhRB98w76TEqlZEHzhxu3aYSxPPhb1X+QyGCtiQxbsDFVeoy/ZPIist/vRyvCOG4+EifB7D3Tt1L6KKjVtIpJxGMcdCKP623SM50xY/LjoiPfHnMkXAgj2lIZyToxogHDJ2Fk1KqSYOceigEuxIVRSpVHzgZBO5lGlXh5BKZIRxU1LJWd3Asj3K9SwIGQXyIlgL8KuQqR5MSuL7QTBQuy0UIMjLuO7bkImdzq0mE/EKEowLECjgjzALggB9cQHcISpkyygeZF7tOIboKKQ3tB3iWXbAyqhTqF7dmGeOUadTwCwVQ1yc1rk1PNi8mvleXktdZ4udYbgk5MmPMWaeuYQPsYuoX7CeMLFxpNmFG+Cd2SwnyT8QYudwEXf6LArYM85qE3T84CiY/nbOfPdhAAlv3BF4glUv+bfCPDiloqBGMx2gXwEy1FYYZf+NZVFZSaRVhIaVJLAde+J50I9cL43EAoQcBTLDHfxNI8KJq6EHVTekWOSXQJctNWGA95CYCCYWZsYdkCXp0s+QExhG24PgxQRlYAFZAw4mFxbwXFOL5KRClYMFGSYRRyQQVz9iGnSGZkrul6IGCBkw5wKyEDWmH195Vw83dgzi2zQHwhnnlRjcNmaRY6q5oo6/1XndTIp1aZN8KiD01AkwnmNkadWcc2clDixmaI5aeSIcmYw06hek5QgYKpOUrtdcXoVIt4iR5KHE6W2IYkDeSaNO1CWG5XjS5gez/kmRoqySuCcPET+mUawoeOGY16Ao5DKLtE1g+uuPfk42qxDgdmViXtzpVaNRYdLaRKDv0udkGsFeIOl11/q0rrYYXgvSFghMOFu9yh316XhSAmhXqV2me0KdnM4Y04Ly5UtBlvgWOALA20ZmB0Yg/JRMYXWWa965Uxa4wG4XLizBwE+W3NJdyqKpa6hP9NsOlydy52umZ8bGKi2F3SbzxtX6MqLLIeQH8pfweuIZedxeAC26WXuAJMsSewwzewhzQPNhHaBBSNkVOPHK0hLsyzXUwv7LbmYGrBBdB19v8QBpdK284oA+J2WqfmFvkElcnrnYhNIfsqwl3RY4EOfd/simxqHZe9v7SrAcT0oqJCMWfleS7Dnb7UqcWx0uQTJvTSwo+Q0QAAEITGJ6aZdnZiSDGUi5rLCBNwr27j0kQEAAAzRPAO4lIL/BA4djztmEJreq+L3o8kUCZZ92Girbbmhh+/nNDwC99HSijjkBQ3vg6Dmcr0nDWsPalzT3Dh+iAAHpC2D6NhM9JWAmZtRhlZ2K0jdd8KVh5SkZEV4zOI0xQTUCzOBmCgY3r1WPN/Gbnl+w8z1fqGw8xZOg5CxIBc1kMIDMC4CXTvin3s2QNEDYggNIkxYaWkB8XCNR9k7SwSrI4Hkv1CD0iqgBMVgvMwkMwtN4kEK+hW5uxYBZ/hJfCD8f5sB9pypA4tqGCSZmIGVRrMZQntCOQbhwiwKcoRktYDccUc1sBtwJCOTGiDli4YAAhGMAr+dHCXysXd0p5IvE0TUKAPFmHrEVEgWpPkLywFb6yZseSsiI+TRrRSzcgz2et7wXMq95t7ue9KQGMHmFgQSwCp7FxhdKRBQqkJTczP1EgknuMKeW5SADylhGMsSMwkLPO+UWUzkGn+2wju0BxxW9kZxs4VKQG7QTQNizQfYZcF93UGQoDrAYJCpTmXGcnArG1h1pTBOYLsBEI7WimUlmEJ2bieUJlsEbcSLBW/TyZmpQ4c8KPJNdlHSeGOepOFYWoKDf4SM8/nXDJ+5N9BgIOIA9sSnGv1HJHhD1gdz0ecErjpGK67omHAnI0EtIA4IssgJMVYUFL70RnedTZj4F2gpJke8RfHQdFohQz4RWkqRUGRZS/yS58X3BBqZSKSo1iKGLJmJrP4XK/JoKnzCsZ6Mr7Whu7HEHL+pAdlylnxs6gdB7CvB5GPIoYuSpP4WglX+Di9A4/OclsG4xL1mlHAdGENSmMepIRPWrWwnI07MQVq+SM2xdj6RFoxJAm4LFUlDT2rJiqKmeOE0iAUKqj8dylmVm3YcTC5BQ+GX2AhAyLGTPlVql9FWqAbzsa6Mki9O+zS4zIKUpMyfYeci2qYSobUqA/nbNUxKgsaLYbFqLAF3EfhWXrnUZJ5U1W+4R4jikBcXHNCPDls5kpr71RnU9a4LwHuJseJ2ueXebm/Tqkb74fRlnXzXf/Fazu2Bzb2ka4Z01rNe/FZgmKQJLBY3a7nYANAABxLCXEbwMwUpQEym+0g3lYoEAAAhxAEJMYgCMOAAoBuAviSADIwi4QMNKxYsXVOIa2/jGJh7x8jYDPxONoAxWTY8DyGWCA6sAxDhOspJtrONU6sUfYwDEjKUZBA+vdcRLzrKWmTxi2yUTAYupASbIYOSPTLkFDygxlrfM5jbX+MEFCMBiCoZhVizPzWxeM55xfDvM1rkS/9uzoNUs/ugAaPLPgL5zjfU86EYn+aGIJhVm1jOAON8uxyJOMqP3vGkcDyDIkbYJGYzQ4hkgAHc7RnGnHZ3lAYTaRjMzZBmpR4TNQFjVJma1jQnw6q4YosiNcBT8bpfTXONZhr3Ozg4lQOoS+EN5Et4MAJpn7BuPNtn4ba8NhnFbF+oW269ubxmWTd+/2aAMRQY3omHJYhrU4MfjDoG66SaGO3B4CEMgghxGsO2XlXneT5XuPfJNAyLwW8r/BvgRpmlfgrOYBGo5tzAVvgqGz+q4A5+BDIpQg0Z4NOEUP2PD8zpySeRbDlYOeUS5W3JfYLyp/VV5SQTe8pKDWuay3GrNiZle/gbj3CbCgCXBI7tzmLsjhLv1KIFhuXEpArjoHgqFAQIggFzLNdTjNgHE2R0Vofjl5RR05SEkLICym73sBVD5r4UR9CIMPb6orcQBqH72ugsgADenXNYPDnF9O12NSG8DAuhu98IH4MyvFcHLhsH0k8ccCYMvvOTNzuuf/4YMiDeoagg/+ckHwPJUUQ0AOk96s7sa9B4RfelXX/bMox4tgWa97BHgsT6QW7BABrHsZY/s+zyE43knFSZ0v/vVyxDkbTAMxJEPBuWNvvill7NgkREHjrueCgkYAPSNn/bMAjEuHHcs2bdP+gEc+rXo3ff1dXCAATyf/JIfwEld9slH/tVAH+2Hf+ezW2eLFzz4OzB3+jd5/BdppNNUD7d+HTB1A1h4ADBh6iYMXPVwlWAA2teAdfeAVsV8VbBtEyQ5D8eBF1AAGHh2GlhQUtNFqEFYOjc+HCeCE5AAJVh1EGhIjzB4IlZpudEH0rVvycd55AcAxIUElsNocqaAS8CCCGh9X5AA7wd9MiRg2ddpn5YeQsdVEPcFT8h6vdeBisZkB3AfPLhZLLYpVACEnSd9f7RqJDZ/R9ICPHhx0fKCVUCCpKeGWIAJ7qdkeOdO+PB4EyBPPXh/VHCBdhcAYcgGU7dou2YMNDNZ+4QJHwg2dJhhSFZ239YGcZZlNXgLqDBF/j9whSBIiCFSB26YhDi4ZN13CyIQdrsUT6JIiQWkbEjGh5BmDFkSSsJgHPcAfNVUi0q2isYAQWpgRh44gaVjTGxIYn0YGBOnB3XiD8B0jCBocEjIAwmwjCJGICnoc29QUTEhPfIkX964CtmXZc1IH3MXQGLnBUPUPekQi3Cnb7NoEAWAjp3IAXnxVsLYBtsVIZDoEPLogqRIKJvIiMx4eB9QOxk0hMqAM+MjUOMYL69AXeAAjNVWYrfoAfuoQReFbtCAMpJSUDu0cUsYkK2AYlnWjhhgIrjVj8ISa15DVmhiNNWyVPIwkKECiF4QaFlGeyfwRm91UiAhVvKDE50x/pMBIY3QJYl8dBxmppJKlokf4JLn1DwFUBQ2wBpTAV/qJEuzEl67eC44iQvaGGIx15FDaS++tJF0QlPMkovh1QccU5b+qI23AyUmkkR3BFspGE3bw2EkkiVEcGBjeFiW8IVJlo8goJa5RZQfpBcMFCbDYzZ3ZYZ08I+50goHSWglVnkpsJcvlJUd8D4hwwGdA5FSUQWHaZdgcI9Lhogy45jONX+Wwx4klFdGYgN1AopUsG1Xd1UYiWMwuUes9UJ9mSj6QRheWZl8sy/XeAgPsIdLdooY4JgDxFAO5RyecR5zMlMA6IlniYeZggBJ5JbVUSlhNB/AAwJeWSb0tYiZ/nZjCtkCQplb83EgiOSQ1REoXzlgOxmdYGAATLZrHURpyFkbDgUnySlyJxE5ecWTKZEfJ6Zpz/UC9zlA1olJq6GafvMis1KOPdGZj+YzBmCeL1RMz3k3zBF4BrI5LdI04SmdsMmH14ahzeU81gkxvOFnacM6VLKTM4oLw3ljQPkCCMqPGpIf+zmYygI3ZNVVuaEAWMaGn1Y4loNbjJk2ZMMpeKUxMNInQ+oF5oOXtZSkAtSgl1A9zJGIzJKal0GYMJhhWral9qmlQ7KgjUEkQgWHvWlhdmE7rQZMyJSiu6kfQ4INvxArszKmF4QAWoae8ZShzqOXAMMrcPoSNnCT/hJKCQ5AnZqGANKDpsqkpopzOabaRK7IB5O4K3OaA6kYjOJIqZUGJU7AHuEDozvzGq65Cg+Al9YJAouRRCypHP/SLnPSLME6PTzTq7TDhsyzrF5Dq3lxGeyRqqrap9MSlh6RjUkmAEcwrAn6Eu7DHZehq8Wxk6+aGI+2gZRaXhrxVazBApkKh+9ocBKBkV1WUOL6VsUqGwhSAOfHp4tgVyMpoLoRq3LGU1l6T/x5F4fDHcWiKCzhVBKhGovhozzQr7l1AMVym7wRLO8prfRBjAhLISHyrg/rntyUL+/goi6AELOAkvmFnc7zr/SxnGiGrlChQH30ajc1SGAaNKf5/hn94xDjg7OZZbPNo7Gh+USk2QIUEwySknLadWqjaUF66iUdNERBtjVD4ai2sBhX2bT9ArJwshkei7RH6xDN4pxJR60WNGS4GRqewLC3sa6HwLTyVzhMuhrY6gHtyQnIQLP0JrdsEZle4kzy0VgH+Ad6uwccO0AD+wO9tKcwUCeNVZJiEH4IxqRZWxLcVLnnqq3BAG91xrTwYzp/6TtgEnWvt5CI2yR1exXVELtBeZzpwzxUKZCKW0uDi7uJgqJThZXAtJ2MMUfOEI7CC7C6+5ingKhBcbvN20SzmwMptRrIE7zVKwGqS7KXwE4bVEg827148rxCywmZhI2QZL4zvvO96SCvdwOzpcs9J2sZGBS6PIA4heS17huIlFqANtE7F1WvzTsCAKRTksoW0LSyLsC9wusA9nQ74DtYiPMI5Vu9ilFKAnxWt7LAmQuk/zuGnXqqT2RVEPy/vMChjOGm9fB1Ymu+Wxu49DpCKixT2uKsC+IXkWt5b9IcFTwvA3LDRhRGXHsEz1QKPfxzqrGfQSy4TEfEHXisciLFvoaoS2zFL1BOq3G/Woy0rBHDXxwIeJFRXjzGDwwJmAlwEQAAIfkECQoACwAsAAAAAOsA6wCDV1dXcHBwICAggoKCl5eXq6urzMzMycnJw8PD1tbW5+fn/////v7+/Pz8+fn58/PzBP5wyUmrvTjrzbtfj5I8z2eeaKqubOu+GGkYRZHAeK7vfP8+tWBBUfIZj8ikcgOsEYKjpXRKraqawlrRyu16pQ5sdmt0LESKr3qNVGSDaWRCZIiz7/jfofAUJsw+Dw4zBgcjgHmJih5ifUOIPAqFhAZ/i5eYGG5vUT4JlDM3maOZDgl8QU+iPQ+ghZ2ksSiQPGJ+RpKTMwcHZLK/GA4iCYdGp28FtDkJB66rwNAVD3sEAQMEdjumqVDKMK2UzXXR5BQKBAPpAwFDPptv2TkK4qC+5b/z6voH3j9vT/ZgMHN2rxwQferaRULlxEY8GINcHXhYMFYCAujW7Qvowhacfv4scoHqVTEakIzqrCnU4VELj0/0QpUkRwOhOpIshTh6BlHiuJnQTtq8RrHFNp02QKoQWQ9otD1DBxhQmsIBMhs7PhF0Cs0qSn0rcbxzVEBHxHATuUYzgMCaPmsIOKowRbYGAqonmBLCqfaXV5vseLYIkaWPDq2gBPclVXMo3xfvxuA4G67o4kw1hmLD6+FowwKPB8csFLrMZRynosbF0TJsC8R7LR0hQZvz6Q1/3arDxvpzELknKFOyPNnUpznAb3donDLdan/IZA92NSM55EqkiylfwUezAtu4L/pWnAI2IVismPIisX2Fm6/qnhu9ar3DA/MyjbQabah+ewzdaf60G3EfNOGIKj9QZ4AggYBDnX//WZAAAlEVAGEGnvkBXgYDJbZhcMQoWFqEHmRmEwHkmWAVNzUY4IIpo1XiQxj4hcIgiSikNpR8K7R24QUONtVDLuIUScyHOE5gIkK8vcZiDS7gZwiS9tFBXS8/LnKjMQVUmGUFx7xB5QSmSJQiCzTGWAkR94RxTg3S9bBkOtag2EJkQnw5QZCU6KmBMPMoeGYsDxAAwKEAoDimB254ycIxB7r4qIKLahCign6y8cAAiHaaTKUbzLnboEwgVQOBf0pJKgohdBjTH6CqUUCntFroSZdD2XoFfT2qmekFwpBWZCioklJAALR2GoARov6mY+dcn/Ux1VJm/lqBcfwVsmU5DhyQrLIBFJtCo7lKWl50VN5nZg7CMMPfkTMl8C2tTe5Qg24DLoUAN0+YewKfhFhrjpqFsDlTofPSisBC8K2j67942qXvg5N1GA4x21b0QMLKrorCkropei5DcFIJU2IQ3WfxLlMuNuuhyH7LTqwVKEBhruJS4MC+b9zFqpo5/xlCM6MhYHBfD8TMcQAEZNxCs9fE2UEYvObl6w8rn4feYggkqzSiD0OGq00WfggpQzx64C7KCao5gsCZPEAhx4cOQLOSY+sjsgmtebyngkEHQwd/E91Nirx0J/rdNzfTmVDgCzwZdgeB7hKwUf73EY4ciRclHoDfHED97AdhZmH2Xue5YOVIMiapAKd0s/NNgPi6Vmp0fAM+WNa7OB0h7EsfAIPooMv95IV6Xd7j2hQnOYEbX89bluoBvmV7Bq35y0GNoFtAAi/UzWH4PS8vPXkK954oNfankLU3BwDPAPmelz44fkFtJU5ApWEg0DA74jIeMvyTvOpcQV3hY4/zgJSA6H1rAN2zwL4EpI9pwS8yffBZB2AjjghKIFhqMtr9ZqIAB3rNg3uqHljEVToodGZlvJjfGcxDj/Ut0AKvSxwAUCgBE+GLABb80x6Qwg/KYSoF8ZuEDZUwwh44wITKGkARkajCx9nHNy7ZHv7qQvEhN6lpIjIcTAhI0MQdAAFRUASA8FQwweakY0HbuwpehEMIyJVJUL7TjwKsJL5RbEqH55taFdNxvWuZCisbSN56IKagSuSRFa1i3tYuYQBAPjIDTqAg04KoidL1ITl39JCKCkgsKZBgGBI5WiYMkEY0fmmQAygkmSI2Ip0tgDpBo5FE+gM3DrjpZAmUxcb0t8QMtNEmtdzTe2qQFvjx50JJrMQkaxFJywUzFsIAHsy8FjihkA1V02DG4uxzMQVSrkby6yWGWkUaXaCuGao8XABaCYDPbeiYCCkWknS5pg84IJSJmSa7Ikm0RmLHnL/QYQAWViBYNs2JICAChP5EAL6tzIidBqUEMeIpzPJxjAAmgMpbYllGW76Qd/B04i/dmdE9hvEOhoqdLKWhQoy8VBurSwxCJxNJdAZUoiUZBD3raZsJhWycagiWoIq5gpVmNDsiUCcbjrXNeQ0gZ6fY101ZktN63O+XxCCYLjbK0YPp8KEqwgMCnVHWHlXToLwwBHKkmogDxJRua4xG5ZxxSX9G1EpileYckGqWPJTQcxr0Cw1txBpUPlWwO2XJhHhYC6rS7QYlDcRIMEazVgWWZWRFQiU7tgaEJS6QmADommIVgq76RJp7pOu1GiiA2tq2tlJUQ/6WxlBZpMmRNw2Dyh4rv0NkdgIBuK1ybf4rOy6Ygp5o/UVrydhUQPFui7Btaw+Wy13m9pYKDeTYVaMBKuHWD7tjxVhfdVCA7rq3ts2dQgK0WU9EjZdEpxxIjF412OMCq73vDfDMpHAAKKIWaSQIa0VfS4zNWUEBAAiwhAUAgAPnJFmjU05+4bqLBhPWCgSYsIgrvFX4WdYalJXuHq97MbLKFokDELGME/Xi5/Gsxmqt5hdriBz/quhYMp5xvbTRntbCRKyGWJN2kwrkIE8YABD8oI9n4tSnNpi6pGiLk5+MIhw7BaOv1aj4/gkNLW85wFD+7g0t5U6CkbXEagjvmQOc4TVLw6dx9XBkC0LbObu3nilWi2sTE/7VKVdBEJ3zs3sDkNc1r7WdgiWCoePMKUV3N74LhCFkk/TPi1j60tNzHWKuvN7tnCPCn1bu55Kkro3u2dGGSrVtAQBnYJQgBHbGzRllDYBJ57ocs/p0oH9d5CafWc3ETjaAkuvkUCvbC2YIg3AvYWwJg/TZTASBIGI7ggZ7u9Y+OECM3wtHbE9G29Odg7exU6MOkkLc3V2yuU1ahFO6dN3nJS4l0oaJ+VL4Gl6uCCCifWt7o6HB2GEp865E3GFTQd43pA0R7o1viyF5L59l+HkCTmRit3YY3iYafhAAaX2b3JqW8/W8q6Kyi5/85egV1MozAViCZfzkN7+SQGfOBv6figjmT0XyqDnO8+X9PBzEzTnDj+Ptwb666D0HOkuFFdelC1bdLq1NEVQOdRX4PMwoB61cvz1YiQpi612/x+B8Ar64FlSakUaO2UHwwbT3BVs6J3tUQzBtrtudDSC/cmxrA3UGkZHoflnAwP0u3TO0ymb3esI8Efn3/wCiBMixUBCYZqh51ld6ledKwYVBAgS0b1bogLIOlUXa0JPi8hKwNxBOD+WYDnX1yUK26527p4guoMGmx8ixrIGs2+N+9c7efRdEgKI6Eb+qx49+9JOh/C60wvjSzz5iq9+F+Wr/++AnMfetkLTwm//4TAP3+E3QNfBjH/fFN5TwmbHz9f4fIbznj378Y8mHU/TiO2Ewb0+3CA6Qf/NSfF1SAPsyIURwCHLBeJfQafQHcXfgUehXT553LMdAB7hGd4qnfPvxKhT4BQ5AX+CCgRjBDmyhMnz3gfaHQ1rxdlU3gs7FB9UQSwt1CiqjbR74glPDYhiHMQS4OOr3ggt3dIzlg9sBTBk1Gp0AgUo4IwWkdI4UhWoREVSIR1AYN/cBgK5jczDXR8omAgFiYZehLkkmdYS2hUnVCpmUL87zaBrHYRpFg0BhBmSIEYCRfKz2CQgQE1lIaIinBnLjP3roGIOICSGghqyzJok4BTTyhm4Ehx4nCSQXcy+3OWwoFmwBSyfyiP6EMmhgN3WgZYeUJIlRsRt8+GyetWAx90UXY4qAd3pDMU/fBIrk4FmM2HbwhIsqcAD7coipuA5PUDiVB2ZSV1HNoB2JQBieeCIO4YtLMHBS+HVhKI1AUgkYcYOOoxlA5IWnQSOxdQTtwogWBW2QMoy1UwebmATDAD4fNiTWiHRIJw5F+C/M8AQN440TgY1gQFHKGI/ucGTWRIW+2Il6iC8VYjT+OAWZwzr1VwvzKCKP6Iz7WCH9iCMAqXDMuARoeHLgRQ3woZDESAAMCSoNiURhp1G+OFyP5XBVEgTD2I0EkJE9QgQz0I5843O8ZH0xmC0L4mPEoI+AcSImiWUrQP4MeQIN+YYWc0CCYEY0hpAEWSWMtUgnNSmL3nN6LmRreBYKMNkRYSVNODY0maQbJHkNWVlqTOAjXTGFpaiTY3R/NJCQM3kNCiiQs8CVn8FUQ8iE4aOT+oEFd7kbDJkyrXEq5IB3BhWRFaGUz6g3TwBUqNFCDZFYpQUCtiGHMeKXBqGAF6kZSWEWbug+zOSZ03hw6/VPcmgm92h9zBeZejMEbMk3/7CUmgIOWjGC0WQ5T1kSNmNXI1mLqiBbkXgVhzmLkAYv9tGULNNPBnEfTpCWI1WcM8IzWER5U4MEquWItoEtrlgZgmkC7fMV+PJDNlCbVHQVedkZgFKWqgI6xv6RUaanVxQSmrPpmFGCnUihe8Hwe1rRkVPDGerxCnaoi/S4ccBALjNZnMcVBkOERfoZe3yin+YlhhrQVcsYQaSkU/hwlaqIobiQnR/xAXulPIkEGwMYUYCTJRvZSBO6BgYQmsXJcccpoTnihC7IPh6aouHjQR95JYbwmgsxUnj5Nh4JjOzZPeAwGqiSPAJqAUrlClrpkjCakhtEQf2il06EBXWRnnlxRIlEDyKHFxS1WSjUndiFmnGWEdEIXlfRL0jCPfbhiv1xQVMHRknZSCJHpKTZX1SQISTzCKyiO/AzdfrZmkPaVIC1S5UwnnggDCR6lOMipkzAQfJTJXgUEv58qqDm5hGOwG9q05mk45QEFJ93Yo0xGiECVBiKWRWGeqhk6kicsYi4dFNnylI1hKWaEiZ1kZwooEjlpmu8w6V35poo+XWLmmv/RAPR0pVet0UtMzUn2gwQYqt8JZYu56fC5KxVcwVXkjMPGRtsOkM/KhCAGYt2ZpkNUa5AEp7DSk5UCh7C0HbDATe5unSQykQC9KWregF0Sp6XyJI7+S4O15rXhF/I4Ag3lUTdhB+rOqWos0diAYQ2sq/uEKG/uqPgGiPqiUA1xCqLxZyQsVhixqvk2C11IS3GOqqskyMJ2xmS0JnghrBrqBxE4Kq/gTW4JLKblSUIK6Ji2anQef4avsoiyZQ7EgG0EAm0M+uE6mezqBOWeRAC/JkF4PgagRkc40oIRoNE58ULQtsRHTocGIsmXvoG8YomWdNMIJKtrOJaemoWZXseZ1sV7BoE2iMaHqsCCfQlikqykzGzmCi4BdEan7QMiPol3SlCSJSv5/GaUpuEAndIcJADQXsFemGt7kFDQ/piomigQcWufeCu8DOwRSJDatqyGEJKv8kDWGipBuGtX1qEJ8pFPQKRixK0/7qT6ISyj8ueo4m5MjcXt1uFxlsjFDsjAcst/FkXVBt7V2N0PXoF3GO6wQobWqlWwtuBOlBA2EsBmUOmvaszcvu6TrRiklYQkvAkif6rDTGoUWjbTm73K5z5uUlwt+7ZQqEqubI7C/cxsJSbvOHDrUCRmFn0Ev/rs+U0tLgEvIkgqELQC2WkpoE2vqDAurgBuaU0c2czqNErvtOLJsdbYl1rth78pVrgp5t7p0axuY9asgWsv10gqViEmWakKt+AS52FTtvbHmSYBeXLN+HptmzrsTQjsbFhwPfgjELgX6SUxLwzxN4Dw0I4b5BJchw3xSnzwBDBwUX7qWPEcQ7LiXD7A8drk1YYpqzTS0GKojKscEwMdaHUQWHZmj8MJPMQI3lsf2XMGjRrOO1Cs2tsAse7trtDj1K1iJ0JwTgyspLlhOp5ToFcyIfas+SYKyUazDe3K1eO/B+kRFcjJ1uDhr6WDLDhEwlm8lXYOrGfrGEreY/TsEWbnBdrU0NzjG2hbEaEi3FN1MoEe8oSgqnhS6zUUUZgXMt+TIr3yE8oXAsnanorGoUAw7mq/LPIjBhiS8N90bw53GaIPLhM18euR0dsQaTVHKWYO3jcLGgjjFMjYYymIcyC05klxZnhTM/TqM2ZGghrN8D67JDKiLyBAIhTGdBV8FtT4mVtO8kIzRplx53HS8UP/SIcq1lU+soVDQNg3M4bbb3n+NFqIQMdRtEiPQrlKFEefdJINMbzFgEAIfkEBQoACwAsAAAAAOsA6wCDVlZWcHBwICAgg4ODl5eXq6urzMzMycnJw8PD19fX5+fn/////v7+/Pz8+fn58/PzBP5wyUmrvTjrzbv/3gOOZGmeaKqurOMkSJI4bG3feA4+RqIkOgqvMCAQCoqgcslsahSBAGAQOCR1DyJ1QC2InOCwWPUYAM7ngFd3KAS43DdwTK/bMW40OjDHFbRwXH13hIVODgR6egc6BQSBXASDhpSVNlmKaANfN46QRZOWoqMkDlKZUzlZnwNIpK+wHwmoZ6EqCoCBa7G8vRUPtAAFOAm5cMO+yb2zeqcABjhtrAY0ytavZrR+gG+C19+jBbQBVzWO3XCS4OuGL87NtijGkeXs9nQKwcgsq5+7Sl+q3Rv44J0eAjaKsdqH5YEPB/UGssOEKgAnFQbmDTggEAeuP/4FDECTeM/BgXHxSvxhlZIMyJczSNoDlkYRwxSeIKnTUewlyI4yV4i4GAQKrX8oHOQMtBNHlj9HQBogGtQEDSJHDlC9UYYWQqEakdZ44RNkggdAq5IoCECAWwBflZyktZVEsUdxuIjlV9as2hTA3AoWIGyJAYNoWn7IOC3tLQQgo/45+1fe4MuKUyRAfOamiZWfqN0gW/ZI3codCl4eDCDipUSoCJz+sDRQZhIffR6hjNpEgNWD4+YQV/H2hlzdmtboWdZHb6sEgA/2vLyZHuMawrpOkbv57OfZpQsG8P0EM1TYMSjUuTcp1Mh/FDgG7+G3eMLlS3RFNUBz2PwhMP7XHH3m3eeWcGNlkwkB83mwHiQxsdCdI2Y1SCAHBhgoAHUqEJeJRfJogc4A6W3gUF/xXYhCdAbmcF4mjJyQEzrK+YeifCqiYJ94AVhYwouKxFiCUgttp5+AMBmZowcKaIjgCgoC4AyI+v0nVE9HSNbekiAUoOFI5gQDoAW4LCRhRn2VyKUFDgxgIAA3GDAOmCNIM+IAogGGJoV8jrlmBm3dN4CPIORDi5oSgAaJkChMCNOfGGnIoX7vODPpcXgxdWkIe5blJ6R4aIjoBUqNo2R2n6gxKgW4aAkSWqACtqN0AbQA24efLpBFpsecygFESILEaKwnOBCoeE+aAKQevv5e8KAuuU7gwFPvvRQtsRZ4aSACQlmHxpYZMLYFHBwVS+2A2K7AonitkRHlQYRWoKhtKDxlhE9apdutgf11KCUq8VIwbySrQoRiAavqW8EsBm7agYeK8DGCJyPWuMPBvCmcglJvJrzAZkddXKRVByNwrVUPPHBFwOu4eR95SekjciBvgKvBiS9J5vEILyTQg0PN2pOPgbUWe2vEIDwbR7lrVesTy2QcIJIBByRwANN/vSBpsXN9GLQEkE1z5ME4MvEC1VNPfXIyHL98MsTN0HmcRoieyyfCTjiU9t5f3zMrcABALYQUiPX7MBw0qnmiq38IboICe0dedm8JOGnCfv6ZbOIBAiOP0J2Wjq/ls0hSR76zMtreN2wIcGuSX5n+fPqD03/IncMPo0eu9hgBjbGudDDbVZMitymtF6whQMa4zStAfnXapU89eRMOIAAZEmubcCytP8rMQdif5OvBtBiHHqDUz+99dcZOQEG4lA4Tsz1w8VegwLvfPkw3yw+0odsf2btZ+nQnkr7Z4GiaqF8LUieeEiGCFobLDl4SdzH4VEgVuVMf6c5ivpjpQ4HuepPglpWG7yiFVwQbHwxQFCGuZJCA7AsDTYLxjNOlZn6riWAHQIaKTfUDEsyTlvL6EkA2/YCAaTOg/Gj4L+cwoXLbSpr3MmC8VgAoWBSKIf4ZXqhBLYrBKEyMAgEUUMTjdAwEUZqShaqInf+96gZHjF70ptZCO5SKiQmso1P+thoqceABCHRddpDDBdtdQGW0m4wNIIJEOipRCcXgjFceUhTLeSAPqDhVbahgsQs46lVl1JXVGlm1UPLjAAaR5BnG2MHvaYhbHQBjJi4VlswgMmdvlNAoI3e1q02vEifCYzOG0UoN/A5wyLsZ/qQEywwspDzMcVUykzK6AULPi6L4gzATiAUcXsaP2anIdwjpMAd0yidF1Fsjf6YMI0SMho3zyNY4kIB3qcFHPKhZijaARdMUk5EELJ0VvlEGVfYQhJcU1a/cJwUrduBsMiiP3f6qlT11ynFv2OyFypZJw6ncwGXsYlIxFPBIWSRSKx2cFhentj49EtQAHK0InoopBG8ORocaoGlOkRSVafJMBut0okQUsk34ZXQEULyPDTc20QKI70jWNJ0pC+GCSBZ1IzZkIHCSRQcs+vQDcUSiFXQ6ChoogAAGjZhDVsBH1lAiN1F5KgjONkepgqcY/9qmRSpqUwEUrR17OmoGHFJX9QlWJkpp3fAipjnLSGd1hUhZ6BQQVYyWtCTaLKppVgQccM5kpRidqjWUklabFMB8NGHNUglxRN1FDwhkXQf53gnPX7IOLgAohkTOtk4DXPYvPwhkMKLghdBNSyYOAS0dRf5LkAQIdxwAjO03INfb1QbFBYAs7R6QIF22KXe53a3KtLKg3TOQ6LfgcIFYpXbYdCkAAVEoKh+sCwt1ulaoGtOAzySJmDcwVxTTKmzp2pvfRCk2GA5Fjcpg6NICb8AAaNUsGRWMNqqtD71mo0F4dYCLosLlv28dnc8IHIbjkhR3KgPxIjsszAAYErE+mIFt6+ACXaVMBjJ47VdfcUJhIpSgGqZEyoAGVKDKMQYqHk1imchVB5divGSMcQ/Qx9LQXmNaXAgGfYnlApXiWH2FtStB61k4J/NsARBJLlB7S7o2Sy/JkNzMKQLQSTOzSQRRLjKbSakVqoggJiLYsIRegv7hP2mYyCPe5Z4bKQPH+GwyCNAKSWkA57UI+jkpI6mUK+xmXkJPdzL4waQ96YhHvMd/OM60ncs6ZNxVk9N77iUdqyYDXXUZA7DLyxuMEJUjoAnFKZPApVdNKkSPMsy9lWOiz5KEHVugnqyINq9hEhKVwbbSGptWms8yYllbmM3oWx+tYyxZNIMAptFON1OO0Aqz4M05xyX2XNH85xyvtLJ8HrFDhtxKaOeFZup+A430cq8/VC0GEFmZvDHQM9xVedGurdoP9h3sFThX3ZC4U8CLUASo+K8HEcV2VZLrWohXOaJncTZgUKlxjLs83dN2xPVwDIRgD/uzD4d1zkFNa/75oOXmONPIy10+oorFPCQZiXGz9WVfk4M81GQUuRBifIDrGYHjLR+61iNx9BWmiwfrnKPVRgyRW9/8V2ghI+4KYHUUAvzfRMf4tAkAWS6BXXeR7sGUma1tc8dCsmr2X6nHNfSss6Locl0Tb9vMXpqn2O/fqMaQaX49rKD17VuXttR5rOanM5sTZx/Doa3ts8o/wu2ZT0czIeUCtad8KEvqMg9wbPpMGT7dW5ZtNULvC8m3GseRwcsjbo+3hX99KMAHCdY/sXrja2zIajb98Zxv5t3b2NoTp772ea/97nv/++APv/jHT/7ym//8a/l5jdH/dZr7IMWS5T77LdF0kf4kWtTwl//87bDmT1NNxDiGfzanf9awebzwAsiGRMsGddAXaIaWdkBDgK9AWJ2WbAM2YAF4YvwGeeJVDdyGMGw3Gbl3ZYoWUJ4WVO4Hf7ZGEtsmAyGBMcTSWk6nQaTzPLRmfwHoA1GHXb1Hb9ZWGuUTK52XYztHgyVXhPY3bgxYbhxIVSSVBed0MJIhCRJICprmfmMXa06HACy1gDo4ZDQ2ecWARSgyhYqELZSGFkDjajQ3ZVTDhd82g582YJ6XcktAaeMVggfTF8sDEoXWG2noZWz4Zd9lclElNTFAYvNGcnvYiHxoFgY4E0PheldYZFkoh0HVAhCYY3vYh30IE/5I5n1pmGmk5356h4mf1mAf4IGz44huhEtpAn1VCIg2plKV+HRV42b4pjsTtohr1waV94iJNIxsF3KRyHo+qFJq1oa5eITSEy/YRVJRaEGO2IcZQQ02t39zRWmut4w4xl7/t0EtoW0PwIXU6IqfCBOPd4zUF2wpJmptaImOgRZrJoxQoSVmiCK0VnHOt37tIAGS9YSOtxWf5IoGGQM+14TEFmX8SAq+Nx9NhY/neDcwEVG96H1HNGIzpgxYUoauOIaNNotq4TwWxl4q93cT0muuuD59V35N91qKKGTOdZDF+Hn7V38stY/WADmOCIz7ppBiEGTPIYMKGJN3UJC44P4QlAaUvHNjG8mChfh0DRkLs9MGohZvojB7uTiC7fBqKHiSlpBy/jgKRDhgf1hf/YeCSSCS48ML9iV2bLkE1gZuJvl9JOl/RnllepOAbvZ+1NczjTSVlTGXJ3hNvsWO4ICTGBWXMkSUAdVSiKkMAIVEkQaWf5Fc3sZoeXkhL9lFkXkHN8ZFcyRrfvl8hVg1iCVspdBayAaTFxkrCBhUZ0kImfZ+14KZFhhRjEmbJQhqn8kCbghyHeRwpERHXOkLjsmLu0kGoEZNaWmE9veboheVeWl9liBg+FUKgZeb0kk9inlN0dIzpWkI/SNgibeauTOahsVO4EFd0Olbl5NBHP5Enox2Jc9ZlMd5Byq1c+mzmTipil+UiSxwn0U5m/T3XbTWQfVXSuSpaHWVnfVCoA83bk9Jgr1pWRHKi9LZP+tkSo4pYDj4mutgUWEWUfVyd3sjmPxwffFiZDDEFT+QgGJnh+sQo864MyRZV/nRgAGSaCpaAYvnf/AJRxIKPZCplz6ziz9TTCRnWCfpZT4jooeUQRJHKN9JOqIFLFbTmmlDSb3XpMgGoIWCRGCpN1tqovoFavHinrzEoDggnrrIS/rWnRlAWb11lrjZpYdlp5x2KkGaNlcEa2IXBJ23Z2LKm9UVStT1oBLFpss1WKBVoRRQiAYKpDEalTi4nBOAov4KuEgvhIg/OnVcJKWbSqV09AEUeF9J9px8CaF38KmmY6B/+qh/tFKKoVxjwqdtmp8fg6kg95tXukGmNJmREzAxOqMb4KiOlDQ692356WVKKj2FoKzK6UIERKqelKSv5SvJ2QMGZE58WWmkV136SZ2WiRtkClag5iuc+lojEKweZTZgWoE9YAepqoAb9p3YMZkY2CygpSaw2qVgAK3XWgfUWmG+pAOzSjWSKqqMygG6WmHzmTRhNmDcpzLNWGUGCK9u6hScCqg74JXeSigH66omElSbt2AZVKlod6F9emnf2bBT10WpcaG1JjqMZoCuhq1BwFsVK3EAQVlhJjvrmv4azdoDjrOwAksHahiU5iqXx9al58oqXGSyQEqgh8pw32W1HciXA3WHJfspxLqssYREl/Wxn0anhOqy0Xl2NgqegqOYPGs/RXgy7lmimooFbLuZ70plfHMkL9RoAfKiVmGqXcirhbBmA8SyGLBgvnkkOpceIjs11BSueUsMRsq3a2G2k1W1kgtDawN2Yaq2b5qRN5s3dym1j2M6XEsmEZc9RVo1l+sUSydDlYVSQ6KsQIuq/woYSVpyjAtgTFuyxWKnczS3zqKqvnuCV0O6zQW6xWKrfrKwsnsLQTW79mBOBBS6K/VI9xavmtGq5NeZ0dkon3q6vEu4G0Op44e2Iv4xtbhWtY8Us/ywpekKfjG7NhBRWOgrCyVaRqlrOuAXm2J2AnIbLbi6HDcqiuWpOwHkuFaGs3sTivzQW877pb17C7A6Knv5aQbKoWJ1wQcIwhi6RYY1KkprXQiKuCNns/D7BL3ZuhkAmE56A+y7cCkDQ2cZwN5auPdbA2grUOBrZ8CinhO7MW9LOiRlwJ0KR4XJnnaWMtbEkvWroQZsuEg7Giu8asAip6FkUV2YUhmMuWIVvEERxGiqAvuJUR5zsEMMxCjrZGNLq7rEutxBr29cA25sf9gLWNcqXckpwyYimvWaA0qrxAWmr9I1x1Dsw82psIUowqBJr5p7SNRayf4fg7dFwbxDynS6awVTda+nisQa1LEugjaF1cc09q+iRZxLqydyypUEjFHPh8cy+66mKsi16mnHqZgs7F3bu2GXbEO/u5hLoKxmPBEg+l8Ri4MDKr1MII2NjC1S7MDMFWCSA8ABlcyqiZXPZ8T/dcBVPKHcvJBUirsY9HCCeyUwpMoE0sVnemmBnLUqBM3aiHauN2zzbAPUurv3/EcvvLoP+sHIVs7/vIq6i8lC0MQHHVmO6ktTxcruPL6iSV+s3NCRFbXOzBX8adAYDcNsTF/aK6cffZRFa62PXNKil9CMm8AqHZTUiryr62mSTNFW7BQV7dEvXaopjblyVL07HSsGnhsEREi2QX0I52vGRWxvRy0GTRpqd+iUOt3Um0p6ofqmVG2vWb3VMhEBADs=" alt="Redirecting Please wait...">
</center>
<?php
endif;
?>
    </body>
</html>