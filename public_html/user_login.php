<?php

    
if (isset($_POST['email']) == true && empty($_POST['email']) == false) {
    $email= $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == true ){
       echo"That is a valid email"; 
        }
    else{
         echo"That is not a valid email!!";
        }
       
    }
      
?>
