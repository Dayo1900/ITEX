<?php session_start();

if(!isset($_SESSION['email']))                  //this will make the page assessible to only logged in users
  
{echo "<p class='design'>Please <a href='itex_login.php'>log in. </a></p>";
   
return false; 
}
?>
<!DOCTYPE html>

<html lang="en">

<head>

<title>Withdraw Money</title>

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
 
    <!--steps to take after user clicks the transfer button-->
<!--Design the dashboard page--> 
  <h1 style="text-align:center; color:#003399; margin-top:2.5%; font-size:2.5rem;"> Withdraw </h1>
  <p class="design" style="margin-top:none;"> Transfer money from itex wallet to bank account.</p>


<form method="post" action="itex_withdrawMoney.php">
<div class="a2" style="padding-top:2%;">
<h6 class="design" style="color:purple;"> Note: This is only a demo, do not submit real bank details here!</h6>

<div class="align">
<label for="withdrawMoney" class="d2">Amount to transfer: </label>
   <input class="card" type="number" name="withdrawMoney" placeholder= "0.00"> 
   <span class="error"> 
      <small><?php if (isset ($_POST["transfer"]) && (!is_numeric($_POST["withdrawMoney"])))   //This will ensure that a number is submitted
                             {echo "<br><p class='design'>Incorrect Details</p>";
                             return false;
                                exit();} ?> 
   </small>
   </span>
</div>

<div class="align">
  <label for="account_number" class="d2">Account number<br>10-digits: </label>
   <input class="card" type="text" name="account_number" placeholder="0000000000"> 
   <span class="error">
   <small><?php if (isset ($_POST["transfer"]) && ((mb_strlen($_POST["account_number"]) !==10)))       //This will ensure that account number is submitted 
                             {echo"<p><br><br>Enter account number.</p>";
                             return false;
                             exit();} ?>     
   </small>
   </span>
</div>

<div class="align"> 
<label for="account_name" class="d2">Account name:</label>
   <input class="card" style="margin-right:none;" type="text" name="account_name"> 
   <span class="error">
   <small><?php if (isset ($_POST["transfer"]) && (empty($_POST["account_name"])))   //This will ensure that account name is submitted
                             {echo "<p><br> Enter account name.</p>";  return false;
exit();} ?> 
   </small>
   </span>
</div>


<div class="align">
   <label for="bank" class="d2">Bank name: </label>
   <input class="card" type="text" name="bank"> 
   <span class="error"> 
      <small><?php if (isset ($_POST["transfer"]) && (empty($_POST["bank"])))   //This will ensure that bank is submitted
                             {echo("<p><br> Enter name of bank.</p>");   return false;
exit();} ?> 
   </small>
   </span>
</div>

<input class="c" style="margin-top:10%;" type="submit" name="transfer" value="Transfer money">

<input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">    <!--This will submit the user ID-->

</form>
</div>
       
       
       <?php if (isset ($_POST["transfer"]))
{
error_reporting(0);


//define variables and set to empty values
$card_number=$card_validity=$card_cvv=$addMoney=$id=""; 

//create a function to sanitise the data input from the client-side
 function check_input($data)
 {
 $data=trim($data);
 $data=stripslashes($data);
 $data=htmlspecialchars($data);
 return $data;
 }
 
 
// sanitise input from client side once submitted
$account_name=check_input($_POST["account_name"]);
$bank=check_input($_POST["bank"]);
$account_number=check_input($_POST["account_number"]);
$id=$_POST["id"];


if(is_numeric($_POST["withdrawMoney"]))
{ 
    $withdrawMoney = $_POST["withdrawMoney"];
    
    include 'server_withdrawMoney.php';          //this will include script which will submit transaction to database.
}

//In a real situation, all the variables above would be forwarded to the specified bank for verification. But I don't have their API so I can't take this step.
}
?>
       
       
       <br><br><br>     
</body>
</html>
