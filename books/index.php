<?php

require_once '../lib/init.php';

$book = new Book();
$books = $book->all();
include "../templates/header.php";

?>
<div class="container-blank">
<div class="cardbody">
<div class="header">
    <h1>Books</h1>
    <a href="create.php">Create</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $key => $book) : ?>
            <tr>
                <td><?php echo $book['id'] ?></td>
                <td><a href="edit.php?id=<?php echo $book['id'] ?>"><?php echo $book['title'] ?></a></td>
                <td><button type="button" class="trash" data-model-end-point="books" data-model-id="<?php echo $book['id'] ?>">Delete</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>
<?php

require "../templates/footer.php";
