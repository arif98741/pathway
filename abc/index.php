<?php
include '../src/Main/Structure.php';
include '../src/Main/File.php';
include '../vendor/autoload.php';


use Phpdark\Main\Structure as Structure;
use Phpdark\Main\File as File;



$st = new Structure('abc/def/',true);
$f  = new File();

//echo Structure::serverName(); echo "<br>";
//echo Structure::requestPath(); echo "<br>";
//echo Structure::fileCurrent(); echo "<br>";
//echo Structure::fileName(); echo "<br>";

echo $f->countFile();