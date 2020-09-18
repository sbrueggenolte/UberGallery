<?php

// TODO: implement login check

$file = __DIR__ . '/' . $_GET['file'];
$filename = basename($file);

header('Content-type: application/zip');
header('Content-Disposition: attachment; filename="' . $filename . '"');
echo file_get_contents($file);