<?php

require_once ('Tree.php');

$isShowFiles = ((isset($argv[2]) && $argv[2] === '-f')) ? true : false;
$directoryPath = $argv[1];

$tree = new Tree($directoryPath, $isShowFiles);
print_r($tree->printTree($tree->getDirectoryTree($tree->directoryPath)));