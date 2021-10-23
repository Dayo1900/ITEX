<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Set Password</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="'itex',">

<link rel="stylesheet" type="text/css" href="itex_design.css">
<link rel="stylesheet" type="text/css" media="(max-width:1199px)" href="itex_design1199px.css">
<link rel="stylesheet" type="text/css" media="(max-width:860px)" href="itex_design860px.css">
<link rel="stylesheet" type="text/css" media="(max-width:600px)" href="itex_design600px.css">
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">

</head>

<body>


<?php if (isset ($_POST["confirm"]))
{
$password_1 = $_POST['password_1'];
$password_2 = $_POST['password_2'];

if ($password_1 === $password_2)
{
$_SESSION['password_reactivate'] = $password_1;
include 'server_reactivateUser.php';
}
else
{
echo "<p class='design' style='font-size:1.2rem; text-align:center; color:purple;'>Password not matching</p>";
return false;
               exit();
}
}
?>


<!--Design the page--> 

<h5 class="password"> Set Password</h5>

<p style='text-align:center; font-size:1.2rem;'> Set a new password for your wallet.<br></p>
                                                            

           <div class="email">         
  <form action="confirm_password.php" method="post">
       
<br>   
        <div style= "display:grid; align-items:center;">
        <input class="confirm" type="password" name="password_1"  placeholder="New password" required> 
             <span class="error"> 
           <?php
           if ((isset ($_POST["confirm"])) && (empty ($_POST["password_1"]))) 
           {
               echo ("*Password required");
               return false;
               exit();
           } 
           ?> 
       </span>
       </div>                       
                                     
     
     
        <div style= "display:grid; align-items:center;">
            <input class="confirm" type="password" name="password_2" placeholder="Confirm password" required> 
              <span class="error"> 
            <?php 
               if ((isset ($_POST["confirm"])) && (empty ($_POST["password_2"])))  
               {
                   echo "*Confirm password";
                   return false;
               exit();
               }  
               elseif((isset ($_POST["confirm"])) && (($_POST["password_1"]) !== ($_POST["password_2"])))
                               {
                               echo ("*Password not matching");
                               return false;
               exit();
                               }?>     <!--execute elseif statement if password doesn't match-->     
       </span>
       
       
       <br> <br>
<input type="submit" class="confirm_password" name="confirm" value="Confirm">
</div>

</div>
</form>


</body>
</html>
