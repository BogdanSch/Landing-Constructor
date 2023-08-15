<?php

class Header extends Block
{
    private $landingHeaderTitle;
    private $logoImg;
    private array $headerLinks;

    function __construct($landingHeaderTitle = "Header", $logoImg = "", array $headerLinks = ["Home" => "index.html"])
    {
        $this->landingHeaderTitle = $landingHeaderTitle;
        $this->logoImg = $logoImg;
        $this->headerLinks = $headerLinks;
    }

    public function draw()
    {
        $img = "";
        if ($this->logoImg) {
            $img = '<img src="' . $this->logoImg . '" alt="logo" class="logo">';
        }

        $str = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>' . $this->landingHeaderTitle . '</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="./assets/style/style.css">
</head> 
<body>
    <header class="header">
        <div class="container">
            <div class="header__wrap">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">';
        $i = 0;
        foreach ($this->headerLinks as $linkName => $link) {
            if ($i === 0) {
                $str .= '<a class="navbar-brand" href="' . $link . '">' . $this->landingHeaderTitle . '</a>';
                $str .= '<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="' . $link . '">' . $linkName . '</a>
                        </li>';
                $i++;
                continue;
            }
            $str .= '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="' . $link . '">' . $linkName . '</a>
                    </li>';
        }
        $str .= '</ul>
                    ' . $img . '
                </div>
            </nav>
        </div>       
    </div>
</header>
<main class="main">';
        return $str;
    }
}
