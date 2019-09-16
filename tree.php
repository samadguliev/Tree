<?php

require_once ('bootstrap.php');

$isShowFiles = ((isset($argv[2]) && $argv[2] === '-f')) ? true : false;
$directoryPath = $argv[1];

$writer = new WriterStdout();
//$writer = new WriterFile('./text.txt');
$tree = new Tree($writer, $isShowFiles);
$tree->showTree($directoryPath);