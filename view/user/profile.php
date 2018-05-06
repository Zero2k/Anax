<?php if ($userExist) : ?>
    <h1>User Profile</h1>

    <h4>Username</h4>
    <?= htmlentities($profile->acronym) ?>

    <h4>Email</h4>
    <?= htmlentities($profile->email) ?>

    <h4>Member since</h4>
    <?= htmlentities(substr($profile->created, 0, 10)) ?>
    <hr>
    <a href="update">Change user</a> | <a href="logout">Logout</a>
<?php else : ?>
    <p><a href="login">You need to login</a></p>
<?php endif; ?>
