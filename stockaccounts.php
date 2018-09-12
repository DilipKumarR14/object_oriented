<?php
include "utility.php";
$ref = new utility();
class stock
{

    public function stockaccount($file)
    {
        fopen($file, 'w+');
    }
    public function valueof($sum)
    {
        return $sum;
    }
    public function sell($amt, $symbol, $sharetobuy)
    {
        $ref = new utility();
        $data = file_get_contents('sell.json');
        $json = json_decode($data, true);

        $date = date("Y-M-D h:i:a");

        $check = $this->symbolcheck($symbol);
        if ($check == false) {
            if ($amt > $json[$check]['eachshare']) {
                if ($sharetobuy < $json[$check]['noofshare']) {
                    $res=$json[$check]['noofshare'];
                    for ($i = 0; $i < sizeof($json);) {
                        if ($i == $check) {
                            $res=$res - $sharetobuy;
                            break;
                        } else {
                            $i++;
                        }
                    }
                    $addarr=array(
                    'username'=>$json[$check]['username'],
                    'stockname'=>$json[$check]['stockname'],
                    'symbol'=>$json[$check]['symbol'],
                    'noofshare'=>$res,
                    'soldate '=>$date,
                    'balance'=>$json[$check]['balance'],
                    "eachshare"=>$json[$check]['eachshare'],
                    "purchased"=>$json[$check]['purchased']);
                    
                     echo "bought!!!!\n";
                    $adjson=json_encode($addarr);
                    file_put_contents('sell.json',$adjson);
               
                    // $arr = json_encode($str);
                    // file_put_contents('sell.json', $arr);
               
                } else {
                    echo "entered more share to buy\n";
                }

            } else {
                echo "insufficent amount balance\n";
            }

            echo "\n";
        } else {
            echo "symbol doesnt exist\n";
        }
    }
    public function buy($amt, $symbol)
    {
        $ref = new utility();
        $file = file_get_contents('sell.json');
        $json = json_decode($file, true);
        echo "enter the amount\n";
        for ($i = 0; $i < sizeof($json); $i++) {
            $res = $this->symbolcheck1($symbol);
            if ($res == $i) {
                echo "enter the amount of shares to buy\n";
                $sh = $ref->getint();
                $kbal=$json[$i]['balance'];
                $total=$json[$i]['noofshare']+$sh;

                $json[$i]['balance']=$kbal+$amt*$sh;//balance incr
                $json[$i]['noofshare']=$total;//shares sold
                $json[$i]['solddate']=date("Y-M-D h:i:a");
                $json[$i]['username']=$json[$i]['username'];
                $json[$i]['stockname']=$json[$i]['stockname'];
                $json[$i]['symbol']=$json[$i]['symbol'];
                $json[$i]['eachshare']=$json[$i]['eachshare'];
                $json[$i]['purchased']=$json[$i]['purchased'];

                $jsondata=json_encode($json);
                file_put_contents('sell.json',$jsondata);
                echo "sold !!!!!\n";
                break;
            }
            else{
                echo "share is not available\n";
            }
        }

    }

    public function symbolcheck($symbol)
    {
        $data = file_get_contents('sell.json');
        $json = json_decode($data, true);
        $i = 0;
        while ($i < 1) {
            if ($json[$i]['symbol'] == $symbol) {
                return false;
            } else {
                $i++;
            }
        }

    }

    public function symbolcheck1($symbol)
    {
        $data = file_get_contents('sell.json');
        $json = json_decode($data, true);
        $i = 0;
        while ($i < sizeof('sell.json')) {
            if ($json[$i]['symbol'] == $symbol) {
                return $i;
            } else {
                $i++;
            }
        }

    }
    public function printreport($str){
        echo "\n";
        $file=file_get_contents($str);
        $json=json_decode($file,true);
        echo "name : ".$json['username'] . "\n";
        echo "balance : ".$json['balance'] . "\n";
        echo "stockname : ".$json['stockname']."\n";
        echo "symbol: ".$json['symbol']."\n";
        echo "noofshare: ".$json['noofshare']."\n";
        echo "balance: ".$json['balance']."\n";
        echo "purchased time : ".$json['purchased']."\n";
        echo "sold time : ".$json['soldate']."\n";
        echo "\n";

    }

}
$s = new stock();
// $s->buy(1000, '@');
$s->sell(15400, '@',1);
$s->printreport('sell.json');
