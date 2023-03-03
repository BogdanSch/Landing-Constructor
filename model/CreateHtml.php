<?php
class CreateHtml
{
    private $model;
    private $dir;
    public function __construct($model, $dir) {
        $this->model = $model;
        $this->dir = $dir;
    }
    public function create(){
        $str_land = $this->model->generate();
        $path = "{$this->dir}/index.html";
        $f = fopen($path, "w+");
        fwrite($f, $str_land);
        fclose($f);
    }
}
