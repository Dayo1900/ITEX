<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">

<head>

<title>Login</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="itex">

<link rel="stylesheet" type="text/css" href="itex_design.css">
<link rel="stylesheet" type="text/css" media="(max-width:990px)" href="itex_design990px.css">
<link rel="stylesheet" type="text/css" media="(max-width:630px)" href="itex_design630px.css">	
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">
</head>


<body class="colour">


<?php 
if (isset ($_POST["login"]))           //begin the log in process once the login button is clicked
{
$email=$password="";                    //define variables and initialise to empty

$email=($_POST['email']);
$password=md5($_POST['password']);

include 'server_itexLogin.php';         //this script will login users
}
?>


<!-- Design the login page -->
<h1 style="text-align:center; color:#003399; margin-top:4%; font-size:2.5rem;"> Login </h1>
<p class="design" style="margin:0;">Sign-in to your itex account.</p>

<div class="a">
 
  <form action="itex_login.php" method="post">     
      
  <input class="b" type="email" name="email" placeholder="Email" required autocomplete="on"><br>
         <span class="error"> <?php if ((isset ($_POST["login"])) && (empty ($_POST["email"])))
                                     {echo "*Email required";}  ?> </span>
  
  <input class="b" type="password" name="password" placeholder="Password" required> 
         <span class="error"> <?php if((isset ($_POST["login"])) && (empty ($_POST["password"])))
                                     {echo "*Password required";}  ?> </span>
  
    <input class="c" style="box-shadow:none;" type="submit" name="login" value="Login">
 </form>
 </div>  
<br>
<p class="design"> Not yet registered? <a href="itex_register.php"> Create account.</a></p>



</body>
</html>
