<?php

require_once '../lib/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {


    parse_str(file_get_contents('php://input'), $data);

    // Access the ID
    if (isset($data['id'])) {
        $id = htmlspecialchars($data['id']);
        $book = new Book();
        $book->delete($id);
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }

}
