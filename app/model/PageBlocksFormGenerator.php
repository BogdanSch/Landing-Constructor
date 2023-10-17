<?php

class PageBlocksFormGenerator
{
    private $blockParts = [
        "start" => <<<EOD
        <section class="landing">
            <div class="container">
                <div class="landing__wrap">
                    <h1>Landing Constructor form</h1>
                    <form class="landing__form form" enctype="multipart/form-data" action="app/controller/controller.php" method="post">
                        <p>* Fields that you need to fill in!</p>
                        <div class="landing__title mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Page title*</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter page title" required>
                        </div>
                        <div class="landing__header mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Page title for header*</label>
                            <input type="text" name="header" class="form-control" placeholder="Enter page title for header" required>
                        </div>
                        <div class="landing__logo mb-3">
                            <label class="form-label">Logo*</label>
                            <input class="form-control" name="logo" type="file" id="formFile" required>
                            <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
                            <div id="message"></div>
                        </div>
        EOD,
        "end" => <<<EOD
                        <div class="landing__footer mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Page footer*</label>
                            <input type="text" name="footer" class="form-control" placeholder="Enter footer copyright" required>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3" name="submitB">Generate Landing</button>
                    </form>
                </div>
            </div>
        </section>
    EOD,
    ];
    private $blockTypes = [];
    private $blocks = [];
    public function __construct(array $blockTypes)
    {
        $this->blockTypes = $blockTypes;
    }
    public function generateForm()
    {
        $this->blocks[] = $this->blockParts["start"];
        foreach ($this->blockTypes as $key => $value) {
            $block = $this->getBlock($value);
            if (isset($block)) {
                $this->blocks[] = $block;
            }
        }
    }
    private function getBlock($block)
    {
        switch ($block) {
            case "heading":
                $count = $this->getCountBlocksOfType('name="heading');
                return '<div class="landing_heading mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Landing Heading*</label>
                    <input class="form-control" id="exampleFormControlTextarea1" name="heading' . $count . '" rows="3" required></input>
                </div>';
            case "paragraph":
                $count = $this->getCountBlocksOfType('name="paragraph');
                return '
            <div class="landing_paragraph mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Paragraph*</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="paragraph' . $count . '" rows="3" required></textarea>
            </div>';
            case "image":
                $count = $this->getCountBlocksOfType('name="image');
                return '
                <div class="landing__image mb-3">
                    <label class="form-label">Image*</label>
                    <input name="image' . $count . '" class="form-control" type="file" id="formFile" required>
                    <input type="hidden" name="image' . $count . '">
                </div>';
            case "form":
                $count = $this->getCountBlocksOfType('name="form');
                return '<div class="landing__form">
                <label class="form-label">Form*</label>
                <input type="input" name="form' . $count . '" class="form-control" placeholder="Enter button text" required />
            </div>';
            case "accordion":
                $count = $this->getCountBlocksOfType('name="accordion');
                return '<div class="landing__accordion">
                <label class="form-label">Accordion*</label>
                <div class="form-group">
                    <small class="form-text text-muted">Accordion title</small>
                    <input type="input" name="accordion-title' . $count . '" class="form-control" placeholder="Enter accordion title" required/>
                </div>
                <div class="form-group">
                    <small class="form-text text-muted">Accordion content</small>
                    <input type="input" name="accordion-content' . $count . '" class="form-control" placeholder="Enter accordion content" required/>   
                </div>
            </div>';
            default:
                return null;
        }
    }
    private function getCountBlocksOfType($blockType)
    {
        $count = 0;
        foreach ($this->blocks as $key => $value) {
            if (str_contains($value, $blockType)) {
                $count++;
            }
        }
        return $count;
    }
    public function printForm()
    {
        $this->blocks[] = $this->blockParts["end"];
        if (count($this->blocks) > 0) {
            foreach ($this->blocks as $str) {
                echo $str;
            }
        }
    }
}
