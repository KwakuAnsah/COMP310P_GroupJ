<?php
require_once('../../private/initialize.php');
?>

<?php $page_title = 'MovieTime - Film Genres'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<body>

    <h1> Genre 1</h1>
    <div id="content">
        This will be the specific Genre Page <br><br><br>
       Will be similar format to show.php pages since we are essentially showing a genre. 
        
        Would link to each upcoming Event page with this genre. Again can limit city.
         <li><a href="<?php echo url_for('events/show.php?id=1'); ?>">Event id=1 Page</a></li> 
         <li><a href="<?php echo url_for('events/show.php?id=2'); ?>">Event id=2 Page</a></li> 
    </div>

</body>
<?php include(SHARED_PATH . '/footer.php'); ?>
