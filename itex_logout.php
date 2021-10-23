<?php session_start();

if(isset($_SESSION['email']))
{
session_unset();
session_destroy();
}
else
{
    exit("<p style='text-align:center;'>You are currently not logged in</p>");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<title>Log out</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="'itex', 'wallet'">

<link rel="stylesheet" type="text/css" href="itex_design.css">
<link rel="stylesheet" type="text/css" media="(max-width:1199px)" href="itex_design1199px.css">
<link rel="stylesheet" type="text/css" media="(max-width:860px)" href="itex_design860px.css">
<link rel="stylesheet" type="text/css" media="(max-width:600px)" href="itex_design600px.css">
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">

</head>
<body>
    
<?php 
echo "<p style='text-align:center; color:purple; font-family:arial, sans-serif;'> You are logged out.</p>";
 echo "<meta http-equiv='refresh' content='2;url=itex_homepage.php' />";

?>

 

</body>
</html>



