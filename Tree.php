<?php

class Tree
{
    private $writer = null;
    private $isShowFiles = false;

    public function __construct(\WriterInterface $writer, bool $isShowFiles)
    {
        $this->writer = $writer;
        $this->isShowFiles = $isShowFiles;
    }

    public function showTree($directoryPath, $indent='')
    {
        $directoryFiles = $this->getDirStructure($directoryPath);
        foreach ($directoryFiles as $file) {
            if ($file == end($directoryFiles)) {
                $filePrefix = '└── ';
                $indentSlash = '    ';
            } else {
                $filePrefix = '├── ';
                $indentSlash = '│   ';
            }

            if (is_dir($directoryPath . '/' . $file)) {
                $this->printStr($indent . $filePrefix . $file. "\n");
                $this->showTree($directoryPath . '/' . $file, $indent . $indentSlash);
            } elseif ($this->isShowFiles) {
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

    private function getDirStructure($directoryPath)
    {
        $directoryFiles = scandir($directoryPath);
        natcasesort($directoryFiles);
        foreach ($directoryFiles as $key => $file) {
            if ((!is_dir($directoryPath . '/' . $file ) && !$this->isShowFiles) ||
                ($file === '.' || $file === '..')) {
                unset($directoryFiles[$key]);
            }
        }
        return $directoryFiles;
    }
}