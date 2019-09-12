<?php

class Tree
{
    private $isShowFiles = false;

    public function __construct($directoryPath, $isShowFiles)
    {
        $this->directoryPath = $directoryPath;
        $this->isShowFiles = $isShowFiles;
    }

    public function getDirectoryTree($path)
    {
        $directoryFiles = scandir($path);
        $files = [];

        foreach ($directoryFiles as $file) {
            if ($file === '.' || $file === '..' || $file === '.git' || $file === '.idea') {
                continue;
            }

            if (is_dir($path . '/' . $file)) {
                $dir = $this->getDirectoryTree($path . '/' . $file);
                if (empty($dir)) {
                    $files[] = $file;
                } else {
                    $files[$file] = $dir;
                }
            } elseif ($this->isShowFiles) {
                $fileSize = filesize($path . '/' . $file);
                $fileSizeText = $fileSize ? (' (' . $fileSize . 'b)') : ' (empty)';
                $file .= $fileSizeText;
                $files[] = $file;
            }
        }
        return $files;
    }

    public function printTree ($filesArray, $indent='')
    {
        $resultStr = "\n";
        if (!$filesArray) {
            return $resultStr;
        }
        foreach ($filesArray as $key => $file) {
            $filePrefix = '├── ';
            $indentSlash = '     ';
            if ($file == end($filesArray)) {
                $filePrefix = '└── ';
            } else {
                $indentSlash = '│    ';
            }

            if (is_array($file)) {
                $resultStr .= $indent . $filePrefix . $key;
                $resultStr .= $this->printTree($file, $indent . $indentSlash);
            } else {
                $resultStr .= $indent . $filePrefix . $file . "\n";
            }
        }
        return $resultStr;
    }
}