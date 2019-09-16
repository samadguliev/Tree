<?php
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    public function testGetDirectoryTree()
    {
        $expected = "
├── vue
│   └── main.js (20b)
└── zzz.txt (21b)
";
        $writer = new WriterBuffer();
        $tree = new Tree($writer);
        $tree->showTree(__DIR__ . '/data/src',true);
        $this->assertEquals($expected, $writer->getBuffer());
    }

    public function testGetDirectoryTreeWithoutFiles()
    {
        $expected = "
├── dist
│   ├── css
│   ├── html
│   └── js
└── src
    └── vue
";
        $writer = new WriterBuffer();
        $tree = new Tree($writer);
        $tree->showTree(__DIR__ . '/data',false);
        $this->assertEquals($expected, $writer->getBuffer());
    }

    public function testPrintTree ()
    {
        $expected = '
├── css
│   └── app.css (14b)
├── html
│   └── index.html (15b)
└── js
    └── app.js (13b)
';
        $writer = new WriterBuffer();
        $tree = new Tree($writer);
        $tree->showTree(__DIR__ . '/data/dist',true);
        $this->assertEquals($expected, $writer->getBuffer());
    }
}