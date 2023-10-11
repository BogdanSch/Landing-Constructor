<?php

class Header extends Block
{
    private $landingHeaderTitle;
    private $logoImg;
    private $headerBackgroundImage;
    private array $headerLinks;
    private $showTellMoreButton;

    function __construct($landingHeaderTitle = "Header", $logoImg = "", $headerBackgroundImage = "", array $headerLinks = ["Home" => "index.html"], $showTellMoreButton = true)
    {
        $this->landingHeaderTitle = $landingHeaderTitle;
        $this->logoImg = $logoImg;
        $this->headerBackgroundImage = $headerBackgroundImage;
        $this->headerLinks = $headerLinks;
        $this->showTellMoreButton = $showTellMoreButton;
    }
    private function getHeaderLinks(){
        $str = '<ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">';
        foreach ($this->headerLinks as $linkName => $link) {
            $str .= '<li class="nav-item">
                        <a class="nav-link" href="' . $link . '">' . $linkName . '</a>
                    </li>';
        }
        $str .= '</ul>';
        return $str;
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
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./assets/styles/theme.css">
    <link rel="stylesheet" href="./assets/styles/style.css">
</head> 
<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="' . $this->headerLinks["Home"] . '">'.''. $img . $this->landingHeaderTitle . '</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                    ';
        $str .= $this->getHeaderLinks();
        $str .= '</div>
        </div>
    </nav>
    <header class="masthead" style="background-image: url('. $this->headerBackgroundImage .');">
            <div class="container">
                <div class="masthead-subheading">Welcome To</div>
                <div class="masthead-heading text-uppercase">' . $this->landingHeaderTitle . '</div>';
                if($this->showTellMoreButton){
                    $str.= '<a class="btn btn-primary btn-xl text-uppercase" href="' . $this->headerLinks["About"] . '">Tell Me More</a>';
                }
                else{
                    $str.= '<a class="btn btn-primary btn-xl text-uppercase" href="' . $this->headerLinks["Home"] . '">Get Back</a>';
                }
            $str .= '</div>
    </header>

<main class="main">';
        return $str;
    }
}