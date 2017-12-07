<?php
require_once('../../private/initialize.php');

if (is_post_request()) {

    // Handle form values

    $user = [];
    $user['password'] = $_POST['password'] ?? '';
    $user['first_name'] = $_POST['last_name'] ?? '';
    $user['last_name'] = $_POST['last_name'] ?? '';
    $user['age'] = $_POST['age'] ?? '';
    $user['username'] = $_POST['username'] ?? '';
    $user['address_id'] = $_POST['address_id'] ?? '';
    $user['email'] = $_POST['email'] ?? '';

    $result = insert_user($user);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/users/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    // display the blank form
}

$user_set = find_all_users();
$user_count = mysqli_num_rows($user_set) + 1;
mysqli_free_result($user_set);
?>

<?php $page_title = 'Sign Up'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <div class="user new">
        <h1>Create User</h1>
        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/users/new.php'); ?>"
              method="post">
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
                <dt>Password</dt>
                <dd><input type="text" name="password_check" value="" /></dd>
            </dl>
            <dl>
                <dt>Age</dt>
                <dd><input type="text" name="age" value="" /></dd>
            </dl>            
            <dl>
                <dt>Country</dt>
                <dd><input type="text" name="country" value="" /></dd>
            </dl>            
            <dl>
                <dt>City</dt>
                <dd><input type="text" name="city" value="" /></dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Create Account" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
