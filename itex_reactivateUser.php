<?php session_start();?>
<!DOCTYPE html>

<html lang="en">

<head>

<title>Reactivate Wallet</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="itex">

<link rel="stylesheet" type="text/css" href="itex_design.css">
<link rel="stylesheet" type="text/css" media="(max-width:1199px)" href="itex_design1199px.css">
<link rel="stylesheet" type="text/css" media="(max-width:860px)" href="itex_design860px.css">
<link rel="stylesheet" type="text/css" media="(max-width:600px)" href="itex_design600px.css">
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">
</head>

<body style="background-color:#f5f5f0;">


<?php 
if (isset ($_POST["reactivate"]))           //begin the process once the reactivate button is clicked
{

$email_3 = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

if($email_3 == TRUE)
{
    $email_reactivate = $_POST['email'];
    
    $_SESSION['email_reactivate'] = $email_reactivate;
    
    echo "<meta http-equiv='refresh' content='2;url=email_reactivateUser.php'>";
}
    else
    {
        echo"<p style='font-size:1.2rem; text-align:center; color:purple;'>Enter your ITEX email address</p>";
    }
}
?>


<!-- Design the reactivate page -->
<h1 style="text-align:center; color:#003399; margin-top:8%; font-size:2.5rem;"> Reactivate Wallet </h1>
<p class="design" style="margin:0;">Get your old wallet back with a few simple steps.</p>

<div class="a">
 
  <form action="itex_reactivateUser.php" method="post">     
      
  <input class="b" type="email" name="email" placeholder="Your ITEX email" autocomplete="on" required><br>
         <span class="error"> <?php if ((isset ($_POST["reactivate"])) && (empty ($_POST["email"])))
                                     {echo("*Email required");
                                     return false;
                                     exit();}  ?> </span>
  

  
    <input class="c3" style="box-shadow:none;" type="submit" name="reactivate" value="Reactivate Wallet">
 </form>
 </div>  
<br>
<p class="design"> Not yet registered? <a href="itex_register.php"> Create account.</a></p>


<br>
</body>
</html>
