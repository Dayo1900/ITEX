<?php


// initiate connection with database


//connect to database
$conn = mysqli_connect('****', '*****', '*****', '*****');

//check connection
if (!$conn) 
{ 
  die("Connection failed: Unable to connect to server.");
}

// this page shows how to restore deactivated users back into table registration and remove their records from table store_account
//the user will submit his email for reactivation and this email will be used to get his records from store_account


$email_reactivate = $_SESSION['email_reactivate'];

//select user info from store_account
$reactivate="SELECT * FROM store_account WHERE email='$email_reactivate'";
$result = mysqli_query($conn, $reactivate);

while($row = mysqli_fetch_assoc($result))         //fetch associative array 
{
$email_return = $row["email"];
$fname = $row['fname'];
$sname = $row['sname'];
$nin = $row['nin'];
$account_balance = $row['account_balance'];
}

$password = md5($_SESSION['password_reactivate']);

//inform user that his email wasn't deactivated(this only applies to users who are not sure if their account still exists)
if(mysqli_num_rows($result) ==0)
{
    echo "<p class='design' style='text-align:center; color:purple;'>" .$email_reactivate. " was not deactivated.<br>Thank you.</p>";
    exit();
}

//create new record for user in table registration
$return_user = "INSERT INTO registration (email, fname, sname, nin, password, account_balance) VALUES ('$email_return', '$fname', '$sname', '$nin', '$password', $account_balance)";


//delete user info from store_account
$delete="DELETE FROM store_account WHERE email='$email_reactivate'";


//give feedback on operations
if (mysqli_query($conn, $return_user))
{ 
    echo "<p class='design' style='text-align:center; color:purple;'>Your account has been reactivated</p>";
    echo "<meta http-equiv='refresh'  content='2;url=itex_login.php'>";
}

else { 
    echo "<p class='design' style='text-align:center; color:purple;'>Unable to reactivate account due to network issues<br>Try again later.</p>";
}

mysqli_close($conn);

?>
