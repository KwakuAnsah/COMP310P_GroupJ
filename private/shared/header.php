<?php
  if(!isset($page_title)) { $page_title = 'MovieTime'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>MovieTime - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/style.css'); ?>" />
  </head>

  <body>
    <header>
      <h1>HEADER</h1>
    </header>

    <navigation>
      <ul inline>
        <li><a href="<?php echo url_for('/index.php'); ?>">Home</a></li>
        <li><a href="<?php echo url_for('/location_browse.php'); ?>">Locations</a></li>
        <li><a href="<?php echo url_for('/film_genres_browse.php'); ?>">Film Genres</a></li>
        <li><a href="<?php echo url_for('/events/new.php'); ?>">Create Event</a></li>
        <br><br>
      </ul>
        <ul inline>
        <li><a href="<?php echo url_for('/users/new.php'); ?>">Create New User Account(Sign Up)</a></li>
        <li><a href="<?php echo url_for('/users/login.php'); ?>">Login</a></li> 
        <li><a href="">Logout</a></li> 
        <li><a href="<?php echo url_for('/users/show.php'); ?>">View Profile</a></li>
      </ul>
        <br>
       <!--These Links above can be hidden as appropriate with php when we use cookies to see if they have already logged in. -->
        <!--Log out could be performed using cookies? I imagine just something like, delete username cookie. -->
    </navigation>
