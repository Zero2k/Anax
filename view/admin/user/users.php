<?php if ($userExist && $userAdmin) : ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <th scope="row"><?= $user->id ?></th>
                <td><?= $user->acronym ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->admin ?></td>
                <td><a href="users/edit/<?= $user->id ?>">Edit</a> | <a href="users/delete/<?= $user->id ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="users/add">Add new user</a>
<?php else : ?>
    <p><a href="login">You need to login</a></p>
<?php endif; ?>
