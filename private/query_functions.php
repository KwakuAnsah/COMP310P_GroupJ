<?php

// Users ----DONE except validate users-----------------------------------------
function find_all_users() {
    global $db;

    $sql = "SELECT * FROM user ";
    $sql .= "ORDER BY user_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_user_by_id($user_id) {
    global $db;
    $sql = "SELECT user.user_id, user.password, user.first_name, user.last_name,";
    $sql .= " user.username, user.address_id, user.email, user.date_of_birth, ";
    $sql .= "address.address_id, address_line_1, postcode, city.city_id, ";
    $sql .= "city_name, country.country_id, country_name FROM user ";
    $sql .= "JOIN address ON address.address_id = user.address_id ";
    $sql .= "JOIN city ON address.city_id = city.city_id ";
    $sql .= "JOIN country ON country.country_id = city.country_id ";
    $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;
}

function validate_user($user) {
    $errors = [];
    /* TESTS 
     * CANNOT BE BLANK
      if (is_blank($event['XXXX'])) {
      $errors[] = "XXXXX cannot be blank.";
      }
     * 
     * MUST BE UNIQUE
      $current_id = $event['id'] ?? '0';
      if(!has_unique_event_menu_name($event['menu_name'],$current_id)){
      $errors[] = "Menu name must be unique.";
      }
     * 
     * MUST BE WITHIN A RANGE (INTs)
      $postion_int = (int) $event['position'];
      if ($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
      }
      if ($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
      }
     * 
     * STRING LENGTH MUST BE WITH RANGE
     * if (!has_length($event['menu_name'], ['min' => 2, 'max' => 150])) {
      $errors[] = "Name must be between 2 and 150 characters.";
      }
     * 
     * STRING MUST INCLUDE 0 OR 1 / Make sure we are working with a string
      $visible_str = (string) $event['visible'];
      if (!has_inclusion_of($visible_str, ["0", "1"])) {
      $errors[] = "Visible must be true or false.";
      }

     */
    // first_name -------------------------------------------------------------
    //      First name cannot be blank.
    //      First name must be between 2 and 65 characters.
    // ------------------------------------------------------------------------

    if (is_blank($user['first_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($user['first_name'], ['min' => 2, 'max' => 65])) {
        $errors[] = "Name must be between 2 and 65 characters.";
    }

    // last_name -------------------------------------------------------------
    //      Last name cannot be blank.
    //      Last name must be between 2 and 100 characters.
    // ------------------------------------------------------------------------
    if (is_blank($user['first_name'])) {
        $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user['first_name'], ['min' => 2, 'max' => 100])) {
        $errors[] = "Last name must be between 2 and 100 characters.";
    }
    return $errors;
}

function insert_user($user) {
    global $db;


    $errors = validate_user($user);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO user ";
    $sql .= "(email, password, first_name, last_name, username, address_id, date_of_birth) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $user['email']) . "',";
    $sql .= "'" . db_escape($db, $user['password']) . "',";
    $sql .= "'" . db_escape($db, $user['first_name']) . "',";
    $sql .= "'" . db_escape($db, $user['last_name']) . "',";
    $sql .= "'" . db_escape($db, $user['username']) . "',";
    $sql .= "'" . db_escape($db, $user['address_id']) . "',";
    $sql .= "'" . db_escape($db, $user['date_of_birth']) . "'";
    $sql .= ") ";

    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_user($user_id) {
    global $db;
    $sql = "DELETE FROM user ";
    $sql .= "WHERE id ='" . db_escape($db, $user_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    //For DELETE statements, $result is true false

    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_host_by_event_id($event_id) {
    global $db;


    $sql = "SELECT * FROM user ";
    $sql .= "JOIN event ON event.host_user_id = user.user_id  ";
    $sql .= "WHERE event.event_id='" . db_escape($db, $event_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $host = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $host; //returns an associative array
}

function find_all_participants_by_host($host_user_id) {
    global $db;
    $today = date("Y-m-d H:i:s");

    $sql = "SELECT user.user_id, first_name, last_name, host_user_id, "
            . "event_has_booking.event_id, booking.booking_id, "
            . "number_of_tickets, event_name, total_tickets, event_start ";
    $sql .= "FROM user "
            . "JOIN booking_has_user ON booking_has_user.user_id = user.user_id "
            . "JOIN event_has_booking ON event_has_booking.booking_id = booking_has_user.booking_id "
            . "JOIN event ON event.event_id = event_has_booking.event_id "
            . "JOIN booking ON booking.booking_id = booking_has_user.booking_id "
            . "WHERE host_user_id ='" . db_escape($db, $host_user_id) . "' "
            . "AND event_start > '" . $today . "' "
            . "ORDER BY event_start, event_name, user_id";



    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result; //returns an associative array
}

function find_all_participants_by_host_past($host_user_id) {
    global $db;
    $today = date("Y-m-d H:i:s");

    $sql = "SELECT user.user_id, first_name, last_name, host_user_id, "
            . "event_has_booking.event_id, booking.booking_id, "
            . "number_of_tickets, event_name, total_tickets, event_start ";
    $sql .= "FROM user "
            . "JOIN booking_has_user ON booking_has_user.user_id = user.user_id "
            . "JOIN event_has_booking ON event_has_booking.booking_id = booking_has_user.booking_id "
            . "JOIN event ON event.event_id = event_has_booking.event_id "
            . "JOIN booking ON booking.booking_id = booking_has_user.booking_id "
            . "WHERE host_user_id ='" . db_escape($db, $host_user_id) . "' "
            . "AND event_start < '" . $today . "' "
            . "ORDER BY event_start, event_name, user_id";



    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result; //returns an associative array
}

// Events -------DONE except validate event-------------------------------------
function find_all_events() {
    global $db;

    $sql = "SELECT * FROM event ";
    $sql .= "ORDER BY event_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_all_upcoming_events_by_host($host_user_id) {
    global $db;

    $today = date("Y-m-d H:i:s");

    $sql = "SELECT * FROM event ";
    $sql .= "WHERE host_user_id = '" . db_escape($db, $host_user_id) . "' ";
    $sql .= "AND event_start > '" . $today . "' ";
    $sql .= "ORDER BY event_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_all_past_events_by_host($host_user_id) {
    global $db;

    $today = date("Y-m-d H:i:s");

    $sql = "SELECT * FROM event ";
    $sql .= "WHERE host_user_id = '" . db_escape($db, $host_user_id) . "' ";
    $sql .= "AND event_start < '" . $today . "' ";
    $sql .= "ORDER BY event_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}


function find_all_events_detailed() {
    global $db;

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
            . "ORDER BY event_start ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_event_by_id($event_id) {
    global $db;

    $sql = "SELECT * FROM event ";
    $sql .= "WHERE event_id='" . db_escape($db, $event_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $event = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $event; //returns an associative array
}

function validate_event($event) {
    $errors = [];

    /* EXAMPLES TESTS 
     * CANNOT BE BLANK
      if (is_blank($event['XXXX'])) {
      $errors[] = "XXXXX cannot be blank.";
      }
     * 
     * MUST BE UNIQUE
      $current_id = $event['event_id'] ?? '0';
      if(!has_unique_event_menu_name($event['menu_name'],$current_id)){
      $errors[] = "Menu name must be unique.";
      }
     * 
     * MUST BE WITHIN A RANGE (INTs)
      $postion_int = (int) $event['position'];
      if ($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
      }
      if ($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
      }
     * 
     * STRING LENGTH MUST BE WITH RANGE
     * if (!has_length($event['menu_name'], ['min' => 2, 'max' => 150])) {
      $errors[] = "Name must be between 2 and 150 characters.";
      }
     * 
     * STRING MUST INCLUDE 0 OR 1 / Make sure we are working with a string
      $visible_str = (string) $event['visible'];
      if (!has_inclusion_of($visible_str, ["0", "1"])) {
      $errors[] = "Visible must be true or false.";
      }

     */

    // event_name -------------------------------------------------------------
    //      Event name cannot be blank.
    //      Name must be between 2 and 150 characters.
    // ------------------------------------------------------------------------
    if (is_blank($event['event_name'])) {
        $errors[] = "Event name cannot be blank.";
    } elseif (!has_length($event['event_name'], ['min' => 2, 'max' => 150])) {
        $errors[] = "Name must be between 2 and 150 characters.";
    }

    // host_user_id -----------------------------------------------------------
    //      You must log in to create an event. (host_user_id cannot be blank).
    // ------------------------------------------------------------------------
    if (is_blank($event['host_user_id'])) {
        $errors[] = "You must log in to create an event. (host_user_id cannot be blank).";
    }

    // event_end --------------------------------------------------------------
    //      Event end time must be after event start time.
    // ------------------------------------------------------------------------
    $event_end = (int) $event['event_end'];
    $event_start = (int) $event['event_start'];
    if ($event_end < $event_start) {
        $errors[] = "Event end time must be after event start time.";
    }

    // ticket_sale_end --------------------------------------------------------
    //      The time that ticket sales end must be before the event start time.
    // ------------------------------------------------------------------------
    $event_end = (int) $event['event_end'];
    $event_start = (int) $event['event_start'];
    if ($event_end < $event_start) {
        $errors[] = "Event end time must be after event start time.";
    }

    // event_start ------------------------------------------------------------
    //      The event start time cannot be in the past.
    // ------------------------------------------------------------------------
    $event_end = (int) $event['event_end'];
    $todays_date_obj = new Date() . setHours(0, 0, 0, 0);
    $todays_date_int = (int) $todays_date_obj;
    if ($todays_date_int > $event_start) {
        $errors[] = "The event start time cannot be in the past.";
    }

    // event_description  -----------------------------------------------------
    //      Event description cannot be blank.
    // ------------------------------------------------------------------------
    if (is_blank($event['event_description'])) {
        $errors[] = "Event description cannot be blank.";
    }

    return $errors;
}

function insert_event($event) {
    global $db;

    /* $errors = validate_event($event); //array of errors
      if (!empty($errors)) {
      return $errors;
      } */

    $sql = "INSERT INTO event ";
    $sql .= "(event_name, host_user_id, event_end, event_description, "
            . "total_tickets, room_id, event_category_id, event_start, ticket_sale_end) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $event['event_name']) . "',";
    $sql .= "'" . db_escape($db, $event['host_user_id']) . "',";
    $sql .= "'" . db_escape($db, $event['event_end']) . "',";
    $sql .= "'" . db_escape($db, $event['event_description']) . "',";
    $sql .= "'" . db_escape($db, $event['total_tickets']) . "',";
    $sql .= "'" . db_escape($db, $event['room_id']) . "',";
    $sql .= "'" . db_escape($db, $event['event_category_id']) . "',";
    $sql .= "'" . db_escape($db, $event['event_start']) . "',";
    $sql .= "'" . db_escape($db, $event['ticket_sale_end']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_event($event) {
    global $db;
    $errors = validate_event($event); //array of errors
    if (!empty($errors)) {
        return $errors;
    }
    $sql = "UPDATE event SET ";
    $sql .= "event_id='" . db_escape($db, $event['event_id']) . "', ";
    $sql .= "event_name='" . db_escape($db, $event['event_name']) . "', ";
    $sql .= "host_user_id='" . db_escape($db, $event['host_user_id']) . "', ";
    $sql .= "event_end='" . db_escape($db, $event['event_end']) . "', ";
    $sql .= "event_description='" . db_escape($db, $event['event_description']) . "', ";
    $sql .= "total_tickets='" . db_escape($db, $event['total_tickets']) . "', ";
    $sql .= "room_id='" . db_escape($db, $event['room_id']) . "', ";
    $sql .= "event_category='" . db_escape($db, $event['event_category']) . "', ";
    $sql .= "event_start='" . db_escape($db, $event['event_start']) . "', ";
    $sql .= "ticket_sale_end='" . db_escape($db, $event['ticket_sale_end']) . "' ";
    $sql .= "WHERE event_id='" . db_escape($db, $event['event_id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_event($event_id) {
    global $db;
    $sql = "DELETE FROM event ";
    $sql .= "WHERE event_id ='" . db_escape($db, $event_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    //For DELETE statements, $result is true false

    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// Categories ----DONE----------------------------------------------------------
function find_all_categories() {
    global $db;

    $sql = "SELECT * FROM category ";
    $sql .= "ORDER BY category_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_category_by_id($category_id) {
    global $db;

    $sql = "SELECT * FROM event ";
    $sql .= "WHERE event_id='" . db_escape($db, $category_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $category = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $category; //returns an associative array
}

function find_category_by_event_id($event_id) {
    global $db;

    $sql = "SELECT * FROM category ";
    $sql .= "JOIN event ON event.event_category_id = category.category_id ";
    $sql .= "WHERE event.event_id='" . db_escape($db, $event_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $category = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $category; //returns an associative array
}

// Bookings ----DONE---------------------------------------------------
function find_all_bookings() {
    global $db;

    $sql = "SELECT * FROM booking ";
    $sql .= "ORDER BY booking_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_booking_by_id($id) {
    global $db;

    $sql = "SELECT booking.booking_id, number_of_tickets, user_id, event_id ";
    $sql .= "FROM booking ";
    $sql .= "JOIN event_has_booking ON event_has_booking.booking_id = booking.booking_id ";
    $sql .= "JOIN booking_has_user ON booking_has_user.booking_id = booking.booking_id ";
    $sql .= "WHERE booking.booking_id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $booking = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $booking; //returns an associative array
}

function validate_booking($booking) {
    $errors = [];

    // number_of_tickets -------------------------------------------------------------
    //      Please fill in the number of tickets.
    //      You must order at least one ticket.
    //      There's not enough tickets to meet your request. Please order less tickets.
    // ------------------------------------------------------------------------
    if (is_blank($booking['number_of_tickets'])) {
        $errors[] = "Please fill in the number of tickets.";
    }
    if ($booking['number_of_tickets'] <= 0) {
        $errors[] = "You must order at least one ticket.";
    }
    $event = find_event_by_id($booking['event_id']);
    $tickets_sold = find_tickets_sold($booking['event_id']);
    $tickets_remaining = $event['total_tickets'] - $tickets_sold;
    if ($booking['number_of_tickets'] > $tickets_remaining) {
        if ($tickets_remaining == 1) {
            $errors[] = "There is only " . $tickets_remaining . "ticket remaining.  Please order less tickets.";
        } else {
            $errors[] = "There are only " . $tickets_remaining . "tickets remaining.  Please order less tickets.";
        }
    }
    return $errors;
}

function insert_booking($booking) {
    global $db;

    $errors = validate_booking($booking); //array of errors
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO booking ";
    $sql .= "(number_of_tickets) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $booking['number_of_tickets']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
// For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_booking($booking) {
    global $db;
    $errors = validate_booking($booking); //array of errors
    if (!empty($errors)) {
        return $errors;
    }
    $sql = "UPDATE booking SET ";
    $sql .= "number_of_tickets='" . db_escape($db, $booking['number_of_tickets']) . "' ";
    $sql .= "WHERE booking_id='" . db_escape($db, $booking['booking_id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
// For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_booking($booking_id) {
    global $db;
    $sql = "DELETE FROM booking ";
    $sql .= "WHERE booking_id ='" . db_escape($db, $booking_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
//For DELETE statements, $result is true false

    if ($result) {
        delete_booking_has_user($booking_id);
        delete_event_has_booking($booking_id);
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_tickets_sold($event_id) {
    global $db;

    $sql = "SELECT SUM(number_of_tickets) AS tickets_sold FROM booking ";
    $sql .= "JOIN event_has_booking ON event_has_booking.booking_id = booking.booking_id ";
    $sql .= "WHERE event_has_booking.event_id ='" . $event_id . "'";
    $result = mysqli_query($db, $sql);
    if (!$result) {
        return '0';
    }
    $tickets_sold = mysqli_fetch_array($result);
    mysqli_free_result($result);
    return $tickets_sold[0];
}

function find_total_tickets($event_id) {
    global $db;

    $sql = "SELECT total_tickets FROM event ";
    $sql .= "WHERE event_id ='" . $event_id . "'";
    $result = mysqli_query($db, $sql);
    if (!$result) {
        return '0';
    }
    $total_tickets = mysqli_fetch_array($result);
    mysqli_free_result($result);
    return $total_tickets[0];
}

// Booking_has_user -----------------------------------------------------------------------

function find_all_booking_has_user() {
    global $db;

    $sql = "SELECT * FROM booking_has_user ";
    $sql .= "ORDER BY booking_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_booking_has_user_by_id($id) {
    global $db;

    $sql = "SELECT * FROM booking_has_user ";
    $sql .= "WHERE booking_id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $booking_has_user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $booking_has_user; //returns an associative array
}

function insert_booking_has_user($booking_has_user) {
    global $db;

    $sql = "INSERT INTO booking_has_user ";
    $sql .= "(booking_id, user_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $booking_has_user['booking_id']) . "',";
    $sql .= "'" . db_escape($db, $booking_has_user['user_id']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
// For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_booking_has_user($booking_id) {
    global $db;
    $sql = "DELETE FROM booking_has_user ";
    $sql .= "WHERE booking_id ='" . db_escape($db, $booking_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
//For DELETE statements, $result is true false

    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// Event_has_booking --------NEED TO CHECK---------------------------------------------------

function find_all_event_has_booking() {
    global $db;

    $sql = "SELECT * FROM event_has_booking ";
    $sql .= "ORDER BY event_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_event_has_booking_by_id($id) {

    global $db;

    $sql = "SELECT * FROM event_has_booking ";
    $sql .= "WHERE event_id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $event_has_booking = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $event_has_booking; //returns an associative array
}

function insert_event_has_booking($event_has_booking) {
    global $db;

    $sql = "INSERT INTO event_has_booking ";
    $sql .= "(event_id, booking_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $event_has_booking['event_id']) . "',";
    $sql .= "'" . db_escape($db, $event_has_booking['booking_id']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
// For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_event_has_booking($event_has_booking) {
    global $db;
    $errors = validate_event_has_booking($event_has_booking); //array of errors
    if (!empty($errors)) {
        return $errors;
    }
    $sql = "UPDATE event_has_booking SET ";
    $sql .= "event_id='" . db_escape($db, $event_has_booking['event_id']) . "', ";
    $sql .= "booking_id='" . db_escape($db, $event_has_booking['booking_id']) . "', ";
    $sql .= "WHERE event_id='" . db_escape($db, $event_has_booking['event_id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
// For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_event_has_booking($booking_id) {
    global $db;
    $sql = "DELETE FROM event_has_booking ";
    $sql .= "WHERE booking_id ='" . db_escape($db, $booking_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
//For DELETE statements, $result is true false

    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// Rating ----DONE except validate rating-----------------------------------


function find_all_ratings() {
    global $db;

    $sql = "SELECT * FROM rating ";
    $sql .= "ORDER BY event_id ASC, event_rating ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_rating_by_id($rating_id) {
    global $db;

    $sql = "SELECT * FROM rating ";
    $sql .= "WHERE rating_id='" . db_escape($db, $rating_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $rating = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $rating; //returns an associative array
}

function find_rating_by_event_id($event_id) {
    global $db;

    $sql = "SELECT * FROM rating ";
    $sql .= "WHERE event_id='" . db_escape($db, $event_id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    if ($rating = mysqli_fetch_assoc($result)) {
        return '';
    }
    mysqli_free_result($result);
    return $rating; //returns an associative array
}

function validate_rating($rating) {
    $errors = [];

    /* EXAMPLES TESTS 
     * CANNOT BE BLANK
      if (is_blank($event['XXXX'])) {
      $errors[] = "XXXXX cannot be blank.";
      }
     * 
     * MUST BE UNIQUE
      $current_id = $event['event_id'] ?? '0';
      if(!has_unique_event_menu_name($event['menu_name'],$current_id)){
      $errors[] = "Menu name must be unique.";
      }
     * 
     * MUST BE WITHIN A RANGE (INTs)
      $postion_int = (int) $event['position'];
      if ($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
      }
      if ($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
      }
     * 
     * STRING LENGTH MUST BE WITH RANGE
     * if (!has_length($event['menu_name'], ['min' => 2, 'max' => 150])) {
      $errors[] = "Name must be between 2 and 150 characters.";
      }
     * 
     * STRING MUST INCLUDE 0 OR 1 / Make sure we are working with a string
      $visible_str = (string) $event['visible'];
      if (!has_inclusion_of($visible_str, ["0", "1"])) {
      $errors[] = "Visible must be true or false.";
      }

     */

// event_name -------------------------------------------------------------
//      Event name cannot be blank.
//      Name must be between 2 and 150 characters.
// ------------------------------------------------------------------------
    if (is_blank($event['event_name'])) {
        $errors[] = "Event name cannot be blank.";
    } elseif (!has_length($event['event_name'], ['min' => 2, 'max' => 150])) {
        $errors[] = "Name must be between 2 and 150 characters.";
    }

// host_user_id -----------------------------------------------------------
//      You must log in to create an event. (host_user_id cannot be blank).
// ------------------------------------------------------------------------
    if (is_blank($event['host_user_id'])) {
        $errors[] = "You must log in to create an event. (host_user_id cannot be blank).";
    }

// event_end --------------------------------------------------------------
//      Event end time must be after event start time.
// ------------------------------------------------------------------------
    $event_end = (int) $event['event_end'];
    $event_start = (int) $event['event_start'];
    if ($event_end < $event_start) {
        $errors[] = "Event end time must be after event start time.";
    }

// ticket_sale_end --------------------------------------------------------
//      The time that ticket sales end must be before the event start time.
// ------------------------------------------------------------------------
    $event_end = (int) $event['event_end'];
    $event_start = (int) $event['event_start'];
    if ($event_end < $event_start) {
        $errors[] = "Event end time must be after event start time.";
    }

// event_start ------------------------------------------------------------
//      The event start time cannot be in the past.
// ------------------------------------------------------------------------
    $event_end = (int) $event['event_end'];
    $todays_date_obj = new Date() . setHours(0, 0, 0, 0);
    $todays_date_int = (int) $todays_date_obj;
    if ($todays_date_int > $event_start) {
        $errors[] = "The event start time cannot be in the past.";
    }

// event_description  -----------------------------------------------------
//      Event description cannot be blank.
// ------------------------------------------------------------------------
    if (is_blank($event['event_description'])) {
        $errors[] = "Event description cannot be blank.";
    }

    return $errors;
}

//EDIT VALIDATE_RATING   FUNCTION
function insert_rating($rating) {
    global $db;

    $errors = validate_rating($rating); //array of errors
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO rating ";
    $sql .= "(event_rating, host_rating, review_text, event_id, "
            . "user_ID(rater)) VALUES (";
    $sql .= "'" . db_escape($db, $rating['event_rating']) . "',";
    $sql .= "'" . db_escape($db, $rating['host_rating']) . "',";
    $sql .= "'" . db_escape($db, $rating['review_text']) . "',";
    $sql .= "'" . db_escape($db, $rating['event_id']) . "',";
    $sql .= "'" . db_escape($db, $rating['rater_user_id']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
// For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_rating($rating) {
    global $db;
    $errors = validate_event($event); //array of errors
    if (!empty($errors)) {
        return $errors;
    }
    $sql = "UPDATE rating SET ";
    $sql .= "rating_id='" . db_escape($db, $rating['rating_id']) . "', ";
    $sql .= "event_rating='" . db_escape($db, $rating['event_rating']) . "', ";
    $sql .= "host_rating='" . db_escape($db, $rating['host_rating']) . "', ";
    $sql .= "review_text='" . db_escape($db, $rating['review_text']) . "', ";
    $sql .= "event_id='" . db_escape($db, $rating['event_id']) . "', ";
    $sql .= "rater_user_id='" . db_escape($db, $rating['ticket_sale_end']) . "' ";
    $sql .= "WHERE ratingt_id='" . db_escape($db, $rating['rating_id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
// For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_rating($rating_id) {
    global $db;
    $sql = "DELETE FROM rating ";
    $sql .= "WHERE raring_id ='" . db_escape($db, $rating_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
//For DELETE statements, $result is true false

    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_avg_host_rating($host_user_id) {
    global $db;

    $sql = "SELECT AVG(host_rating) FROM rating ";
    $sql .= "JOIN event ON event.event_id = rating.event_id";
    $sql .= " WHERE host_user_id='" . db_escape($db, $host_user_id) . "' ";
    $result = mysqli_query($db, $sql);
    if (!$result) {
        return 'No Rating';
    }

    $rating = mysqli_fetch_array($result);
    mysqli_free_result($result);
    return $rating[0];
}

// Film  ----------------------------------------------------------------------


function find_all_films() {
    global $db;

    $sql = "SELECT film.film_id, title, tagline, certificate, genre_name FROM film ";
    $sql .= "JOIN film_film_genre ON film_film_genre.film_id = film.film_id ";
    $sql .= "JOIN film_genre ON film_film_genre.genre_id = film_genre.genre_id ";
    $sql .= "ORDER BY title ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_film_by_id($film_id) {
    global $db;

    $sql = "SELECT * FROM film ";
    $sql .= "WHERE film_id='" . db_escape($db, $film_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $film = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $film; //returns an associative array
}

function find_films_by_event_id($event_id) {
    global $db;

    $sql = "SELECT title, tagline, certificate FROM film ";
    $sql .= "JOIN film_event ON film_event.film_id = film.film_id ";
    $sql .= "JOIN event ON event.event_id = film_event.event_id ";
    $sql .= "WHERE event.event_id='" . db_escape($db, $event_id) . "'";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_number_of_films_by_event_id($event_id) {
    global $db;

    $sql = "SELECT COUNT(event_id) FROM film_event ";
    $sql .= "WHERE event_id='" . db_escape($db, $event_id) . "'";
    $result = mysqli_query($db, $sql);
    if (!$result) {
        return 'No Rating';
    }
    $number_of_films = mysqli_fetch_array($result);
    mysqli_free_result($result);
    return $number_of_films[0];
}

// Film_Film_Genre  -------------------------------------------------------------
/*
  function find_film_genres_by_film_id($film_id) {
  global $db;

  $sql = "SELECT genre_name FROM film_film_genre ";
  $sql .= "JOIN film ON film.film_id = film_film_genre.film_id ";
  $sql .= "JOIN film_genre ON film_genre.genre_id = film_film_genre.genre_id ";
  $sql .= "WHERE film.film_id='" . db_escape($db, $film_id) . "'";

  $result = mysqli_query($db, $sql);
  $genres = mysqli_fetch_assoc($result);
  mysqli_free_result($result);

  $prefix = $genre_list = '';
  foreach ($genres as $genre)
  {
  $genre_list .= $prefix . '"' . $genre['genre_name'] . '"';
  $prefix = ', ';
  }
  return $genre_list;
  }
 */

// Film_Event ------------------------------------------------------------------

function insert_film_event($film_event) {
    global $db;

    $sql = "INSERT INTO film_event ";
    $sql .= "(film_id, event_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $film_event['film_id']) . "', ";
    $sql .= "'" . db_escape($db, $film_event['event_id']) . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// Room ---DONE----------------------------------------------------------------

function find_all_rooms() {
    global $db;

    $sql = "SELECT * FROM room ";

    $sql .= "ORDER BY room_name ASC ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_all_rooms_locations() {
    global $db;

    $sql = "SELECT room.room_id, room_name, capacity, wheelchair_accessible, ";
    $sql .= "address.address_id, address_line_1, postcode, city.city_id, ";
    $sql .= "city_name, country.country_id, country_name  FROM address ";
    $sql .= "JOIN city ON address.city_id = city.city_id ";
    $sql .= "JOIN country ON country.country_id = city.country_id ";
    $sql .= "JOIN room ON room.address_id = address.address_id ";
    $sql .= "ORDER BY country_name ASC ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_room_by_id($room_id) {
    global $db;

    $sql = "SELECT * FROM room ";
    $sql .= "WHERE room_id='" . db_escape($db, $room_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $room = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $room; //returns an associative array
}

function find_room_by_event_id($event_id) {
    global $db;

    $sql = "SELECT * FROM room ";
    $sql .= "JOIN event ON event.room_id = room.room_id  ";
    $sql .= "WHERE event.event_id='" . db_escape($db, $event_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $room = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $room; //returns an associative array
}

// Address -----------------------------------------------------------------------

function find_address_by_room_id($room_id) {
    global $db;

    $sql = "SELECT room.room_id, room_name, capacity, wheelchair_accessible, ";
    $sql .= "address.address_id, address_line_1, postcode, city.city_id, ";
    $sql .= "city_name, country.country_id, country_name  FROM address ";
    $sql .= "JOIN city ON address.city_id = city.city_id ";
    $sql .= "JOIN country ON country.country_id = city.country_id ";
    $sql .= "JOIN room ON room.address_id = address.address_id ";
    $sql .= "WHERE room.room_id = '" . db_escape($db, $room_id) . "' ";
    $sql .= "ORDER BY country.country_name ";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $address = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $address; //returns an associative array
}

function validate_address($address) {
    $errors = [];

// address_line_1 -------------------------------------------------------------
//      Address Line 1 cannot be blank.
//      Address Line 1 must be between 2 and 150 characters.
// ------------------------------------------------------------------------
    if (is_blank($address['address_line_1'])) {
        $errors[] = "Address Line 1 cannot be blank.";
    } elseif (!has_length($address['address_line_1'], ['min' => 2, 'max' => 100])) {
        $errors[] = "Address Line 1 must be between 2 and 100 characters.";
    }
// Postcode -----------------------------------------------------------
//      Postcode cannot be blank.
//      Postcode must be between 2 and 150 characters.
// ------------------------------------------------------------------------
    if (is_blank($address['postcode'])) {
        $errors[] = "Postcode cannot be blank.";
    } elseif (!has_length($address['postcode'], ['min' => 2, 'max' => 45])) {
        $errors[] = "Postcode must be between 2 and 45 characters.";
    }
// city_id -----------------------------------------------------------
//      City_id cannot be blank.
// ------------------------------------------------------------------------
    if (is_blank($address['city_id'])) {
        $errors[] = "Please select your closest city.";
    }
    return $errors;
}

function insert_address($address) {
    global $db;


    $errors = validate_address($address);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO address ";
    $sql .= "(address_line_1, city_id, postcode) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $address['address_line_1']) . "',";
    $sql .= "'" . db_escape($db, $address['city_id']) . "',";
    $sql .= "'" . db_escape($db, $address['postcode']) . "'";
    $sql .= ") ";
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// Countries -------------------------------------------------------------------


/* function below is done */ function find_all_countries() {
    global

    $db;

    $sql = "SELECT * FROM country ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* function below is done */

function find_all_country_names() {
    global

    $db;

    $sql = "SELECT country_name FROM country ";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* function below is done */

function find_country_by_id(
$country_id) {
    global $db;

    $sql = "SELECT * FROM country ";
    $sql .= "WHERE country_id = '" . db_escape($db, $country_id) . "' ";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $country = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $country; //returns an associative array
}

// Cities -----DONE----------------------------------------------------------


function find_all_cities() {
    global

    $db;

    $sql = "SELECT * FROM city ORDER BY city_name ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_city_by_id($city_id) {
    global $db;

    $sql = "SELECT * FROM city ";
    $sql .= "WHERE city_id = '" . db_escape($db, $city_id) . "' ";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $city = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $city; //returns an associative array
}

?>
