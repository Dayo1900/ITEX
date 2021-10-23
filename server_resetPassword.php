<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Africa/Lagos');

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/OAuth.php';
require 'PHPMailer/src/POP3.php';


//connect to database
$conn = mysqli_connect('localhost', 'id17048003_gahs', 'Temitope.1900', 'id17048003_customer');

//check connection
if (!$conn) 
{ 
  die("<p class='design' style='text-align:center; color:purple;'>Connection failed: Unable to connect to server</p>");
}



$searchEmail = $_SESSION["email_reset_passwd"];
$password = md5($_SESSION['password_reset']);               //encrypt password


//update password
$reset = "UPDATE registration SET password = '$password' WHERE email = '$searchEmail'";



//give feedback on operations
if (mysqli_query($conn, $reset))
{ 
    echo "<p class='design' style='text-align:center; color:purple;'>Password changed.</p>";
    
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
    $mail->addAddress($searchEmail); // Add a recipient address
    //$mail->addAddress('contact@example.com');               // Name is optional
    $mail->addReplyTo('boselamo@yahoo.com');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Your password has been changed';
$mail->Body    = "<html>
<body>
<p style='font-family:Helvetica, sans-serif;'> Hi there,</p>

<p style='font-family:Helvetica, sans-serif;'> <br>
This is to notify you that the password to your ITEX wallet has been changed just now. 
<br> If you didn't do this, it means someone has access to your wallet<br>
So you should contact us by replying to this email as soon as possible. <br></p>


<p style='font-family:Helvetica, sans-serif;'> <br>
However, if you did change it then no harm done. <br>
We sincerely appreciate your patronage <br>
Thanks.</p>

<br><br><br>
Best Regards,<br>
ITEX_Test_Demo.

</body>
</html>";

$mail -> send();
echo "<meta http-equiv='refresh'  content='2;url=itex_login.php'>";
}
catch   (Exception $e)
{
echo "<p style='text-align:center; font-size:1.5rem; color:purple;'>Unable to reset password at the moment, please try again later. <br>Thank you.</p>"; 
}
}



mysqli_close($conn);

?>
