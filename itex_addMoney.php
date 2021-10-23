<?php session_start();

if(!isset($_SESSION['email']))                  //this will make the page assessible to only logged in users
  
{
echo "<p style='font-family:garamond, serif; text-align:center; font-size:1.2rem;'>Please <a href='itex_login.php'>log in. </a></p>";
return false;
}
?>

<!DOCTYPE html>


<html lang="en">

<head>

<title>Fund Wallet</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="'itex', 'wallet'">

<link rel="stylesheet" type="text/css" href="itex_design.css">
<link rel="stylesheet" type="text/css" media="(max-width:1199px)" href="itex_design1199px.css">
<link rel="stylesheet" type="text/css" media="(max-width:860px)" href="itex_design860px.css">
<link rel="stylesheet" type="text/css" media="(max-width:600px)" href="itex_design600px.css">
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">

</head>





<body style="background-color:#f9f2ec;">
 

<?php
error_reporting(0);

if (isset ($_POST["fund_wallet"]))
{
$id = ($_POST["id"]);

//assign input to temporary variables
$one = $_POST["addMoney"];
$two = $_POST["card_number"];
$three = $_POST["card_validity"];
$four = $_POST["card_cvv"];
$five = $_POST["pin"];


//create function to check input
function check($data)
{
$data = strval($data);		//convert input to string
$data = trim($data);		//remove excess whitespace from string
$data = strlen($data);		//find the string length
return $data;
}



//process input
if (is_numeric($one))   
{
$add_money = $_POST["addMoney"];	     //store user input
$error_money = "";
} else
{
$error_money = "<small style='text-align:left;'>Enter only numbers with no spaces.</small>";
}


if (is_numeric($two))  
{
//check the length of integer submitted
$c_num = check($_POST['card_number']);
}
elseif($c_num == 16)         //check the length of string
{	                        
$card_number = $_POST['card_number'];		    //store user input
}


if (is_numeric($three))   
{
//check the length of integer submitted
$c_validity = check($_POST['card_validity']);
}
elseif($c_validity == 4)         //check the length of string
{	                        
$card_validity = $_POST['card_validity'];		    //store user input
}


if (is_numeric($four))   
{
//check the length of integer submitted
$c_cvv = check($_POST['card_cvv']);
}
elseif($c_cvv == 3)              //check the length of string
{	                        
$card_cvv = $_POST['card_cvv'];		    //store user input
}


if (is_numeric($five))   
{
//check the length of integer submitted
$c_pin = check($_POST['pin']);
}
elseif($c_pin == 4)              //check the length of string
{	                        
$pin = md5($_POST['pin']);		    //encrypt and store PIN
}

if($c_num==16 && $c_validity==4 && $c_cvv==3 && $c_pin==4)
{include 'server_addMoney.php'; }   //this will include script which will submit transaction to database.

}





//In a real situation, $card_number, $card_validity and $card_cvv would be forwarded to visacard, mastercard etc. for verification. 
//But I'm not their merchant so I can't take this step.
?>





<!--Design the dashboard page--> 
  
<h1 style="text-align:center; color:#003399; margin-top:2.5%; font-size:2.5rem;"> Fund wallet </h1>
  
<p class="design" style="margin-top:none;"> Transfer money to your itex wallet with a debit or credit card.</p>



<form action="itex_addMoney.php" method="post">

<div class="a2" style="padding-top:2%;">

<h6 class="design" style="color:purple;"> Note: This is only a demo, do not submit real card details here!</h6>



<div class="align">

<label for="addMoney" class="d2">Amount to add: </label>
   
<input class="card" type="number" name="addMoney" placeholder= "000000"> 

<span class="error"> 
<?php if (isset ($_POST["fund_wallet"]) && empty($_POST['addMoney']))
 {
 echo "<br> $error_money";
 return false;
exit();
 }?>
</span>
</div>



<div class="align">
  
<label for="card_number" class="d2">16-digit number <br> on card: </label>
   
<input class="card" type="number" name="card_number" placeholder="0000000000000000"> 
   
<span class="error"> 
<?php if (isset ($_POST["fund_wallet"]) && ($c_num !== 16))
 {
 echo("<br><br><small style='text-align:left;'>Enter a 16-digit number with no spaces.</small>");
 return false;
exit();
 }?>
</span>
</div>



<div class="align"> 

<label for="card_validity" class="d2">Card valid<br> thru: </label>
   
<input class="card" style="margin-right:none;" type="number" name="card_validity" placeholder="0000 (month and year)"> 
   
<span class="error"> 
<?php if ((isset ($_POST["fund_wallet"])) && ($c_validity !==4))
 {
     echo("<br> <br> <small style='text-align:left;'>Enter the 4-digit card expiry date with no spaces.</small>");
     return false;
exit();
 }?>
</span>
</div>


<div class="align">
   
<label for="card_cvv" class="d2">CVV: </label>
   
<input class="card" type="number" name="card_cvv" placeholder="3 digits at the back of card"> 
   
<span class="error"> 
<?php if ((isset ($_POST["fund_wallet"])) && ($c_cvv !==3))
 {
echo("<br> <small style='text-align:left;'>Check the back of your card to enter the 3-digit number, with no spaces.</small>");
return false;
exit();
 }?> 
</span>
</div>


<div class="align">
   
<label for="pin" class="d2">4-digit PIN: </label>
   
<input class="card" type="password" name="pin" placeholder="Enter PIN"> 
   
<span class="error"> 
<?php if ((isset ($_POST["fund_wallet"])) && ($c_pin !==4))
 {
 echo ("<br> <small style='text-align:left;'>Enter your PIN with no spaces.</small>");
 return false;
exit();
 }?> 
</span>
</div>


<input class="c" type="submit" name="fund_wallet" value="Fund wallet">

<input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">    <!--This will submit the user ID-->


</form>

</div>
      


 <br><br><br>     


</body>

</html>
















































