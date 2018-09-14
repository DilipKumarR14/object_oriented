<?php
class Inventory
{
    public function fileCreate($filename, $txt)
    {
        $handle = fopen($filename, 'w');
        fwrite($handle, $txt);
    }
    public function readFile($filename)
    {
        $filecontent = file_get_contents($filename);
        return $filecontent;
    }
    public function createObject($filecontent)
    {
        $json = json_decode($filecontent, true);
        return $json;
    }
    public function display($json)
    {
        $a=array("rice","pulse","wheat");
        $n=sizeof($json);
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $k=$a[$i];
            $sum1=0;
        echo "Displaying the details of ".$k."\n";
            for($j=0;$j<sizeof($json[$k]);$j++)
            {    
            $name = $json[$k][$j]["name"];
            $price = $json[$k][$j]["price"];
            $weight = $json[$k][$j]["weight"];
            echo "Name : " . $name ."\n"."quantity present is " . $weight ." kg \n"."and the cost per kg is rs " . $price . "\n";
            $r = $price * $weight;
            $sum = $sum + $r;
            $sum1=$sum1+$r;
        }
        echo "\n";
        echo "Total cost is Rs" . $sum . "\n";
        echo "\n";
    }
    }
}
?>