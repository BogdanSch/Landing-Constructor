<?php
class Footer extends Block
{
    private $landing_footer;
    function __construct($landing_footer = "Footer")
    {
        $this->landing_footer = $landing_footer;
    }
    public function draw()
    {
        $str = <<<EOD
        </div>
    </main>
    <!-------------Block "Footer"-------------------------->
    <footer class='footer'>
        <div class="container">
            <div class="footer__wrap">
                <h3>{$this->landing_footer}</h3> 
            </div>
        </div>   
    </footer>
    <!-------------Конец блока "Footer"-------------------->\n
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
EOD;
        return $str;
    }
}