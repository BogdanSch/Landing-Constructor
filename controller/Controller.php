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
        ob_start();
        if ($_POST['header']) {
            $img = "";
            if (isset($_FILES["logo"]["name"])) {
                $img = "images/" . $_FILES["logo"]["name"];
            }
            $header = new Header($_POST['header'], $img);
            $blocks[] = $header;
        }
        if ($_POST['text']) {
            $text = new Text($_POST['text']);
            $blocks[] = $text;
        }
        if ($_POST['form']) {
            $form = new Form($_POST['form']);
            $blocks[] = $form;
        }
        if($_POST['footer']){
            $footer = new Footer($_POST['footer']);
            $blocks[] = $footer;
        }
        if (isset($_POST['title'])) {
            $model = new Model($blocks, $_POST['title']);
        } else {
            $model = new Model($blocks);
        }
        $html = new CreateHtml($model, $this->dir);
        $html->create();
        if (isset($_FILES["logo"]["name"])) {
            echo $model->upload($_FILES["logo"], $this->uploaddir);
        }
        $model->archive($this->dir);
        header("Location: ../index.php");
        ob_flush();
    }
}
$controller = new Controller('../landing');
$controller->action();