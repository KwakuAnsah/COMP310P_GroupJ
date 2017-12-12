<?php
require_once('../private/initialize.php');
?>
<?php
if (!isset($page_title)) {
    $page_title = 'MovieTime';
}
?>
<!doctype html>

<html lang="en">
    <head>
        <title><?php echo h($page_title); ?></title>
        <?php require_once('../private/bootstrap.php');?>

        <!-- Stylesheet -->
        <?php
        if ($stylesheet == 'event') {
            echo '<link rel="stylesheet" media="all" href="' .
            url_for('/stylesheets/events_style.css') . '/>';
        } elseif ($stylesheet == 'index') {
            echo '<link rel="stylesheet" media="all" href="' .
            url_for('/stylesheets/index_CSS.css') . '/>' . '< /br>' .
            '<link rel="stylesheet" media="all" href="' .
            url_for('/stylesheets/index_sidenav_CSS.css') . '/>';
        } else{
            echo '<link rel="stylesheet" media="all" href="' .
            url_for('/stylesheets/style.css') . '/>';
        }
        ?>

        <!-- Script -->
        <?php
        if ($script == 'event') {
            // JS for Login/register form -- async used so script is executed as soon as it's downloaded, without blocking the browser in the meantime.-->
            echo '<script type = "text/javascript" src = "' .
            url_for('index-login script.js') . '" async></script>';
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

<div id="content">
    
    -----------------------------------------------------------------------------------------------------------------

    <select name="country_id">
        <?php
        $country_set = find_all_countries();
        while ($country = mysqli_fetch_assoc($country_set)) {
            echo "<option value=" . $country["country_id"] . ">" 
                    . h($country["country_name"]) . "</option>";
        }
        mysqli_free_result($country_set);
        ?>
    </select>
---------------------------------------------------------------------------------------------------------


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>