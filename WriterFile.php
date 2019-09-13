<?php

class WriterFile implements WriterInterface
{
    private $filePath = 'text.txt';

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function printStr(String $str)
    {
        file_put_contents($this->filePath, $str, FILE_APPEND);
    }
}