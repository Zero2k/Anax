<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("book/create");
$urlToDelete = url("book/delete");



?><h1>View all books</h1>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $item) : ?>
    <tr>
        <th scope="row">
            <a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </th>
        <td><img src="<?= $item->image ?>"></td>
        <td><?= $item->title ?></td>
        <td><?= $item->author ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<p>
    <a href="<?= $urlToCreate ?>">Create</a> | 
    <a href="<?= $urlToDelete ?>">Delete</a>
</p>
