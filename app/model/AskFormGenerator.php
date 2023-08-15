<?php
class AskFormGenerator
{
    private $blockParts = [
        "start" => '<h3>Header and footer are already included</h3><form class="generator__form" enctype="multipart/form-data" action="index.php" method="POST"><div class="generator__form-options">',
        "end" => '<button id="addBlockButton" class="btn btn-form btn-add-block btn-primary">+</button><input type="submit" name="blocks-types" class="btn btn-primary btn-form"></form>',
    ];
    private $blocksAmount = 0;
    private $blocks = [];
    public function getBlocksAmount()
    {
        return $this->blocksAmount;
    }
    public function setBlocksAmount($blocksAmount)
    {
        $this->blocksAmount = $blocksAmount;
        return $this;
    }
    public function __construct($blocksAmount = 0, $blocks = [])
    {
        $this->blocksAmount = $blocksAmount;
        $this->blocks = $blocks;
    }
    public function generateForm($blocksAmount = 0)
    {
        if($blocksAmount <= 0){
            $blocksAmount = $this->getBlocksAmount();
        }
        for ($i = 0; $i < $blocksAmount; $i++) {
            $this->blocks[] = <<<EOD
                <div class="blocks__item">
                    <label class="m-1">Choose your block type*</label>
                    <select class="form-select" name="blockType{$i}" required>
                        <option value="heading">Heading</option>
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
        array_unshift($this->blocks, $this->blockParts["start"]); 
        $this->blocks[] = '</div><input type="hidden" name="currentAmountBlocks" value="'.$this->getBlocksAmount().'">';
        $this->blocks[] = $this->blockParts["end"];
        if (count($this->blocks) > 0) {
            foreach ($this->blocks as $str) {
                echo $str;
            }
        }
    }
}
