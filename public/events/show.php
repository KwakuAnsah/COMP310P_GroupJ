<?php

require_once('../../private/initialize.php');
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0
$event = find_event_by_id($id);
// this enables us to display the event info
// further down the webevent
?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/events/host_pages/index.php');
?>">&laquo; Back to List</a>

    <div class="event show">

        <h1>Page: <?php echo h($event['menu_name']); ?></h1>

        <div class="attributes">
            <?php $subject = find_subject_by_id($event['subject_id']); ?>
            <dl>
                <dt>Subject</dt>
                <dd><?php echo h($subject['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($event['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($event['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $event['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd><?php echo h($event['content']); ?></dd>
            </dl>
        </div>

    </div>

</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
