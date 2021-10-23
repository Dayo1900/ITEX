<?php session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Africa/Lagos');

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/OAuth.php';
require 'PHPMailer/src/POP3.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Verify Email</title>

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
 
  
  


<!--Design the email verification page--> 

<h5 class="password"> Do not close your browser</h5>

 <div class="email2">         

  <form action="email_registration.php" method="post">
      
    <?php
    echo '<p style="text-align:center; font-size:1.05rem; word-wrap:break-word;">A number will be sent to confirm your email.<br>
                                                             Click "send"</p>';?>
<br>       
            <input type="submit" class="confirm_password" name="send" value="Send">
<br><br><br>
</form>



  <form action="email_registration.php" method="post">
    <?php
    if(isset($_POST['send']))
    {
        echo  '<p style="text-align:center; font-size:1.05rem; word-wrap:break-word;"> You may wait for about five minutes before refreshing your inbox or the spam folder.<br> Enter the number sent to ' .$_SESSION['email_register']. '.</p><br>';
    }
    ?>
    
            <div style= "display:grid; align-items:center;">
        <label for="confirmation" style="font-family:Tahoma, sans-serif; letter-spacing:2px; margin-left:5%;">Confirm: <input class="confirm" type="number" name="confirmation" placeholder="Confirm number" required></label>
       
       <span class="error"> <?php if ((isset ($_POST["confirm"])) && (empty ($_POST["confirmation"])))
                                     {echo ("*Please confirm number");
                                     return false;
                                      exit();}?>  </span> 
                                     
                                     
                 <br><br>
         <input type="submit" class="confirm_password" name="confirm" value="Confirm">
</div>
</form>
<br>
</div>
  
    
<?php 

if(isset($_POST['send']))
{
$_SESSION['number'] = rand(100000, 999999);

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
    $mail->addAddress($_SESSION['email_register']); // Add a recipient address
    //$mail->addAddress('contact@example.com');               // Name is optional
    $mail->addReplyTo('boselamo@yahoo.com');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Verify Email';
$mail->Body    = "<html>
<body>
<p style='font-family:Helvetica, sans-serif;'> Hi " .$_SESSION['fname']. ",<br></p>

<p style='font-family:Helvetica, sans-serif;'> <br>
As part of creating an ITEX wallet for you, we have sent a one-time verification number. 
<br>Copy it and use it to verify your email. <br></p>

<p style='font-family:Helvetica, sans-serif; font-size:2.5rem; font-weight:bold;'><br>" .$_SESSION['number']. "</p>

<p style='font-family:Helvetica, sans-serif;'> <br>
If you did not make this request, please ignore this email. <br>
Thanks.</p>

<br><br><br>
Best Regards,<br>
ITEX_Test_Demo.

</body>
</html>";

$mail -> send();
echo "";
}
catch   (Exception $e)
{
echo "<p style='text-align:center; font-size:1.5rem; color:purple;'>Unable to register new users due to network issues, please try again later. <br>Thank you.</p>"; 
echo "Mailer error: " . $mail -> ErrorInfo;
}
}


if (isset ($_POST["confirm"]))
{
$confirmation = $_POST['confirmation'];

if ($confirmation == $_SESSION['number'])
{
include 'server_itexRegister.php';
}
else
{
echo "<p class='design' style='font-size:1.2rem; text-align:center; color:purple;'>Number not correct</p>";
}
}
?>
             
</body>
</html>
