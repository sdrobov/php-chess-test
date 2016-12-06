<?php

namespace Chess;

class ChessBoardFileSerializer implements ChessBoardSerializer
{
    /**
     * @var string
     */
    protected $fileName;

    public function __construct ($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @param ChessBoard $chessBoard
     * @return bool
     */
    public function save (ChessBoard $chessBoard)
    {
        if (file_exists($this->fileName) && !is_writable($this->fileName)) {
            return false;
        }

        file_put_contents($this->fileName, serialize($chessBoard));

        return true;
    }

    /**
     * @return ChessBoard
     */
    public function load ()
    {
        if (!file_exists($this->fileName) || !is_readable($this->fileName) || !is_file($this->fileName)) {
            throw new \Exception("Cant read {$this->fileName}");
        }

        $chessBoard = unserialize(file_get_contents($this->fileName));
        if (!$chessBoard || !($chessBoard instanceof ChessBoard)) {
            throw new \Exception('Invalid save file');
        }

        return $chessBoard;
    }
}
