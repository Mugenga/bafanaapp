<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="page-title" onclick="this.classList.add('hidden')">
    <div class="alert alert-info" role="alert">
        <?= $message ?>
    </div>
</div>
