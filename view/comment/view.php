<h1>All comments</h1>

<?php foreach ($allComments as $comment) : ?>
<ul class="list-unstyled">
  <li class="media comment">
    <img class="mr-3" src="<?= $gravatar->url($comment->email) ?>" alt="Generic placeholder image">
    <div class="media-body">
    <h5 class="mt-0"><?= $comment->postedBy ?></h5>
    <h6>posted <?= $comment->created ?></h6>
    <p><?= $comment->text ?></p>
    <?php if ($username) : ?>
        <small><a href="comment/update/<?= $comment->id ?>">update</a></small>
    <?php endif; ?>
    </div>
  </li>
</ul>
<?php endforeach; ?>

<?php if ($username) : ?>
    <p><a href="comment/create">Add comment</a> | <a href="comment/delete">Delete a comment</a></p>
<?php else : ?>
    <p><a href="user/login">You need to login</a></p>
<?php endif; ?>


