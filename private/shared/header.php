<?php // Adapted from: (Lynda.com - Kevin Skoglund, 2017) ?>

<?php

if (!isset($page_title)) {
    $page_title = 'MovieTime';
}
?>
<!doctype html>

<html lang="en">
    <head>
        <title><?php echo h($page_title); ?></title>
        <meta charset="utf-8">

        <?php include(PRIVATE_PATH . '/bootstrap.php'); ?>
        <!-- Stylesheet and script-->
        <?php
        if ($page == 'show.php') {
           echo '<link rel="stylesheet for sidenav" href= "' . url_for('stylesheets/index_sidenav_CSS.css').'"/>';  
        } 
        
        elseif ($page == 'index.php') {
           echo '<link rel="stylesheet for sidenav" href= "' . url_for('stylesheets/index_sidenav_CSS.css').'"/>';
           echo '<script type = "text/javascript" src = "' .url_for('script/index-login script.js') . '" async></script>'; 
           echo '<link rel="stylesheet for index page" href= "' . url_for('stylesheets/index CSS.css').'"/>';
        } 
        
        elseif ($page == 'event_genres.php') {
            echo '<link rel="stylesheet for event_genres" href= "' . url_for('stylesheets/event_genres_CSS.css').'"/>';
        } 
        
        elseif ($page == 'whats_on.php') {
            echo '<link rel="whats on page" href= "' . url_for('stylesheets/whats_on CSS.css').'"/>';
            echo '<script type = "text/javascript" src = "' .url_for('script/whats_on script.js') . '" async></script>'; 
        }
        
        elseif ($page == 'host_events.php') {
            echo '<link rel="stylesheet for sidenav & whats on page" href= "' . url_for('stylesheets/whats_on CSS.css').'"/>';
            echo '<script type = "text/javascript" src = "' .url_for('script/whats_on script.js') . '" async></script>'; 
        }
    //  FOR BOOKING CONFIRMATION PAGE :  
        elseif ($page == 'Booking Confirmation page') {
            echo "<link href='". url_for('stylesheets/bookings_style.css')."' rel='Bookings stylesheet'>";
        }

    //  FOR ABOUT US PAGE :    
        elseif ($page == 'about_us.php') {
            echo '<link rel="stylesheet for about us" href= "' . url_for('/stylesheets/about_contact_us_style.css').'"/>';
        }
    //  FOR CONTACT US PAGE :    
        elseif ($page == 'contact_us.php') {
            echo '<link rel="stylesheet for contact us" href= "' . url_for('/stylesheets/about_contact_us_style.css').'"/>';
        }
    //  FOR LINKING TO CREATE AN ACCOUNT (NEW USER) PAGE :    
        elseif ($page == 'user_new.php') {
            echo '<link rel="stylesheet for user pages" href= "' . url_for('/stylesheets/users_style.css').'"/>';
        }
    //  FOR LINKING TO DELETE USER PAGE :    
        elseif ($page == 'user_delete.php') {
            echo '<link rel="stylesheet for user pages" href= "' . url_for('/stylesheets/users_style.css').'"/>';
        }
    //  FOR LINKING TO EDIT USER PAGE :   
        elseif ($page == 'user_edit.php') {
            echo '<link rel="stylesheet for user pages" href= "' . url_for('/stylesheets/users_style.css').'"/>';
        }
        ?>       
    </head>
    
    <body>
        <div class="container text-center "> 
            <h1  style="display: inline; font-size:500%;" ><a href="<?php echo url_for('/whats_on.php'); ?>"> MovieTime </a></h1>
        </div>

        <!--        Creates & centers the navigation bar  & makes sure black strip fills the screen width-->
        <div class="container-fluid">
            <nav class="navbar   navbar-inverse  ">         
                <!--                    <div class="navbar-header">
                                        <a class="navbar-brand" href="#">WebSiteName</a>
                                        </div>-->

                <div class="container" style="text-align:">  
                    <ul class="nav navbar-nav" style="text-align:center; position: relative; display: inline-block; left: 200px">
                        <li class="active"><a href="<?php echo url_for('/index.php'); ?>">Home</a></li>
                        <li><a href="<?php echo url_for('/whats_on.php'); ?>">What's on</a></li>
                        <li><a href="<?php echo url_for('/events/new.php'); ?>">Create Event</a></li>                  
                        <li><a href="<?php echo url_for('/about_us.php'); ?>">About Us</a></li>
                        <li><a href="<?php echo url_for('/contact_us.php'); ?>">Contact Us</a></li>
                    </ul>
                    <div class="container" style="text-align:">
                    <ul class="nav navbar-nav" style="text-align:center; position: relative; display: inline-block; left: 290px"> <?php if(isset($_SESSION['user_id'])){                   
                                         echo "<li><a href='". url_for('users/show.php?user_id=').$_SESSION['user_id'] ."'> ".$_SESSION['first_name']."'s Profile</a></li>";
                                         echo "<li><a href='". url_for('users/logout.php') ."'>Log Out</a></li>";}
                                
                                         ?>
                    </ul>
                    </div>   
                </div>   
                
            </nav>
        </div>
