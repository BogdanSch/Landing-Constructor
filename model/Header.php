<?php
class Header extends Block
{
    private $landing_header;
    private $logo_img;
    private $link_mode;
    function __construct($landing_header = "Header", $logo_img = "", $link_mode = "html")
    {
        $this->landing_header = $landing_header;
        $this->logo_img = $logo_img;
        $this->link_mode = $link_mode;
    }
    public function draw()
    {
        if ($this->logo_img) {
            $img = "<img src=\"{$this->logo_img}\" alt=\"logo\" class=\"logo\"/>";
        } else
            $img = "";
        $str = <<<EOD
    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{$this->landing_header}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
</head> 
<body>
<!-------------Блок "Header"-------------------------->
        <header class="header">
            <div class="container">
                <div class="header__wrap">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid">  
                            <a class="navbar-brand" href="index.{$this->link_mode}">{$this->landing_header}</a>
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.{$this->link_mode}">Home</a>
                                </li>
                            </ul>
                            {$img}
                        </div>
                    </nav>
                </div>       
            </div>
        </header>
    <!-------------Конец блока "Header"-------------------->
    <main class="main">
        <div class="container">
EOD;
        return $str;
    }
}