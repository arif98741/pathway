<?php
include 'src/Main/Structure.php';
include 'src/Main/File.php';
include 'vendor/autoload.php';


use Phpdark\Main\Structure as Structure;
use Phpdark\Main\File as File;





$st = new Structure('/abc',true);
$f  = new File();

echo "<pre>";
print_r($f->countFile());