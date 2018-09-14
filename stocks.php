<?php
class stocks
{

    public $total;
    public $file;
    public function __construct()
    {
        $this->total = 0;
        $this->file = file_get_contents('stock.json');
    }
    public function stock(){
        $json=json_decode($this->file,true);
        $i=0;
        while($i<sizeof($json)){
        echo "stock name : " . $json[$i]["stockname"]."\n";
        echo "stockshares : " . $json[$i]["stockshares"]."\n";
        echo "cost of each share " . $json[$i]["price"]."\n";
        echo "total values : " . $json[$i]["totalvalue"]."\n";
        $this->total=$json[$i]["totalvalue"];
            $i++;
        }
    }
    public function result(){
        echo "total value : ".$this->total;
    }
}
