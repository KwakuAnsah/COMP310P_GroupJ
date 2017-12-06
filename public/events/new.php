<?php
require_once('../../private/initialize.php');

if (is_post_request()) {
    $event = [];
    $event['subject_id'] = $_POST['subject_id'] ?? '';
    $event['menu_name'] = $_POST['menu_name'] ?? '';
    $event['position'] = $_POST['position'] ?? '';
    $event['visible'] = $_POST['visible'] ?? '';
    $event['content'] = $_POST['content'] ?? '';

    $result = insert_event($event);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/events/host_pages/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    $event = [];
    $event['subject_id'] = '';
    $event['menu_name'] = '';
    $event['position'] = '';
    $event['visible'] = '';
    $event['content'] = '';
}

$event_set = find_all_events();
$event_count = mysqli_num_rows($event_set) + 1;
mysqli_free_result($event_set);
?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/events/host_pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="event new">
        <h1>Create Page</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/events/host_pages/new.php'); ?>" method="post">
            <dl>
                <dt>Subject</dt>
                <dd>
                    <select name="subject_id">
                        <?php
                        $subject_set = find_all_subjects();
                        while ($subject = mysqli_fetch_assoc($subject_set)) {
                            echo "<option value=\"" . h($subject['id']) . "\"";
                            if ($event["subject_id"] == $subject['id']) {
                                echo " selected";
                            }
                            echo ">" . h($subject['menu_name']) . "</option>";
                        }
                        mysqli_free_result($subject_set);
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?php echo 
                h($event['menu_name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php
                        for ($i = 1; $i <= $event_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if ($event["position"] == $i) {
                                echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"<?php
                        if ($event['subject_id'] == "1") {
                            echo " checked";
                        }
                        ?>/>
                </dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd>
                    <textarea name="content" cols="60" rows="10"><?php echo h($event['content']); ?></textarea>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Page" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
