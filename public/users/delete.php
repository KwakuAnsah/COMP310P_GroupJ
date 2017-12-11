<?php

require_once('../../private/initialize.php');

if(!isset($_GET['user_id'])) {
    // If it is a get request not a post request then 
    // redirect back to the index
    redirect_to(url_for('index.php'));
}
$user_id = $_GET['user_id'];

if(is_post_request()) { 
    // If it is a POST request then we will delete the entry 
    $result = delete_user($user_id);
    redirect_to(url_for('index.php'));
            
}else {
    // Error handling
    $user = find_user_by_id($user_id);
}

?>

<?php $page_title = 'Delete User'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php
    echo
    url_for('/users/show.php?user_id=' . $user_id);
    ?>">&laquo; Back to Profile</a>

  <div class="user delete">
    <h1>Delete Account</h1>
    <p> Hi <?php echo h($user['first_name']); ?>, 
        we are sorry to see you leave.</p> 
    
    <p>Are you sure you want to delete your account?</p>
    <p class="item"><?php echo h($user['username']); ?></p>

    <form action="<?php echo url_for('/users/delete.php?id=' . h(u($user['user_id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete User" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
