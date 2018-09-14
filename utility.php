<?php
class utility
{
    //take integer input
    public function getint()
    {
        fscanf(STDIN, '%d', $num);
        if (filter_var($num, FILTER_VALIDATE_INT)) {
            return $num;
        } else {
            return $this->getint();
        }
    }

    //take integer string
    public function getstring()
    {
        fscanf(STDIN, '%s', $str);
        if (filter_var($str, FILTER_SANITIZE_STRING)) {
            return $str;
        } else {
            return $this->getstring();
        }
    }

    public function json()
    {
        $i = new Inventory();
        echo "enter the name of file : ";
        $file = $this->getstring();
        $file = $i->readFile('file1.json');
        $object = $i->createObject($file);
        $display = $i->display($object);
    }

    public function regex()
    {
        $str = "Hello <<name>>, We have your full
name as <<full name>> in our system. your contact number is 91-xxxxxxxxxx.
Please,let us know in case of any clarification Thank you BridgeLabz 01/01/2016";

        echo "enter the first name : " . "\n";
        $firstname = $this->getstring();
        echo "enter the full name : " . "\n";
        $fullname = $this->getstring();
        echo "enter the mobile numbers " . "\n";
        $mobile = $this->getint();

        $str = preg_replace("/ <<name>>/", $firstname, $str);
        $str = preg_replace("/<<full name>>/", $fullname, $str);
        $str = preg_replace("/-xxxxxxxxxx/", $mobile, $str);
        $str = preg_replace('/([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})/', date("d/m/Y"), $str);

        echo $str . "\n";
    }

    public function calculate($stockshares, $price)
    {
        return $stockshares * $price;
    }

    public function stockreport()
    {
        $stockname = null;
        $stockshares = 0;
        $price = 0;

        echo "enter the no of stocks : ";
        $nums = $this->getint();

        $url = 'stock.json';
        $data = file_get_contents($url);
        $ch = json_decode($data, true);

        for ($i = 0; $i < $nums; $i++) {
            echo "Enter the stock the name : ";
            $stockname = $this->getstring();

            echo "enter the no of shares : ";
            $stockshares = $this->getint();

            echo "enter the share price of each share : ";
            $price = $this->getint();

            $totalvalue = $stockshares * $price;

            $ch[$i]['stockname'] = $stockname;
            $ch[$i]['stockshares'] = $stockshares;
            $ch[$i]['price'] = $price;
            $ch[$i]['totalValue'] = $totalvalue;

        }
        echo "\n";
        $jsonData = json_encode($ch);
        file_put_contents('stock.json', $jsonData); // put the contents into json
        echo "-----------------------stock report-------------------------------\n";
        $count = 0;
        foreach ($ch as $key => $value) {
            echo "total of  " . $value['stockname'] . " has " . $value['stockshares'] . " shares " .
            "and value of each shares value is  " . $value['price'] .
            " total value is " . $this->calculate($value['stockshares'], $value['price']) .
                "\n";
        }
    }

    public function inventoryfactory()
    {
        $stockname = null;
        $stockshares = 0;
        $price = 0;

        echo "enter the no of stocks : ";
        $nums = $this->getint();

        $url = 'stock.json';
        $data = file_get_contents($url);
        $ch = json_decode($data, true);

        for ($i = 0; $i < $nums; $i++) {
            echo "Enter the stock the name : ";
            $stockname = $this->getstring();

            echo "enter the no of shares : ";
            $stockshares = $this->getint();

            echo "enter the share price of each share : ";
            $price = $this->getint();

            $totalvalue = $stockshares * $price;

            $ch[$i]['stockname'] = $stockname;
            $ch[$i]['stockshares'] = $stockshares;
            $ch[$i]['price'] = $price;
            $ch[$i]['totalValue'] = $totalvalue;

        }
        echo "\n";
        $jsonData = json_encode($ch);
        file_put_contents('stock.json', $jsonData); // put the contents into json
        echo "------------------------------------Stock Report-----------------------------------\n";
        $count = 0;
        foreach ($ch as $key => $value) {
            echo "total of  " . $value['stockname'] . " has " . $value['stockshares'] . " shares " .
            "and value of each shares value is  " . $value['price'] .
            " total value is " . $this->calculating($value['stockshares'], $value['price'], $nums) .
                "\n";
        }
        $res = 0;
        $temp = 0;
        foreach ($ch as $key => $value) {
            $res = $value['stockshares'] * $value['price'];
            $temp += $res;
        }
        echo "total value present in inventory  : " . $temp;
        echo "\n";

        print_r($ch);
    }

    public function calculating($stockshares, $price, $nums)
    {
        $res = $stockshares * $price;
        return $res;
    }
    public function json1($json)
    {
        $a = array("rice", "pulse", "wheat");
        $n = sizeof($json);
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $k = $a[$i];
            $sum1 = 0;
            echo "Displaying the details of " . $k . "\n";
            for ($j = 0; $j < sizeof($json[$k]); $j++) {
                $name = $json[$k][$j]["name"];
                $price = $json[$k][$j]["price"];
                $weight = $json[$k][$j]["weight"];
                echo "Name : " . $name . "\n" . "quantity present is " . $weight . " kg \n" . "and the cost per kg is rs " . $price . "\n";
                $r = $price * $weight;
                $sum = $sum + $r;
                $sum1 = $sum1 + $r;
            }
            echo "\n";
            echo "Total cost is Rs" . $sum . "\n";
            echo "\n";
        }
    }

    #main ends
}
