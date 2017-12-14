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
    $user['first_name'] = $_POST['last_name'] ?? '';
    $user['last_name'] = $_POST['last_name'] ?? '';
    $user['date_of_birth'] = $_POST['date_of_birth'] ?? '';
    $user['username'] = $_POST['username'] ?? '';
    $user['address_id'] = $_POST['address_id'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['address_line_1'] = $_POST['address_line_1'] ?? '';
    $user['city_id'] = $_POST['city_id'] ?? '';
    $user['postcode'] = $_POST['postcode'] ?? '';


    $result = insert_user($user);
    if ($result === true) {
        $new_user_id = mysqli_insert_id($db);


        redirect_to(url_for('/users/show.php?id=' . $new_user_id));
    } else {
        $errors = $result;
    }
} else {
    $user = [];
    $user['password'] = '';
    $user['first_name'] = '';
    $user['last_name'] = '';
    $user['date_of_birth'] = '';
    $user['username'] = '';
    $user['address_id'] = '';
    $user['email'] = '';
    $user['address_line_1'];
    $user['city_id'];
    $user['postcode'];
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

        <!-- * * * EDIT ACTION LINK? * * * -->   
        <form action="<?php echo url_for('/users/new.php'); ?>" method="post">
            <dl>
                <dt>First Name</dt>
                <dd><input type="text" name="first_name" value="" /></dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="last_name" value="" /></dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd><input type="text" name="email" value="" /></dd>
            </dl>

            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" value="" /></dd>
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
                <dd><input type="date" name="date_of_birth" value="" /></dd>
            </dl>            
            <dl>
                <dt>Country</dt>
                <dd><input type="text" name="country" value="" /></dd>
            </dl>            
            <dl>
                <dt>City</dt>
                <dd><input type="text" name="city" value="" /></dd>
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
