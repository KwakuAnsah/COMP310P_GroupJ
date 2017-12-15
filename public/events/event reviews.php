
<?php
$ratings_set = find_all_ratings_by_event_id($event_id);
//Creating table of events
if (mysqli_num_rows($ratings_set) > 0) {
    echo "<table class=\"table table-striped\" id=\"myTable\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th></th>";
    echo "<th class=\"text-center\">Username</th>";
    echo "<th class=\"text-center\">Event Rating</th>";
    echo "<th class=\"text-center\">Host Rating</th>";
    echo "<th class=\"text-center\">Review Text</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    //Displaying each event row
    
    while ($rating = mysqli_fetch_assoc($ratings_set)) {
        echo "<tr class=\"text-center\">";
        echo "<td>" . $rating['username'] . "</td>";
        echo "<td>" . $rating['event_rating'] . "</td>";
        echo "<td>" . $rating['host_rating'] . "</td>";
        echo "<td>" . $rating['review_text'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    mysqli_free_result($ratings_set);
} else {
    echo "No records matching your request were found.";
}
?>
