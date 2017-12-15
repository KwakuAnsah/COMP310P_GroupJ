<?php // Did not have time to link this page. ?>

<?php

require_once('../../private/initialize.php');
include(SHARED_PATH . '/access_denied.php');

if(!isset($_SESSION['user_id'])){
    echo "<div class='no_session'>  </div>";
    redirect_to(url_for("index.php"));
}

if(!isset($_GET['id'])) {
  redirect_to(url_for('/events/host_pages/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_event($id);
  redirect_to(url_for('/events/host_pages/index.php'));

} else {
  $event = find_event_by_id($id);
}

?>

<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/events/host_pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="event delete">
    <h1>Delete Page</h1>
    <p>Are you sure you want to delete this event?</p>
    <p class="item"><?php echo h($event['menu_name']); ?></p>

    <form action="<?php echo url_for('/events/host_pages/delete.php?id=' . 
            h(u($event['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Page" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
