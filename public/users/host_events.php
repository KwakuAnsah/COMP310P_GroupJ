
<?php
require_once('../../private/initialize.php');
include(SHARED_PATH . '/access_denied.php');

$page_title = 'Host user';
$page = "host_events.php";

$host_user_id = $_SESSION['user_id'];
?>

<?php include(SHARED_PATH . '/header.php'); ?>

<!-- Asynchronous searching used on this page -->
<!-- Generating a list of participants -->
<?php
$today = date("Y-m-d H:i:s");

$result = find_all_participants_by_host($host_user_id);
echo "<h2>Movie Goers Attending Your Upcoming Events</h2><br>"
 . "<a class='action' href='" . url_for('users/past_host_events.php')
 . "'>View Previously Hosted Events</a><br><br>";





if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table class = \"table table-striped\" id=\"myTable\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th></th>";
        echo "<th class=\"text-center\">Your event name</th>";
        echo "<th class=\"text-center\">Start Date</th>";
        echo "<th class=\"text-center\">Participant name</th>";
        echo "<th class=\"text-center\">Booking ID</th>";
        echo "<th class=\"text-center\">Number of tickets booked</th>";
        echo "</tr>";
        echo "</thead>";
//Displaying rows of each participant
        echo "<tbody>";
        $participants_set = find_all_participants_by_host($host_user_id);
        while ($participant = mysqli_fetch_assoc($participants_set)) {
            $event = find_event_by_id($participant['event_id']);
            echo "<tr class=\"text-center\">";
            echo "<td>"
            ?><a class="action" href="<?php echo url_for('events/show.php?id=' . $event['event_id']); ?>">View Event Details</a><br><br><?php
            "</td>";
            echo "<td>" . $participant['event_name'] . "</td>";
            echo "<td>" . $participant['event_start'] . "</td>";
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
    echo "ERROR: Could not execute the SQL." . mysqli_error($db);
}
?>
<!-- View progress of ticket sales -->
<?php
echo "<h2>View progress of ticket sales</h2><br>";
$events_set = find_all_upcoming_events_by_host($host_user_id);
if ($events_set) {
    if (mysqli_num_rows($events_set) > 0) {
        echo "<table class = \"table table-striped\" id=\"myTable\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th></th>";
        echo "<th class=\"text-center\">Your event name</th>";
        echo "<th class=\"text-center\">Start Date</th>";
        echo "<th class=\"text-center\">Tickets Sold</th>";
        echo "<th class=\"text-center\">Total Tickets</th>";
        echo "</tr>";
        echo "</thead>";
//Displaying rows of each participant
        echo "<tbody>";

        while ($event = mysqli_fetch_assoc($events_set)) {
            echo "<tr class=\"text-center\">";
            echo "<td>"
            ?><a class="action" href="<?php echo url_for('events/show.php?id=' . $event['event_id']); ?>">View Event Details</a><br><br><?php
            "</td>";
            echo "<td>" . $event['event_name'] . "</td>";
            echo "<td>" . $event['event_start'] . "</td>";
            echo "<td>" . find_tickets_sold($event['event_id']) . "</td>";
            echo "<td>" . find_total_tickets($event['event_id']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        mysqli_free_result($events_set);
    } else {
        echo "No participants were found.";
    }
} else {
    echo "ERROR: Could not execute the SQL.". mysqli_error($db);
}
?>

<?php include(SHARED_PATH . '/footer.php'); ?>
