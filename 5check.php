<?php
include "utility.php";
include "sa.php";

function check(){
$s = new Stock();
$ref=new utility();
$user = file_get_contents('user.json');
$u1 = json_decode($user, true);


echo "shares availiable jio->!,airtel->@,idea-># : \n";

$file = file_get_contents('stocksym.json');
$json = json_decode($file, true);
print_r($json);
echo "enter the symbol for jio-->! , airtel-->@  , idea-->#  : ";
$symbol=$ref->getstring();

echo "enter the 1-buy / 2-sell : ";
$option=$ref->getint();

switch ($option) {
    case 1:
    echo "enter the amount : ";
    $amt=$ref->getint();
    $s->buy($amt, $symbol);
    $s->printreport();
    echo "\n";
    break;

    case 2:
    echo "enter the amount : ";
    $amt=$ref->getint();
    $s->sell($amt, $symbol);
    $s->printreport();
    echo "\n";
    break;

    default:
        echo "choose the correct option\n";
        check();
        echo "\n";
        break;
}


}
check();
?>