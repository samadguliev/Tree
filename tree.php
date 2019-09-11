<?php

require_once ('Tree.php');

$isShowFiles = ($argv[2] === '-f') ? true : false;
$directoryPath = $argv[1];

$tree = new Tree($directoryPath, $isShowFiles);
$tree->printTree($tree->getDirectoryTree($tree->directoryPath));