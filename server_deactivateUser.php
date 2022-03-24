<?php

// initiate connection with database
$conn = mysqli_connect('******', '********', '******', '***');


//check connection
if (!$conn) 
{
  die("Connection failed: Unable to connect to server");
}

//There is a separate page named 'create database' where I showed how I created two tables: 'registration' and 'store_account'.

//1. table registration to hold information of normal users

//2. table store_account to hold information of deactivated users

//3. this page shows how to remove users from table registration and insert into table store_account during deactivation

$id = $_SESSION['id'];

$fname = $_SESSION['fname'];

$sname = $_SESSION['sname'];

$email = $_SESSION['email'];

$nin = $_SESSION['nin'];

$account_balance = $_SESSION['account_balance'];



//if there's still some money in account_balance, don't deactivate wallet
if($account_balance > 5)
{
 $cash = number_format($account_balance);
 echo "<p class='design' style='font-size:1.2rem; text-align:center;'>You still have some money in your account, empty it to deactivate wallet.</p>";
  return false;
  exit();
}
elseif($account_balance == NULL)
{
    $account_balance = 0;
}
elseif($nin == NULL)
{
    $nin = 0;
}
else {}



//insert user basic details into store_account 

//because the user is still logged in, I can make use of session variables
$deactivate = "INSERT INTO store_account (fname, sname, email, nin, account_balance) VALUES ('$fname', '$sname', '$email', '$nin', $account_balance);";

//after inserting
if(mysqli_query($conn, $deactivate))
{
echo "<p class='design' style='font-size:1.2rem; text-align:center; color:purple;'>Processing</p>";    
}
else {
    echo "Unable to connect to database";
    exit();
}

//delete user basic info from table registration;
$delete = "DELETE FROM registration WHERE ID = $id";

//unset and destroy user session
session_unset();
    
session_destroy();




    
if(mysqli_query($conn, $delete))
{
//redirect back to home page
echo "<meta http-equiv='refresh'  content='2;url=itex_homepage.php'>";

echo "<p class='design' style='font-size:1.2rem; text-align:center; color:purple;'>Wallet deactivated successfully.</p>";
}
else {
 echo "<p class='design' style='font-size:1.2rem; text-align:center;'>Unable to deactivate wallet at the moment</p>";
 exit();
}


mysqli_close($conn);


?>
























