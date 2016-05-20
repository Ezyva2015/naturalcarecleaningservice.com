<?php
session_start();
// If no session variable exists, or unauthorized user_level, redirect the user:
   if (isset($_SESSION['username']))
   {
   // if a valid user session is found then the user level is checked, if the
   // user has level 3 access they will be granted access if not a access denied
   //message be displayed and the user will be redirected.
         if ($_SESSION['username'] == 'kauseway') {}
        
      else
      {
        header("Refresh: 3; url=index.php");
       echo '<h3>Access deined - you do not have access to this page</h3>';
       echo 'You will be redirected in 3 seconds';
       include ('includes/footer.html');
        exit(); // Quit the script.
      }  
   }
   // if no valid session is found then the user is not logged in and will
   // receive a access denied message and will be redirected to the login page.
   else if (!isset($_SESSION['user_id'])) {
    
      header("Refresh: 3; url=index.php");
      echo '<h3>Access deined - you do not have access to this page</h3>';
      echo '<p>You will be redirected in 3 seconds</p>';
      include ('includes/footer.html');
      exit(); // Quit the script.
   }  
?>
<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($base, 
  $keepclean, 
  $getclean, 
  $deepclean, 
  $moveinout, 
  $addon,
  $addon_inside_windows_1,
  $addon_inside_windows_2,
  $addon_bed_stream,
  $addon_inside_fridge,
  $addon_inside_stove, 
  $beds, 
  $baths, 
  $sqft, 
  $week, 
  $biweek, 
  $month, 
  $rate, 
  $use_flat_first_time_discount, 
  $first_time_disocunt, 
  $final_link, 
  $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
 <link rel="stylesheet" href="login.css"/>
 <style>
     ul
{
    list-style-type: none;
}
    input {
        float: right;
    }
 </style>
 <script src="../assets/plugins/jquery-2.0.3.min.js"></script>
 <script>
     $(function() {
         $('#useFlatDiscount').change(function() {
            if($(this).prop('checked'))
                $('#firstTimeDiscount').show();
            else
                $('#firstTimeDiscount').hide();
         });
     });
 </script>
 </head>
 <body>
 <?php // if there are any errors, display them
	if ($error!='')
	{
		echo '<div style="padding:4px; border:1px solid red; color:red;">' . $error . '</div>';
	}
 ?> 
 
 <h2>NaturalCare Value Variables</h2>
 <div class="navigation">
     <a class="button" href="admin.php">Dashboard</a>
     <a class="button" href="edit.php">Calculation Values</a>
     <a class="button" href="view.php">Disabled Dates</a>
     <a class="button" type="button" href="logout.php">Log-Out</a>
 </div><br><br>
 
 
 <p>These values are used to determine the cost of cleaning for NaturalCare Cleaning Services.</p>
 <p>Every value must not be empty, and must be a positive number on submit, or the calculations will not work.</p><br>
 <p>Deep Clean and Move In/Out are extra charges based on percentages. For a 50% additional charge, enter 50 into the field.</p>
 <p>Week, Bi-Weekly, and Monthly are discounts based on percentages. For a 50% discount, enter 50 into the field.</p>
 <form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <div>
     <div style="width:20%; float:left">
     <ul>
        <li>
            <strong>Base starting value: *</strong> <input type="text" name="base" value="<?php echo $base; ?>"/><br/>
        </li><br>
        <li>
            <strong>Keep It Clean: *</strong> <input type="text" name="keepclean" value="<?php echo $keepclean; ?>" />(%)<br/>
        </li><br>
        <li>
            <strong>Get It Clean: *</strong> <input type="text" name="getclean" value="<?php echo $getclean; ?>" />(%)<br />
        </li><br>
        <li>
             <strong>Deep Clean: *</strong> <input type="text" name="deepclean" value="<?php echo $deepclean; ?>"/>(%)<br/>
        </li>   <br> 
        <li>     
             <strong>Move In/Out: *</strong> <input type="text" name="moveinout" value="<?php echo $moveinout; ?>"/>(%)<br/>
        </li> <br>    
        

        <li>     
             <strong>Add on: *</strong> <input type="text" name="addon" value="<?php echo $addon; ?>"/><br/>
        </li> <br>  
        <li>     
           <strong>Add on: Inside Windows: *</strong> <br>
           <input type="text" name="addon_inside_windows_1" value="<?php echo $addon_inside_windows_1; ?>"/><br/>
           <input type="text" name="addon_inside_windows_2" value="<?php echo $addon_inside_windows_2; ?>"/><br/>
        </li> <br>   
        <li>     
             <strong>Add on:  Bed Stream: *</strong> <br> <input type="text" name="addon_bed_stream" value="<?php echo $addon_bed_stream; ?>"/><br/>
        </li> <br>    
        <li>     
             <strong>Add on: Inside Fridge: *</strong><br> <input type="text" name="addon_inside_fridge" value="<?php echo $addon_inside_fridge; ?>"/><br/>
        </li> <br>   
        <li>     
             <strong> Add on:  Inside Stove: *</strong><br> <input type="text" name="addon_inside_stove" value="<?php echo $addon_inside_stove; ?>"/><br/>
        </li> <br>  

        <li>     
             <strong>Beds: *</strong> <input type="text" name="beds" value="<?php echo $beds; ?>"/><br/>
        </li> <br>    
        <li>    
             <strong>Baths: *</strong> <input type="text" name="baths" value="<?php echo $baths; ?>"/><br/>
        </li><br> 
        <li>     
             <strong>Square Footage: *</strong> <input type="text" name="sqft" value="<?php echo $sqft; ?>"/><br/>
        </li><br>
        <li>     
             <strong>Week: *</strong> <input type="text" name="week" value="<?php echo $week; ?>"/>(%)<br/>
        </li><br>
        <li>     
             <strong>Bi-Week: *</strong> <input type="text" name="biweek" value="<?php echo $biweek; ?>"/>(%)<br/>
        </li><br>
        <li>    
             <strong>Month: *</strong> <input type="text" name="month" value="<?php echo $month; ?>"/>(%)<br/>
        </li> <br>
        <li>     
             <strong>Hourly Rate: *</strong> <input type="text" name="rate" value="<?php echo $rate; ?>"/><br/>
        </li><br>
        <li>     
             <strong>Thank You Link: *</strong> <input type="text" name="final_link" value="<?php echo $final_link; ?>"/><br/>
        </li><br>
        <li>
            <input type="checkbox" name="use_flat_first_time_discount" id="useFlatDiscount" value="1" <?php if($use_flat_first_time_discount) echo 'checked'; ?> /> 
            <strong>Use First Time Discount</strong>
            <ul id="firstTimeDiscount" <?php if (!$use_flat_first_time_discount) echo 'style="display: none"'; ?>>
                <li><strong>Discount: </strong> <input type="text" name="first_time_discount" value="<?php echo $first_time_discount; ?>" /></li>
            </ul>
        </li><br>     
    </ul>
    </div>
<div style="clear: both">
 <p>* Required</p>
 <input style="float:none" class="button2" type="submit" name="submit" value="Submit"><br>

 </div>
 </div>
 </form> 
 </body>
 </html> 
 <?php
}

// connect to the database
include('connect-db.php');

// check if the form has been submitted. If it has, process the form and save it to the database
if (isset($_POST['submit']))
{




		// get form data, making sure it is valid

    $addon_inside_windows_1 = mysql_real_escape_string(htmlspecialchars($_POST['addon_inside_windows_1']));
    $addon_inside_windows_2 = mysql_real_escape_string(htmlspecialchars($_POST['addon_inside_windows_2']));
    $addon_bed_stream = mysql_real_escape_string(htmlspecialchars($_POST['addon_bed_stream']));
    $addon_inside_fridge = mysql_real_escape_string(htmlspecialchars($_POST['addon_inside_fridge']));
    $addon_inside_stove = mysql_real_escape_string(htmlspecialchars($_POST['addon_inside_stove']));  
		$base = mysql_real_escape_string(htmlspecialchars($_POST['base']));
        $getclean = mysql_real_escape_string(htmlspecialchars($_POST['getclean']));
        $keepclean = mysql_real_escape_string(htmlspecialchars($_POST['keepclean']));
		$deepclean = mysql_real_escape_string(htmlspecialchars($_POST['deepclean']));
		$moveinout = mysql_real_escape_string(htmlspecialchars($_POST['moveinout']));
		$addon = mysql_real_escape_string(htmlspecialchars($_POST['addon']));
		$beds = mysql_real_escape_string(htmlspecialchars($_POST['beds']));
		$baths = mysql_real_escape_string(htmlspecialchars($_POST['baths']));
		$sqft = mysql_real_escape_string(htmlspecialchars($_POST['sqft']));
		$week = mysql_real_escape_string(htmlspecialchars($_POST['week']));
		$biweek = mysql_real_escape_string(htmlspecialchars($_POST['biweek']));
		$month = mysql_real_escape_string(htmlspecialchars($_POST['month']));
		$rate = mysql_real_escape_string(htmlspecialchars($_POST['rate']));
        $use_flat_first_time_discount = isset($_POST['use_flat_first_time_discount']) ? 1 : 0;
        $first_time_discount = $_POST['first_time_discount'] ? mysql_real_escape_string(htmlspecialchars($_POST['first_time_discount'])) : 0;
        $final_link = mysql_real_escape_string(htmlspecialchars(($_POST['final_link'])));
	
		//SC: insert error checking here!
		//if/else




		// save the data to the database
		$query = "UPDATE options SET addon_inside_windows_1='$addon_inside_windows_1', addon_inside_windows_2='$addon_inside_windows_2', addon_bed_stream='$addon_bed_stream', addon_inside_fridge='$addon_inside_fridge', addon_inside_stove='$addon_inside_stove',
    base='$base', keepclean='$keepclean', getclean='$getclean', deepclean='$deepclean', moveinout='$moveinout', addon='$addon', beds='$beds',
		baths='$baths', sqft='$sqft', week='$week', biweek='$biweek', month='$month', rate='$rate', use_flat_first_time_discount=$use_flat_first_time_discount, first_time_discount='$first_time_discount', final_link = '$final_link'";
		mysql_query($query)
		or die(mysql_error());
		
		// once saved, redirect back to the view page
		header("Location: edit.php");


}
else
// if the form hasn't been submitted, get the data from the db and display the form
{

	
	// query db
	$id = $_GET['id'];
	$result = mysql_query("SELECT * FROM options")
	or die(mysql_error());
	$row = mysql_fetch_array($result);
	
	// check that the 'id' matches up with a row in the databse
	if($row)
	{
	
		$base = $row['base'];
        $getclean = $row['getclean'];
        $keepclean = $row['keepclean'];
		$deepclean = $row['deepclean'];
		$moveinout = $row['moveinout'];
		$addon = $row['addon'];
		$beds = $row['beds'];
		$baths = $row['baths'];
		$sqft = $row['sqft'];
		$week = $row['week'];
		$biweek = $row['biweek'];
		$month = $row['month'];
		$rate = $row['rate'];
    $use_flat_first_time_discount = $row['use_flat_first_time_discount'];
    $first_time_discount = $row['first_time_discount'];
		$final_link = $row['final_link'];
    $addon_inside_windows_1 = $row['addon_inside_windows_1'];
    $addon_inside_windows_2 = $row['addon_inside_windows_2'];
    $addon_bed_stream = $row['addon_bed_stream'];
    $addon_inside_fridge = $row['addon_inside_fridge'];
    $addon_inside_stove = $row['addon_inside_stove'];


 
		// show form
		renderForm(
      $base, 
      $keepclean, 
      $getclean, 
      $deepclean, 
      $moveinout, 
      $addon, 
      $addon_inside_windows_1,
      $addon_inside_windows_2,
      $addon_bed_stream,
      $addon_inside_fridge,
      $addon_inside_stove,
      $beds, 
      $baths, 
      $sqft, 
      $week, 
      $biweek, 
      $month, 
      $rate, 
      $use_flat_first_time_discount, 
      $first_time_discount, 
      $final_link, 
      ''
      );
	}
	else
	// if no match, display result
	{
		echo "No results!";
	}
	
	
}
?>
