<?php

class WriterStdout implements WriterInterface
{
    public function printStr(String $str)
    {
        echo $str;
    }
}