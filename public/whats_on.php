
<?php
require_once('../private/initialize.php');

$page_title = 'Whats On';
$page = "whats_on.php";

$Search1 = filter_input(INPUT_POST, "Search");
?>
<?php include(SHARED_PATH . '/header.php'); ?>

<!--        Asynchronous searching used on this page-->

<div class="container text-center">
    <h1 class='whats_on_title'>What's On</h1>
    <br>
    <br>
    <form class="searchbox form-group" onsubmit="return checkSearch(this)" method="post">
        <p class="search_dates">
            Search for events happening between:
            <input type="date" id="dateinput1" name="dateInput1"/>
            and
            <input type="date" id="dateinput2" name="dateInput2"/>
        </p>
    </form>
</div>
</div>
<br>





<?php
    $today = date("Y-m-d H:i:s");
    echo "<p>Current date and time:  $today </p>";
    $input = db_escape($db, $Search1);

// Search is not submitted
    /*if (filter_input(INPUT_POST, "searchsubmit") == FALSE) {
        $sql = "SELECT e.event_id, e.event_name, e.event_description, e.start_time, e.end_time, e.venue, c.category_name, (e.total_tickets - t.tickets_sold) "
                . "FROM event e join category c on e.category_id=c.category_id join ticket t where t.ticketed_event_id =e.event_id and e.start_time > sysdate()";
    }

// Search submitted!
    else {
//Search and category
        if (filter_input(INPUT_POST, "Football") == true) {
            $option1 = "Football";
        }
        if (filter_input(INPUT_POST, "Basketball") == true) {
            $option2 = "Basketball";
        }
        if (filter_input(INPUT_POST, "Tennis") == true) {
            $option3 = "Tennis";
        }
        if (filter_input(INPUT_POST, "Rugby") == true) {
            $option4 = "Rugby";
        }
        if (filter_input(INPUT_POST, "AmericanFootball") == true) {
            $option5 = "American Football";
        }
        if (filter_input(INPUT_POST, "Volleyball") == true) {
            $option6 = "Volleyball";
        }
        if (filter_input(INPUT_POST, "Cricket") == true) {
            $option7 = "Cricket";
        }
        if (filter_input(INPUT_POST, "Badminton") == true) {
            $option8 = "Badminton";
        }
        
//add sort
        $selection = filter_input(INPUT_POST, "selections");
        if ($selection == "eventName") {
            $sort = "group by e.event_name";
        }
        if ($selection == "category") {
            $sort = "group by c.category_name";
        }
        if ($selection == "venue") {
            $sort = "group by e.venue";
        }
        if ($selection == "start") {
            $sort = "group by e.start_time";
        }
        if ($selection == "low-high") {
            $sort = "group by (e.total_tickets - t.tickets_sold)";
        }
        if ($selection == "high-low") {
            $sort = "group by (e.total_tickets - t.tickets_sold) desc";
        }
        */
//add date
        $datedis1 = db_escape($db, filter_input(INPUT_POST, "dateInput1"));
        $datedis2 = db_escape($db, filter_input(INPUT_POST, "dateInput2"));
        $date1 = $datedis . " 00:00:00";
        $date2 = $datedis . " 23:59:59";
        //$date1 = mysqli_real_escape_string($connection, filter_input(INPUT_POST, "dateInput1")) . " 00:00:00";
        //$date2 = mysqli_real_escape_string($connection, filter_input(INPUT_POST, "dateInput2")) . " 23:59:59";
        $datepart = "";
        if ($datedis1 != "" and $datedis2 != "") {
            $datepart = "AND event_start BETWEEN '$date1'  AND '$date2'";
        }
        $sql = "SELECT event.event_id, event_name, host_user_id, username, "
            . "first_name, last_name, event_end, event_description, "
            . "total_tickets, event_category_id, event_start, ticket_sale_end, "
            . "room.room_id, room_name, capacity, wheelchair_accessible, "
            . "address.address_id, address_line_1, postcode, city.city_id, "
            . "city_name, country.country_id, country_name ";
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
            . "WHERE event_name LIKE '%".$input."%' "
        //$sql = "SELECT e.event_id, e.event_name, e.event_description, e.start_time, e.end_time, e.venue, c.category_name, (e.total_tickets - t.tickets_sold) "
                //. "FROM event e join category c on e.category_id=c.category_id join ticket t where t.ticketed_event_id =e.event_id and e.event_name like '%$input%'"
                //. "and c.category_name like '$option1%'"
                //. "and c.category_name like '%$option2%'"
                //. "and c.category_name like '%$option3%'"
                //. "and c.category_name like '%$option4%'"
                //. "and c.category_name like '%$option5%'"
                //. "and c.category_name like '%$option6%'"
                //. "and c.category_name like '%$option7%'"
                //. "and c.category_name like '%$option8%' "
                . "AND event_start > sysdate() "
                . $datepart;
                //. $sort;

//Result
        if ($input != "") {
            $searchres = "about $input";
        }

        //if ($option1 != "" or $option2 != "" or $option3 != "" or $option4 != "" or $option5 != "" or
        //        $option6 != "" or $option7 != "" or $option8 != "") {
        //    $categoryres = "under category: $option1 $option2 $option3 $option4 $option5 $option6 $option7 $option8";
        //}

        if ($datedis1 != "" and $datedis2 != "") {
            $dateres = "happen between $datedis1 and $datedis2";
        }
        
        /*
        if ($selection === "eventName") {
            $s = "sorted by Category";
        }
        if ($selection === "category") {
            $s = "sorted by Category";
        }
        if ($selection === "venue") {
            $s = "sorted by Venue";
        }
        if ($selection === "start") {
            $s = "sorted by Start Date (Most Recent)";
        }
        if ($selection === "low-high") {
            $s = "sorted by Ticket Remaining (Low-High)";
        }
        if ($selection === "high-low") {
            $s = "sorted by Ticket Remaining (High-Low)";
        }
        */
        //echo "<h3>Searched result: Events $searchres $categoryres $dateres $s</h3>"
        echo "<h3>Searched result: Events $dateres $s</h3>";
    //}

    
    
    if ($result = mysqli_query($db, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table class=\"table table-striped\" id=\"myTable\">";
            echo "<tr>";
            echo "<th> </th>";
            echo "<th>Event Name</th>";
            echo "<th>Event Description</th>";
            echo "<th>Start Time</th>";
            echo "<th>End Time</th>";
            //echo "<th>Address</th>";
            //echo "<th>Event Category</th>";
            //echo "<th>Film Showing</th>";
            //echo "<th>Film Genre</th>";
            //echo "<th>Tickets Remaining</th>";
            echo "</tr>";
            $events_set = find_all_events_detailed();
            while ($event = mysqli_fetch_assoc($events_set)) {
                echo "<tr>";
                echo "<td>"
                ?><a class="action" href="<?php echo url_for('bookings/new.php?id=' . $event['event_id']); ?>">Book</a><?php
                "</td>";
                echo "<td>" . $event['event_name'] . "</td>";
                echo "<td>" . $event['event_description'] . "</td>";
                echo "<td>" . $event['event_start'] . "</td>";
                echo "<td>" . $event['event_end'] . "</td>";
                //echo "<td>" . $row['venue'] . "</td>";
                //echo "<td>" . $row['category.category_name'] . "</td>";
                //echo "<td>" . $row['(e.total_tickets - t.tickets_sold)'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
        } else {
            echo "No records matching your request were found.";
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    
    
    
    
    
    
    
    
    
    
    /*
    $events_set =  find_all_events_detailed();
            while ($event = mysqli_fetch_assoc($events_set)) {
                echo "<tr>";
                echo "<td>"
                //<?php echo url_for('bookings/new
                ?><a class="action" href="<?php echo url_for('participants/book_tickets.php?id=' . $row['event_id']); ?>">Book</a><?php
                "</td>";
                echo "<td>" . $event['event_name'] . "</td>";
                echo "<td>" . $event['event_description'] . "</td>";
                echo "<td>" . $row['start_time'] . "</td>";
                echo "<td>" . $row['end_time'] . "</td>";
                echo "<td>" . $row['venue'] . "</td>";
                echo "<td>" . $row['category_name'] . "</td>";
                echo "<td>" . $row['(e.total_tickets - t.tickets_sold)'] . "</td>";
                 echo "<td>" . find_tickets_sold( $event['event_id']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
    
    */
    
    
    













mysqli_close($connection);
    ?>

                
                
                
                <br>
                <br>
                <br>
                <br>
                <br>

<!--          Table with data-->
<div class="container-fluid text-center">
    <table class='table table-striped' id="myTable" >  
        <thead>  
            <tr>  
                <th>Event Name</th>  
                <th>Event End</th>  
                <th>Event Description</th>  
                <th>Total Tickets</th>  
                <th>Event Start</th>  
                <th>Ticket Sale End</th>  
            </tr>  
        </thead>  
        <!--       Use PHP to input data-->
        <tbody>  
            <tr>  
                <td>Spooky Movie Marathon</td>  
                <td>2018-01-19 02:00:00</td>  
                <td>Spooky Movie Night in the Buttercup Room</td>  
                <td>16</td>  
                <td>2018-01-18 18:00:00</td> 
                <td>2018-01-18 17:00:00</td>  
            </tr>
            <tr>  
                <td>Fun ACADEMY DINOSAUR Screening!</td>  
                <td>2017-12-08 23:00:00</td>  
                <td>Come along and watch Academy Dinosaur with me!</td>  
                <td>17</td>  
                <td>2017-12-08 17:00</td> 
                <td>2017-12-08 16:45:00</td>  
            </tr>
        </tbody> 

    </table> 
</div>  


<?php include(SHARED_PATH . '/footer.php'); ?>