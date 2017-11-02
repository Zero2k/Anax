<h1>All comments</h1>

<?php foreach ($allComments as $comment) : ?>
<ul class="list-unstyled">
  <li class="media comment">
    <img class="mr-3" src="http://via.placeholder.com/80x80" alt="Generic placeholder image">
    <div class="media-body">
    <h5 class="mt-0"><?= $comment["name"] ?></h5>
    <h6>posted Thu 2 November 2017 at 13:18</h6>
    <?= $comment["content"] ?>
    </div>
    <form action="<?= $app->url->create('comments/remove') ?>" method="post">
    <input type="hidden" name="id" value="<?= $comment["id"] ?>">
    <input class="btn btn-link" input type="submit" name="submit" value="Remove">
</form>
  </li>
</ul>
<?php endforeach; ?>

<h3>Leave a comment</h3>
<form action="<?= $app->url->create('comments/post') ?>" method="post">
    <div class="form-group">
        <input class="form-control" type="text" name="name" placeholder="Name" autofocus>
    </div>
    <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder="Email (required)">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="content" rows="8"></textarea>
    </div>
    <input class="btn btn-default btn-primary" input type="submit" name="submit" value="Add comment">
</form>
