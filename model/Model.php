<?php
class Model
{
    private $name;
    private $blocks = [];
    function getName()
    {
        return $this->name;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function getBlocks()
    {
        return $this->blocks;
    }
    function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }
    function __construct(array $blocks = [], $name = "Landing Constructor")
    {
        $this->name = $name;
        $this->blocks = $blocks;
    }
    function archive($dir)
    {
        $zip = new ZipArchive();
        $arch = ".zip";
        $zip->open($dir . $arch, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $lendir = substr($dir, 3);
                $relativePath = strstr($filePath, $lendir);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    }
    function generate()
    {
        $content = "";
        for ($i = 0; $i < count($this->blocks); $i++) {
            $content .= $this->blocks[$i]->draw();
        }
        return $content;
    }
    public function upload($files, $uploaddir)
    {
        $message = "";
        $target_file = $uploaddir.basename($files["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = @getimagesize($files["tmp_name"]);
        if (!$check) {
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            $message = "Файл уже существует.";
        }
        if ($files["size"] > 50000000) {
            $message = "Файл слишком большой.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "Извините, разрешены только форматы JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $message .= " Файл не был загружен.";
        } else {
            if (move_uploaded_file($files['tmp_name'], $target_file)) {
                $message .= "Файл " . basename($files["tmp_name"]) . " был успешно загружен.";
            } else {
                $message .= "При загрузке файла произошла ошибка." . basename($files["tmp_name"]);
            }
        }
        return $message;
    }

}