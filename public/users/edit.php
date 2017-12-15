<?php
require_once('../../private/initialize.php');
$page_title = 'Edit account details';
$page = 'user_edit.php';
include(SHARED_PATH . '/access_denied.php');
?>

<?php
if (!isset($_GET['user_id'])) {
    redirect_to(url_for('/index.php'));
}
$user_id = $_GET['user_id'];
if (is_post_request()) {

    // Handle form values sent by /users/new.php

    $user = [];
    $user['user_id'] = $user_id;
    $user['password'] = $_POST['password'] ?? '';
    $user['first_name'] = $_POST['last_name'] ?? '';
    $user['last_name'] = $_POST['last_name'] ?? '';
    $user['date_of_birth'] = $_POST['date_of_birth'] ?? '';
    $user['username'] = $_POST['username'] ?? '';
    $user['address_id'] = $_POST['address_id'] ?? '';
    $user['email'] = $_POST['email'] ?? '';

    $result = update_user($user);
    if ($result === true) {
        redirect_to(url_for('/users/show.php?id=' . $user_id));
    } else {
        $errors = $result;
        //var_dump($errors); for debugging
    }
} else {

    $user = find_user_by_id($user_id);
}
//Count users
$user_set = find_all_users();
$user_count = mysqli_num_rows($user_set);
mysqli_free_result($user_set);
?>


<?php include(SHARED_PATH . '/header.php'); ?>

<!-- Start of body -->
<div class="user_edit">
    <a class="back-link" href="<?php echo url_for('/users/show.php?user_id=' . $user_id); ?>">&laquo; Back to Profile</a>
    <div class="container-fluid text-center">
        <h1>Edit Account Details</h1>
        <br>
        <?php echo display_errors($errors); ?>

        <!-- * * * EDIT ACTION LINK? * * * -->    
        <form action="<?php echo url_for('/users/edit.php?user_id=' . h(u($user_id))); ?>" method="post">
            <dl>
                <dt>First Name</dt>
                <dd><input type="text" name="first_name" value="<?php echo h($user['first_name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="last_name" value="<?php echo h($user['last_name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd><input type="text" name="email" value="<?php echo h($user['email']); ?>" /></dd>
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
                <dt>Password</dt>
                <dd><input type="text" name="password_check" value="" /></dd>
            </dl>
            <dl>
                <dt>Date of Birth</dt>
                <dd><input type="date" name="date_of_birth" value='<?php echo h($user['date_of_birth']); ?>' /></dd>
            </dl>            
            <dl>
                <dt>Address Line 1</dt>
                <dd><input type="text" name="address_line_1" value="<?php
                    echo
                    h($user['address_line_1']);
                    ?>" /></dd>
            </dl> 
            <dl>
                <dt>Postcode</dt>
                <dd><input type="text" name="postcode" value="<?php
                    echo
                    h($user['postcode']);
                    ?>" /></dd>
            </dl>             
            <dl>
                <dt>City</dt>
                <dd>
                    <select name="city_id">
                        <?php
                        $city_set = find_all_cities();
                        while ($city = mysqli_fetch_assoc($city_set)) {
                            echo "<option value='" . h($city['city_id']) . "'";
                            if ($user["city_id"] == $city['city_id']) {
                                echo " selected";
                            }
                            echo ">" . h($city["city_name"]) . "</option>";
                        }
                        mysqli_free_result($city_set);
                        ?>
                    </select>
                </dd>
            </dl>

            <!-- * * * button to save edited details - EDIT LINK * * * --> 
            <div id="operations">
                <input class="submission_btn btn btn-lg btn-default" type="submit" name="edit_user" value="Edit User">
            </div>
        </form>
    </div>

    <!-- * * * button to save edited details - EDIT LINK * * * -->
    <div class="text-center">
        <a class="action" href="<?php echo url_for('/users/delete.php?user_id=' . h(u($user['user_id']))); ?>">Delete your account</a>
    </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
