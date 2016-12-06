<?php

namespace Chess;

class ChessBoardRedisSerializer implements ChessBoardSerializer
{
    /**
     * @var Redis
     */
    protected $redis;

    /**
     * @var string
     */
    protected $chessBoardName;

    public function __construct ($chessBoardName)
    {
        $this->redis = new \Redis;
        $this->redis->connect('127.0.0.1');
    }

    /**
     * @param ChessBoard $chessBoard
     * @return bool
     */
    public function save (ChessBoard $chessBoard)
    {
        return $this->redis->set($this->chessBoardName, serialize($chessBoard));
    }

    /**
     * @return ChessBoard
     */
    public function load ()
    {
        if (!$this->redis->exists($this->chessBoardName)) {
            throw new \Exception("Save {$this->chessBoardName} doesnt exists");
        }

        $chessBoard = unserialize($this->redis->get($this->chessBoardName));
        if (!$chessBoard || !($chessBoard instanceof ChessBoard)) {
            throw new \Exception('Invalid save');
        }

        return $chessBoard;
    }
}
