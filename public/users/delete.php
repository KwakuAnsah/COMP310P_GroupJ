<?php

require_once('../../private/initialize.php');

if(!isset($_GET['id'])) {
    // If it is a get request not a post request then 
    // redirect back to the index
    redirect_to(url_for('/events/subjects/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) { 
    // If it is a POST request then we will delete the entry 
    $result = delete_subject($id);
    redirect_to(url_for('events/subjects/index.php'));
            
}else {
    // Error handling
    $subject = find_subject_by_id($id);
}

?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/events/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject delete">
    <h1>Delete Subject</h1>
    <p>Are you sure you want to delete this subject?</p>
    <p class="item"><?php echo h($subject['menu_name']); ?></p>

    <form action="<?php echo url_for('/events/subjects/delete.php?id=' . h(u($subject['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Subject" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
