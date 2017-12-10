<!DOCTYPE html>
<html lang="eng">

    <head>
        <?php require_once('../private/initialize.php'); ?>
        <?php $page_title = 'MovieTime - About Us'; ?>

        <!-- old header file -->
        <!-- <?php include(SHARED_PATH . '/header.php'); ?> -->

        <?php include "bootstrap.php"; ?>

        <!-- CSS stylesheet for About us page-->    
        <link href="stylesheets/about_contact_us_style.css" rel="About us stylesheet">

        <style>
            .well-lg {
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
            }
        </style>
    </head>

    <body>


        <?php $page_title = 'MovieTime - About Us'; ?>
        <?php include(SHARED_PATH . '/header.php'); ?>
        <?php include "header.php"; ?> 

        <div class="container">
            <h1 class="heading-centre">About Us</h1>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="well-lg">
                    <h3 class="welcome">Welcome to MovieTime, the world's largest film event platform!</h3><br>
                    <p class="aboutUs">
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
        <div class="container">
            <div class="row">
                <h2 class="link">Why not...</h2>
                <br>
                <!--MAY CHANGE TO BUTTONS-->                
                <div class="col-md-3"></div>
                <div class="col-md-2">
                    <div class="well">
                        <p class="aboutUs">Browse our list of <a href="<?php echo url_for('/location_browse.php'); ?>">venues</a>?<br></p>
                    </div>
                </div>
                <!--<div class="col-md-1"></div>-->
                <div class="col-md-2">
                    <div class="well">
                        <p class="aboutUs">Find out <a href="<?php echo url_for('/index.php'); ?>">what's on</a> near you?</p>
                    </div>
                </div>
                <!--<div class="col-md-1"></div>-->
                <div class="col-md-2">
                    <div class="well">
                        <p class="aboutUs">Search for films by <a href="<?php echo url_for('films/genre.php'); ?>">genre</a>?</p>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
            <div>
                <p class="larger-text aboutUs">Or <a href="<?php echo url_for('/index.php'); ?>">sign up</a>, and join the MovieTime community today!</p>
            </div>
            <!--<div class="sign-up">
                <input type="submit" value="Sign Up" name="sign_up_button" disabled="disabled" />
            </div>-->
        </div>
        <br>
        <br>
    </body>
    <?php include(SHARED_PATH . '/footer.php'); ?>
