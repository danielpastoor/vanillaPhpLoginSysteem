<?php

$error = $error ?? "";

if (!empty($error)) : ?>
    <div class="alert alert-danger mt-3" role="alert">
        <?= $error ?>
    </div>
<?php endif; ?>