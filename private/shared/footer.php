<?php // Adapted from: (Lynda.com - Kevin Skoglund, 2017) ?>

<br>
<br>
<footer>
    &copy; <?php echo date('Y'); ?> MovieTime   
</footer>

<!--<input type="invisible" value="" />-->

<?php
$email_alert = find_all_events()
?>

<!--<script type = "text/javascript" src = "' .<?php url_for('script/email_alert.js') ?> . '" async></script> -->
<script>
    var now = new Date();
//converts to milliseconds since 1/1/1970
    var millis_now = now.getTime();

//Getting event name and start time from our database
    var event_name = document.getElementById("");
    var event_time = document.getElementById("");

//Converting event start time to milliseconds since 1/1/1970
    var millis_event = event_time.getTime();
    var alert_time = millis_event - "86400000";

//When alert should show
    if (millis_now > alert_time) {
        alert("Reminder! You have an event: " + event_name + ", in 24 hours!");
    }
    else {
        
    }
</script>

</body>
</html>

<?php
db_disconnect($db);
?>
