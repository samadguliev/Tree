<?php
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    public function testGetDir()
    {
        $expected = [
            'empty.txt',
            'dist',
            'src'
        ];
        $tree = new Tree(true);
        $this->assertEquals($expected, $tree->getDir(__DIR__ . '/data/'));
    }

    public function testGetDirOnly()
    {
        $expected = [
            'dist',
            'src'
        ];
        $tree = new Tree(false);
        $this->assertEquals($expected, $tree->getDir(__DIR__ . '/data/'));
    }

}