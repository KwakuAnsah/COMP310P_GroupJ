<?php
if(!isset($_SESSION['user_id'])){
    echo "<div class='no_session'>  </div>";
    redirect_to(url_for("index.php"));
}
?>