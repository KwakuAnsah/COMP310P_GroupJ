

<?php

if (is_post_request()) {

    // Handle form values
    $user = [];
    $user['password'] = $_POST['password'] ?? '';
    $user['first_name'] = $_POST['first_name'] ?? '';
    $user['last_name'] = $_POST['last_name'] ?? '';
    $user['date_of_birth'] = $_POST['date_of_birth'] ?? '';
    $user['username'] = $_POST['username'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['password_check'] = $_POST['password_check'] ?? '';

    $address = [];
    $address['address_line_1'] = $_POST['address_line_1'] ?? '';
    $address['city_id'] = $_POST['city_id'] ?? '';
    $address['postcode'] = $_POST['postcode'] ?? '';

    $address_errors = validate_address($address);
    $user_errors = validate_user($user);

    if (empty($address_errors) && empty($user_errors)) {
        $address_result = insert_address($address);
        $new_address_id = mysqli_insert_id($db);
        $user['address_id'] = $new_address_id;
        $user_result = insert_user($user);
        $new_user_id = mysqli_insert_id($db);
        $_SESSION["user_id"] = $new_user_id;
        $_SESSION["first_name"] = $user["first_name"];
        $_SESSION["last_name"] = $user["last_name"];
        $_SESSION["username"] = $user["username"];

        redirect_to(url_for('/users/show.php?user_id=' . $new_user_id));
    }
    $errors = array_merge($address_errors, $user_errors);
} else {
    $user = [];
    $user['password'] = '';
    $user['first_name'] = '';
    $user['last_name'] = '';
    $user['date_of_birth'] = '';
    $user['username'] = '';
    $user['address_id'] = '';
    $user['email'] = '';

    $address = [];
    $address['address_line_1'] = '';
    $address['city_id'] = '';
    $address['postcode'] = '';
}

$user_set = find_all_users();
$user_count = mysqli_num_rows($user_set) + 1;
mysqli_free_result($user_set);
?>

