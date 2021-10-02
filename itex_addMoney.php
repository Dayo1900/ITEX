<?php session_start();

if(!isset($_SESSION['email']))                  //this will make the page assessible to only logged in users
  
{echo "<p class='design'>Please <a href='itex_login.php'>log in. </a></p>";
   
return false; 
}
?>
<!DOCTYPE html>   <!-- this page is where users will be able to add money to their wallet 

<html lang="en">

<head>

<title>ITEX Dashboard</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="'itex', 'wallet'">

<link rel="stylesheet" type="text/css" href="itex_design.css">
<link rel="stylesheet" type="text/css" media="(max-width:990px)" href="itex_design990px.css">
<link rel="stylesheet" type="text/css" media="(max-width:630px)" href="itex_design630px.css">	
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">
</head>

<body style="background-color:#f9f2ec;">
 
    
<?php if (isset ($_POST["fund_wallet"]))
{

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
$card_number=check_input($_POST["card_number"]);
$card_validity=check_input($_POST["card_validity"]);
$card_cvv=check_input($_POST["card_cvv"]);
$addMoney=check_input($_POST["addMoney"]);
$id=$_POST["id"];


include 'server_addMoney.php';          //this will include script which will submit transaction to database.

//In a real situation, $card_number, $card_validity and $card_cvv would be forwarded to visacard, mastercard etc. for verification. But I'm not their merchant so I can't take this step.
}
?>




<!--Design the dashboard page--> 
  <h1 style="text-align:center; color:#003399; margin-top:2.5%; font-size:2.5rem;"> Fund wallet </h1>
  <p class="design" style="margin-top:none;"> Transfer money to your itex wallet with a debit or credit card.</p>


<form method="post" action="itex_addMoney.php">
<div class="a2" style="padding-top:2%;">
<h6 class="design" style="color:red;"> Note: This is only a demo, do not submit real card details here!</h6>

<div class="align">
<label for="addMoney" class="d2">Amount to add: </label>
   <input class="card" type="number" name="addMoney" placeholder= "0.00"> 
</div>

<div class="align">
  <label for="card_number" class="d2">16-digit number on card: </label>
   <input class="card" type="number" name="card_number" placeholder="0000 0000 0000 0000"> 
   <span class="error"> <?php if (isset ($_POST["register"]) && (mb_strlen($_POST["card_validity"]) !=16))
                             {echo "<p> Enter a 16-digit number.</p>";}      //This will ensure only 16 digits are submitted
                             ?> </span>
</div>

<div class="align"> 
<label for="card_validity" class="d2">Card valid<br> thru: </label>
   <input class="card" style="margin-right:none;" type="number" name="card_validity" placeholder="'0000' (month and year)"> 
   <span class="error"> <?php if (isset ($_POST["register"]) && (mb_strlen($_POST["card_validity"]) !=4))   //This will ensure only 4 digits are submitted
                             {echo "<p> Enter card expiry month.</p>";} ?> 
                             </span>
</div>


<div class="align">
   <label for="card_cvv" class="d2">CVV: </label>
   <input class="card" title="Three digits at the back of card." type="number" name="card_cvv" placeholder="3 digits at the back of card"> 
   <span class="error"> <?php if (isset ($_POST["register"]) && (mb_strlen($_POST["card_validity"]) !=3))   //This will ensure only 3 digits are submitted
                             {echo "<p> Enter card cvv.</p>";} 
                             ?> </span>
</div>

<input class="c" style="margin-top:10%;" type="submit" name="fund_wallet" value="Fund wallet">

<input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">    <!--This will submit the user ID-->

</form>
</div>
       <br><br><br>     
</body>
</html>
