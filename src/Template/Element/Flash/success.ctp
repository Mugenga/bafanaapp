<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="page-title" onclick="this.classList.add('hidden')">
    <div class="alert alert-success" role="alert">
        <?= $message ?>
    </div>
</div>
