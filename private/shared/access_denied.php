<?php
if(!isset($_SESSION["user_id"])){
  
   redirect_to(url_for("index.php"));
}
?>