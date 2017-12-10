<?php
require_once('../private/initialize.php');
?>

<?php $page_title = 'MovieTime - Venues'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<body>

    <h1> MovieTime Venues</h1>
    <div id="content">
        This will be the MovieTime Locations Page <br><br><br>
        
        Page can assume your location from the log in info and then display
        events upcoming in your city./ option to choose city from drop down.
       
         <li><a href="<?php echo url_for('events/show.php?id=1'); ?>">Event id=1 Page</a></li> 
         <li><a href="<?php echo url_for('events/show.php?id=2'); ?>">Event id=2 Page</a></li> 
         
         
         then also have functionality to filter results
    </div>

</body>
<?php include(SHARED_PATH . '/footer.php'); ?>
