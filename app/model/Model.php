<?php
class Model
{
    private $name;
    private $blocks = [];
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getBlocks()
    {
        return $this->blocks;
    }
    public function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }
    public function __construct(array $blocks = [], $name = "Landing Constructor")
    {
        $this->name = $name;
        $this->blocks = $blocks;
    }
    public function archive($dir)
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
    public function generate()
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
        echo " u: " . $uploaddir;
        echo " bfn: " . basename($files["name"]);
        echo " f2: ";
        print_r($files);
        $target_file = $uploaddir . basename($files["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            $message = "The file already exists";
            $uploadOk = 0;
        }
        if ($files["size"] > 50000000) {
            $message = "The file is too big";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "Sorry, only these formats allowed JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }
        if ($files["tmp_name"] == "") {
            $message .= "File did not loaded.";
            $uploadOk = 0;
        } else {
            $check = @getimagesize($files["tmp_name"]);
            if (!$check) {
                $message .= "Can not get image info";
                $uploadOk = 0;
            }
        }
        if ($uploadOk == 0) {
            $message .= "File was not uploaded.";
        } else {
            if (move_uploaded_file($files['tmp_name'], $target_file)) {
                $message .= "File " . basename($files["tmp_name"]) . " was successfully uploaded!";
            } else {
                $message .= "There's an error while loading file " . basename($files["tmp_name"]);
            }
        }
        return $message;
    }
    public static function is_dir_empty($dir)
    {
        if (is_dir($dir)) {
            if (!is_readable($dir)) {
                return true;
            }

            return (count(scandir($dir)) == 2);
        }
        return true;
    }
}