<?php

namespace Chess;

class ChessBoard
{
    const X_AXIS = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
    const Y_AXIS = [1, 2, 3, 4, 5, 6, 7, 8];

    /**
     * @var ChessFigure[][]
     */
    protected $figures = [];

    /**
     * @param ChessFigure $chessFigure
     * @param string $x
     * @param int $y
     * @return ChessBoard
     * @throws \Exception
     */
    public function addFigure (ChessFigure $chessFigure, $x, $y)
    {
        if (!$this->isValidX($x) || !$this->isValidY($y)) {
            throw new \Exception('Out of range');
        }

        if (!$this->isEmptyCell($x, $y)) {
            throw new \Exception("At position {$x}:{$y} already stands figure " . $this->figures[$x][$y]->getName());
        }

        $chessFigure->pos($x, $y);

        if (!isset($this->figures[$x])) {
            $this->figures[$x] = [
                $y => $chessFigure,
            ];
        } else {
            $this->figures[$x][$y] = $chessFigure;
        }

        return $this;
    }

    /**
     * @param string $fromX
     * @param int $fromY
     * @param string $toX
     * @param int $toY
     * @return ChessBoard
     * @throws \Exception
     */
    public function moveFigure($fromX, $fromY, $toX, $toY)
    {
        if (!$this->isValidX($fromX) || !$this->isValidY($fromY)) {
            throw new \Exception('Out of range');
        }

        if (!$this->isValidX($toX) || !$this->isValidY($toY)) {
            throw new \Exception('Out of range');
        }

        if ($this->isEmptyCell($fromX, $fromY)) {
            throw new \Exception("There is no figure at position {$fromX}:{$fromY}");
        }

        /** @var ChessFigure $srcFigure */
        $srcFigure = $this->figures[$fromX][$fromY];

        if (!$this->isEmptyCell($toX, $toY)) {
            /** @var ChessFigure $dstFigure */
            $dstFigure = $this->figures[$toX][$toY];

            if ($srcFigure->isWhite() == $dstFigure->isWhite()) {
                throw new \Exception('Figure at destination position is the same color, cant move there');
            }
        }

        if ($srcFigure->move($toX, $toY)) {
            $this->figures[$toX][$toY] = $srcFigure;
            unset($this->figures[$fromX][$fromY]);
        } else {
            throw new \Exception('Invalid move!');
        }

        return $this;
    }

    /**
     * @param string $x
     * @param int $y
     * @return $this
     * @throws \Exception
     */
    public function dropFigure ($x, $y)
    {
        if (!$this->isValidX($x) || !$this->isValidY($y)) {
            throw new \Exception('Out of range');
        }

        if ($this->isEmptyCell($x, $y)) {
            throw new \Exception("There is no figure at position {$x}:{$y}");
        }

        unset($this->figures[$x][$y]);

        return $this;
    }

    /**
     * @param string $x
     * @param int $y
     * @return bool
     */
    protected function isEmptyCell($x, $y)
    {
        return !isset($this->figures[$x]) || !isset($this->figures[$x][$y]);
    }

    /**
     * @param string $x
     * @return bool
     */
    protected function isValidX($x)
    {
        return in_array($x, static::X_AXIS);
    }

    /**
     * @param int $y
     * @return bool
     */
    protected function isValidY($y)
    {
        return in_array($y, static::Y_AXIS);
    }
}
