<?php
class AskFormGenerator
{
    private $block_parts = [
        "start" => '<h3>Header and footer are already included</h3><form class="generator__form" enctype="multipart/form-data" action="index.php" method="POST">',
        "end" => '<input type="submit" name="blocks-types"></form>',
    ];
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
    public function generate_form()
    {
        $blocks = [$this->block_parts["start"]];
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
        $this->form = $blocks;
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