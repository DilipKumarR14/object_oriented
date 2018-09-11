<?php
include "utility.php";
include "linkedlist.php";
class StockAccount
{
    public function StockAccount($file)
    {
        $file = fopen($file, 'w+');
    }
    public function valueof($sum)
    {
        return $sum;
    }

    public function buy($amt, $symbol, $string)
    {
        $link = new LinkList();
        $file = file_get_contents('stocksym.json');
        $filesym = file_get_contents($string);
        $json = json_decode($file, true);
        $json1 = json_decode($filesym, true);
        for ($i = 0; $i < sizeof($json); $i++) {

            $k=$json1[$i]['symbol'];
            $s1=0;
            if($sum<$json[0]['balance'] && $amt>=$json[$i]['eachshare'] ){
                $amt1=$json[$i]['eachshare'];
                $share=$json[$i]['noofshares'];
                $s1=floor($amt/$amt1);
                $k=$json1[0]['balance'];
                $k11=$k-$amt*$s1;
                $json1[0]['balance']=$k11;
                if($share>$s1){
                    $ch=$this->check($symbol,$s1,$k11,$string);
                    if($n!=1){
                        $new =json_encode($json1);
                        file_put_contents($string,$new);
                        $company=$json[$i]["stockname"];
                        $sym1=$symbol;
                        $ns=$s1;
                        $pos=date("Y-M-D h:i:a");
                        $arr=array(
                            'stockname'=>$company,
                            'symbol'=>$sym1,
                            'noofshare'=>$pos,
                            'soldDate'=>"00-00-00",
                        );
                        $date_res=file_get_contents($string);
                        $temparr=json_decode($date_res);
                        $temparr[]=$arr;
                        $jsondata=json_encode($temparr);
                        file_put_contents($str,$jsondata);
                    }
                    else {
                        echo "no share \n";
                    }
                }
                else{
                    echo "insufficient balance\n";
                }
                return $s1;
            }
        }
    }
    public function sell($amt,$symbol,$str){

        $ref=new utility();
        $link=new LinkList();
        $file=file_get_contents($str);
        $json=json_decode($file,true);
        $c=1;
        for($i=1;$i<sizeof($json);$i++){
            if($json[$i]["symbol"] == $symbol)
            {
                echo "enter the no of shares to sold : ";
                $n1=$ref->getint();
                $n=$json[0]['noofshares'];
                
            }
        }


    }
}
