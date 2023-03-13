<?php

class PageBlocksFormGenerator
{
    private $block_parts = [
        "start" => <<<EOD
        <section class="landing">
            <div class="container">
                <div class="landing__wrap">
                    <form class="landing__form form" enctype="multipart/form-data" action="controller/controller.php" method="posr">
                        <p>* Fields that you need to fill in!</p>
                        <div class="landing__title mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Page title*</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter page title">
                        </div>
                        <div class="landing__header mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Page title for header*</label>
                            <input type="text" name="header" class="form-control" placeholder="Enter page title for header">
                        </div>
                        <div class="landing__logo mb-3">
                            <h4>Logo</h4>
                            <label for="formFile" class="form-label">Default file input example</label>
                            <input class="form-control" name="logo" type="file" id="formFile">
                            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                            <div id="message"></div>
                        </div>
        EOD,
        "end" => <<<EOD
                        <div class="landing__footer mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Page footer*</label>
                            <input type="text" name="footer" class="form-control" placeholder="Enter footer copyright">
                        </div>
                        <button type="submit" class="btn btn-primary mb-3" name="submitB">Generate Landing</button>
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
                return '
            <div class="landing__text mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Paragraph*</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="text'.$count.'" rows="3"></textarea>
            </div>';
            case "image":
                $count = $this->get_count_blocks_of_type('name="image');
                return '
                <div class="landing__image mb-3">
                    <h4>Image*</h4>
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input name="image'.$count.'" class="form-control" type="file" id="formFile">
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