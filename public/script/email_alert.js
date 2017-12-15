/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Time now



var now = new Date();   
//converts to milliseconds since 1/1/1970;
now.getTime();

var alert_time = now.getTime() - "86400000";

var event_time = $

/*
var event_start = '2017-12-02 16:00:00'; // IN THE PAST

var timestamp_event_start = strtotime(event_start);
 

   /* if (timestamp_event_start < now) {
        errors[] = "The event start time cannot be in the past.";
    } */
/*
alert (Reminder! You have an event: ... , in 24 hours!)


function submit(){
      var user_email = document.getElementById("email").value;
      var retDate = document.getElementById("returnDate").value;
      var input_date = new Date(retDate).setHours(0,0,0,0);
      var todaysDateObj = new Date().setHours(0,0,0,0);
      todaysDate = Date.now(); // Gets today's date
      //var reg = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)$/;
      var mailformat = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
    if(document.getElementById("email").value === ""){
        document.getElementById("submitMessage").innerHTML = 
                "Please provide an email address";
        document.getElementById("email").focus();
    } else if(mailformat.test(document.getElementById("email").value)=== false){  
        document.getElementById("submitMessage").innerHTML =
                "Please enter a valid email address";
        //alert("You have entered an invalid email address!");
        document.getElementById("email").focus();
    } else if (document.getElementById("film").value === ""){
        document.getElementById("submitMessage").innerHTML = 
                "Please enter the film title of your return.";
        document.getElementById("film").focus();
    } else if (retDate === ""){
        document.getElementById("submitMessage").innerHTML = 
                "Please enter the date of your return.";
        document.getElementById("returnDate").focus();
    } else if(input_date !== todaysDateObj)
    // call setHours to take the time out of the comparison .setHours(0,0,0,0)
    {
        document.getElementById("submitMessage").innerHTML = 
                "You must enter today's date.";
    } else {
        document.getElementById("submitMessage").innerHTML = 
                "You have successfully logged your return.";    
    }
    
    */