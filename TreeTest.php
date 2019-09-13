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
        $writer = new WriterBuffer();
        $tree = new Tree($writer);
        $this->assertEquals($expected, $tree->showTree(__DIR__ . '/data/src',true));
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
        $writer = new WriterStdout();
        $tree = new Tree($writer);
        $this->assertEquals($expected, $tree->showTree(__DIR__ . '/data', false));
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