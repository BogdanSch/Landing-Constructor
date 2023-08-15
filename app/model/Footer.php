<?php
class Footer extends Block
{
    private $landingFooterTitle;
    function __construct($landingFooterTitle = "Footer")
    {
        $this->landingFooterTitle = $landingFooterTitle;
    }
    public function draw()
    {
        $str = <<<EOD
    </main>
    <footer class='footer'>
        <div class="container">
            <div class="footer__wrap">
                <h3>{$this->landingFooterTitle}</h3> 
            </div>
        </div>   
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="assets/scripts/addBlockOption.js"></script>
</body>
</html>
EOD;
        return $str;
    }
}?>