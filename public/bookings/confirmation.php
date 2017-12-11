<!DOCTYPE html>
<html lang="eng">

    <head>
        <?php require_once('../../private/initialize.php'); ?>
        <?php $page_title = 'Booking Confirmation page'; ?>

        <?php include "../../public/bootstrap.php"; ?>

        <!-- CSS stylesheet for Bookings pages-->
        <link href="../stylesheets/bookings_style.css" rel="Bookings stylesheet">
        
        <?php
        $id = $_GET['booking_id'] ?? '1';
        $booking = find_booking_by_id($id);
        
        ?>
    </head>
    
    <body>
    <!-- * * * * * UPDATE HEADER FILE * * * * * -->    
        <?php include "../../public/header.php"; ?>
        <div class="container">
            <h1 class="heading-centre">Booking Confirmation</h1>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="well-lg">
                    <h3 class="confirmation">Thank you very much for booking with us! We hope you enjoy your event!</h3>
                    <br>
                    <br>
                    <p class="message">
                        Your booking ID: <i><!-- * * * * * INSERT USER'S BOOKING ID * * * * * -->  <?php echo h($booking_has_user['booking_id']); ?>
                        </i>
                        <br>
                        <br>
                        A confirmation email has been sent to:
                        <br>
                        <i>
    <!-- * * * * * INSERT USER'S EMAIL ADDRESS * * * * * --> 
                        <?php echo h($user['email']); ?>
                        </i>
                        <br>
                        <br>
                        <b>Please bring your confirmation email with you to the event, otherwise entry will not be permitted.</b>
                    </p>
                </div>
            </div>  
            <div class="col-md-1"></div>
        </div>
    </body>