<?php
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    public function testGetDir()
    {
        $expected = [
            'somefile.php',
            'somepoddir'
        ];
        $tree = new Tree(true);
        $this->assertEquals($expected, $tree->getDir(__DIR__ . '/somedir/'));
    }

    public function testGetDirOnly()
    {
        $expected = [
            'somepoddir'
        ];
        $tree = new Tree(false);
        $this->assertEquals($expected, $tree->getDir(__DIR__ . '/somedir/'));
    }

}