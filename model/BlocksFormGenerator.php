<?php
class BlocksFormGenerator
{
    private $blocksAmount;
    private $form = [];
    public function getBlocksAmount()
    {
        return $this->blocksAmount;
    }
    public function setBlocksAmount($blocksAmount)
    {
        $this->blocksAmount = $blocksAmount;

        return $this;
    }
    public function __construct($blocksAmount = 0)
    {
        $this->blocksAmount = $blocksAmount;
    }
    public function generate_ask_form()
    {
        $blocks = ['<h3>Header and footer are already included</h3><form class="generator__form" enctype="multipart/form-data" action="' . $_SERVER['PHP_SELF'] . '" method="POST">'];
        for ($i = 0; $i < $this->blocksAmount; $i++) {
            $blocks[] = <<<EOD
                <div class="blocks__item">
                    <p>Choose your block type</p>
                    <select name="blockType{$i}">
                        <option value="text">Text</option>
                        <option value="image">Image</option>
                        <option value="form">Form</option>
                    </select>
                </div>
            EOD;
        }
        $blocks[] = '<input type="submit" name="blocks-types"></form>';
        $this->form = $blocks;
    }
    public function generate_blocks_form(array $blocks_types)
    {
        $form_start = <<<EOD
        <section class="landing">
            <div class="container">
                <div class="landing__wrap">
                    <form class="landing__form form" enctype="multipart/form-data" action="controller/controller.php" method="post">
                        <p>* поля, обов'язкові до заповнення </p>
                        <div class="landing__title">
                            <h3>Title сторінки*</h3>
                            <input type="input" name="title" value="" placeholder="Уведіть title сторінки" class="design" />
                        </div>
                        <div class="landing__header">
                            <h3>Заголовок сторінки*</h3>
                            <input type="input" name="header" value="" placeholder=" Уведіть заголовок сторінки " class="design" />
                        </div>
                        <div class="landing__logo">
                            <h3>Логотип</h3>
                            <input type="file" name="logo" value="" placeholder="Введите изображение логотипа" class="design" />
                            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                            <div id="message"></div>
                        </div>
        EOD;
        $blocks = [$form_start];
        foreach ($blocks_types as $key => $value) {
            if ($block = $this->get_block_type($$value)) {
                $blocks[] = $block;
            }
        }
        $form_end = <<<EOD
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
            </section>
        EOD;
        $blocks[] = $form_end;
        $form = $blocks;
    }
    public function print_form()
    {
        if (count($this->form) > 0) {
            foreach ($this->form as $str) {
                echo $str;
            }
        }
    }
    private function get_block_type($block)
    {
        switch ($block) {
            case "text":
                return '<div class="landing__text">
                <h3>Paragraph*</h3>
                <textarea name="text" value="" placeholder=" Уведіть текст сторінки" class="design"></textarea>
            </div>';
            case "image":
                return '<div class="landing__image">
                <h3>Image*</h3>
                <textarea name="text" value="" placeholder=" Уведіть текст сторінки" class="design"></textarea>
            </div>';
            case "form":
                return '<div class="landing__form">
                <h3>Form*</h3>
                <input type="input" name="form" value="" placeholder="Введите название кнопки" class="design" />
            </div>';
            default:
                return false;
        }
    }
}