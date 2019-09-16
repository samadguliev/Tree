<?php

class Tree
{
    private $writer = null;
    private $isShowFiles = false;

    public function __construct(\WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    public function showTree($directoryPath, $isShowFiles, $indent='')
    {
        $directoryFiles = scandir($directoryPath);
        natcasesort($directoryFiles);
        $this->printStr("\n");
        foreach ($directoryFiles as $key => $file) {
            if (!is_dir($directoryPath . '/' . $file )&& !$isShowFiles) {
                unset($directoryFiles[$key]);
            }
        }
        foreach ($directoryFiles as $file) {
            if ($file === '.' || $file === '..' || $file === '.git' || $file === '.idea') {
                continue;
            }

            $filePrefix = '├── ';
            $indentSlash = '    ';
            if ($file == end($directoryFiles)) {
                $filePrefix = '└── ';
            } else {
                $indentSlash = '│   ';
            }

            if (is_dir($directoryPath . '/' . $file)) {
                $this->printStr($indent . $filePrefix . $file);
                $this->showTree($directoryPath . '/' . $file, $isShowFiles, $indent . $indentSlash);
            } elseif ($isShowFiles) {
                $fileSize = filesize($directoryPath . '/' . $file);
                $fileSizeText = $fileSize ? (' (' . $fileSize . 'b)') : ' (empty)';
                $file .= $fileSizeText;
                $this->printStr($indent . $filePrefix . $file . "\n");
            }
        }
    }

    private function printStr(String $str)
    {
        $this->writer->printStr($str);
    }
}