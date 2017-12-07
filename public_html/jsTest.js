"use strict";

//var element = document.getElementById("email_submit");

//element.addEventListener("click", validate);
function success(){
      var user_input = document.getElementById("email").value;
      var welcome = document.getElementById("welcome");
      
      var reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        
      
     if (reg.test(user_input) == false ){
         
         alert("invalid email address. Enter valid email");
         document.getElementById("email").focus();
       
       return false;
     }
     
         welcome.innerHTML="Welcome " + user_input;
     
  
  }
 
//Not used because form not needed/data not being submitted
function validate(form_id, email){
    console.log("here");
 
 
 
  var reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
  var address = document.forms[form_id].elements[email].value;
    
    //  var address = document.getElementById("email");
  
    if (reg.test(address) == false)
  {
       alert("Invalid email address. Enter valid email.");
      document.forms[form_id].elements[email].focus();
      
//      document.getElementById("email").focus();

 var test = document.getElementById("hello");
    test.innerHTML = "No entry " + address;
  
      return false;
      
  }
  
  
//  function success(form_id, email) {
//      
//      var address = document.forms[form_id].elements[email].value;
//       var test = document.getElementById("welcome");
//    test.innerHTML = "No entry " + address;
//      
//  }
   

}

