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

        <?php include(PUBLIC_PATH . '/bootstrap.php'); ?>
        <!-- Stylesheet and script-->
        <?php
        if ($page == 'show.php') {
           echo '<link rel="stylesheet for sidenav" href= "' . url_for('stylesheets/index_sidenav_CSS.css').'"/>';  
        } elseif ($page == 'index.php') {
           echo '<link rel="stylesheet for sidenav" href= "' . url_for('stylesheets/index_sidenav_CSS.css').'"/>';
           echo '<script type = "text/javascript" src = "' .url_for('script/index-login script.js') . '" async></script>'; 
           echo '<link rel="stylesheet for index page" href= "' . url_for('stylesheets/index CSS.css').'"/>';
        } elseif ($page == 'event_genres.php') {
            echo '<link rel="stylesheet for event_genres" href= "' . url_for('stylesheets/event_genres_CSS.css').'"/>';
        } elseif ($page == 'whats_on.php') {
            echo '<link rel="whats on page" href= "' . url_for('stylesheets/whats_on CSS.css').'"/>';
            echo '<script type = "text/javascript" src = "' .url_for('script/whats_on script.js') . '" async></script>'; 
        }elseif ($page == 'host_events.php') {
            echo '<link rel="stylesheet for sidenav & whats on page" href= "' . url_for('stylesheets/whats_on CSS.css').'"/>';
            echo '<script type = "text/javascript" src = "' .url_for('script/whats_on script.js') . '" async></script>'; 
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
            <h1  style="display: inline; font-size:500%;" >MovieTime     </h1>
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
                        <li><a href="<?php echo url_for('/location_browse.php'); ?>">Locations</a></li> 
                        <li><a href="<?php echo url_for('/film_genres_browse.php'); ?>">Film Genres </a></li>
                        <li><a href="<?php echo url_for('/about_us.php'); ?>">About Us</a></li>
                        <li><a href="<?php echo url_for('/contact_us.php'); ?>">Contact Us</a></li>
                    </ul>

                    <!--                        Form to submit  user search -->
                    <form class="navbar-form navbar-left" action="/search_results.php" style="text-align:center; position: relative; display: inline-block; left: 230px">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>                     
                </div>                              
            </nav>
        </div>
