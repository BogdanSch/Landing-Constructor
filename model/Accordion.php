<?php
class Accordion extends Block
{
  private $accordion_title;
  private $accordion_content;

  public function __construct($accordion_title, $accordion_content)
  {
    $this->accordion_title = $accordion_title;
    $this->accordion_content = $accordion_content;
  }
  public function draw()
  {
    $str = <<<EOD
     <!-------------Block "Accordion"-------------------------->
     <div class="accordion" id="accordionExample">
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					{$this->accordion_title}
				</button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
				<div class="accordion-body">
					{$this->accordion_content}
				</div>
			</div>
		</div>
	</div>
    <!-------------End of Block "Accordion"-------------------->\n
EOD;
    return $str;
  }
}