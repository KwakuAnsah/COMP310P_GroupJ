<?php
require_once('../../private/initialize.php');
$page_title = 'Create Event';
$page = 'show';


if (is_post_request()) {
    $event = [];
    $event['event_id'] = $_POST['event_id'] ?? '';
    $event['event_name'] = $_POST['event_name'] ?? '';
    $event['host_user_id'] = $_POST['host_user_id'] ?? '';
    $event['event_end'] = $_POST['event_description'] ?? '';
    $event['total_tickets'] = $_POST['total_tickets'] ?? '';
    $event['room_id'] = $_POST['room_id'] ?? '';
    $event['event_category'] = $_POST['event_category'] ?? '';
    $event['event_start'] = $_POST['event_start'] ?? '';
    $event['ticket_sale_end'] = $_POST['ticket_sale_end'] ?? '';


    $result = insert_event($event);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/events/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    $event = [];
    $event['event_id'] = '';
    $event['event_name'] = '';
    $event['host_user_id'] = '';
    $event['event_end'] = '';
    $event['total_tickets'] = '';
    $event['room_id'] = '';
    $event['event_category'] = '';
    $event['event_start'] = '';
    $event['ticket_sale_end'] = '';
}

$event_set = find_all_events();
$event_count = mysqli_num_rows($event_set) + 1;
mysqli_free_result($event_set);
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
                    h($event['event_name']);
                    ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Host</dt>
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
            </dl>
            <h2>Date and Time</h2>
            <dl>
                <dt>Event Start</dt>
                <dd><input type="datetime-local" name="event_start" value="<?php echo h($event['event_start']); ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Event End</dt>
                <dd><input type="datetime-local" name="event_end" value="<?php echo h($event['event_end']); ?>" />
                </dd>
            </dl>
            <dl>
                <dt>Ticket Sale End</dt>
                <dd><input type="datetime-local" name="ticket_sale_end" value="<?php echo h($event['ticket_sale_end']); ?>" />
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
                        . h($room["room_name"]) . ", " . h($room["address_line_1"]) .
                        ", " . h($room["postcode"]) . ", " . h($room["city_name"]) .
                        ", " . h($room["country_name"]) . "</option>";
                    }
                    mysqli_free_result($room_set);
                    ?>
                </select>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Event" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
