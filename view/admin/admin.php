<?php if ($userExist && $userAdmin) : ?>
    <h1>Admin Dashboard</h1>
    <?= $content ?>
<?php else: ?>
    <p><a href="login">You need to login</a></p>
<?php endif; ?>
