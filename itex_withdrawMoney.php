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
<link rel="stylesheet" type="text/css" media="(max-width:990px)" href="itex_design990px.css">
<link rel="stylesheet" type="text/css" media="(max-width:630px)" href="itex_design630px.css">	
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">
</head>

<body style="background-color:#f9f2ec;">
 
    <!--steps to take after user clicks the transfer button-->
<?php if (isset ($_POST["transfer"]))
{

//define variables and set to empty values
$account_number=$account_name=$bank=$withdrawMoney=$id=""; 

//create a function to sanitise the data input from the client-side
 function check_input($data)
 {
 $data=trim($data);
 $data=stripslashes($data);
 $data=htmlspecialchars($data);
 return $data;
 }
 
 
// sanitise input from client side once submitted
$account_number=check_input($_POST["account_number"]);
$account_name=check_input($_POST["account_name"]);
$bank=check_input($_POST["bank"]);
$withdrawMoney=check_input($_POST["withdrawMoney"]);
$id=$_POST["id"];


include 'server_withdrawMoney.php';          //this will include script which will submit transaction to database.

//In a real situation, $account_number, $account_name, $bank and $withdrawMoney would be forwarded to the appropriate Bank API for processing.
}
?>


<!--Design the dashboard page--> 
  <h1 style="text-align:center; color:#003399; margin-top:2.5%; font-size:2.5rem;"> Withdraw </h1>
  <p class="design" style="margin-top:none;"> Transfer money from itex wallet to bank account.</p>


<form method="post" action="itex_withdrawMoney.php">
<div class="a2" style="padding-top:2%;">
<h6 class="design" style="color:red;"> Note: This is only a demo, do not submit real bank details here!</h6>

<div class="align">
<label for="withdrawMoney" class="d2">Amount to transfer: </label>
   <input class="card" type="number" name="withdrawMoney" placeholder= "0.00"> 
</div>

<div class="align">
  <label for="account_number" class="d2">Account number: </label>
   <input class="card" type="number" name="account_number" placeholder="0000000000"> 
   <span class="error"> <?php if (isset ($_POST["transfer"]) && (empty($_POST["account_number"])))
                             {echo "<p> Enter account number.</p>";}      //This will ensure that account number is submitted
                             ?> </span>
</div>

<div class="align"> 
<label for="account_name" class="d2">Account name:</label>
   <input class="card" style="margin-right:none;" type="text" name="account_name"> 
   <span class="error"> <?php if (isset ($_POST["transfer"]) && (empty($_POST["account_name"])))   //This will ensure that account name is submitted
                             {echo "<p> Enter account name.</p>";} ?> 
                             </span>
</div>


<div class="align">
   <label for="bank" class="d2">Bank name: </label>
   <input class="card" type="text" name="bank"> 
   <span class="error"> <?php if (isset ($_POST["transfer"]) && (empty($_POST["bank"])))   //This will ensure that bank is submitted
                             {echo "<p> Enter name of bank.</p>";} 
                             ?> </span>
</div>

<input class="c" style="margin-top:10%;" type="submit" name="transfer" value="Transfer money">

<input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">    <!--This will submit the user ID-->

</form>
</div>
       <br><br><br>     
</body>
</html>
