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
    public function upload($file, $uploaddir)
    {
        $message = "";
        $target_file = $uploaddir.basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if(isset($file["tmp_name"])){
            if (file_exists($target_file)) {
                $message = "The file already exists";
                $uploadOk = 0;
            }
            if ($file["size"] > 100000000) {
                $message = "The file is too big";
                $uploadOk = 0;
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $message = "Sorry, only these formats allowed JPG, JPEG, PNG & GIF.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $message .= "! File was not uploaded. ";
            } else {
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    $message .= "File ".basename($file["tmp_name"])." was successfully uploaded!";
                } else {
                    $message .= "There's an error while loading file ".basename($file["tmp_name"]);
                }
            }
            return $message;
        }
        return "File tmp_name error!";
    }
    public static function is_dir_empty($dir) {
        if(is_dir($dir)){
            if (!is_readable($dir)) return true;
            return (count(scandir($dir)) == 2);
        }
        return true;
    }
}