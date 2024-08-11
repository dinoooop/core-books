<?php

require_once '../lib/init.php';

if (isset($_POST['action']) && $_POST['action'] == 'create_book') {
    $book = new Book();

    $data = [];
    $data['title'] = $_POST['title'];
    if(isset($_FILES['cover']) && $_FILES['cover']['error'] == UPLOAD_ERR_OK){
        $data['cover'] = Helper::uploadFile('cover');
    }

    $book->create($data);
    header("Location: index.php");
    exit();
}

require "../templates/header.php";
?>
<div class="container-blank">
    <div class="cardbody">
        <div class="header">
            <h1>Books</h1>
            <a href="index.php">Back</a>
        </div>

        <form action="create.php" enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="cover">Cover Image</label>
                <input type="file" name="cover" id="cover" accept="image/*">
                <img id="coverPreview" src="" alt="Cover Preview" style="display:none; max-width: 100%; margin-top: 10px;">
            </div>
            <input type="hidden" name="action" value="create_book">
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
<?php

require "../templates/footer.php";
