<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Confirm withdrawal</title>

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
$password_1 = md5($_POST['password_1']);
$password_2 = $_SESSION['password'];

if ($password_1 == $password_2)
{
echo "<meta http-equiv='refresh'  content='2;url=email_withdrawMoney.php'";
}
else
{
echo "<p class='design' style='font-size:1.2rem; text-align:center; color:purple;'>Password not correct</p>";
return false;
               exit();
}
}
?>
             



<!--Design the email verification page--> 

<h5 class="password"> Processing. . .</h5>

<p style='text-align:center; font-size:1.2rem;'>  Enter password.<br></p>
                                                            

           <div class="email">         
  <form action="confirm_withdrawal.php" method="post">
       
<br>   
        <div style= "display:grid; align-items:center;">
        <input class="confirm" type="password" name="password_1"  placeholder="Wallet password" required> 
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
       
       
       <br> <br>
<input type="submit" class="confirm_password" name="confirm" value="Enter">
</div>

</div>
</form>



</body>
</html>
