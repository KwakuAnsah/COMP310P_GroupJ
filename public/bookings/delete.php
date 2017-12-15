<?php
require_once('../../private/initialize.php');

if(!isset($_GET['booking_id'])) {
    redirect_to(url_for('/whatson.php'));
}
$booking_id = $_GET['booking_id'];
$booking = find_booking_by_id($booking_id);

if(is_post_request() && booking['user_id']==$_SESSION['user_id']) { 
    $result = delete_booking($booking_id);
    redirect_to(url_for('whatson.php'));
       
}
?>

<?php $page_title = 'Delete Booking'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

   <div class="subject delete">
    <h1>Delete Booking</h1>
    <p>Are you sure you want to delete this booking?</p>
    <p class="item"><?php echo h($booking['event_name']); ?></p>

    <form action="<?php echo url_for('/bookings/delete.php?booking_id=' . h(u($booking_id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Subject" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
