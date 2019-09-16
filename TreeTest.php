<?php
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    public function testGetDirectoryTree()
    {
        $expected = "├── vue
│   └── main.js (20b)
└── zzz.txt (21b)
";
        $writer = new WriterBuffer();
        $tree = new Tree($writer, true);
        $tree->showTree(__DIR__ . '/data/src');
        $this->assertEquals($expected, $writer->getBuffer());
    }

    public function testGetDirectoryTreeWithoutFiles()
    {
        $expected = "├── dist
│   ├── css
│   ├── html
│   └── js
└── src
    └── vue
";
        $writer = new WriterBuffer();
        $tree = new Tree($writer, false);
        $tree->showTree(__DIR__ . '/data');
        $this->assertEquals($expected, $writer->getBuffer());
    }

    public function testPrintTree()
    {
        $expected = '├── css
│   └── app.css (14b)
├── html
│   └── index.html (15b)
└── js
    └── app.js (13b)
';
        $writer = new WriterBuffer();
        $tree = new Tree($writer, true);
        $tree->showTree(__DIR__ . '/data/dist');
        $this->assertEquals($expected, $writer->getBuffer());
    }

    public function testFileContent()
    {
        $expected = '├── css
│   └── app.css (14b)
├── html
│   └── index.html (15b)
└── js
    └── app.js (13b)
';
        file_put_contents('./testText.txt', null);
        $writer = new WriterFile('./testText.txt');
        $tree = new Tree($writer, true);
        $tree->showTree(__DIR__ . '/data/dist');
        $fileContent = file_get_contents('./testText.txt');
        $this->assertEquals($expected, $fileContent);
    }
}