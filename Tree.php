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
//            var_dump($file);

            if (is_dir($path . $file) || $this->isShowFiles) {
                $files[] = $file;
            }
        }
        closedir($handle);
//        print_r($files);
        return $files;
    }
}