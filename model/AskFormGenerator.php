<?php
class AskFormGenerator
{
    private $block_parts = [
        "start" => '<h3>Header and footer are already included</h3><form class="generator__form" enctype="multipart/form-data" action="index.php" method="POST">',
        "end" => '<input type="submit" name="blocks-types" class="btn btn-primary"></form>',
    ];
    private $blocksAmount;
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
    public function generate_form()
    {
        $this->blocks[] = $this->block_parts["start"];
        for ($i = 0; $i < $this->blocksAmount; $i++) {
            $this->blocks[] = <<<EOD
                <div class="blocks__item">
                    <p>Choose your block type*</p>
                    <select class="form-select" name="blockType{$i}">
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
