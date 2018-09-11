<?php
include "utility.php";
class Manager
{
 function manager(){
     $ref=new utility();
     $ref->inventoryfactory();
 }
}
$man=new Manager();
?>