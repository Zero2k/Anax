<?php if ($userExist && $userAdmin) : ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">UserId</th>
                <th scope="col">Published</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment) : ?>
            <tr>
                <th scope="row"><?= $comment->id ?></th>
                <td><?= $comment->postedBy ?></td>
                <td><?= $comment->userId ?></td>
                <td><?= $comment->published ?></td>
                <td><a href="comments/edit/<?= $comment->id ?>">Edit</a> | <a href="comments/delete/<?= $comment->id ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="comments/add">Add new comment</a>
<?php else : ?>
    <p><a href="login">You need to login</a></p>
<?php endif; ?>
