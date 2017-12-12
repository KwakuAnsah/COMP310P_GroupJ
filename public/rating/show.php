<?php
require_once('../../private/initialize.php');
?>


<?php
$rating_id = $_GET['rating_id'] ?? '1'; // PHP > 7.0
$user = find_user_by_id($user_id);
?>

<?php $page_title = 'Profile Page'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <div class="user show">

        <h1>My Account </h1>
        <h2> Hi <?php echo h($user['first_name']) . ' ' . h($user['last_name']); ?>!  </h2>

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

        <div>
            <a class="action" href="<?php
            echo url_for('/users/delete.php?user_id=' . h(u($user['user_id'])));
            ?>">Delete your account</a>
            <br>
            <a class="action" href="<?php
               echo
               url_for('/users/edit.php?user_id=' . h(u($user['user_id'])));
               ?>">Edit your account details</a>


        </div>



    </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>