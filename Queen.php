<?php

namespace Chess;

class Queen implements ChessFigure
{
    /**
     * @var bool
     */
    protected $white;

    /**
     * @var string
     */
    protected $curX;

    /**
     * @var int
     */
    protected $curY;

    public function __construct($white)
    {
        $this->white = (bool)$white;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Queen';
    }

    /**
     * @return bool
     */
    public function isWhite()
    {
        return $this->white;
    }

    /**
     * @param string $x
     * @param int $y
     * @return bool
     */
    public function move($x, $y)
    {
        // TODO: Implement move() method.
    }

    /**
     * @param string $x
     * @param int $y
     */
    public function pos($x, $y)
    {
        $this->curX = $x;
        $this->curY = $y;
    }
}
