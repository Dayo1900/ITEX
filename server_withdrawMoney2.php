<?php
error_reporting(0);


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
  die("Connection failed: Unable to connect to server");
}


//In a real situation, a message will be sent to the appropriate online card operator to deduct the stipulated amount from source. 
//I'm assuming here that the merchant has deducted from source and sent me the money 
//So the next thing I want to do is insert the money into my database and keep records


//first step is to update account balance

$new_account = $_SESSION['account'];
$id = $_SESSION['id'];
$account_name = $_SESSION['account_name'];
$account_number = $_SESSION['account_number'];
$bank = $_SESSION['bank'];
$withdrawMoney = $_SESSION['withdrawMoney'];





//update new balance into account_balance

//this will add a new record to account_balance
$submit_2 = "UPDATE registration SET account_balance = $new_account WHERE ID = $id"; 
   

//update the account_balance session variable to reflect in other pages where needed
$_SESSION['account_balance'] = "";
$_SESSION['account_balance'] = $new_account;   


if (!mysqli_query($conn, $submit_2))
{
echo "<p class='design' style='text-align:center;'>Unable to update account balance at the moment: </p>"; 
exit();
}




//Next thing to do is to store records in two different columns, namely: withdrawMoney and transaction_history


//find the amount of money in withdrawMoney column
$account_1 = "SELECT withdrawMoney FROM registration WHERE ID = $id";
$account_one = mysqli_query($conn, $account_1);


//fetch associative array
while ($account1result = mysqli_fetch_assoc($account_one))     
{   
//this is the total sum of money that ever entered the account
$accountOne = $account1result['withdrawMoney'];    
}


//add the outgoing cash to column withdrawMoney in database
$newMoney= $withdrawMoney + $accountOne;


//update withdrawMoney record in database
$submit = "UPDATE registration SET withdrawMoney = $newMoney WHERE ID = $id";  //$addMoney and $id are integers so they are not inside quotations.


//next, add a new record to transaction history
if (mysqli_query($conn, $submit))
{
// because the user is logged in, there is an existing session variable
$_SESSION["transaction_history"];
    
  
if (empty($_SESSION['transaction_history']))
{
$_SESSION['transaction_history'] = " - ";
}
    
    $money = number_format($withdrawMoney);

//this will give the money added and date right now
$transaction_history= "<small><p>" .date('d-m-Y'). "<br>". "&#x20A6;" .$money. " was transferred to " .$account_name. "<br>Bank: " .$bank. "</p></small>";       

 
//join new history to old history
$newHistory = $_SESSION["transaction_history"] . $transaction_history;
 
 
//update records
$transact_history="UPDATE registration SET transaction_history = '$newHistory' WHERE ID = $id";


//this will hold the account transaction_history in a session variable
$_SESSION['transaction_history'] = " ";
$_SESSION['transaction_history'] = $newHistory;
}

else
{
echo "<p class='design' style='color:purple; text-align:center;'>Unable to update records</p>";
exit();
}




//announce outcome of operation after all steps have been concluded
if( mysqli_query($conn, $transact_history))
{
printf("<p class='design' style='color:purple; text-align:center;'> Money transferred successfully<br> Proceed to <a style='font-weight:bold;' href='itex_dashboard.php'>dashboard</a></p>");
}

else
{
echo "<p class='design' style='text-align:center;'>Unable to fund wallet at the moment. </p>";
}



mysqli_close($conn);
?>


























