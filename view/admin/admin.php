<?php if ($userExist && $userAdmin) : ?>
    <h1>Admin Dashboard</h1>
    <p><?= $content ?></p>
    <a href="admin/users">Change users</a>
<?php else : ?>
    <p><a href="login">You need to login</a></p>
<?php endif; ?>
