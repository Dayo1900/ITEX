<?php


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

//In a real situation, a message will be sent to the appropriate online card operator to deduct the stipulated amount from source. 
//I'm assuming here that the merchant has deducted from source and sent me the money 
//So the next thing I want to do is insert the money into my database and keep records


//insert data into database
$submit_1 = "INSERT INTO registration (addMoney) VALUES ($addMoney) WHERE ID = $id";  //$addMoney and $id are integers so they are not inside quotations.

//if inserted successfully proceed with these steps
if(mysqli_query($conn, $submit_1))  
{
//calculate the account balance 
$account_1 = "SELECT SUM(addMoney) FROM registration WHERE ID = $id";
$account_one=mysqli_query($conn, $account_1);

//fetch associative array
while ($account1result = mysqli_fetch_assoc($account_one))    

{   //this is the total sum of money that has ever entered the account
    $accountOne = $account1result['SUM(addMoney)'];     
}


$account_2 = "SELECT SUM(withdrawMoney) FROM registration WHERE ID = $id";
$account_two=mysqli_query($conn, $account_2);

//fetch associative array
while ($account2result = mysqli_fetch_assoc($account_two))     

{   //this is the total sum of money that was ever withdrawn from the account
    $accountTwo = $account2result['SUM(withdrawMoney)'];    
}
//this is the new account balance
$account = $accountOne - $accountTwo;       
}

else
{
echo "<p class='design' style='text-align:center;'>Unable to submit to database at the moment: </p>" . mysqli_error($conn);    
}


//insert balance into account_balance
if (mysqli_query($conn, $account_1) && mysqli_query($conn, $account_2))
{   
    //this will add a new record to account_balance
    $submit_2 = "INSERT INTO registration (account_balance) VALUES ($account) WHERE ID = $id";    
    
    //update the account_balance session variable to reflect in other pages where needed
    $_SESSION['account_balance'] = $account;   
}

else
{
echo "<p class='design' style='text-align:center;'>Unable to update account balance at the moment: </p>" . mysqli_error($conn);    
}



//add a new record to transaction_history
if (mysqli_query($conn, $submit_2))
{
    //this will give the money added, card used and date
 $transaction_history= date('d-m-Y')."<br>".$addMoney." "."was received from card:".$card_number;       

 $transact_history="INSERT INTO registration (transaction_history) VALUES ('$transaction_history') WHERE ID = $id";


//this  will select all the available transaction history in an account
$account_history = "SELECT transaction_history FROM registration WHERE ID = $id";
$account_details=mysqli_query($conn, $account_history);

while ($details = mysqli_fetch_assoc($account_history))     

{   //this will hold the history of the account in session variable
    $_SESSION['transaction_history'] = $details['transaction_history'];    
}
}

else{
    echo "unable to update records";
    exit();
}


//announce outcome of operation after all steps have been concluded
if( mysqli_query($conn, $history))
{
printf("<p class='design' style='color:purple; text-align:center;'> Wallet has been funded.</p>");
}

else
{
echo "<p class='design' style='text-align:center;'>Unable to fund wallet at the moment: </p>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
