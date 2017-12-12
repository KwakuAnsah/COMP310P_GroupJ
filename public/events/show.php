<?php
require_once('../../private/initialize.php');


$id = $_GET['event_id'] ?? '1'; // PHP > 7.0
$event = find_event_by_id($id);

$page_title = $event['event_name'];
$page = 'show';
?>



<!-- * * * * * ADD CORRECT HEADER FILE? * * * * *-->
<?php include(SHARED_PATH . '/header.php'); ?>
<div class="container">
    <div id="content">
        <a class="back-link" href="<?php echo url_for('/search_results.php'); ?>">&laquo; Back to List</a>
        <div class="event show">
            <h1><?php echo h($event['event_name']); ?></h1>
            <div class="attributes"> 
                <h2>Event Details</h2>
                <dl>
                    <dt>Event type:</dt>
                    <dd><?php echo h($event['event_category_id']); ?></dd>
                </dl>
                <dl>
                    <dt>Hosted by:</dt>
                    <dd><?php echo h($event['host_user_id']); ?></dd>
                </dl>
                <dl>
                    <dt>Host rating:</dt>
                    <!-- * * * * * * * * * * INSERT host rating * * * * * * * * * * -->
                    <dd><?php echo h($XXX['XXX']); ?></dd>
                </dl>
                <!-- Not sure what this is for?
                <dl>
                    <dt>Visible:</dt>
                    <dd><?php echo $event['visible'] == '1' ? 'true' : 'false'; ?></dd>
                </dl>
                -->
                <dl>
                    <dt>Event Description:</dt>
                    <dd><?php echo h($event['event_description']); ?></dd>
                </dl>
                <dl>
                    <dt>Films showing:</dt>
                    <!-- * * * * * * * * * * INSERT films to be shown * * * * * * * * * * -->
                    <dd><?php echo h($XXX['XXX']); ?></dd>
                </dl>
                <br>
                <h2>Date and Time</h2>
                <dl>
                    <dt>Start:</dt>
                    <dd><?php echo h($event['event_start']); ?></dd>
                </dl>
                <dl>
                    <dt>End:</dt>
                    <dd><?php echo h($event['event_end']); ?></dd>
                </dl>
                <br>
                <h2>Location</h2>
                <dl>
                    <dt>Room:</dt>
                    <dd><?php echo h($event['room_id']); ?></dd>
                </dl>
                <!-- * * * * * Include rest of address? - address id, postcode, city id, country id etc.? * * * * * -->       
                <br>
                <h2>More Information</h2>
                <dl>
                    <dt>Room is wheelchair accessible:</dt>
                    <!-- * * * * * * * * * * Include this here? Or show this on the locations page? * * * * * * * * * * -->                        
                    <dd><?php echo h($XXX['XXX']); ?></dd>
                </dl>
            </div>                  
        </div>
    </div>
</div>
</body>

<?php include(SHARED_PATH . '/footer.php'); ?>
