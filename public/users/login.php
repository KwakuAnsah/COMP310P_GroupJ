
<?php


$email = "";
$password = "";
$first_name = "";
$last_name = "";
$user_id = "";
$error = "";
if (is_post_request()) {
    $email = db_escape($db, $_POST['email']);
    $password = db_escape($db, $_POST['password']);
    
    $sql = "SELECT * FROM user WHERE email = '".$email."' AND password = '".$password."'";
    $result = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION["user_id"] = $user["user_id"];
    $_SESSION["first_name"] = $user["first_name"];
    $_SESSION["last_name"] = $user["last_name"];
    $_SESSION["username"] = $user["username"];
    
    
    
    echo $_SESSION["first_name"];
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        redirect_to(url_for('/whats_on.php?event_id=' . $new_id));
    } else {
        $error = "Your Email and Password do not match";
        echo "$user";
    }
}
?>

  