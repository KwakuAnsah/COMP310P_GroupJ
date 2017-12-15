<?php
require_once('../../private/initialize.php');
$page_title = 'Rate an Event';
$page = 'new.php';
include(SHARED_PATH . '/access_denied.php');

if(!isset($_SESSION['user_id'])){
    echo "<div class='no_session'>  </div>";
    redirect_to(url_for("index.php"));
}

if (is_post_request()) {
    
    $rating = [];
    $rating['event_name'] = $_POST['event_rating'] ?? '';
    $rating['host_user_id'] = $_POST['host_rating'] ?? '';
    $rating['event_description'] = $_POST['review_text'] ?? '';
    $rating['total_tickets'] = $_POST['event_id'] ?? '';
    $rating['room_id'] = $_POST['rater_user_id'] ?? '';


    $result = insert_event($rating);
    if ($result === true) {
        $new_event_id = mysqli_insert_id($db);
        $film_event['film_id'] = $_POST['film_id'] ?? '';
        $film_event['event_id'] = $new_event_id;
        insert_film_event($film_event);
        redirect_to(url_for('/events/show.php?event_id=' . $new_event_id));
    } else {
        $errors = $result;
    }
} else {
    $rating = [];
    $rating['event_name'] =  '';
    $rating['host_user_id'] =  '';
    $rating['event_description'] =  '';
    $rating['total_tickets']=  '';
    $rating['room_id'] =  '';
}

$rating_set = find_all_events();
$rating_count = mysqli_num_rows($rating_set) + 1;
mysqli_free_result($rating_set);
?>


<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <div class="event new">
        <h1>Create Event</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/events/new.php'); ?>" method="post">
            <dl>
                <dt>Event Name</dt>
                <dd><input type="text" name="event_name" value="<?php
                    echo
                    h($rating['event_name']);
                    ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Host</dt>
                <dd>
                    <select name="host_user_id">
                        <?php
                        $user_set = find_all_users();
                        while ($user = mysqli_fetch_assoc($user_set)) {
                            echo "<option value=" . $user["user_id"] . ">"
                            . h($user["username"]) . " - " . h($user["first_name"])
                            . " " . h($user["last_name"]) . "</option>";
                        }
                        mysqli_free_result($user_set);
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Category</dt>
                <dd>
                    <select name="event_category_id">
                        <?php
                        $category_set = find_all_categories();
                        while ($category = mysqli_fetch_assoc($category_set)) {
                            echo "<option value='" . $category["category_id"] .
                            "'>" . h($category["category_name"]) . "</option>";
                        }
                        mysqli_free_result($category_set);
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>

                <dt>Description</dt>
                <dd><input type="text" name="event_description" value="<?php
                    echo
                    h($rating['event_description']);
                    ?>" />
                </dd>
            </dl>
            <h2>Films</h2>
            <dl>
                <dt>Film</dt>
                <dd>
                    <select name="film_id">
                        <?php
                        $film_set = find_all_films();
                        while ($film = mysqli_fetch_assoc($film_set)) {
                            echo "<option value=" . $film["film_id"] . ">"
                            . h($film["title"]) . " ("
                            . h($film["certificate"]) . ") - "
                            . h($film["genre_name"]) . "</option>";
                        }
                        mysqli_free_result($film_set);
                        ?>
                    </select>
                </dd>
            </dl>




            <h2>Date and Time</h2>
            <p> Please select a date and type a time:</p>
            <dl>
                <dt>Event Start</dt>
                <dd><input type="datetime-local" name="event_start" value="<?php echo h($rating['event_start']); ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Event End</dt>
                <dd><input type="datetime-local" name="event_end" value="<?php echo h($rating['event_end']); ?>" />
                </dd>
            </dl>
            <h2>Location</h2>
            <dl>
                <dt>Room</dt>
                <select name="room_id">
                    <?php
                    $room_set = find_all_rooms_locations();
                    while ($room = mysqli_fetch_assoc($room_set)) {
                        echo "<option value=" . $room["room_id"] . ">"
                        . h($room["room_name"]) . " - (Capacity: "
                        . h($room["capacity"]) . "), "
                        . h($room["address_line_1"]) . ", "
                        . h($room["postcode"]) . ", "
                        . h($room["city_name"]) . ", "
                        . h($room["country_name"]) . "</option>";
                    }
                    mysqli_free_result($room_set);
                    ?>
                </select>
            </dl>
            <h2>Tickets</h2>
            <dl>
                <dt>Ticket Sale End</dt>
                <dd><input type="datetime-local" name="ticket_sale_end" value="<?php echo h($rating['ticket_sale_end']); ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Total Tickets</dt>
                <dd><input type="int" name="total_tickets" value="<?php echo h($rating['total_tickets']); ?>" />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Event" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
