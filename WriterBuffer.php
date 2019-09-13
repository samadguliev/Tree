<?php

class WriterBuffer implements WriterInterface
{
    private $buffer = '';

    public function printStr(String $str)
    {
        $this->buffer .= $str;
    }

    public function getBuffer()
    {
        return $this->buffer;
    }
}