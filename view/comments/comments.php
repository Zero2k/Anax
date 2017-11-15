<h1>All comments</h1>

<?php foreach ($allComments as $comment) : ?>
<ul class="list-unstyled">
  <li class="media comment">
    <img class="mr-3" src="http://via.placeholder.com/80x80" alt="Generic placeholder image">
    <div class="media-body">
    <h5 class="mt-0"><?= $comment->postedBy ?></h5>
    <h6>posted <?= $comment->created ?></h6>
    <?= $comment->text ?>
    </div>
  </li>
</ul>
<?php endforeach; ?>

<h3>Leave a comment</h3>
<form action="<?= $app->url->create('comments/add') ?>" method="post">
    <div class="form-group">
        <input class="form-control" type="text" name="name" placeholder="Name" autofocus>
    </div>
    <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder="Email (required)" required>
    </div>
    <div class="form-group">
        <textarea class="form-control" name="content" rows="8"></textarea>
    </div>
    <input class="btn btn-default btn-primary" input type="submit" name="submit" value="Add comment">
</form>
