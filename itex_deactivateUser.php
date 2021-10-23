<?php session_start();
if(!isset($_SESSION['email']))
  
{echo "<p class='design' style='font-size:1.2rem; text-align:center;'>Please <a href='itex_login.php'>log in. </a></p>";
return false; 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Deactivate Wallet</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="'itex', 'register'">

<link rel="stylesheet" type="text/css" href="itex_design.css">
<link rel="stylesheet" type="text/css" media="(max-width:1199px)" href="itex_design1199px.css">
<link rel="stylesheet" type="text/css" media="(max-width:860px)" href="itex_design860px.css">
<link rel="stylesheet" type="text/css" media="(max-width:600px)" href="itex_design600px.css">
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">
</head>

<body>
 
    
<?php if (isset ($_POST["deactivate"]))
{
    $password = md5($_POST['password_1']);
    
//check if password is correct by cross checking with the password used to log in
if($_SESSION['password'] === $password)
{
echo     "<meta http-equiv='refresh' content='2;url=email_deactivate.php'>";
}
else
{
 echo "<p style='text-align:center; color:purple; font-size:1.5rem;'>Password not correct!</p>";
}
}
?>


<!--Design the deactivate account page--> 
  <a class="loginTwo" href="itex_reactivateUser.php"> Reactivate wallet</a>
           
             
<h1 style="text-align:center; color:#003399; margin-top:12%; font-size:2.5rem;"> Deactivate Wallet </h1>
<p class="design" style="margin:0;">Your itex wallet will be closed but you can get it back at any time.</p>

  <div class="a"> 
  <form method="post" action="itex_deactivateUser.php">

<!-- use php empty() funtion to ensure that mandatory fields are not blank.-->  
       <div class="align">
       <label for="password" class="d">Enter password: </label>
       <input class="b2" type="password" name="password_1" id="password" autocomplete="on" required> 
             <span class="error"> 
           <?php
           if ((isset ($_POST["deactivate"])) && (empty ($_POST["password_1"]))) 
	   {echo("*Password required");
	       return false;
exit();
	   } 
           ?> 
       </span>
       </div>	


         <input class="c3" type="submit" name="deactivate" value="Deactivate wallet">

<br>     
    </form> 

</div>


     <br><br><br><br>        
</body>
</html>
