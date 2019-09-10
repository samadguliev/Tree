<?php

class Tree
{
    private $isShowFiles = false;

    public function __construct($isShowFiles)
    {
        $this->isShowFiles = $isShowFiles;
    }

    public function getDir($path)
    {
        $files = [];
        $handle = opendir($path);

        while ($file = readdir($handle)) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            if (is_dir($path . '/' . $file)) {
                $dir = $this->getDir($path . '/' . $file);
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
}