<?php

// Users -----------------------------------------------------------------------


/* Done */ function find_all_users() {
    global $db;

    $sql = "SELECT * FROM user ";
    $sql .= "ORDER BY user_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_user_by_id($user_id) {
    global $db;
    $sql = "SELECT * FROM user ";
    $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;
}

function validate_users($user) {
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
    // first_name
    if (is_blank($user['first_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($user['first_name'], ['min' => 2, 'max' => 65])) {
        $errors[] = "Name must be between 2 and 65 characters.";
    }

    // last_name
    if (is_blank($user['first_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($user['first_name'], ['min' => 2, 'max' => 65])) {
        $errors[] = "Name must be between 2 and 65 characters.";
    }




    // position
    // Make sure we are working with an integer
    $postion_int = (int) $subject['position'];
    if ($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if ($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}

/* Done */ function insert_user($user) {
    global $db;

    $errors = validate_user($subject); //array of errors
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO user ";
    $sql .= "(email, password, first_name, last_name) ";
    $sql .= "VALUES (";
    //  $sql .= "'" . db_escape($db, $user['user_id']) . "',";
    $sql .= "'" . db_escape($db, $user['email']) . "',";
    $sql .= "'" . db_escape($db, $user['password']) . "',";
    $sql .= "'" . db_escape($db, $user['first_name']) . "',";
    $sql .= "'" . db_escape($db, $user['last_name']) . "'";
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

/* Done */ function delete_user($id) {
    global $db;
    $sql = "DELETE FROM user ";
    $sql .= "WHERE id ='" . db_escape($db, $id) . "' ";
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

/* Done */ function find_host_by_event_id($event_id){
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


// Events ----------------------------------------------------------------------


/* Done */ function find_all_events() {
    global $db;

    $sql = "SELECT * FROM event ";
    $sql .= "ORDER BY event_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_event_by_id($event_id) {
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

/* Done */ function insert_event($event) {
    global $db;

    $errors = validate_event($event); //array of errors
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO event ";
    $sql .= "(event_name, host_user_id, event_end, event_description, "
            . "total_tickets, room_id, event_category, event_start, ticket_sale_end) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $event['event_name']) . "',";
    $sql .= "'" . db_escape($db, $event['host_user_id']) . "',";
    $sql .= "'" . db_escape($db, $event['event_end']) . "',";
    $sql .= "'" . db_escape($db, $event['event_description']) . "',";
    $sql .= "'" . db_escape($db, $event['total_tickets']) . "',";
    $sql .= "'" . db_escape($db, $event['room_id']) . "',";
    $sql .= "'" . db_escape($db, $event['event_category']) . "',";
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

/* Done */ function update_event($event) {
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

/* Done */ function delete_event($event_id) {
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


// Categories ----------------------------------------------------------------------

/* Done */ function find_all_categories() {
    global $db;

    $sql = "SELECT * FROM category ";
    $sql .= "ORDER BY event_id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_category_by_id($category_id) {
    global $db;

    $sql = "SELECT * FROM event ";
    $sql .= "WHERE event_id='" . db_escape($db, $category_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $category = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $category; //returns an associative array
}

/* Done */ function find_category_by_event_id($event_id) {
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



// Bookings --------------------------------------------------------------------


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

    $sql = "SELECT * FROM booking ";
    $sql .= "WHERE booking_id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $booking = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $booking; //returns an associative array
}

function validate_booking($booking) {
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

function insert_booking($booking) {
    global $db;

    $errors = validate_booking($booking); //array of errors
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO booking ";
    $sql .= "(booking_id, number_of_tickets) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $event['booking_id']) . "',";
    $sql .= "'" . db_escape($db, $event['number_of_tickets']) . "',";
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
    $sql .= "booking_id='" . db_escape($db, $booking['booking_id']) . "', ";
    $sql .= "number_of_tickets='" . db_escape($db, $booking['number_of_tickets']) . "', ";
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
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// Booking_has_user ------------------------------------------------------------


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

//EDIT VALIDATE_BOOKING_HAS_USER FUNCTION
function validate_booking_has_user($booking_has_user) {
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

function insert_booking_has_user($booking_has_user) {
    global $db;

    $errors = validate_booking_has_user($booking_has_user); //array of errors
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO booking_has_user ";
    $sql .= "(booking_id, user_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $booking_has_user['booking_id']) . "',";
    $sql .= "'" . db_escape($db, $booking_has_user['user_id']) . "',";
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

function update_booking_has_user($booking_has_user) {
    global $db;
    $errors = validate_booking_has_user($booking_has_user); //array of errors
    if (!empty($errors)) {
        return $errors;
    }
    $sql = "UPDATE booking_has_user SET ";
    $sql .= "booking_id='" . db_escape($db, $booking_has_user['booking_id']) . "', ";
    $sql .= "user_id='" . db_escape($db, $booking_has_user['user_id']) . "', ";
    $sql .= "WHERE booking_id='" . db_escape($db, $booking_has_user['booking_id']) . "' ";
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

// Event_has_booking -----------------------------------------------------------


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

//EDIT VALIDATE_BOOKING_HAS_USER FUNCTION
function validate_event_has_booking($event_has_booking) {
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

function insert_event_has_booking($event_has_booking) {
    global $db;

    $errors = validate_event_has_booking($event_has_booking); //array of errors
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO event_has_booking ";
    $sql .= "(event_id, booking_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $event_has_booking['event_id']) . "',";
    $sql .= "'" . db_escape($db, $event_has_booking['booking_id']) . "',";
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

function delete_event_has_booking($event_id) {
    global $db;
    $sql = "DELETE FROM event_has_booking ";
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

// Rating ----------------------------------------------------------------------


/* Done */ function find_all_ratings() {
    global $db;

    $sql = "SELECT * FROM rating ";
    $sql .= "ORDER BY event_id ASC, event_rating ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_rating_by_id($rating_id) {
    global $db;

    $sql = "SELECT * FROM rating ";
    $sql .= "WHERE rating_id='" . db_escape($db, $rating_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $rating = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $rating; //returns an associative array
}

/* Done */ function find_rating_by_event_id($event_id) {
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

/* Done */ function insert_rating($rating) {
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

/* Done */ function update_rating($rating) {
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

/* Done */ function delete_rating($rating_id) {
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

/* Done */ function find_avg_host_rating($host_user_id) {
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


/* Done */ function find_all_films() {
    global $db;

    $sql = "SELECT * FROM film ";
    $sql .= "ORDER BY title ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_film_by_id($film_id) {
    global $db;

    $sql = "SELECT * FROM film ";
    $sql .= "WHERE film_id='" . db_escape($db, $film_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $film = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $film; //returns an associative array
}

/* Done */ function find_films_by_event_id($event_id) {
    global $db;

    $sql = "SELECT title, tagline, certificate FROM film ";
    $sql .= "JOIN film_event ON film_event.film_id = film.film_id ";
    $sql .= "JOIN event ON event.event_id = film_event.event_id ";
    $sql .= "WHERE event.event_id='" . db_escape($db, $event_id) . "'";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_number_of_films_by_event_id($event_id) {
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

// Room -----------------------------------------------------------------------


/* Done */ function find_all_rooms() {
    global $db;

    $sql = "SELECT * FROM room ";
    $sql .= "ORDER BY room_name ASC ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_room_by_id($room_id) {
    global $db;

    $sql = "SELECT * FROM room ";
    $sql .= "WHERE room_id='" . db_escape($db, $room_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $room = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $room; //returns an associative array
}

/* Done */ function find_room_by_event_id($event_id) {
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

/* Done */ function find_address_by_room_id($room_id) {
    global $db;

    $sql = "SELECT * FROM address ";
    $sql .= "JOIN room ON room.address_id = address.address_id  ";
    $sql .= "WHERE room.room_id='" . db_escape($db, $room_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $room = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $room; //returns an associative array
}

// Countries -------------------------------------------------------------------


/* Done */ function find_all_countries() {
    global $db;

    $sql = "SELECT * FROM country ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_all_country_names() {
    global $db;

    $sql = "SELECT country_name FROM country ";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_country_by_id($country_id) {
    global $db;

    $sql = "SELECT * FROM country ";
    $sql .= "WHERE country_id='" . db_escape($db, $country_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $country = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $country; //returns an associative array
}

// Cities -------------------------------------------------------------------


/* Done */ function find_all_cities() {
    global $db;

    $sql = "SELECT * FROM city ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_all_city_names() {
    global $db;

    $sql = "SELECT city_name FROM country ";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

/* Done */ function find_city_by_id($city_id) {
    global $db;

    $sql = "SELECT * FROM city ";
    $sql .= "WHERE city_id='" . db_escape($db, $city_id) . "'";
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $city = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $city; //returns an associative array
}
?>