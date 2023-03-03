<?php

class PageBlocksFormGenerator
{
    private $block_parts = [
        "start" => <<<EOD
        <section class="landing">
            <div class="container">
                <div class="landing__wrap">
                    <form class="landing__form form" enctype="multipart/form-data" action="controller/controller.php" method="post">
                        <p>* Fields that you need to fill in!</p>
                        <div class="landing__title">
                            <h4>Page title*</h4>
                            <input type="input" name="title" placeholder="Enter page title" class="design" />
                        </div>
                        <div class="landing__header">
                            <h4>Page title for header*</h4>
                            <input type="input" name="header" placeholder="Enter page title for header" class="design" />
                        </div>
                        <div class="landing__logo">
                            <h4>Logo</h4>
                            <input type="file" name="logo" class="design" />
                            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                            <div id="message"></div>
                        </div>
        EOD,
        "end" => <<<EOD
        <div class="landing__footer">
            <h4>Footer сторінки*</h4>
            <input type="input" name="footer" placeholder="Enter footer copyright" class="design" />
        </div>
        <input type="submit" name="submitB" value="Generate Landing" class="design" id="ok" />
        <a href="landing.zip" class="design" download>Download the result</a>
    </form>
                    <hr>
                    <div class="landing__result">
                        <h2>Result</h2>
                        <hr>
                        <a href='landing/index.html' class="design" target="_blank">Check up the result in the new tab</a>
                        <iframe width="900px" height="550px" src="./landing/index.html"></iframe>
                    </div>
                </div>
            </div>
        </section>
    EOD,
    ];
    private $block_types;
    private $form = [];
    public function __construct(array $block_types)
    {
        $this->block_types = $block_types;
    }
    public function generate_form()
    {
        $blocks = [$this->block_parts["start"]];
        foreach ($this->block_types as $key => $value) {
            $block = $this->get_block_type($value);
            if ($block) {
                $blocks[] = $block;
            }
        }
        $this->form = $blocks;
    }
    private function get_block_type($block)
    {
        switch ($block) {
            case "text":
                return '<div class="landing__text">
                <h4>Paragraph*</h4>
                <textarea name="text" placeholder="Enter your text" class="design"></textarea>
            </div>';
            case "image":
                return '<div class="landing__image">
                <h4>Image*</h4>
                <input type="file" name="text" placeholder="" class="design"></input>
            </div>';
            case "form":
                return '<div class="landing__form">
                <h4>Form*</h4>
                <input type="input" name="form" placeholder="Enter button text" class="design" />
            </div>';
            default:
                return false;
        }
    }
    public function print_form()
    {
        $this->form[] = $this->block_parts["end"];
        if (count($this->form) > 0) {
            foreach ($this->form as $str) {
                echo $str;
            }
        }
    }
}
