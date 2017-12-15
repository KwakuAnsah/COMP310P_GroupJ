<?php

require_once('../../private/initialize.php');
include(SHARED_PATH . '/header.php');

setcookie(session_name(), '', 100);
session_unset();
session_destroy();
$_SESSION = array();
redirect_to(url_for("index.php"));
include(SHARED_PATH . '/footer.php');
?>