<?php
require_once('../../private/initialize.php');
$page_title = 'Profile page';
$page = 'show.php';

include(SHARED_PATH . '/access_denied.php');
?>

<?php
$user_id = $_GET['user_id'] ?? '1'; // PHP > 7.0
$user = find_user_by_id($user_id);

if ($_SESSION['user_id'] !== $user_id) {
    redirect_to(url_for("index.php"));
}
?>

<?php include(SHARED_PATH . '/header.php'); ?>
<!--Start of body-->
<div class="container-fluid text-center">    

    <div class="row content">
        <div class="col-sm-2 sidenav">
            <p><img src="<?php echo url_for("images/Justice league poster.jpg") ?>" class="img-thumbnail img" alt="Generic profile picure"> Profile picture</p>
            <br>
            <br>
            <!--                Include links to pages later-->
            <p><a href="">Create Event</a></p>
            <p><a class="action" href="<?php echo url_for('/users/delete.php?user_id=' . h(u($user['user_id']))); ?>">Delete your account</a></p>
            <p><a class="action" href="<?php echo url_for('/users/edit.php?user_id=' . h(u($user['user_id']))); ?>">Edit your account details</a></p>
            <p><a class="action" href="<?php echo url_for('/users/host_events.php?host_user_id=' . h(u($user['user_id']))); ?>">View Events you are Hosting</a></p>
        </div>
        <div id="content">

            <div class="user show">

                <h1>My Account </h1>
                <h2> Hi <?php echo h($user['first_name']) . ' ' . h($user['last_name']); ?>  </h2>

                <div class="attributes">
                    <dl>
                        <dt>Username:</dt>
                        <dd><?php echo h($user['username']) ?></dd>
                    </dl>
                    <dl>
                        <dt>First Name:</dt>
                        <dd><?php echo h($user['first_name']) ?></dd>
                    </dl>
                    <dl>
                        <dt>Last Name:</dt>
                        <dd><?php echo h($user['last_name']) ?></dd>
                    </dl>
                    <dl>
                        <dt>Date of Birth</dt>
                        <dd><?php echo h($user['date_of_birth']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Email</dt>
                        <dd><?php echo h($user['email']) ?></dd>
                    </dl>
                    <dl>
                        <dt>Address:</dt>
                        <dd><?php echo h($user['address_line_1']); ?></dd>
                        <dd><?php echo h($user['postcode']); ?></dd>
                        <dd><?php echo h($user['city_name']); ?></dd>
                        <dd><?php echo h($user['country_name']); ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <h2>Your Upcoming Events</h2>
    <?php include(PUBLIC_PATH . '/users/upcoming_user_events.php'); ?>  
        <br>
    <br>
    <h2>Events You Have Attended</h2>
    <?php include(PUBLIC_PATH . '/users/past_user_events.php'); ?>  
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
