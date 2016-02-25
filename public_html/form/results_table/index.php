<?php 
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['username'] == 'kauseway'
                                        && $_POST['password'] == 'password1')
{
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
//die(print_r($_SESSION));
header('Location: admin.php');
exit();
}
?>

<html>
<head>
<title>NaturalCare Admin</title>
<!-- Include CSS File Here -->
<link rel="stylesheet" href="login.css"/>
</head>
<body>
<div class="container">
<div class="main">
<h2>NaturalCare Admin - Login</h2>
<form id="form_id" method="post" name="myform">
<div style="margin-bottom:15px">
    <label>User Name :</label>
    <input type="text" name="username" id="username"/>
</div>
<div style="margin-bottom:15px">
    <label>Password :</label>
    <input type="password" name="password" id="password"/>
</div>
<div>
    <center><button type="submit" value="Login" id="submit" onclick="validate()">Login</button></center>
</div>
</form>
</div>
</div>
</body>
</html>