<?php
//this script will update the account balance anytime money is added to a wallet

// initiate connection with database
$servername="localhost";

$username="id17048003_gahs";

$password="Temitope.1900";

$databasename="id17048003_customer";


//connect to database
$conn=mysqli_connect($servername, $username, $password, $databasename);

//check connection
if (!$conn) 
{ 
  die("Connection failed: Unable to connect to server" . mysqli_connect_error());
}

//In a real situation, a message will be sent to online card operator to deduct the stipulated amount from source. 
//I'm assuming here that the merchant has deducted from source and sent me the money 
//So the next thing I want to do is insert the money into my database and keep records


//insert data into database
$submit_1 = "INSERT INTO registration (addMoney, transaction_history) VALUES ($addMoney, '$transaction_history') WHERE ID = $id";  //$addMoney and $id are integers so they are not inside quotations.

if(mysqli_query($conn, $submit_1))  //if inserted successfully proceed with these steps
{
//calculate the account balance 
$account_1 = "SELECT SUM(addMoney) FROM registration WHERE ID = $id";
$account_one=mysqli_query($conn, $account_1);

while ($account1result = mysqli_fetch_assoc($account_one))    //fetch associative array

{ 
    $accountOne = $account1result['SUM(addMoney)'];     //this is the total sum of money that has ever entered the account
}


$account_2 = "SELECT SUM(withdrawMoney) FROM registration WHERE ID = $id";
$account_two=mysqli_query($conn, $account_2);

while ($account2result = mysqli_fetch_assoc($account_two))     //fetch associative array

{ 
    $accountTwo = $account2result['SUM(withdrawMoney)'];    //this is the total sum of money that was ever withdrawn from the account
}

$account = $accountOne - $accountTwo;
}

else
{
echo "<p class='design' style='text-align:center;'>Unable to submit to database at the moment: </p>" . mysqli_error($conn);    
}


//insert account into account_balance
if (mysqli_query($conn, $account_1) && mysqli_query($conn, $account_2))
{
    $submit_2 = "INSERT INTO registration (account_balance) VALUES ($account) WHERE ID = $id";    //this will create a new record inside account_balance
    
    $_SESSION['account_balance'] = $account;   //update the account_balance session variable to reflect in other pages where it's needed
}

else
{
echo "<p class='design' style='text-align:center;'>Unable to update account balance at the moment: </p>" . mysqli_error($conn);    
}


//announce successful operation
if( mysqli_query($conn, $submit_2))
{
printf("<p class='design' style='color:purple; text-align:center;'> Wallet has been funded.</p>");
}

else
{
echo "<p class='design' style='text-align:center;'>Unable to fund wallet at the moment: </p>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
