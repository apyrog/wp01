<?php
$post = get_post();
$postId = $post->ID;
$eventStatus = get_post_meta($postId, 'event_status', true);
$eventStatus = ! empty($eventStatus) ? $eventStatus : "";
$eventDate = get_post_meta($postId, 'event_date', true);
$eventDate = ! empty($eventDate) ? $eventDate : "";
$checkedHtml = ' checked="checked"';
$statusPublicChecked = (($eventStatus === 'public') || ($eventStatus === '')) ? $checkedHtml : '';
$statusPrivateChecked = ($eventStatus === 'private') ? $checkedHtml : '';
?>

<div>
    <div>
        <span><strong>Status</strong></span>
        <br>
        <p>
            <input type="radio" id="status-public" name="event_status" value="public" <?= $statusPublicChecked; ?>>
            <label for="status-public">Open event</label>
        </p>
        <p>
            <input type="radio" id="status-private" name="event_status" value="private" <?= $statusPrivateChecked; ?>>
            <label for="status-private">Event by invitation only</label>
        </p>
    </div>
    <br>
    <div>
        <p>
            <label for="event_date"><strong>Event Date</strong></label>
            <input id="event_date" type="date" name="event_date" value="<?= $eventDate; ?>">
        </p>
    </div>
</div>
