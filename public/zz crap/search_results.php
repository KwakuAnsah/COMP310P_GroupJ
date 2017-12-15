<?php
require_once('../private/initialize.php');
$page_title = 'Whats On';
$page = "whats_on.php";

// Setting up parameters for this page
$date_result = null;
$Search1 = filter_input(INPUT_POST, "Search");
?>

<?php include(SHARED_PATH . '/header.php'); ?>

<!-- Asynchronous searching used on this page -->
<div class="container text-center">
    <h1 class='whats_on_title'> Search Results</h1>
    <br>
    <br>
    <form class="searchbox form-group" onsubmit="return checkSearch(this)" method="post">
        <p class="search_dates">
            Search for events happening between:
            <input type="date" id="dateinput1" name="dateInput1"/>
            and
            <input type="date" id="dateinput2" name="dateInput2"/>
            <input type="submit" value="Search" name="searchsubmit"/>
        </p>
    </form>
</div>
<br>

<?php
$today = date("Y-m-d H:i:s");
echo "<p>Current date and time:  $today </p>";
$input = db_escape($db, $Search1);

//Adding filtering by user-specified date range
$date_input1 = db_escape($db, filter_input(INPUT_POST, "dateInput1"));
$date_input2 = db_escape($db, filter_input(INPUT_POST, "dateInput2"));
$date_time1 = $date_input1 . " 00:00:00";
$date_time2 = $date_input2 . " 23:59:59";
$datepart = "";
if ($date_input1 != "" and $date_input2 != "") {
    $datepart = "AND event_start BETWEEN '$date_time1'  AND '$date_time2'";
}
$sql = "SELECT event.event_id, event_name, host_user_id, username, "
        . "first_name, last_name, event_end, event_description, "
        . "total_tickets, event_category_id, category_name, event_start, ticket_sale_end, "
        . "room.room_id, room_name, capacity, wheelchair_accessible, "
        . "address.address_id, address_line_1, postcode, city.city_id, "
        . "city_name, country.country_id, country_name, genre_name ";
$sql .= "FROM event "
        . "JOIN user ON event.host_user_id = user.user_id "
        . "JOIN film_event ON film_event.event_id = event.event_id "
        . "JOIN film ON film.film_id = film_event.film_id "
        . "JOIN film_film_genre ON film_film_genre.film_id =film.film_id "
        . "JOIN film_genre ON film_genre.genre_id = film_film_genre.genre_id "
        . "JOIN category ON event_category_id = category_id "
        . "JOIN room ON event.room_id = room.room_id "
        . "JOIN address ON room.address_id = address.address_id "
        . "JOIN city ON address.city_id = city.city_id "
        . "JOIN country ON country.country_id = city.country_id "
        . "WHERE event_name LIKE '%" . $input . "%' "
        . "AND event_start > sysdate() "
        . $datepart;

if ($date_input1 != "" and $date_input2 != "") {
    $date_result = "happening between $date_input1 and $date_input2";
}
echo "<h3>Your search results: Events $date_result</h3>";

//Creating table of events
if ($result = mysqli_query($db, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table class=\"table table-striped\" id=\"myTable\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th></th>";
        echo "<th class=\"text-center\">Event Name</th>";
        echo "<th class=\"text-center\">Event Category</th>";
        echo "<th class=\"text-center\">Event Description</th>";
        echo "<th class=\"text-center\">Film Genre</th>";
        echo "<th class=\"text-center\">Start Time</th>";
        echo "<th class=\"text-center\">End Time</th>";
        echo "<th class=\"text-center\">Room and Address</th>";
        echo "<th class=\"text-center\">Tickets remaining</th>";
        echo "<th class=\"text-center\">Ticket Sale End</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        //Displaying each event row
        $events_set = find_all_events_detailed();
        while ($event = mysqli_fetch_assoc($events_set)) {
            $t_sold = find_tickets_sold($event['event_id']);
            $tickets_remaining = $event['total_tickets'] - $t_sold;
            echo "<tr class=\"text-center\">";
            echo "<td>"
            ?><a class="action" href="<?php echo url_for('events/show.php?event_id=' . $event['event_id']); ?>">View Details</a><br><br><?php
            ?><a class="action" href="<?php echo url_for('bookings/new.php?event_id=' . $event['event_id']); ?>">Book</a><?php
            "</td>";
            echo "<td>" . $event['event_name'] . "</td>";
            echo "<td>" . $event['category_name'] . "</td>";
            echo "<td>" . $event['event_description'] . "</td>";
            echo "<td>" . $event['genre_name'] . "</td>";
            echo "<td>" . $event['event_start'] . "</td>";
            echo "<td>" . $event['event_end'] . "</td>";
            echo "<td>" . $event['room_name'] . ", " . $event['address_line_1'] . ", " . $event['postcode'] . ", " . $event['city_name'] . ", " . $event['country_name'] . "</td>";
            echo "<td>" . $tickets_remaining . "/" . $event['total_tickets'] . "</td>";
            echo "<td>" . $event['ticket_sale_end'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        mysqli_free_result($events_set);
    } else {
        echo "No records matching your request were found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
?>
<br>
<br>
<br>
<?php include(SHARED_PATH . '/footer.php'); ?>
