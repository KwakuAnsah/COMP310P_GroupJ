<?php
require_once('../../private/initialize.php');

$page_title = 'Host user';
$page = "host_events.php";

if (!isset($_GET['host_user_id'])) {
    redirect_to(url_for('/index.php'));
}
$host_user_id = $_GET['host_user_id'];

$event_id = $_GET['event_id'] ?? '1';
?>

<?php include(SHARED_PATH . '/header.php'); ?>

<!-- Asynchronous searching used on this page -->
<!-- Generating a list of participants -->
<?php
echo "<h2>View progress of ticket sales</h2><br>";

$sql = "SELECT user.user_id, first_name, last_name, host_user_id, "
        . "event_has_booking.event_id, booking.booking_id, "
        . "number_of_tickets, event_name, total_tickets ";
$sql .= "FROM user "
        . "JOIN booking_has_user ON booking_has_user.user_id = user.user_id "
        . "JOIN event_has_booking ON event_has_booking.booking_id = booking_has_user.booking_id "
        . "JOIN event ON event.event_id = event_has_booking.event_id "
        . "JOIN booking ON booking.booking_id = booking_has_user.booking_id ";
$sql .= "WHERE event.event_id='" . db_escape($db, $event_id) . "'";

if ($result = mysqli_query($db, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table class=\"table table-striped\" id=\"myTable\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th></th>";
        echo "<th class=\"text-center\">Your event name</th>";
        echo "<th class=\"text-center\">Participant name</th>";
        echo "<th class=\"text-center\">Booking ID</th>";
        echo "<th class=\"text-center\">Number of tickets booked</th>";
        echo "</tr>";
        echo "</thead>";
        //Displaying rows of each participant
        echo "<tbody>";
        $participants_set = find_participants_by_event_id($event_id);
        while ($participant = mysqli_fetch_assoc($participants_set)) {
            echo "<tr class=\"text-center\">";
            echo "<td>"
            ?><a class="action" href="<?php echo url_for('events/show.php?id=' . $event['event_id']); ?>">View Event Details</a><br><br><?php
            "</td>";
            echo "<td>" . $participant['event_name'] . "</td>";
            echo "<td>" . $participant['first_name'] . " " . $participant['last_name'] . "</td>";
            echo "<td>" . $participant['booking_id'] . "</td>";
            echo "<td>" . $participant['number_of_tickets'] . " / " . $participant['total_tickets'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        mysqli_free_result($participants_set);
    } else {
        echo "No participants were found.";
    }
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($link);
}

//* * * * * TICKETS SOLD FOR ONE EVENT * * * * *//
//$tickets_sold = find_tickets_sold($event_id);
//$total_tickets = find_total_tickets($event_id);
//echo "<h3>Tickets Sold: " . $tickets_sold . " / " . $total_tickets . "</h3>";
?>

<?php include(SHARED_PATH . '/footer.php'); ?>
