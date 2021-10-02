<?php 
//This script will login users from the server

// error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//connect to database
$conn = mysqli_connect('localhost', 'id17048003_gahs', 'Temitope.1900', 'id17048003_customer');

//check connection
if (!$conn) 
{ 
  die("Connection failed: " . mysqli_connect_error());
}

//select data from database
$sql = "SELECT ID, email, password, fname, sname, nin, stamp, account_balance, transaction_history FROM registration WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);


    while($row = mysqli_fetch_assoc($result))         //fetch associative array 
{
$_SESSION["id"] = $row["ID"];
$_SESSION["email"] = $row["email"];
$_SESSION["password"] = $row["password"];
$_SESSION["fname"] = $row['fname'];
$_SESSION["sname"] = $row['sname'];
$_SESSION["nin"] = $row['nin'];
$_SESSION["stamp"] = $row['stamp'];
$_SESSION["account_balance"] = $row['account_balance'];
$_SESSION["transaction_history"] = $row['transaction_history'];
}

if(isset($_SESSION['email']))
{
printf("<p class='design' style='color:purple;'> You are now logged in.</p>");
 echo "<meta http-equiv='refresh' content='2;url=itex_dashboard.php' />";
}


elseif(mysqli_num_rows($result)==0)
{
echo "<p class='error'>*Incorrect email or password. </p>";
return false;
}



mysqli_close($conn);
?>
