<?php
include "utility.php";
abstract class Sample
{
    abstract public function valueof($sum);
    abstract public function buy($amount, $symbol);
    abstract public function sells($symbol);
    abstract public function symbolcheck($symbol);
    abstract public function printreport($str);
}
class Stock extends Sample
{
    public function StockAccoount()
    {
        $stockname = null;
        $stockshares = 0;
        $price = 0;

        $url = 'user.json';
        $data = file_get_contents($url);
        $ch = json_decode($data, true);
        $ref=new utility();
        for ($i = 0; $i < 1; $i++) {
            echo "enter the user name : ";
            $user=$ref->getstring();
            echo "enter the balance : ";
            $bal=$ref->getint();

            echo "enter the no of shares : ";
            $stockshares = $ref->getint();

            echo "enter the share price of each share : ";
            $price = $ref->getint();

            $totalvalue = $stockshares * $price;
            $ch[$i]['username']=$user;
            $ch[$i]['balance']=$bal;
            $ch[$i]['eachshare'] = $stockshares;
            $ch[$i]['stockname']=null;
            $ch[$i]["symbol"]=null;
            $ch[$i]['purchased']=null;
            $ch[$i]['solddate']=null;
        }
        echo "\n";
        $jsonData = json_encode($ch);
        file_put_contents('user.json', $jsonData); // put the contents into json
        // echo "-----------------------stock report-------------------------------\n";
        // $count = 0;
        // foreach ($ch as $key => $value) {
        //     echo "total of  " . $value['stockname'] . " has " . $value['stockshares'] . " shares " .
        //     "and value of each shares value is  " . $value['price'] .
        //     " total value is " . $this->calculate($value['stockshares'], $value['price']) .
        //         "\n";
        // }
    }
    public function valueof($sum)
    {
        return $sum;
    }
    public function buy($amount, $symbol)
    {

        $ref = new utility();
        $file = file_get_contents('stocksym.json');
        $json = json_decode($file, true);
        $user = file_get_contents('user.json');
        $u1 = json_decode($user, true);
        $res = $this->symbolcheck($symbol);
        if ($res < sizeof($json)) {

            if ($amount > $json[$res]['eachshare']) {
                echo "enough balance \n";
                $date = date("Y-M-d h:i:a");
                echo "enter the no of share to buy\n";
                $share = $ref->getint();
                $qw = $json[$res]['eachshare'] * $share;
                $b = $amount-$qw;
                if ($json[$res]['eachshare'] * $share < $amount) {
                    if ($share < $json[$res]['noofshares']) {
                        echo "u can buy\n";
                        print_r($file);
                        $balance = $u1[0]['balance'] - $amount + $b;
                        $u1[0]['balance'] = $balance;
                        $u1[0]['stockname'] = $json[$res]['stockname'];
                        $u1[0]['noofshare'] = $share + $u1[0]['noofshare'];
                        $u1[0]['symbol'] = $symbol;
                        $u1[0]['purchased'] = $date;
                        $u1[0]['solddate'] = $u1[0]['solddate'];
                        $u1[0]['eachshare'] = $u1[0]['eachshare'];

                        $json[$res]['stockname'] = $json[$res]['stockname'];
                        $json[$res]['noofshares'] = $json[$res]['noofshares'] - $share;
                        $json[$res]['symbol'] = $json[$res]['symbol'];
                        $json[$res]['eachshare'] = $json[$res]['eachshare'];

                        $comjson = json_encode($json);
                        file_put_contents('stocksym.json', $comjson);

                        $jsondata = json_encode($u1);
                        file_put_contents('user.json', $jsondata);
                        echo "bought\n";
                    } else {
                        echo "entered more no of share\n";
                    }
                } else {
                    echo "no ennough balance\n";
                }
            } else {
                echo "insuff balance\n";
            }
        } else {
            echo "symbol doesnt exist\n";
        }

    }

    public function sells($symbol)
    {
        $ref = new utility();
        $file = file_get_contents('stocksym.json');
        $json = json_decode($file, true);
        $user = file_get_contents('user.json');
        $u1 = json_decode($user, true);
        $res = $this->symbolcheck($symbol);

        if ($res < sizeof($json)) 
        {
            if ($u1[0]['noofshare'] > 0) 
            {
                if ($json[$res]['symbol'] == $symbol) 
                {
                        echo "u can sell\n";
                        echo "enter the no of share to sell\n";
                        $sell = $ref->getint();
                        $balsell = $u1[0]['noofshare'] - $sell;
                        $u1[0]['username'] = $u1[0]['username'];
                        $u1[0]['balance'] = $u1[0]['balance'] + $u1[0]['eachshare'] * $sell;
                        $u1[0]['stockname'] = $u1[0]['stockname'];
                        $u1[0]['noofshare'] = $u1[0]['noofshare'] - $sell;
                        $u1[0]['symbol'] = $u1[0]['symbol'];
                        $u1[0]['purchased'] = $u1[0]['purchased'];
                        $u1[0]['solddate'] = date("Y-M-d h:i:a");

                        $json[$res]['stockname'] = $json[$res]['stockname'];
                        $json[$res]['noofshares'] = $json[$res]['noofshares'] + $sell;
                        $json[$res]['symbol'] = $json[$res]['symbol'];
                        $json[$res]['eachshare'] = $json[$res]['eachshare'];

                        $comjson = json_encode($json);
                        file_put_contents('stocksym.json', $comjson);

                        $jsondata = json_encode($u1);
                        file_put_contents('user.json', $jsondata);
                } 
                else {
                    echo "different symbol\n";
                }
            } 
            else {
                echo "your share is zero\n";
            }
        } else {
            echo "symbol doesnt exist\n";
        }
    }
    public function symbolcheck($symbol)
    {
        $data = file_get_contents('stocksym.json');
        $json = json_decode($data, true);
        $i = 0;
        while ($i < sizeof($json)) {
            if ($json[$i]['symbol'] == $symbol) {
                echo "symbol exists\n";
                return $i;
            } else {
                $i++;
            }
        }
        return $i;
    }
    public function printreport($str)
    {
        echo "\n";
        $file = file_get_contents($str);
        $json = json_decode($file, true);
        echo "name : " . $json[0]['username'] . "\n";
        echo "balance : " . $json[0]['balance'] . "\n";
        echo "stockname : " . $json[0]['stockname'] . "\n";
        echo "symbol: " . $json[0]['symbol'] . "\n";
        echo "noofshare: " . $json[0]['noofshare'] . "\n";
        echo "balance: " . $json[0]['balance'] . "\n";
        echo "purchased time : " . $json[0]['purchased'] . "\n";
        echo "sold time : " . $json[0]['solddate'] . "\n";
        echo "\n";
    }
#main ends
}
function test()
{
    $ref = new utility();
    $s = new Stock();
    echo "Create the user : \n";
    // $s->StockAccoount();
    $file = file_get_contents('stocksym.json');
    $json = json_decode($file, true);
    print_r($json);
    echo "Enter the 1/buy  2/sell 3/report: ";
    $option = $ref->getint();
    switch ($option) {
        case 1:
            echo "enter the amount : ";
            $amt = $ref->getint();
            echo "enter the symbol : ";
            $sym = $ref->getstring();
            if ($sym == "!" || $sym == "@" || $sym == "#") {
                $s->buy($amt, $sym);
            } else {
                echo "Entered wrong symbol\n";
                break;
            }
            break;
        case 2:
            echo "enter the symbol : ";
            $sym = $ref->getstring();
            if ($sym == "!" || $sym == "@" || $sym == "#") {
                $s->sells($sym);
                
            } else {
                echo "entered wrong symbol\n";
            }
            break;
        case 3:
        echo "REPORT : \n";
        $s->printreport('user.json');
        break;
        default:
            echo "ENTERED wrong option\n";
            test();
    }
}

test();
?>