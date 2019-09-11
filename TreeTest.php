<?php
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    public function testGetDirectoryTree()
    {
        $expected = [
            'vue' => [
                'main.js (20b)'
            ],
            'zzz.txt (21b)'
        ];
        $tree = new Tree(__DIR__ . '/data/src',true);
        $this->assertEquals($expected, $tree->getDirectoryTree($tree->directoryPath));
    }

    public function testGetDirectoryTreeWithoutFiles()
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
        $tree = new Tree(__DIR__ . '/data', false);
        $this->assertEquals($expected, $tree->getDirectoryTree($tree->directoryPath));
    }
}