<?php
error_reporting(0);
//connect to database
$conn = mysqli_connect('****', '*****', '*****', '*****');


//check connection
if (!$conn) 
{ 
  die("Connection failed: Unable to connect to server");
}



$fname = $_SESSION['fname'];
$sname = $_SESSION['sname'];
$email = $_SESSION['email_register'];
$password_1 = $_SESSION['password_1'];
$password_2 = $_SESSION['password_2'];
$nin = $_SESSION['nin'];



//Table registration is a table created to keep record of registered emails so as to avoid email duplication
//check if email has already been registered.
$check = mysqli_query($conn, "SELECT email FROM registration WHERE email='$email'");
$row = mysqli_num_rows($check);

if($row > 0) 
{
 printf("<p class='design' style='text-align:center; color:purple;'>Email already registered, try another.<br></p>");
 return false;
 exit();
}
elseif ($password_1 !== $password_2)
{ 
    echo "<p class='design' style='text-align:center; color:purple;'>Password not matching. </p>";
    return false;
    exit();
}
else 
{
    $password = md5($password_1);       //encrypt the password before saving in the database
} 



//insert data into database
$submit_1 = "INSERT INTO registration (fname, sname, email, nin, password) VALUES ('$fname', '$sname', '$email', '$nin', '$password')";

if( mysqli_query($conn, $submit_1))
{
printf("<p class='design' style='text-align:center; color:purple;'> Registration complete.</p>");
echo "<meta http-equiv='refresh'  content='2;url=itex_login.php'>";
}
else
{
echo "<p class='design' style='text-align:center; color:purple;'>Unable to register at the moment: </p>";
}



mysqli_close($conn);

?>
