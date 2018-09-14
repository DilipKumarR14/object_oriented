<?php
include "utility.php";
$ref=new utility();
$file=file_get_contents('file1.json');
$decode=json_decode($file,true);
print_r($decode);
$ref->json1($decode);
?>