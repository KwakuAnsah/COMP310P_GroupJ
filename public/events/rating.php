<!DOCTYPE html>
<html lang="eng">

    <head>
        <?php
        require_once('../../private/initialize.php');
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
        $id = $_GET['event_id'] ?? '1'; // PHP > 7.0
        $event = find_event_by_id($id);
// this enables us to display the event info
// further down the webevent
        
        if (is_post_request()) {
            $rating = [];
            $rating['rating_id'] = $_POST['rating_id'] ?? '';
            $rating['event_rating'] = $_POST['event_rating'] ?? '';
            $rating['host_rating'] = $_POST['host_rating'] ?? '';
            $rating['review_text'] = $_POST['review_text'] ?? '';
            $rating['event_id'] = $_POST['event_id'] ?? '';
            $rating['user_id(rater)'] = $_POST['user_id(rater)'] ?? '';
        
            $result = insert_rating($rating);
            if ($result === true) {
                $new_id = mysqli_insert_id($db);
                //UPDATE URL
                redirect_to(url_for('/events/show.php?id=' . $new_id));
            } else {
                $errors = $result;
            }
        } else {
            $rating = [];
            $rating['rating_id'] = '';
            $rating['event_rating'] = '';
            $rating['host_rating'] = '';
            $rating['review_text'] = '';
            $rating['event_id'] = '';
            $rating['user_id(rater)'] = '';
        ?>
        <?php $page_title = 'Show Events Page'; ?>
      
        <!-- CSS stylesheet for Events pages-->
        <!-- <link href="../../public/stylesheets/events_style.css" rel="Style for events pages"> -->
    </head>
    
    
    
    <body>
    <!-- * * * * * ADD CORRECT HEADER FILE? * * * * *-->
        <?php include(SHARED_PATH . '/header.php'); ?>
        <div class="container">
            <div id="content">
                <a class="back-link" href="<?php echo url_for('/events/host_pages/index.php'); ?>">&laquo; Back to List</a>
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
    <!-- * * * * * * * * * * FOR WRITING A REVIEW * * * * * * * * * * -->
                        <h1>Write a review:</h1>                     
                       <form action="../../public/users/show.php">
                                Overall event rating: <input type="text" name="event_rating"><br><br>
                                Host rating: <input type="text" name="host_rating"><br><br>
                                <!-- move style to external sheet -->
                                Comments: <input type="text" name="host_rating" style="height:100px;width:400px;"><br><br>
                                <input type="submit" value="Submit">
                        </form>                       
                    </div>                  
                </div>
            </div>
        </div>
    </body>
    
    <?php include(SHARED_PATH . '/footer.php'); ?>
