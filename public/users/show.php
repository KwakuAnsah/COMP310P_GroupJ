<?php
require_once('../../private/initialize.php');
$page_title = 'Profile page';
$page = 'show.php'
?>

<?php
$user_id = $_GET['user_id'] ?? '1'; // PHP > 7.0
$user = find_user_by_id($user_id);
?>

<?php include(SHARED_PATH . '/header.php'); ?>
<!--Start of body-->
<div class="container-fluid text-center">    
          <div class="row content">
            <div class="col-sm-2 sidenav">
                <p><img src="" class="img-thumbnail img" alt="Generic profile picure"> Profile picture above </p>
                <br>
                <br>
<!--                Include links to pages later-->
                <p><a href="">Create Event</a></p>
                <p><a class="action" href="<?php echo url_for('/users/delete.php?user_id=' . h(u($user['user_id']))); ?>">Delete your account</a></p>
                <p><a class="action" href="<?php echo url_for('/users/edit.php?user_id=' . h(u($user['user_id']))); ?>">Edit your account details</a></p>
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
                                    <dt>Address</dt>
                                    <dd><?php echo h($user['address_id']) ?> - Link to Address info to be completed</dd>
                                </dl>
                            </div>
                        </div>

                    </div>
          </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>