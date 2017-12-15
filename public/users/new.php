<?php
require_once('../../private/initialize.php');
$page_title = 'Create new user';
$page = 'user_new.php'
?>

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
    if (empty($address_errors)) {
        $address_result = insert_address($address);
        if ($address_result === true) {
            $new_address_id = mysqli_insert_id($db);
            $user['address_id'] = $new_address_id;
            $user_result = insert_user($user);
            if ($user_result === true) {
                $new_user_id = mysqli_insert_id($db);
                redirect_to(url_for('/users/show.php?user_id=' . $new_user_id));
            } else {
                $user_result = $user_errors;
            }
        }
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

<!-- Link to our header file -->
<?php include(SHARED_PATH . '/header.php'); ?>

<!-- Start of body -->
<div class="container-fluid text-center">
    <div class="user_new">
        <h1>Create an account</h1>
        <br>
        <h5>Please enter your details below. All fields are compulsory.</h5>
        <br>
        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/users/new.php'); ?>" method="post">
            <dl>
                <dt>First Name</dt>
                <dd><input type="text" name="first_name" value="<?php
                    echo
                    h($user['first_name']);
                    ?>" /></dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="last_name" value="<?php
                    echo
                    h($user['last_name']);
                    ?>" /></dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd><input type="text" name="email" value="<?php
                    echo
                    h($user['email']);
                    ?>" /></dd>
            </dl>

            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" value="<?php echo h($user['username']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Password</dt>
                <dd><input type="text" name="password" value="" /></dd>
            </dl>
            <dl>
                <dt>Confirm Password</dt>
                <dd><input type="text" name="password_check" value="" /></dd>
            </dl>
            <dl>
                <dt>Date of Birth</dt>
                <dd><input type="date" name="date_of_birth" value="<?php
                    echo
                    h($user['date_of_birth']);
                    ?>" /></dd>
            </dl>
            <dl>
                <dt>Address Line 1</dt>
                <dd><input type="text" name="address_line_1" value="<?php
                    echo
                    h($address['address_line_1']);
                    ?>" /></dd>
            </dl> 
            <dl>
                <dt>Postcode</dt>
                <dd><input type="text" name="postcode" value="<?php
                    echo
                    h($address['postcode']);
                    ?>" /></dd>
            </dl>             
            <dl>
                <dt>City</dt>
                <dd>
                    <select name="city_id">
                        <?php
                        $city_set = find_all_cities();
                        while ($city = mysqli_fetch_assoc($city_set)) {
                            echo "<option value=" . $city["city_id"] . ">"
                            . h($city["city_name"]) . "</option>";
                        }
                        mysqli_free_result($city_set);
                        ?>
                    </select>
                </dd>
            </dl>
            <br>
            <br>
            <!-- * * * button to submit details - EDIT LINK * * * -->    
            <div id="operations">
                <input class="submission_btn btn btn-lg btn-default" type="submit" name="create_account" value="Create Account">
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
