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
        $files = [];
        $handle = opendir($path);

        while ($file = readdir($handle)) {
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
        closedir($handle);
        return $files;
    }

    public function printTree ($arr, $indent='')
    {
        $lvl = 0;
        echo "\n";
        if ($arr) {
            foreach ($arr as $key => $value) {
                if (is_array($value)) {
                    echo '   '.$indent.$key;
                    $this->printTree($value, $indent . '    ');
                } else {
                    //  Output
                    echo "$indent $value \n";
                }
            }
        }
    }
}