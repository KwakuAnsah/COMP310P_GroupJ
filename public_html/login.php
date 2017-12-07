<?php

//Works as a standalone page

$email_error ="Email Valid";
$email="";

if (empty($_POST["email"])){
    $email_error="Email is required";
    }
else{
     $email= test_input($_POST["email"]);
     if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
         $email_error="Invalid email format";
        
     }
     ;
    }
    
    
    
function test_input($data){
   
    $data= trim($data);
    $data= stripslashes($data);
    $data= htmlspecialchars($data);
    return $data;
}



?>
<form method="post" action=""/>
<input type="text" name="email"/>
<span id="error"><?php echo $email_error?> </span>
<br/>
<input type="submit" value="submit"/>
