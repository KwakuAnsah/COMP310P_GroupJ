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

    <select name="country_id">
        <?php
        $country_set = find_all_countries();
        while ($country = mysqli_fetch_assoc($country_set)) {
            echo "<option value=" . $country["country_id"] . ">" 
                    . h($country["country_name"]) . "</option>";
        }
        mysqli_free_result($country_set);
        ?>
    </select>
<!----------------------------------------------------------------->

<?php include(SHARED_PATH . '/footer.php'); ?>