<?php
require_once('../private/initialize.php');
$page_title = 'About Us';
$page = "about_us.php";

include(SHARED_PATH . '/header.php');
?>

<!-- Additional style for overwriting default Bootstrap styling -->
<style>
    .well-lg {
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
    }
</style>

<div class="container text-center">
    <h1 class="heading-centre">About Us</h1>
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="well-lg">
            <h3 class="welcome">Welcome to MovieTime, the world's largest film event platform!</h3><br>
            <p class="about_us">
                Our users are able to create, organise and host their own unique film 
                screenings in just a few easy steps. We allow anyone to browse our system of 
                events and attend film screenings from all over the world. 
                With nine different genres to pick and choose from, we're sure there
                will be a film event for everyone!
            </p>
        </div>
    </div>  
    <div class="col-md-1"></div>
</div>
<br>
<br>
<div class="container text-center">
    <div class="row">
        <h2>Why not...</h2>
        <br>             
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="well">
                <p class="about_us">Find out <a href="<?php echo url_for('/whats_on.php'); ?>">what's on</a> near you?</p>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div>
        <p class="about_us">Or <a href="<?php echo url_for('/index.php'); ?>">sign up</a>, and join the MovieTime community today!</p>
    </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
