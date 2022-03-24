<?php

if(empty($add_money))
{
    echo "<p style='text-align:center; color:purple; font-family:Arial; font-weight:bold;'>No money transferred.</p>";
    return false;
    exit();
}
elseif ($c_num !==16)
{ 
    echo("<p style='text-align:center; color:purple; font-family:Arial; font-weight:bold;'>Please check and correct the error below.</p>");
    return false;
exit();
}

elseif ($c_validity !==4)
{ 
    echo("<p style='text-align:center; color:purple; font-family:Arial; font-weight:bold;'>Please check and correct the error below.</p>");
    return false;
exit();
}

elseif($c_cvv !==3)
{ 
    echo("<p style='text-align:center; color:purple; font-family:Arial; font-weight:bold;'>Please check and correct the error below.</p>");
    return false;
exit();
}

elseif($c_pin !==4)
{ 
    echo("<p style='text-align:center; color:purple; font-family:Arial; font-weight:bold;'>Please check and complete the error below.</p>");
    return false;
exit();
}

else{}

// initiate connection with database
$servername="localhost";

$username="***";

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
//I am using session variable for addMoney because there won't be foul play and it saves server workload but I won't use session variables for withdraw money for security reasons.


 
//find the amount of money in addMoney column in database
$account_1 = "SELECT addMoney FROM registration WHERE ID = $id";
$account_one = mysqli_query($conn, $account_1);

//fetch associative array
while ($account1result = mysqli_fetch_assoc($account_one))     
{   
//this is the total sum of money that ever entered the account
$accountOne = $account1result['addMoney'];    
}

//add the incoming cash to column addmoney in database
$newMoney= $add_money + $accountOne;


//update addMoney record in database
$submit_1 = "UPDATE registration SET addMoney = $newMoney WHERE ID = $id";  
//$addMoney and $id are integers so they are not inside quotations.




//if updated successfully proceed with these steps
if(mysqli_query($conn, $submit_1))  
{
//find the account_balance
$account_2 = "SELECT account_balance FROM registration WHERE ID = $id";
$account_two=mysqli_query($conn, $account_2);

//fetch associative array
while ($account2result = mysqli_fetch_assoc($account_two))     
{   
//this is the present account_balance
$accountTwo = $account2result['account_balance'];    
}

if(empty($accountTwo))
{
    $accountTwo = 0;
}

//this is the new account balance: incoming money + existing money
$account = $add_money + $accountTwo;       
}
else
{
echo("<p class='design' style='text-align:center;'>Unable to submit to database at the moment: </p>");    
return false;
exit();
}



//update new balance into account_balance
if (mysqli_query($conn, $account_2))
{   
//this will add a new record to account_balance
 $submit_2 = "UPDATE registration SET account_balance = $account WHERE ID = $id";    

//update the account_balance session variable to reflect in other pages where needed
$_SESSION['account_balance'] = "";
$_SESSION['account_balance'] = $account;   
}
else
{
echo("<p class='design' style='text-align:center;'>Unable to update account balance at the moment: </p>");    
return false;
exit();
}




//add a new record to transaction history
if (mysqli_query($conn, $submit_2))
{
    //from session variable
    $_SESSION["transaction_history"];
    
    if (empty($_SESSION['transaction_history']))
    {
        $_SESSION['transaction_history'] = " - ";
    }
 
 
 $new_money = number_format($add_money);
 
//this will give the money added and date right now
$transaction_history= "<small><p>" .date('d-m-Y'). "<br>&#8358;" .$new_money. " was credited </p></small>";       

 //join new history to old history
 $newHistory = $_SESSION["transaction_history"] . $transaction_history;
 
 //update records
$transact_history="UPDATE registration SET transaction_history = '$newHistory' WHERE ID = $id";

//this will hold the history of the account in session variable
    $_SESSION['transaction_history'] = $newHistory;
}
else{
    echo "Unable to update records";
    exit();
}




//announce outcome of operation after all steps have been concluded
if( mysqli_query($conn, $transact_history))
{
printf("<p class='design' style='color:purple; text-align:center;'> Wallet has been funded.<br> Proceed to <a style='font-weight:bold;' href='itex_dashboard.php'>dashboard</a></p>");
}
else
{
echo "<p class='design' style='text-align:center;'>Unable to fund wallet at the moment: </p>";
}


mysqli_close($conn);
?>

