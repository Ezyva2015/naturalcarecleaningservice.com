<?php

    require_once('../infusionsoft/PHP-iSDK-master/src/isdk.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['fname'] != '' && $_POST['Address'] != '' && $_POST['Email2'] != '')
    {
        session_start();

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
            $_SESSION['Email2'] = $_POST['Email2'];
            $_SESSION['_SquareFootagesize'] = $_POST['_SquareFootagesize'];
            $_SESSION['_Beds'] = $_POST['_Beds'];
            $_SESSION['_baths'] = $_POST['_baths'];
            
           	$_SESSION['Address'] = $_POST['Address'];
            

			$_SESSION['phonenum'] = $_POST['phonenum'];
			
            
            $allowed_zips = file('/home/natural/etc/zipcodes', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
       
                if(!in_array($_POST['PostalCode'], $allowed_zips)){
                    echo '<div class="alert alert-danger">Sorry, based on your zip code, we dont serve your area</div>';
                }
                else{
                
                
				  /***for the hidden fields**/

				   $_SESSION['street_number'] = $_POST['street_number'];
				   $_SESSION['State'] = $_POST['State'];
				   $_SESSION['PostalCode'] = $_POST['PostalCode'];
				   $_SESSION['city'] = $_POST['city'];
				   $_SESSION['route'] = $_POST['route'];                    
					
					$pieces = explode(" ", $_POST['fname']);
					$_SESSION['FirstName'] = $pieces[0];
					$_SESSION['LastName'] = $pieces[1];											
					
                    $contact = [
                        'Email2' => $_POST['Email2'],
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
                    
                    $contacts = $app->findByEmail($_SESSION['Email2'], array('Id'));
                    if(count($contacts))
                        $contact_id = $app->updateCon($contacts[0]['Id'], $contact);
                    else
                        $contact_id = $app->addCon($contact);
                    
                    $app->grpAssign($contact_id, 510);
                    $_SESSION['contact_id'] = $contact_id;

					echo '<div class="alert alert-success">
					<strong>Success!</strong> Your info is updated.
					</div>';

				  
                }
                            
            }else{
				
				echo '<div class="alert alert-danger">Sorry, based on your zip code, we dont serve your area.</div>';
				
				
			}
    }else{
		
		echo '<div class="alert alert-danger">Sorry, based on your zip code, we dont serve your area...</div>';
		
	}
?>
