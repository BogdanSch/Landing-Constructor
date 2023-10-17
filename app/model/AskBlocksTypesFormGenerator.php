<?php
class AskBlocksTypesFormGenerator
{
    private $blockParts = [
        "start" => '<section class="landing" id="landing"><div class="container"><div class="landing__wrap"><h2>Choose your block types that you would like to have</h2><p>Header and footer are already included</p><form class="generator__form" enctype="multipart/form-data" action="index.php" method="POST"><div class="generator__form-options">',
        "end" => '<button id="addBlockButton" class="btn btn-form btn-add-block btn-primary">+</button><input type="submit" name="blocks-types" class="btn btn-primary btn-form"></form></div></div></section>',
    ];
    private $blocksAmount = 0;
    private $blocks = [];

    public function __construct($blocksAmount = 0, $blocks = [])
    {
        $this->blocksAmount = $blocksAmount;
        $this->blocks = $blocks;
        array_unshift($this->blocks, $this->blockParts["start"]);
    }
    public function getBlocksAmount()
    {
        return count($this->blocks);
    }
    public function generateForm()
    {
        for ($i = 0; $i < $this->blocksAmount; $i++) {
            $this->blocks[] = <<<EOD
                <div class="blocks__item">
                    <label class="form-label m-1" for="block-types">Choose your block type: </label>
                    <select class="form-select" name="block-types{$i}">
                        <option selected value="heading">Heading</option>
                        <option value="paragraph">Paragraph</option>
                        <option value="image">Image</option>
                        <option value="form">Form</option>
                        <option value="accordion">Accordion</option>
                    </select>
                </div>
            EOD;
        }
    }
    public function printForm()
    {
        $this->blocks[] = '</div><input type="hidden" name="currentAmountBlocks" value="' . $this->getBlocksAmount() . '">';
        $this->blocks[] = $this->blockParts["end"];

        if (count($this->blocks) > 0) {
            foreach ($this->blocks as $str) {
                echo $str;
            }
        }
    }
}
