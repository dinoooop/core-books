<?php

require_once '../lib/init.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $book = new Book();
    $record = $book->find($id);
}

if (isset($_POST['action']) && $_POST['action'] == 'edit_book') {
    $book = new Book();

    $data = [];
    $data['title'] = $_POST['title'];
    
    if(isset($_FILES['cover']) && $_FILES['cover']['error'] == UPLOAD_ERR_OK){
        $data['cover'] = Helper::uploadFile('cover');
    }

    $book->update($_POST['id'], $data);
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

        <form action="edit.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?php echo $record['title'] ?>" required>
            </div>
            <div class="form-group">
                <label for="cover">Cover Image</label>
                <input type="file" name="cover" id="cover" accept="image/*">
                <img id="coverPreview" src="<?php echo $record['cover']; ?>" alt="Cover Preview" style="max-width: 100%; margin-top: 10px; <?php echo $record['cover'] ? '' : 'display:none;'; ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="action" value="edit_book">
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
<?php

require "../templates/footer.php";
