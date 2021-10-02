<!DOCTYPE html>

<html lang="en">

<head>

<title>Create Wallet</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="'itex', 'register'">

<link rel="stylesheet" type="text/css" href="itex_design.css">
<link rel="stylesheet" type="text/css" media="(max-width:990px)" href="itex_design990px.css">
<link rel="stylesheet" type="text/css" media="(max-width:630px)" href="itex_design630px.css">	
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">
</head>

<body>
 
    
<?php if (isset ($_POST["register"]))                   //proceed with next steps once the register button is clicked
{

//define variables and set to empty values
$fname=$sname=$email=$password_1=$password_2=$nin=""; 

 //create a function to sanitise the data input from the client-side
 function check_input($data)
 {
 $data=trim($data);
 $data=stripslashes($data);
 $data=htmlspecialchars($data);
 return $data;
 }
 
// sanitise input from client side once submitted
 
$fname=check_input($_POST["fname"]);
$sname=check_input($_POST["sname"]);
$email=check_input($_POST["email"]);
$nin=check_input($_POST["nin"]);
$password_1=($_POST["password_1"]);
$password_2=($_POST['password_2']);


include 'server_itexRegister.php';              //this script will register users
}
?>


<!--Design the create account page--> 
  
    	         <p class="location">
             Already registered?  <br>  <a href="itex_login.php"> Log in</a>
             </p><br><br>
             
<h1 style="text-align:center; color:#003399; margin-top:4%; font-size:2.5rem;"> Register </h1>
<p class="design" style="margin:0;">Fill in a few details to set up your online itex wallet.</p>

  <div style="height:auto; margin-bottom:8%; padding-bottom:2%;" class="a"> 
  <form method="post" action="itex_register.php">

<!-- use php empty() funtion to ensure that mandatory fields are not blank.--> 
	<div class="align">
       <label for="fname" class="d">First name: </label>
       <input class="b2" type="text" name="fname" id="fname" autocomplete="on"> 
       <span class="error"> <?php if ((isset ($_POST["register"])) && (empty ($_POST["fname"])))
                             {echo "*First name required";} 
                             ?> </span>
	</div>


       <div class="align">
       <label for="sname" class="d">Surname: </label>
       <input class="b2" type="text" name="sname" id="sname" autocomplete="on">
              <span class="error"> <?php if ((isset ($_POST["register"])) && (empty ($_POST["sname"]))) 
                             {echo "*Surname required";} ?> </span>       
	</div>


       <div class="align">
       <label for="email" class="d">Email: </label>
       <input class="b2" type="email" name="email" id="email" autocomplete="on" required> 
             <span class="error"> <?php if ((isset ($_POST["register"])) && (empty ($_POST["email"])))
                                     {echo "*Email required";} ?> </span> 
       </div>



       <div class="align">
       <label for="nin" class="d">Nigerian NIN: </label>
       <input class="b2" type="text" name="nin" id="number" required> 
             <span class="error"> 
           <?php
           if ((isset ($_POST["register"])) && (empty ($_POST["nin"]))) {echo "*NIN required";} 
           elseif ((isset ($_POST["register"])) && ((mb_strlen($_POST["nin"]) !=11)))
                             {echo "<br><p>Enter 11-digit NIN.</p>";}
           ?> 
       </span>
       </div>	
        
  
       <div class="align">
       <label for="password" class="d">Password: </label>
       <input class="b2" type="password" name="password_1" id="password" autocomplete="on" required> 
             <span class="error"> 
           <?php
           if ((isset ($_POST["register"])) && (empty ($_POST["password_1"]))) {echo "*Password required";} 
           ?> 
       </span>
       </div>	

      
	<div class="align">
        <label for="password" class="d">Confirm<br>password: </label>
       <input class="b2" type="password" name="password_2" id="password" autocomplete="on" required> 
              <span class="error"> 
            <?php 
               if ((isset ($_POST["register"])) && (empty ($_POST["password_2"])))  {echo "*Password required";}  
               elseif((isset ($_POST["register"])) && (($_POST["password_1"]) !== ($_POST["password_2"])))
                               {echo "*Password not matching";}?>     <!--execute elseif statement if password doesn't match-->     
       </span>
	</div>


         <input class="c" style="margin-top:10%;" type="submit" name="register" value="Register">

<br>     
    </form> 

</div>

             
</body>
</html>
