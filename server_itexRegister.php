<?php


// initiate connection with database


//connect to database
$conn = new mysqli('localhost', 'id17048003_gahs', 'Temitope.1900', 'id17048003_customer');

//check connection
if ($conn->connect_error) 
{ 
  die("Connection failed: " . $conn->connect_error);
}

//check if email has already been registered.
$check = "SELECT email FROM registration WHERE email='$email'";
$response = $conn->query($check);

if($response->num_rows >0) 
{
 printf("<p class='error'>Email already registered, try another.<br></p>");
 return false;
}

if (($_POST["password_1"]) !== ($_POST["password_2"]))
{return false;}
else {$password = md5($password_1);} //encrypt the password before saving in the database

//insert data into database
$submit_1 = "INSERT INTO registration (fname, sname, email, nin, password) 
VALUES ('$fname', '$sname', '$email', '$nin', '$password')";


if( mysqli_query($conn, $submit_1))
{
printf("<p class='design' style='color:purple;'> Wallet created, you may log in.</p>");
}
else
{
echo "<p class='design'>Unable to register at the moment: </p>" . mysqli_error($conn);
}
$conn->close();

?>
