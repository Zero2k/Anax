<?php if ($userExist && $userAdmin) : ?>
    <h1>Edit comment</h1>
    <?= $content ?>
<?php else : ?>
    <p><a href="login">You need to login</a></p>
<?php endif; ?>
