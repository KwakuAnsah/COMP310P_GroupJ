<?php
require_once('../../private/initialize.php');
include(SHARED_PATH . '/access_denied.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/events/host_pages/index.php'));
}
$id = $_GET['id'];

if (is_post_request()) {

    // Handle form values sent by new.php

    $Event = [];
    $Event['id'] = $id;
    $Event['subject_id'] = $_POST['subject_id'] ?? '';
    $Event['menu_name'] = $_POST['menu_name'] ?? '';
    $Event['position'] = $_POST['position'] ?? '';
    $Event['visible'] = $_POST['visible'] ?? '';
    $Event['content'] = $_POST['content'] ?? '';

    $result = update_Event($Event);
    if ($result === true) {
        redirect_to(url_for('/events/host_pages/show.php?id=' . $id));
    } else {
        $errors = $result;
    }
} else {

    $Event = find_Event_by_id($id);
}
$Event_set = find_all_Events();
$Event_count = mysqli_num_rows($Event_set);
mysqli_free_result($Event_set);
?>

<?php $page_title = 'Edit Event'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/events/host_pages/index.php');
?>">&laquo; Back to List</a>

    <div class="Event edit">
        <h1>Edit Event</h1>
        
        <?php echo display_errors($errors); ?>

        <form action="<?php
        echo url_for('/events/host_pages/edit.php?id='
                . h(u($id)));
        ?>" method="post">
            <dl>
                <dt>Subject</dt>
                <dd>
                    <select name="subject_id">
                        <?php
                        $subject_set = find_all_subjects();
                        while ($subject = mysqli_fetch_assoc($subject_set)) {
                            echo "<option value=\"" . h($subject['id']) . "\"";
                            if ($Event["subject_id"] == $subject['id']) {
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
                <dd><input type="text" name="menu_name" value="<?php echo h($Event['menu_name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php
                        for ($i = 1; $i <= $Event_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if ($Event["position"] == $i) {
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
                           if ($Event['subject_id'] == "1") {
                               echo " checked";
                           }
                           ?> />
                </dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd>
                    <textarea name="content" cols="60" rows="10"><?php echo h($Event['content']); ?></textarea>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Event" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
