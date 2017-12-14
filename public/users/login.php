
<?php
require_once('../../private/initialize.php');
include(SHARED_PATH . '/header.php');
?>

<?php

$connection = db_connect();
$email = "";
$password = "";
$first_name = "";
$last_name = "";
$user_id = "";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    ech
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $_SESSION["user_id"] = $row["user_id"];
    $_SESSION["first_name"] = $row["first_name"];
    echo $_SESSION["first_name"];
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        header("location: ../whats_on.php");
    } else {
        $error = "Your Email and Password do not match";
    }
}
?>


<html>
    <body>
    <center>
        <br />
        <h1>Log In</h1>
        <br />
        <?php echo $error; ?>
        <form action="" method="post">
            <dl>
                <dt>Email:</dt>
                <dd><input type="text" name="email" value=""/></dd>
            </dl>
            <dl>
                <dt>Password:</dt>
                <dd><input type="password" name="password" value="" /></dd>
            </dl>
            <div>
                <input type="submit" value="Log In!" />
            </div>
        </form>
    </center>
</body>
</html>
<?php include(SHARED_PATH . '/footer.php'); ?>