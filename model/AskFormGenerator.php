<?php
class AskFormGenerator
{
    private $block_parts = [
        "start" => '<h3>Header and footer are already included</h3><form class="generator__form" enctype="multipart/form-data" action="index.php" method="POST">',
        "end" => '<input type="submit" value="+" name="add-block" class="btn btn-form btn-add-block btn-primary"><input type="submit" name="blocks-types" class="btn btn-primary btn-form"></form>',
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
    public function __construct($blocksAmount = 0)
    {
        $this->blocksAmount = $blocksAmount;
    }
    public function add_block()
    {
        $this->blocksAmount += 1;
    }
    public function generate_form()
    {
        $this->blocks[] = $this->block_parts["start"];
        $this->blocks[] = '<input type="hidden" name="currentAmountBlocks" value="'.$this->getBlocksAmount().'">';
        for ($i = 0; $i < $this->getBlocksAmount(); $i++) {
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
