<?php
error_reporting(0);
date_default_timezone_set('Africa/Lagos');

if(empty($account_name))
{
 echo "<p style='text-align:center; color:purple; font-family:Arial; font-weight:bold;'>Please check and correct the error below.</p>";
return false;
exit();
}

elseif (empty($account_number))
{ 
echo "<p style='text-align:center; color:purple; font-family:Arial; font-weight:bold;'>Please check and correct the error below.</p>";
return false;
exit();
}


elseif (empty($bank))
{ 
echo "<p style='text-align:center; color:purple; font-family:Arial; font-weight:bold;'>Please check and correct the error below.</p>";
return false;
exit();
}


elseif(empty($withdrawMoney))
{ 
echo "<p style='text-align:center; color:purple; font-family:Arial; font-weight:bold;'>No money transferred.</p>";
return false;
exit();
}


else{}

//store as session variables
$_SESSION['account_name'] = $account_name;
$_SESSION['account_number'] = $account_number;
$_SESSION['bank'] = $bank;
$_SESSION['withdrawMoney'] = $withdrawMoney;









// initiate connection with database
$servername="****";
$username="*****";
$password="****";
$databasename="****";


//connect to database
$conn=mysqli_connect($servername, $username, $password, $databasename);


//check connection
if (!$conn) 
{ 
  die("Connection failed: Unable to connect to server");
}


//In a real situation, a message will be sent to the appropriate online card operator to deduct the stipulated amount from source. 
//I'm assuming here that the merchant has deducted from source and sent me the money 
//So the next thing I want to do is insert the money into my database and keep records


//first step is to update account balance


//find the account balance

$account_2 = "SELECT account_balance FROM registration WHERE ID = $id";

$account_two=mysqli_query($conn, $account_2);



//fetch associative array

while ($account2result = mysqli_fetch_assoc($account_two))     
{   
//this is the present account_balance
$accountTwo = $account2result['account_balance'];    
}


if (mysqli_query($conn, $account_2))
{
    
if(empty($accountTwo))
{
$accountTwo = 0;
}
elseif ($withdrawMoney > $accountTwo)
{
exit("<p style='text-align:center; color:purple; font-size:1.2rem;'>You do not have enough money for this transaction</p>");
}
elseif ($withdrawMoney <= $accountTwo)
{
//this is the new account balance: existing money - outgoing money
$account = $accountTwo - $withdrawMoney; 
$_SESSION['account'] = $account;
}
else{}

    echo "<meta http-equiv='refresh'   content='2;url=email_withdrawMoney.php'>";



}
else
{
echo "<p class='design' style='text-align:center;'>Unable to check account at the moment: </p>";    
}


mysqli_close($conn);
?>


























