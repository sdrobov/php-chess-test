<?php

namespace Chess;

interface ChessFigure
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return bool
     */
    public function isWhite();

    /**
     * @param string $x
     * @param int $y
     * @return bool
     */
    public function move($x, $y);

    /**
     * @param string $x
     * @param int $y
     */
    public function pos($x, $y);
}
