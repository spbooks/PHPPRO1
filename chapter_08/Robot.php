<?php
class Robot {
    protected $x = 0;
    protected $y = 0;

    public function getCatchPhrase() {
        return 'Here I am, brain the size of ...';
    }

    public function Dance() {
        $xmove = rand(-2, 2);
        $ymove = rand(-2, 2);
        if($xmove != 0) {
            $this->x += $xmove;
        }
        if($ymove != 0) {
            $this->y += $ymove;
        }
        return true;
    }

}
?>