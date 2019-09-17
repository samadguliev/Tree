<?php
use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream,
    org\bovigo\vfs\vfsStreamDirectory,
    org\bovigo\vfs\vfsStreamWrapper;

class TreeTest extends TestCase
{
    private $file_system;
    public function setUp() {
        $directory = [
            'data' => [
                'dist' => [
                    'css' => [
                        'app.css' => 'some css file '
                    ],
                    'html' => [
                        'index.html' => 'some html file '
                    ],
                    'js' => [
                        'app.js' => 'some js file '
                    ],
                ],
                'src' => [
                    'vue' => [
                        'main.js' => '12346578901234567891'
                    ],
                    'zzz.txt' => '123465789012345678901'
                ],
                'empty.txt' => ''
            ]
        ];
        $this->file_system = vfsStream::setup('root', 444, $directory);
    }

    public function testGetDirectoryTree()
    {
        $expected = "├── vue
│   └── main.js (20b)
└── zzz.txt (21b)
";
        $writer = new WriterBuffer();
        $tree = new Tree($writer, true);
        $tree->showTree($this->file_system->url() . '/data/src/');
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
        $tree->showTree($this->file_system->url() . '/data');
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
        $tree->showTree($this->file_system->url() . '/data/dist');
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

        vfsStream::newFile('testText.txt', 0777)->setContent('')->at(
            $this->file_system->getChild('data')
        );
        $writer = new WriterFile($this->file_system->url() .'/data/testText.txt');
        $tree = new Tree($writer, true);
        $tree->showTree($this->file_system->url() . '/data/dist');
        $fileContent = file_get_contents($this->file_system->url() .'/data/testText.txt');
        $this->assertEquals($expected, $fileContent);
    }
}