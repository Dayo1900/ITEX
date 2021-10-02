<?php


// initiate connection with database


//connect to database
$conn = mysqli_connect('localhost', 'id17048003_gahs', 'Temitope.1900', 'id17048003_customer');

//check connection
if (!$conn) 
{ 
  die("Connection failed: " . mysqli_connect_error());
}


//There is a separate page named 'create database' where I showed how I created two tables: 'registration' and 'store_account'.
//1. table registration to hold information of normal users
//2. table store_account to hold information of deactivated users
//3. this page shows how to remove deactivated users from table registration and insert into table store_account

$_SESSION['id'] = $id;
$_SESSION['fname'] = $fname;
$_SESSION['sname'] = $sname;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['nin'] = $nin;
$_SESSION['account_balance'] = $account_balance;

//insert user basic details into store_account 
//because the user is still logged in, I can make use of session variables
$deactivate="INSERT INTO store_account VALUES ($id, '$fname', '$sname', '$email', '$password', '$nin', '$account_balance' )";

//after inserting
if (mysqli_query($conn, $deactivate))
{
    //delete user basic info from table registration
$delete = "DELETE FROM registration WHERE ID = $id";

    //unset and destroy user session
    session_unset();
    
    session_destroy();
    
    //redirect back to home page
    echo "<meta http-equiv='refresh'  content='2;url=itex_homepage.php'>";
    
}

else { echo "Unable to deactivate account at the moment" . mysqli_error();}

mysqli_close($conn);

?>
