<?php 


//connect to database
$conn = mysqli_connect('****', '*****', '*****', '*****');

//check connection
if (!$conn) 
{ 
  die("Connection failed: " . mysqli_connect_error());
}



//select data from database
//$result = mysqli_query($link, "SELECT * FROM City", MYSQLI_USE_RESULT);
$sql =  "SELECT ID, email, password, fname, sname, nin, withdrawMoney, addMoney, account_balance, transaction_history FROM registration WHERE email = '$email' AND password = '$password'";  
$result = mysqli_query($conn, $sql);


    while($row = mysqli_fetch_assoc($result))         //fetch associative array 
{
$_SESSION["id"] = $row["ID"];
$_SESSION["email"] = $row["email"];
$_SESSION["password"] = $row["password"];
$_SESSION["fname"] = $row['fname'];
$_SESSION["sname"] = $row['sname'];
$_SESSION["nin"] = $row['nin'];
$_SESSION["addMoney"] = $row["addMoney"];
$_SESSION["withdrawMoney"] = $row["withdrawMoney"];
$_SESSION["account_balance"] = $row['account_balance'];
$_SESSION["transaction_history"] = $row['transaction_history'];
}

if(isset($_SESSION["email"]))
{
printf("<p class='design' style='color:purple;'> You are now logged in.</p>");
 echo "<meta http-equiv='refresh' content='2;url=itex_dashboard.php' >";
}


else
{
echo "<p class='error'>*Incorrect email or password. </p>" .mysqli_error($conn);
return false;
exit();
}



mysqli_close($conn);
?>
