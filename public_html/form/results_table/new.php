<?php
session_start();
include('connect-db.php');
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
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($date, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>New Record</title>
 <link rel="stylesheet" href="login.css"/>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
 minDate: 0,
 dateFormat: 'm-dd-yy',
 beforeShowDay: DisableSpecificDates
 });
 });
        </script>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 <h2>Disabled Date Selection</h2>
  <div class="navigation">
     <a class="button" href="admin.php">Dashboard</a>
     <a class="button" href="edit.php">Calculation Values</a>
     <a class="button" href="view.php">Disabled Dates</a>
     <a class="button" href="logout.php">Log-Out</a>
 </div><br><br>
 
 <form action="" method="post">
 <div>
     <h4>The Date format must be: month-day-year</h4>
     <p>The month cannot contain a '0' as the first number (March is 3, not 03)</p><br>
 <strong>Date: *</strong> <input type="text" name="date" id="datepicker" value="" /><br/>
 <p>* required</p>
 <input type="submit" class="button2" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html>
 <?php 
 }
 
 
 

 // connect to the database
 include('connect-db.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
 // check to make sure both fields are entered
 if ($date == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($date, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT into disabledates SET date='$date'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?> 
