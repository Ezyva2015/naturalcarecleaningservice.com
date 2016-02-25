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
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="login.css"/>
</head>
<body>
    <h2>NaturalCare Admin Dashboard</h2>
 <div class="navigation">
     <a class="button" href="admin.php">Dashboard</a>
     <a class="button" href="edit.php">Calculation Values</a>
     <a class="button" href="view.php">Disabled Dates</a>
     <a class="button" type="button" href="logout.php">Log-Out</a>
 </div><br>
 <p>
     This Admin Control panel sets the values for variables contained in the NaturalCare Book-Now form.
 </p>
</body>

</html>