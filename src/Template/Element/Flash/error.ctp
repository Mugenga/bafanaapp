<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="page-title" onclick="this.classList.add('hidden')">
    <div class="alert alert-danger" role="alert">
        <?= $message ?>
    </div>
</div>
