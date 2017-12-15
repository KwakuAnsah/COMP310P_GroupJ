

<?php
$today = date("Y-m-d H:i:s");


//Adding filtering by user-specified date range
$date_input1 = db_escape($db, filter_input(INPUT_POST, "dateInput1"));
$date_input2 = db_escape($db, filter_input(INPUT_POST, "dateInput2"));
$date_time1 = $date_input1 . " 00:00:00";
$date_time2 = $date_input2 . " 23:59:59";
$datepart = "";


$sql = "SELECT booking.number_of_tickets, event_has_booking .booking_id, booking_has_user. user_id, "
        . "event.event_id, event_name, event_end, event_description, total_tickets, event_category_id, "
        . "category_name, event_start, ticket_sale_end, room.room_id, room_name, capacity, "
        . "room.room_id, room_name, capacity, wheelchair_accessible, "
        . "wheelchair_accessible, address.address_id, address_line_1, postcode, city.city_id, city_name, "
        . "country.country_id, country_name, genre_name ";
$sql .= "FROM booking_has_user "
        . "JOIN event_has_booking ON  booking_has_user.booking_id=event_has_booking. booking_id "
        . "JOIN booking ON event_has_booking. booking_id=booking.booking_id "
        . "JOIN event ON event.event_id=event_has_booking.event_id "
        . "JOIN film_event ON film_event.event_id=event.event_id "
        . "JOIN film ON film.film_id=film_event.film_id "
        . "JOIN film_film_genre ON film_film_genre.film_id=film.film_id "
        . "JOIN film_genre ON film_genre.genre_id=film_film_genre.genre_id "
        . "JOIN category ON event_category_id = category_id "
        . "JOIN room ON event.room_id = room.room_id "
        . "JOIN address ON room.address_id = address.address_id "
        . "JOIN city ON address.city_id = city.city_id "
        . "JOIN country ON country.country_id = city.country_id "
        . "WHERE user_id =" . $_SESSION['user_id']
        . " AND event_start < '" . $today . "' "
        . $datepart;


//Creating table of events
if ($result = mysqli_query($db, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table class=\"table table-striped\" id=\"myTable\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th></th>";
        echo "<th class=\"text-center\">Number Of Tickets</th>";
        echo "<th class=\"text-center\">Event Name</th>";
        echo "<th class=\"text-center\">Event Category</th>";
        echo "<th class=\"text-center\">Event Description</th>";
        echo "<th class=\"text-center\">Start Time</th>";
        echo "<th class=\"text-center\">End Time</th>";
        echo "<th class=\"text-center\">Room and Address</th>";
        echo "<th class=\"text-center\">Tickets remaining</th>";
        echo "<th class=\"text-center\">Ticket Sale End</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        //Displaying each event row
        $events_set = $result;
        while ($event = mysqli_fetch_assoc($events_set)) {
            $t_sold = find_tickets_sold($event['event_id']);
            $tickets_remaining = $event['total_tickets'] - $t_sold;
            echo "<tr class=\"text-center\">";
            echo "<td>"
            ?><a class="action" href="<?php echo url_for('events/show.php?event_id=' . $event['event_id']); ?>">View Details</a><br><br><?php
            ?>
            <?php
            if (user_has_already_rated_event($event['event_id']) == 1) {
                echo '<a class="action" href="' . url_for('rating/show.php?event_id=' . $event['event_id']) . '"> See Your Review</a>';
            } else {
                echo '<a class="action" href="' . url_for('rating/new.php?event_id=' . $event['event_id']) . '"> Review this Event</a>';
            }
            ?>


            <?php
            "</td>";
            echo "<td>" . $event['number_of_tickets'] . "</td>";
            echo "<td>" . $event['event_name'] . "</td>";
            echo "<td>" . $event['category_name'] . "</td>";
            echo "<td>" . $event['event_description'] . "</td>";
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
    echo "ERROR: Could execute $sql. " . mysqli_error($db);
}
?>
