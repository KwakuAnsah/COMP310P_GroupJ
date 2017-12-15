<?php // Adapted from: (Lynda.com - Kevin Skoglund, 2017) ?>

<?php

// is_blank('abcd')
// * validate data presence
// * uses trim() so empty spaces don't count
function is_blank($value) {
    return !isset($value) || trim($value) === '';
}

// has_length_greater_than('abcd', 3)
function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
}

// has_length_less_than('abcd', 5)
function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
}

// has_length_exactly('abcd', 4)
function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
}

// has_length('abcd', ['min' => 3, 'max' => 5])
function has_length($value, $options) {
    if (isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
        return false;
    } elseif (isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
        return false;
    } elseif (isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
        return false;
    } else {
        return true;
    }
}

// has_inclusion_of( 5, [1,3,5,7,9] )
// * validate inclusion in a set
function has_inclusion_of($value, $set) {
    return in_array($value, $set);
}

// has_exclusion_of( 5, [1,3,5,7,9] )
// * validate exclusion from a set
function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
}

// has_string('nobody@nowhere.com', '.com')
// * validate inclusion of character(s)
function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
}

// has_valid_email_format('nobody@nowhere.com')

function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}

// has_valid_password_format('nobody@nowhere.com')

function has_valid_password_format($value) {
    $password_regex = '((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{4,20}))';
    return preg_match($password_regex, $value) === 1;
}

// email is unique

function has_unique_email($email, $current_id = "0") {
    global $db;

    $sql = "SELECT * FROM user ";
    $sql .= "WHERE email='" . db_escape($db, $email) . "' ";
    $sql .= "AND id != '" . db_escape($db, $current_id) . "'";

    $email_set = mysqli_query($db, $sql);
    $email_count = mysqli_num_rows($email_set);
    mysqli_free_result($email_set);

    return $email_count === 0;
}

function event_is_in_past($event_id) {
    $event = find_event_by_id($event_id);
    $now = time(); //ms
    $timestamp_event_end = strtotime($event['event_end']); //ms
    if ($timestamp_event_end > $now) {
        //IF in Future
        return 0;
    }
    return 1;
}

?>
