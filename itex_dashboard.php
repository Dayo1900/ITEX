<?php session_start();
//This page is a dashboard where users can view their account summary at a glance

//Ensure users are logged in
if(!isset($_SESSION['email']))
  
{echo "<p class='design'>Please <a href='itex_login.php'>log in. </a></p>";
   
return false; 
}
?>
<!DOCTYPE html>

<html lang="en">

<head>

<title>ITEX Dashboard</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="'itex', 'wallet'">

<link rel="stylesheet" type="text/css" href="itex_design.css">
<link rel="stylesheet" type="text/css" media="(max-width:1199px)" href="itex_design1199px.css">
<link rel="stylesheet" type="text/css" media="(max-width:860px)" href="itex_design860px.css">
<link rel="stylesheet" type="text/css" media="(max-width:600px)" href="itex_design600px.css">
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">

</head>
</head>

<body>
 
    
<!--Design the dashboard page--> 
<a class="logout" href="itex_logout.php"> Logout</a>


  <h1 style="text-align:center; color:#003399; margin-top:2.5%; font-size:2.5rem;"> Wallet Dashboard </h1>
<!--welcome section-->
<div class="dashboard">
<span class="firstSpan">           
<p style='font-size:1.2rem;'>Welcome <?php echo $_SESSION['fname']. " " .$_SESSION['sname'];?>.</p><br>
<p> Account balance: <?php
$balance = number_format($_SESSION['account_balance']);
echo "&#8358;" .$balance; ?> </p></span>

<span class="secondSpan">
<?php 
date_default_timezone_set("Africa/Lagos");	//set time zone to Lagos
echo date('d-m-Y') ."<br><br><br><br>";
?>
<!--link to profile page-->
	<!--link to deactivate wallet account-->
<p><a class="c2" href="itex_deactivateUser.php">Deactivate wallet</a></p>
</span>
</div>

<!--link to fund wallet-->
<div class="dashboard" style="height:7vh; margin-top:6%;">
<span class="firstSpan">
<p><a class="c2" href="itex_addMoney.php"> Add money</a></p>
<small style="margin:auto;"> Add money to your itex wallet.</small>
</span>

<!--link to withdraw funds-->
<span class="secondSpan">
<p><a class="c2" href="itex_withdrawMoney.php"> Withdraw money</a><p>
<small style="margin:auto;"> Withdraw money from <br>your itex wallet.</small>
</span>
</div>

<!--display transaction history-->
<div class="dashboard" style="height:auto; margin-top:6%; margin-bottom:8%; padding-top:1%;">
<h2 style="text-align:center; color:#003399; margin-top:0.5%; text-decoration:underline;"> Transaction History </h2>
<p style="font-size:0.7rem; font-family:'Trebuchet Ms', sans-serif;

 letter-spacing:0.05rem;">
<?php
//present a summary of transactions and give timestamp
echo $_SESSION['transaction_history'];               

if(empty($_SESSION['transaction_history']))
{
    echo "<p style='text-align:center;'>There are no transactions yet</p>";
}
?>
</p> 
</div>

             
</body>
</html>
