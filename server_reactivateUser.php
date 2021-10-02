<?php


// initiate connection with database


//connect to database
$conn = mysqli_connect('localhost', 'id17048003_gahs', 'Temitope.1900', 'id17048003_customer');

//check connection
if (!$conn) 
{ 
  die("Connection failed: " . mysqli_connect_error());
}

// this page shows how to restore deactivated users back into table registration and remove their records from table store_account
//the user will submit his email for reactivation and this email will be used to get his records from store_account

//select user info from store_account
$reactivate="SELECT * FROM store_account WHERE email='$email'";
$result = mysqli_query($conn, $reactivate);

while($row = mysqli_fetch_assoc($result))         //fetch associative array 
{
$email = $row["email"];
$fname = $row['fname'];
$sname = $row['sname'];
$nin = $row['nin'];
$account_balance = $row['account_balance'];
}

//create new record for user in table registration
$return_user = "INSERT INTO registration (email, fname, sname, nin, account_balance) VALUES ('$email', '$fname', '$sname', $nin, $account_balance)";
$user = mysqli_query($conn, $return_user);

//assign to session variables
    while($row2 = mysqli_fetch_assoc($user))         //fetch associative array 
{
$_SESSION["email"] = $row2["email"];
$_SESSION["fname"] = $row2['fname'];
$_SESSION["sname"] = $row2['sname'];
$_SESSION["nin"] = $row2['nin'];
$_SESSION["account_balance"] = $row2['account_balance'];
}


//on the front page, the user will be prompted to provide a new password which will be submitted in a form
if (($_POST["password_1"]) !== ($_POST["password_2"]))
{return false;}
else {$password = md5($password_1);} //encrypt the password before saving in the database

//insert new password into table
$submit_password = "INSERT INTO registration (password) VALUES ('$password')";


//give feedback on operations
if (mysqli_query($conn, $submit_password))
{ echo "Your account has been reactivated";}

else { echo "Unable to reactivate account at the moment" . mysqli_error();}

mysqli_close($conn);

?>
