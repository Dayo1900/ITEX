<?php session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/OAuth.php';
require 'PHPMailer/src/POP3.php';

date_default_timezone_set("Africa/Lagos");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Password Reset</title>
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
  
    
<?php if (isset ($_POST["reset"]))
{

        $_SESSION['number'] = rand(100000, 999999);

    $reset_password = $_POST["email_reset_passwd"];
    
    if (filter_var($reset_password, FILTER_VALIDATE_EMAIL))  //validate email
    {
    $_SESSION["email_reset_passwd"] = $_POST["email_reset_passwd"];
    include 'server_searchEmail.php';              //this will find out if the email is registered


$mail = new PHPMailer(TRUE);
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.mail.yahoo.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'boselamo@yahoo.com';             // SMTP username
    $mail->Password = 'moqmtksecuthtsgg';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('boselamo@yahoo.com', 'ITEX-demonstration');          //This is the email your form sends From
    $mail->addAddress($_SESSION["email_reset_passwd"]); // Add a recipient address
    //$mail->addAddress('contact@example.com');               // Name is optional
    $mail->addReplyTo('boselamo@yahoo.com');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Reset Password';
$mail->Body    = "<html>
<body>
<p style='font-family:Helvetica, sans-serif;'> 
Hello there,</p>

<p style='font-family:Helvetica, sans-serif;'> <br>
Copy the number below to reset your password <br></p>

<p style='font-family:Helvetica, sans-serif; font-size:2.5rem;'><br>" .$_SESSION['number']. "</p>

<p style='font-family:Helvetica, sans-serif;'> <br>
If you have questions, please contact customer care by replying to this email. <br>
An agent will attend to you shortly.</p>

<br><br><br>
Best Regards,<br>
ITEX_Test_Demo.

</body>
</html>";

$mail -> send();
echo '<p style="text-align:center; font-size:1.05rem; word-wrap:break-word;"> You may wait for about five minutes before refreshing your inbox or the spam folder.<br> Enter the number sent to ' .$_SESSION["email_reset_passwd"]. ' to reset your password</p><br>';     
}
catch   (Exception $e)
{
echo "<p style='text-align:center; font-size:1.5rem; color:purple;'>Unable to reset password due to network issues, please try again later. <br>Thank you.</p>"; 
}
}
}
 else{}
 
 
 
 
 if(isset($_POST['confirm']))
    {
$confirmation = $_POST['confirmation'];


if ($confirmation == $_SESSION['number'])
{
echo "<meta http-equiv='refresh'  content='2;url=confirm_password_reset.php'";
}
else
{
echo "<p class='design' style='font-size:1.2rem; text-align:center; color:purple;'>Number not correct</p>";
return false;
exit();
}
}
else{}
?>



 
  
  


<!--Design the password reset page--> 

                                  <h5 style="margin-top:15%; text-align:center; font-size:2rem;"> Reset your password</h5>

<p style='text-align:center; font-size:1.2rem;'> Enter your email address below.</p>

           <div class="email">         

  <form action="email_resetPassword.php" method="post">
       
<br>
    <div style=" margin-top:2.5em; display:grid; align-items:center;">

     <input class="confirm" type="email" name="email_reset_passwd" placeholder="Email" required>
       
       <span class="error"> <?php if ((isset ($_POST["reset"])) && (empty ($_POST["email_reset_passwd"])))
                                     {echo("*Enter email address");
                                     return false;
                                     exit();} ?> </span> 
                                     
                                     
                 <br> <br>
         <input type="submit" class="confirm_password" name="reset" value="Enter">
<div>
</form>



  <form action="email_resetPassword.php" method="post">
    <?php
    if(isset($_POST["reset"]))
    {
        echo  '<p style="text-align:center; font-size:1.05rem; word-wrap:break-word;">Your request is being processed</p>';
    }
    ?>
    <br>
    <div style=" margin-top:2.5em; display:grid; align-items:center;">
        <label for="confirmation" style="font-family:Tahoma, sans-serif; letter-spacing:2px; margin-left:5%;">Number:</label>
        <input class="confirm" type="number" name="confirmation" placeholder="Confirm number" required>
       
       <span class="error"> <?php if ((isset ($_POST["confirm"])) && (empty ($_POST["confirmation"])))
                                     {echo ("*Please confirm number");
                                     return false;
                                     exit();}?>  </span> 
                                     
                                     
                 <br><br>
         <input type="submit" class="confirm_password" name="confirm" value="Enter">
</div>

</form>
<br>
</div>

             
</body>
</html>
