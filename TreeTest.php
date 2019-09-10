<?php
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    public function testGetDir()
    {
        $expected = [
            'vue' => [
                'main.js (20b)'
            ],
            'zzz.txt (21b)'
        ];
        $tree = new Tree(true);
        $this->assertEquals($expected, $tree->getDir(__DIR__ . '/data/src'));
    }

    public function testGetDirOnly()
    {
        $expected = [
            'dist' => [
                'css',
                'html',
                'js'
            ],
            'src' => [
                'vue'
            ]


        ];
        $tree = new Tree(false);
        $this->assertEquals($expected, $tree->getDir(__DIR__ . '/data'));
    }

}