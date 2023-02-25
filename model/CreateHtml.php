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
        $str_land = $this->model->generate(); // генерація тексту лендинга
        $path = "{$this->dir}/index.html";
        $f = fopen($path, "w+"); // створення файлу лендинга по вказаному шляху
        fwrite($f, $str_land); // запис в файл лендингу
        fclose($f);
    }
}
