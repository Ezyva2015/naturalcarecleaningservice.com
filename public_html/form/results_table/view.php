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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
        <title>View Records</title>
        <link rel="stylesheet" href="login.css"/>
</head>
<body> 
    <h2>NaturalCare Disabled Dates</h2>
     <div class="navigation">
     <a class="button" href="admin.php">Dashboard</a>
     <a class="button" href="edit.php">Calculation Values</a>
     <a class="button" href="view.php">Disabled Dates</a>
     <a class="button" type="button" href="logout.php">Log-Out</a>
 </div><br><br>
<h4>Dates that are disabled in the NaturalCare Book-Now form date picker</h4>
<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/

        // connect to the database
        include('connect-db.php');

        // get results from database
        $result = mysql_query("SELECT * FROM disabledates") 
                or die(mysql_error());  
                
        // display data in table
        
        
        echo "<table border='1' cellpadding='10'>";
        echo "<tr> <th>ID</th> <th>Date</th> <th>Actions</th> </tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                
                
                echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
?>
<p><a class="button2" href="new.php">Add a new record</a></p>
<br>

</body>
</html> 
