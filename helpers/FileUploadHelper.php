<?php

class FileUploadHelper
{
    public function upload($file)
    {
        $fileName = time().uniqid().'-' . basename($file['name']);
        move_uploaded_file($file['tmp_name'], 'storage/images/' . $fileName);

        return $fileName;
    }

    public function remove($name)
    {
        if (!file_exists('storage/images/' .$name)) {
            return null;
        }

        return unlink('storage/images/' .$name);
    }
}