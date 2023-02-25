<?php
require_once("autoload.php");
$header = new Header("Landing Constructor");
echo $header->draw();
if (empty($_REQUEST)) {
    echo <<<EOD
    <div class="landing-amount">
        <div class="container">
            <div class="landing__wrap">
                <form class="landing__form amount" enctype="multipart/form-data" action="{$_SERVER['PHP_SELF']}"
                    method="get">
                    <div class="landing__number">
                        <h4>Enter the amount of blocks: </h4>
                        <input type="number" name="blocks-amount" value="2" placeholder="Enter the amount of blocks"
                            class="design"/>
                    </div>
                    <input type="submit" name="submitB" value="Сгенерувати Landing" class="design" id="ok" />
                </form>
            </div>
        </div>
    </div> 
EOD;
}
if (isset($_GET['blocks-amount'])) {
    $generator = new BlocksFormGenerator($_GET['blocks-amount']);
    $generator->generate_form();
}
$footer = new Footer("All rights reserved by Bohdan Shcherbak!");
echo $footer->draw();
?>
<!-- <section class="landing">
    <div class="container">
        <div class="landing__wrap">
            <form class="landing__form" enctype="multipart/form-data" action="controller/controller.php" method="post">
            <p>* поля, обов'язкові до заповнення </p>
                <div class="landing__title">
                    <h3>Title сторінки*</h3>
                    <input type="input" name="title" value="" placeholder="Уведіть title сторінки" class="design" />
                </div>
                <div class="landing__header">
                    <h3>Заголовок сторінки*</h3>
                    <input type="input" name="header" value="" placeholder=" Уведіть заголовок сторінки "
                        class="design" />
                </div>
                <div class="landing__logo">
                    <h3>Логотип</h3>
                    <input type="file" name="logo" value="" placeholder="Введите изображение логотипа" class="design" />
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                    <div id="message"></div>
                </div>
                <div class="landing__form">
                    <h3>Форма</h3>
                    <input type="input" name="form" value="" placeholder="Введите название кнопки" class="design" />
                </div>
                <div class="landing__text">
                    <h3>Текст сторінки*</h3>
                    <textarea name="text" value="" placeholder=" Уведіть текст сторінки" class="design"></textarea>
                </div>
                <div class="landing__footer">
                    <h3>Footer сторінки*</h3>
                    <input type="input" name="footer" placeholder=" Уведіть заголовок сторінки " class="design" />
                </div>
                <input type="submit" name="submitB" value="Сгенерувати Landing" class="design" id="ok" />
                <a href='landing.zip' class="design" download>Скачать результат</a>
            </form>
            <hr>
            <div class="landing__result">
                <h3>Результат</h3>
                <a href='landing/index.html' class="design" target="_blank"> Переглянути результат у новому вікні</a>
                <iframe width="900px" height="550px" src="landing/index.html"></iframe>
            </div>
        </div>
    </div>
</section> -->