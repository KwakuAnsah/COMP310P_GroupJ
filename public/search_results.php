<?php
require_once('../private/initialize.php');
?>

<?php $page_title = 'MovieTime - Search Results'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<body>

    <h1> Search Results</h1>
    <div id="content">
        This will be the Search Results Page <br><br><br>
        
        Would link to a bunch of stuff based on an SQL query... tbh we may have 
        to limit this to only searching events cos otherwise the SQL is long ting
         <li><a href="<?php echo url_for('events/show.php?id=1'); ?>">Event id=1 Page</a></li> 
         <li><a href="<?php echo url_for('events/show.php?id=2'); ?>">Event id=2 Page</a></li> 
         
         
         then also have functionality to filter results
    </div>

</body>
<?php include(SHARED_PATH . '/footer.php'); ?>
