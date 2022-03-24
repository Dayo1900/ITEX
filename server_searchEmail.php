<?php
error_reporting(0);
//connect to database
$conn = mysqli_connect('****', '*****', '*****', '*****');


//check connection
if (!$conn) 
{ 
  die("Connection failed: Unable to connect to server");
}


$searchEmail = $_SESSION["email_reset_passwd"];


//check if email is registered.
$check = mysqli_query($conn, "SELECT email FROM registration WHERE email='$searchEmail'");
$row = mysqli_num_rows($check);

if($row > 0) 
{}

else 
{
  die("<p class='design' style='text-align:center; color:purple;'>" .$searchEmail. " is not registered on this site.</p>");
} 


mysqli_close($conn);

?>
