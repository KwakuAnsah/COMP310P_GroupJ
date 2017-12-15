<?php
require_once('../../private/initialize.php');
$page_title = 'Rate an Event';
$page = 'new.php';
include(SHARED_PATH . '/access_denied.php');

if (!isset($_SESSION['user_id'])) {
    echo "<div class='no_session'>  </div>";
    redirect_to(url_for("index.php"));
}
if(!isset($_GET['event_id'])) {
  redirect_to(url_for('/users/show.php?user_id='.$_SESSION['user_id']));
}
$event_id = $_GET['event_id'];

if (is_post_request()) {

    $rating = [];
    $rating['event_rating'] = $_POST['event_rating'] ?? '';
    $rating['host_rating'] = $_POST['host_rating'] ?? '';
    $rating['review_text'] = $_POST['review_text'] ?? '';
    $rating['event_id'] = $_POST['event_id'] ?? '';
    $rating['rater_user_id'] = $_SESSION['user_id'];


    $result = insert_rating($rating);
    if ($result === true) {
        $new_event_id = mysqli_insert_id($db);
        redirect_to(url_for('/events/show.php?event_id=' . $new_event_id));
    } else {
        $errors = $result;
    }
} else {
    $rating=[];
    $rating['event_rating'] = '';
    $rating['host_rating'] = '';
    $rating['review_text'] = '';
    $rating['event_id'] = '';
    $rating['rater_user_id'] = $_SESSION['user_id'];
}

$rating_set = find_all_ratings();
$rating_count = mysqli_num_rows($rating_set) + 1;
mysqli_free_result($rating_set);
?>


<?php include(SHARED_PATH . '/header.php'); ?>
<?php
$event_id = $_GET['event_id'] ?? '1'; // PHP > 7.0
$user_id = $_SESSION['user_id'];



$rating_set = find_all_ratings();
$rating_count = mysqli_num_rows($rating_set) + 1;
mysqli_free_result($rating_set);


// FOR DISPLAYING THE EVENT DETAILS

$event = find_event_by_id($event_id);
$films = find_films_by_event_id($event_id);
$host = find_host_by_event_id($event_id);
$category = find_category_by_event_id($event_id);
$room = find_room_by_event_id($event_id);
$address = find_address_by_room_id($event['room_id']);
$city = find_city_by_id($address['city_id']);
$country = find_country_by_id($city['country_id']);

$tickets_sold = find_tickets_sold($event['event_id']);
$tickets_remaining = $event['total_tickets'] - $tickets_sold;
?>

<?php $page_title = 'Review ' . $event['event_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div class="container">
    <div id="content">
        <a class="back-link" href="<?php echo url_for('/events/show.php?event_id=' . $event_id); ?>">View Event Details</a>

        <div class="new_booking">
            <h1>Write a Review for <?php echo $event['event_name'] ?></h1>
            <br>
<?php echo display_errors($errors); ?>

            <form action="<?php echo url_for('/ratings/new.php'); ?>" method="post">
                <dl>
                    <dt>Overall Event Score:</dt>
                    <dd><input type="text" name="event_rating" value="
                        <?php echo h($rating['event_rating']); ?>"/> / 10
                        </dd>
                </dl>
                <dl>
                    <dt>Host Score:</dt>
                    <dd><input type="text" name="host_rating" value="
                        <?php echo h($rating['host_rating']); ?>" /> / 10
                        </dd>
                </dl>
                <dl>
                    <dt>Review:</dt>
                    <dd><input type="text" name="host_rating" value="
                        <?php echo h($rating['review_text']); ?>" />
                        </dd>
                </dl>
                    <dl>
                
            </form>



            <!-- THIS SECTION IS FROM EVENT SHOW CODE - UPDATE ONCE EVENT SHOW IS COMPLETE -->
            <div class="attributes"> 
                <h2>Event Details</h2>
                <dl>
                    <dt>Event type:</dt>
                    <dd><?php echo h($category['category_name']); ?></dd>
                </dl>
                <dl>
                    <dt>Hosted by:</dt>
                    <dd><?php
                                echo h($host['first_name']) . ' ' .
                                h($host['last_name']) . ' - ' . h($host['username']);
?></dd>
                </dl>

                        <?php $rating = find_rating_by_event_id($event['event_id']) ?>

                <?php if (isset($rating)) { ?>
                    <dl> 
                        <dt>Host average rating:</dt>
                    <?php $average_rating = find_avg_host_rating($event['host_user_id']); ?>
                        <dd><?php echo $average_rating ?> / 10</dd>
                    </dl>
                    <?php } ?>
                <dl>
                    <dt>Event Description:</dt>
                    <dd><?php echo h($event['event_description']); ?></dd>
                </dl>
                <dl>
<?php $number_of_films = find_number_of_films_by_event_id($event_id) ?>
                    <dt>Films showing: <?php echo $number_of_films ?></dt>
                </dl>
                    <?php echo display_event_films_details($films); ?>
                <br>
                <h2>Date and Time</h2>
                <dl>
                    <dt>Start:</dt>
                    <dd><?php echo h($event['event_start']); ?></dd>
                </dl>
                <dl>
                    <dt>End:</dt>
                    <dd><?php echo h($event['event_end']); ?></dd>
                </dl>
                <br>
                <h2>Location</h2>
                <dl>
                    <dt>Room:</dt>
                    <dd><?php echo h($room['room_name']); ?></dd>
                </dl>
                <dl>
                    <dt>Address:</dt>
                    <dd><?php echo h($address['address_line_1']); ?></dd>
                    <dd><?php echo h($address['postcode']); ?></dd>
                    <dd><?php echo h($city['city_name']); ?></dd>
                    <dd><?php echo h($country['country_name']); ?></dd>
                </dl>
                <dl>
                    <dt>Wheelchair Accessible:</dt>                       
                    <dd><?php echo h($room['wheelchair_accessible']); ?></dd>
                </dl>

            </div> 
        </div>
    </div> 
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
