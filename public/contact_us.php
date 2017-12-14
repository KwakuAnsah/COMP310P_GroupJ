<?php
require_once('../private/initialize.php');
$page_title = 'Contact Us';
$page = "contact_us.php";

include(SHARED_PATH . '/header.php');
?>

<div class="container">
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <h1 class="heading-left">Contact Us</h1>
        <br>
        <h3 class="contact-headings">Head Office:</h3>
        <div class="well">
            <p class="larger-text">
                MovieTime Events<br>
                21 Moorgate<br>
                London<br>
                EC2M
            </p>
        </div>
        <br>
        <h2 class="question-heading">Have a question?</h2>
        <h3 class="contact-headings">Call or email us:</h3>
        <div class="well">
            <p class="larger-text">
                <b>Telephone:</b> 0800 615 2523
                <br>
                <br>
                <b>Email:</b> customerservice@movietime.co.uk
            </p>
        </div>
    </div>
    <div class="col-md-5">
        <br>
        <br>
        <br>
        <h2 class="question-heading">How to find us:</h2>
        <!-- Embedded Google maps link -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.713919895713!2d-0.09034068483771122!3d51.51846427963692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761cac750d67bb%3A0x990970c245b66ef5!2s21+Moorgate%2C+London+EC2M!5e0!3m2!1sen!2suk!4v1512862842574" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <div class="col-md-1"></div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>