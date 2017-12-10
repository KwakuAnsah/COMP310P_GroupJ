<?php
require_once('../private/initialize.php');
?>

<?php $page_title = 'MovieTime - Home Page'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<body>

    <h1> MovieTime: Coming Soon</h1>
    <div id="content">
        This will be the What's On/Home Page <br><br><br>

        Need to implement a search bar, list of upcoming events with filtering 
        options <br><br>        

        <h4>Home Page Few Highligted Events related links:</h4>
        Then there's a list of upcoming events say 9 events. Each is a link to 
        the specific view event page <br>
        <li><a href="<?php echo url_for('/events/show.php?id=1'); ?>">View Event 1</a></li> 
        - this link would eventually be dynamic but for now it goes to event with id=1
        
        <h4>Search Bar related links:</h4>
        <li><a href="<?php echo url_for('/search_results.php'); ?>">Search Results</a></li>
        <br><br><br>
        
        And just while i havent got the CRUD pages working yet (anything to do with user, event, bookings)
        just note that: <br><br>
        
        the user page would link to:
        <li><a href="<?php echo url_for('/bookings/show.php'); ?>">View a Booking</a></li>
        <li><a href="<?php echo url_for('/bookings/delete.php'); ?>">Delete a Booking</a></li>
        <li><a href="<?php echo url_for('/bookings/edit.php'); ?>">Edit a Booking</a></li>
        <br><br>
       
        the view booking page would link to:
        <li><a href="<?php echo url_for('/events/show.php'); ?>">View a Booking</a></li>
        <br><br>
        
        the event page would link to:
        <li><a href="<?php echo url_for('/bookings/new.php'); ?>">New Booking</a></li>
        <br><br>

        
        
        
    </div>

</body>
<?php include(SHARED_PATH . '/footer.php'); ?>
