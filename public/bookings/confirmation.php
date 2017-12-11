<!DOCTYPE html>
<html lang="eng">

    <head>
        <?php require_once('../../private/initialize.php'); ?>
        <?php $page_title = 'Booking Confirmation page'; ?>

        <?php include "../../public/bootstrap.php"; ?>

        <!-- CSS stylesheet for Bookings pages-->
        <link href="../stylesheets/bookings_style.css" rel="Bookings stylesheet">

        <!-- Our page header -->
        <?php include(SHARED_PATH . '/header.php'); ?>

        <!-- For obtaining users' booking ID and email -->
        <?php
        $id = $_GET['booking_id'] ?? '1';
        $booking = find_booking_by_id($id);

        $user_id = $_GET['user_id'] ?? '1'; // PHP > 7.0
        $user = find_user_by_id($user_id);
        ?>
    </head>

    <body>
        <div class="container">
            <h1 class="heading-centre">Booking Confirmation</h1>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="well-lg">
                    <h3 class="confirmation">Thank you very much for booking with us! We hope you enjoy your event!</h3>
                    <br>
                    <br>
                    <p class="message">
                        <b>Your booking ID:</b>
                        <br>
                        <i><?php echo h($booking['booking_id']); ?></i>
                        <br>
                        <br>
                        <b>A confirmation email has been sent to:</b>
                        <br>
                        <i><?php echo h($user['email']); ?></i>
                        <br>
                        <br>
                        <b>Please bring your confirmation email with you to the event, otherwise entry will not be permitted.</b>
                    </p>
                </div>
            </div>  
            <div class="col-md-1"></div>
        </div>
        <br>
        <br>
        <br>
        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <a href="../../public/users/show.php" class="view btn btn-lg btn-default">View my Account</a>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <a href="../../public/whats_on.php" class="view btn btn-lg btn-default">Continue Browsing</a>
            </div>
            <div class="col-md-2"></div>
        </div>
        <br>
        <br>
        <br>
    </body>