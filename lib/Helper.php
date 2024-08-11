<?php

class Helper
{
    public static function uploadFile($name)
    {
        $uploadDir = APP_DIR . '/uploads/';
        $fileInfo = pathinfo($_FILES[$name]['name']);
        $fileExtension = isset($fileInfo['extension']) ? '.' . $fileInfo['extension'] : '';
        $randomNumber = mt_rand(10000, 99999);
        $newFileName = $randomNumber . $fileExtension;
        $uploadFile = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadFile)) {
            return APP_URL . '/uploads/' . $newFileName;
        } else {
            exit('Failed to upload file');
        }
    }
}
