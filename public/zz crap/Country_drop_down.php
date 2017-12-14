<?php
require_once('../private/initialize.php');
?>
<?php
if (!isset($page_title)) {
    $page_title = 'MovieTime';
    $page = 'show.php';
}
?>
<?php include(SHARED_PATH . '/header.php'); ?>
   
<!----------------------------------------------------------------->

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
<!----------------------------------------------------------------->

<?php include(SHARED_PATH . '/footer.php'); ?>