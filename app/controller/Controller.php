<?php
require_once "../../autoload.php";
class Controller
{
    private $dir;
    private $uploadDir;
    public function __construct($dir)
    {
        $this->dir = $dir;
        $this->uploadDir = $dir . "/assets/images/";
        if (!is_dir($this->dir)) {
            mkdir($this->dir);
        }
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir);
        }
        $this->custom_copy("../assets/styles", $dir . "/assets/styles/");
    }
    private function custom_copy($path, $destination)
    {
        if (!is_dir($destination)) {
            mkdir($destination);
        }
        $dir = opendir($path);
        while ($file = readdir($dir)) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($path . '/' . $file)) {
                    $this->custom_copy($path . '/' . $file, $destination . '/' . $file);
                } else {
                    copy($path . '/' . $file, $destination . '/' . $file);
                }
            }
        }

        closedir($dir);
    }
    public function action()
    {
        $blocks = [];
        $accordion_count = 0;
        $title = "";
        $model = new Model();

        ob_start();

        foreach ($_POST as $key => $value) {

            if ($key == 'header') {
                $img = $this->uploadLogo();
                $header = new Header($value, $img, "", [
                    "Home" => "index.html"
                ], false);
                $blocks[] = $header;
            } elseif ($key == 'title') {
                $title = $value;
            }elseif (str_contains($key, "heading")) {
                $heading = new Heading($value);
                $blocks[] = $heading; 
            }elseif (str_contains($key, "paragraph")) {
                $text = new Paragraph($value);
                $blocks[] = $text;
            } elseif (str_contains($key, "form")) {
                $form = new Form($value);
                $blocks[] = $form;
            } elseif (str_contains($key, "accordion") && str_contains($key, $accordion_count)) {
                $accordion = new Accordion($_POST["accordion-title" . $accordion_count], $_POST["accordion-content" . $accordion_count]);
                $blocks[] = $accordion;
                $accordion_count++;
            } elseif (str_contains($key, "image")) {
                $img = $this->uploadImage($key);
                if ($img) {
                    $blocks[] = new Image($img);
                }
            } elseif ($key == "footer") {
                $footer = new Footer($value);
                $blocks[] = $footer;
            }
        }
        if ($title) {
            $model->setName($title);
        }
        $model->setBlocks($blocks);

        $html = new CreateHtml($model, $this->dir);
        $html->create();

        $model->archive($this->dir);
        header("Location: ../../index.php?result=true");
        ob_flush();
    }
    private function uploadImage($key)
    {
        if (isset($_FILES[$key]["name"]) && $_FILES[$key]["name"] != '' && $_FILES[$key]["tmp_name"] != '') {
            $img = "images/" . $_FILES[$key]["name"];
            $model = new Model();
            $model->upload($_FILES[$key], $this->uploadDir);
            return $img;
        }
        return null;
    }
    private function uploadLogo()
    {
        $img = "";
        if (isset($_FILES["logo"]["name"]) && $_FILES["logo"]["name"] != '' && $_FILES["logo"]["tmp_name"] != '') {
            $img = "images/" . $_FILES["logo"]["name"];
            $model = new Model();
            $model->upload($_FILES["logo"], $this->uploadDir);
        }
        return $img;
    }
}
$controller = new Controller('../landing');
$controller->action();