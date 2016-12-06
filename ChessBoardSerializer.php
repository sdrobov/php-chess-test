<?php

namespace Chess;

interface ChessBoardSerializer
{
    /**
     * @param ChessBoard $board
     * @return bool
     */
    public function save (ChessBoard $board);

    /**
     * @return ChessBoard
     */
    public function load ();
}
