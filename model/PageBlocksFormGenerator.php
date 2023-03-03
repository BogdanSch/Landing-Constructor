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
                            <h4>Page footer*</h4>
                            <input type="input" name="footer" placeholder="Enter footer copyright" class="design" />
                        </div>
                        <input type="submit" name="submitB" value="Generate Landing" class="design"/>
                    </form>
                </div>
            </div>
        </section>
    EOD,
    ];
    private $block_types = [];
    private $blocks = [];
    public function __construct(array $block_types)
    {
        $this->block_types = $block_types;
    }
    public function generate_form()
    {
        $this->blocks[] = $this->block_parts["start"];
        foreach ($this->block_types as $key => $value) {
            $block = $this->get_block($value);
            if (isset($block)) {
                $this->blocks[] = $block;
            }
        }
    }
    private function get_block($block)
    {
        switch ($block) {
            case "text":
                $count = $this->get_count_blocks_of_type('name="text');
                return '<div class="landing__text">
                <h4>Paragraph*</h4>
                <textarea name="text'.$count.'" placeholder="Enter your text" class="design"></textarea>
            </div>';
            case "image":
                $count = $this->get_count_blocks_of_type('name="image');
                return '<div class="landing__image">
                <h4>Image*</h4>
                <input type="file" name="image'.$count.'" class="design"></input>
            </div>';
            case "form":
                $count = $this->get_count_blocks_of_type('name="form');
                return '<div class="landing__form">
                <h4>Form*</h4>
                <input type="input" name="form'.$count.'" placeholder="Enter button text" class="design" />
            </div>';
            default:
                return false;
        }
    }
    private function get_count_blocks_of_type($block_type){
        $count = 0;
        foreach ($this->blocks as $key => $value) {
            if(str_contains($value, $block_type)){
                $count++;
            }
        }
        return $count;
    }
    public function print_form()
    {
        $this->blocks[] = $this->block_parts["end"];
        if (count($this->blocks) > 0) {
            foreach ($this->blocks as $str) {
                echo $str;
            }
        }
    }
}