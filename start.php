<?php

//var_dump($argv);

$dir = '/home/samad/PhpstormProjects/tree';

function scandirs($start)
{
    $files = array();
    $handle = opendir($start);

    while (($file = readdir($handle)) !== false) {

        if ($file != '.' && $file != '..') {
            //var_dump($file);
            if (is_dir($start . '/' . $file)) {
                $dir = scandirs($start . '/' . $file);
                $files[$file] = $dir;
            } else {
                $fileSize = filesize($start . '/' . $file);
                $file .= ' (' . $fileSize . 'b)';
                array_push($files, $file);
            }
        }
    }
    closedir($handle);
    return $files;
}

//__DIR__
//print_r(scandirs('./'));