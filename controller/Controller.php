<?php
require_once "../autoload.php";
class Controller
{
    private $dir;
    private $uploaddir;
    public function __construct($dir)
    {
        $this->dir = $dir;
        $this->uploaddir = $dir . "/images/";
        if (!is_dir($this->dir)) {
            mkdir($this->dir);
        }
        if (!is_dir($this->uploaddir)) {
            mkdir($this->uploaddir);
        }
    }
    public function action()
    {
        $blocks = [];
        $title = "";
        ob_start();
        print_r($_POST);
        foreach ($_POST as $key => $value) {
            if ($key == 'header') {
                $img = "";
                if (isset($_FILES["logo"]["name"])) {
                    $img = "images/".$_FILES["logo"]["name"];
                }
                $header = new Header($value, $img);
                $blocks[] = $header;
            }
            elseif($key == 'title'){
                $title = $value;
            }
            elseif (str_contains($key, "text")) {
                $text = new Text($value);
                $blocks[] = $text;
            }
            elseif (str_contains($key, "form")) {
                $form = new Form($value);
                $blocks[] = $form;
            }
            elseif (str_contains($key, "image")) {
                $form = new Image($value);
                $blocks[] = $form;
            }
            elseif($key == "footer"){
                $footer = new Footer($value);
                $blocks[] = $footer;
            }
        }
        if (isset($title)) {
            $model = new Model($blocks, $title);
        } else {
            $model = new Model($blocks);
        }
        $html = new CreateHtml($model, $this->dir);
        $html->create();
        if (isset($_FILES["logo"]["name"])) {
            echo $model->upload($_FILES["logo"], $this->uploaddir);
        }
        $model->archive($this->dir);
        header("Location: ../index.php?result=true");
        ob_flush();
    }
}
$controller = new Controller('../landing');
$controller->action();