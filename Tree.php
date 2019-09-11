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

    public function printTree ($filesArray, $indent=' ', $lvl = 0)
    {
        echo "\n";
        if (!$filesArray) {
            return;
        }
        foreach ($filesArray as $key => $file) {
            $filePrefix = '';
            if ($lvl > 0) {
                $filePrefix = '└── ';
            } elseif ($lvl == 0) {
                $filePrefix = '├── ';
            }
            if (is_array($file)) {
                echo $indent . '├── ' . $key;
                $this->printTree($file, $indent . '     ', $lvl + 1);
            } else {
                echo $indent . $filePrefix . $file . "\n";
            }
        }

    }
}