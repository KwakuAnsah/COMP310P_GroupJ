<?php

// Subjects

function find_all_subjects() {
    global $db;

    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY position ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_subject_by_id($id) {
    global $db;
// uses dynamic data so needs to escaped to avoid SQL injection
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'"; 
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; //returns an associative array
}

function validate_subject($subject) {
    $errors = [];

    // menu_name
    if (is_blank($subject['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
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

function insert_subject($subject) {
    global $db;
    $errors = validate_subject($subject); //array of errors
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $subject['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $subject['position']) . "',";
    $sql .= "'" . db_escape($db, $subject['visible']) . "'";
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

function update_subject($subject) {
    // Input is an associative array
    // Returns true or displays the error number 
    // and disconnects from the database
    global $db;

    $errors = validate_subject($subject); //array of errors
    if (!empty($errors)) {
        return $errors;
    }


    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . db_escape($db, $subject['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $subject['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $subject['visible']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $subject['id']) . "' ";
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

function delete_subject($id) {
    global $db;
    $sql = "DELETE FROM subjects ";
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

// Events

function find_all_events() {
    global $db;

    $sql = "SELECT * FROM events ";
    $sql .= "ORDER BY subject_id ASC, position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_event_by_id($id) {
    global $db;

    $sql = "SELECT * FROM events ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    
    confirm_result_set($result);
    $event = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $event; //returns an associative array
}

function validate_event($event) {
    $errors = [];

    // subject_id
    if (is_blank($event['subject_id'])) {
        $errors[] = "Subject cannot be blank.";
    }

    // menu_name
    if (is_blank($event['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($event['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $event['id'] ?? '0';
    if(!has_unique_event_menu_name($event['menu_name'],$current_id)){
        $errors[] = "Menu name must be unique.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $event['position'];
    if ($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if ($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $event['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    // content
    if (is_blank($event['content'])) {
        $errors[] = "Content cannot be blank.";
    }

    return $errors;
}

function insert_event($event) {
    global $db;

    $errors = validate_event($event); //array of errors
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO events ";
    $sql .= "(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $event['subject_id']) . "',";
    $sql .= "'" . db_escape($db, $event['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $event['position']) . "',";
    $sql .= "'" . db_escape($db, $event['visible']) . "',";
    $sql .= "'" . db_escape($db, $event['content']) . "'";
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

    $sql = "UPDATE events SET ";
    $sql .= "subject_id='" . db_escape($db, $event['subject_id']) . "', ";
    $sql .= "menu_name='" . db_escape($db, $event['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $event['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $event['visible']) . "', ";
    $sql .= "content='" . db_escape($db, $event['content']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $event['id']) . "' ";
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

function delete_event($id) {
    global $db;
    $sql = "DELETE FROM events ";
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
?>

