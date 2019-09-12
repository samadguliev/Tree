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

    public function testPrintTree ()
    {
        $expected = '
├── css
│    └── app.css (14b)
├── html
│    └── index.html (15b)
└── js
     └── app.js (13b)
';
        $tree = new Tree(__DIR__ . '/data/dist', true);
        $this->assertEquals($expected, $tree->printTree($tree->getDirectoryTree($tree->directoryPath)));
    }
}