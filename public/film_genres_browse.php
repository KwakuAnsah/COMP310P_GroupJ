<?php
require_once('../private/initialize.php');
?>

<?php $page_title = 'MovieTime - Film Genres'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<body>

    <h1> Genres</h1>
    <div id="content">
        This will be the Film Genre Browsing Page <br><br><br>
        
        Would link to each Film Genre page. THIS PAGE is a good one to show off JS (see the lucid chart wire frame)
         <li><a href="<?php echo url_for('films/genre.php?id=1'); ?>">Genre id=1 Page</a></li> 
         <li><a href="<?php echo url_for('films/genre.php?id=2'); ?>">Genre id=2 Page</a></li> 
    </div>

</body>
<?php include(SHARED_PATH . '/footer.php'); ?>
