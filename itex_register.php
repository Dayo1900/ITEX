<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

<title>Create Wallet</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="'itex', 'register'">

<link rel="stylesheet" type="text/css" href="itex_design.css">
<link rel="stylesheet" type="text/css" media="(max-width:1199px)" href="itex_design1199px.css">
<link rel="stylesheet" type="text/css" media="(max-width:860px)" href="itex_design860px.css">
<link rel="stylesheet" type="text/css" media="(max-width:600px)" href="itex_design600px.css">
<link rel="stylesheet" type="text/css" media="(max-width:330px)" href="itex_design330px.css">
</head>

<body>

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
       <input class="b2" type="text" name="fname" id="fname" autocomplete="on" required> 
       <span class="error"> <?php if ((isset ($_POST["register"])) && (empty ($_POST["fname"])))
                             {
                                 echo("*First name required");
                                 return false;
                                 exit();
                             } 
                             ?> </span>
	</div>


       <div class="align">
       <label for="sname" class="d">Surname: </label>
       <input class="b2" type="text" name="sname" id="sname" autocomplete="on" required>
              <span class="error"> <?php if ((isset ($_POST["register"])) && (empty ($_POST["sname"]))) 
                             {
                             echo("*Surname required");
                             return false;
                                exit();
                             } ?> </span>       
	</div>


       <div class="align">
       <label for="email" class="d">Email: </label>
       <input class="b2" type="email" name="email" id="email" autocomplete="on" required> 
             <span class="error"> <?php if ((isset ($_POST["register"])) && (empty ($_POST["email"])))
                                     {
                                      echo("*Email required");
                                      return false;
                                        exit();
                                    } ?> 
        </span> 
       </div>



       <div class="align">
       <label for="nin" class="d">Nigerian NIN: </label>
       <input class="b2" type="text" name="nin" id="number" required>  <!--I'm using nin as a text not a number since it doesn't involve calculations-->
             <span class="error"> 
           <?php
           if ((isset ($_POST["register"])) && ((mb_strlen($_POST["nin"]) !=11)))
                             {
                                 echo("<br><p>Enter 11-digit NIN.</p>");
                                 return false;
                                    exit();
                             } ?> 
       </span>
       </div>	
        
  
       <div class="align">
       <label for="password" class="d">Password: </label>
       <input class="b2" type="password" name="password_1" id="password" required> 
             <span class="error"> 
           <?php
           if ((isset ($_POST["register"])) && (empty ($_POST["password_1"]))) 
           {
               echo("*Password required");
               return false;
                exit();
           } 
           ?> 
       </span>
       </div>	

      
	<div class="align">
        <label for="password" class="d">Confirm<br>password: </label>
       <input class="b2" type="password" name="password_2" id="password" required> 
              <span class="error"> 
            <?php 
               if ((isset ($_POST["register"])) && (empty ($_POST["password_2"])))  
               {
                echo("*Password required");
                return false;
                exit();
               }  
               elseif((isset ($_POST["register"])) && (($_POST["password_1"]) !== ($_POST["password_2"])))
                               {
                               echo ("*Password not matching");
                               return false;
                               exit();
                               }?>     <!--execute elseif statement if password doesn't match-->     
       </span>
	</div>


         <input class="c" style="margin-top:10%;" type="submit" name="register" value="Register">

<br>     
    </form> 

</div>



<?php if (isset ($_POST["register"]))                   //proceed with next steps once the register button is clicked
{
 //create a function to sanitise the data input from the client-side
 function check_input($data)
 {
 $data=trim($data);
 $data=stripslashes($data);
 $data=htmlspecialchars($data);
 return $data;
 }
 
 
 
// sanitise input from client side once submitted
$_SESSION['fname'] = check_input($_POST["fname"]);
$_SESSION['sname'] = check_input($_POST["sname"]);
$_SESSION['email_register'] = check_input($_POST["email"]);
$_SESSION['password_1'] = $_POST["password_1"];
$_SESSION['password_2'] = $_POST['password_2'];
$_SESSION['nin'] = $_POST['nin'];


echo "<meta http-equiv='refresh'  content='2;url=email_registration.php'>";
}
?>
      
      
             
</body>
</html>
