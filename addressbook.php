<?php
include "utility.php";
interface Address {
    public function create();
    public function update();
    public function view();
    public function delete();
    public function sort();

}
class AddressBook implements Address{

    public function create(){

        $ref=new utility();
         
        $url = 'file.json';
        $data = file_get_contents($url);
        $ch = json_decode($data, true);

      
        echo "enter the first name : ";
        $first=$ref->getstring();        
        echo "enter the last name : ";
        $last=$ref->getstring();
        echo "enter the mobile no : ";
        $mobile=$ref->getint();
        echo "enter the street number : ";
        $streetno=$ref->getint();
        echo "enter the street name : ";
        $streetname=$ref->getstring();
        echo "enter the district name : ";
        $districtname=$ref->getstring();
        echo "enter the state name : ";
        $statename=$ref->getstring();
        echo "enter the zip : ";
        $zip=$ref->getint();

        $addarr = array(
            'First name' => $first,
            'Last name' => $last,
            'Mobile number' => $mobile,
            'Street number' => $streetname,
            'Street name' => $streetname,
            'District name'=>$districtname,
            'State name'=>$statename,
            'Zip code'=>$zip,
        );
        $data_results = file_get_contents('file.json');
        $tempArray = json_decode($data_results,true);
        //append additional json to json file
        $tempArray[] = $addarr;
        $jsonData = json_encode($tempArray);
        file_put_contents('file.json', $jsonData);
    }

    public function update(){
        $ref=new utility();
        echo "enter the mobile number of person need to be changed to update other informations\n";
        $mobile=$ref->getint();
        $filecontent=file_get_contents('file.json');
        $json=json_decode($filecontent,true);
        $res=$this->check($json,$mobile);
        echo $res."\n";
        $a=count($json);
        if($res>=$a){
            echo "record not found\n";
        }
        else{
            echo "enter 1/firstname 2/lastname 3/mobilenumber 4/street numeber \n";
            echo "5/street name 6/district name 7/state name 8/zip code : ";
            $option=$ref->getint();
            switch ($option) {
                case 1:
                    echo "enter the first name to be updated : ";
                    $first=$ref->getstring();
                    $json[$res]['First name']=$first;
                    break;
                case 2:
                    echo "enter the last name to be updated : ";
                    $last=$ref->getstring();
                    $json[$res]['Last name']=$last;
                    break;
                case 3:
                    echo "enter the mobile number to be updated : ";
                    $mobile=$ref->getstring();
                    $json[$res]['Mobile number']=$mobile;
                    break;
                case 4:
                    echo "enter the street number to be updated : ";
                    $sn=$ref->getstring();
                    $json[$res]['Street number']=$sn;
                    break;
                    
                case 5:
                    echo "enter the street name to be updated : ";
                    $sn=$ref->getstring();
                    $json[$res]['Mobile number']=$sn;
                    break;
                case 6:
                    echo "enter the district name to be updated : ";
                    $sn=$ref->getstring();
                    $json[$res]['District name']=$sn;
                    break;
                
                case 7:
                    echo "enter the state name to be updated : ";
                    $sn=$ref->getstring();
                    $json[$res]['State name']=$sn;
                    break;
                case 8:
                    echo "enter the zip code to be updated : ";
                    $sn=$ref->getstring();
                    $json[$res]['Zip code']=$sn;
                    break;
                    
                default:
                    echo "entered wrong option\n";
                    break;
            }
            $string = json_encode($json);
            file_put_contents('file.json', $string);
        }
    }
    public function view(){
        $ref=new utility();
        echo "enter the mobile number to view the particular person information : ";
        $mobile=$ref->getint();
        $filecontent=file_get_contents('file.json');
        $json=json_decode($filecontent,true);
        $res=$this->check($json,$mobile);
        if($res<sizeof($json)){
            echo "first name : ".$json[$res]['First name'] ."\n";
            echo "last name : ".$json[$res]['Last name'] ."\n";
            echo "mobile number : ".$json[$res]['Mobile number'] ."\n";
            echo "street number : ".$json[$res]['Street number'] ."\n";
            echo "street name : ".$json[$res]['Street name'] ."\n";
            echo "district name :  ".$json[$res]['District name'] ."\n";
            echo "zip code :  ".$json[$res]['Zip code'] ."\n";
        }
        else {
            echo "REcord not found \n";
        }
    }

    public function delete(){
        $ref=new utility();
        echo "enter the mobile number of a person to delete other informations\n";
        $mobile=$ref->getint();
        $filecontent=file_get_contents('file.json');
        $json=json_decode($filecontent,true);
        $res=$this->check($json,$mobile);
        echo $res."\n";
        if($res>$json){
            echo "record not found\n";
        }
        else{
            echo "enter 1/firstname 2/lastname 3/mobilenumber 4/street numeber ";
            echo "5/street name 6/district name 7/state name 8/zip code : ";
            $option=$ref->getint();
            switch ($option) {
                case 1:
                    $json[$res]['First name']=null;
                    break;
                case 2:
                    $json[$res]['Last name']=null;
                    break;
                case 3:
                    $json[$res]['Mobile number']=null;
                    break;
                case 4:
                    $json[$res]['Street number']=null;
                    break;
                    
                case 5:
                    $json[$res]['Mobile number']=null;
                    break;
                case 6:
                    $json[$res]['District name']=null;
                    break;
                
                case 7:
                    $json[$res]['State name']=null;
                    break;
                case 8:
                    $json[$res]['Zip code']=null;
                    break;
                    
                default:
                    echo "entered wrong option\n";
                    break;
            }
            $string = json_encode($json);
            file_put_contents('file.json', $string);
        }
    }
    function stringsort($str1)
{
    $a1=array();
    $filecontent=file_get_contents('file.json');
    $json1=json_decode($filecontent,true);
    for($i=0;$i<sizeof($json1);$i++)
    {
        $a1[$i]=$json1[$i];
    
    }
  $i=0;
  $json1=json_decode($filecontent,true);
  for($i = 0; $i < sizeof($json1); $i++) 
    {
        for ($j = 0; $j < sizeof($json1)- $i - 1; $j++) 
        {
            if ($a1[$j][$str1] > $a1[$j+1][$str1])
            {
                $t = $a1[$j];
                $a1[$j] = $a1[$j+1];
                $a1[$j+1] = $t;
            }
        }
    }
  print_r($a1);
}

function intsort($str1)
{
    $a1=array();
    $filecontent=file_get_contents('file.json');
    $json1=json_decode($filecontent,true);
    for($i=0;$i<sizeof($json1);$i++)
    {
        $a1[$i]=$json1[$i];
    
    }
  $i=0;
  $json1=json_decode($filecontent,true);
  for($i = 0; $i < sizeof($json1); $i++) 
    {
        for ($j = 0; $j < sizeof($json1)- $i - 1; $j++) 
        {
            if ($a1[$j][$str1] > $a1[$j+1][$str1])
            {
                $t = $a1[$j];
                $a1[$j] = $a1[$j+1];
                $a1[$j+1] = $t;
            }
        }
    }
    print_r($a1);
}

public function sort(){
        $ref=new utility();
        $filecontent=file_get_contents('file.json');
        $json=json_decode($filecontent,true);
        echo "enter 1/firstname 2/lastname 3/mobilenumber 4/street numeber \n";
        echo "5/street name 6/district name 7/state name 8/zip code : ";
        $option=$ref->getint();
        switch($option)
     {
         case 1:
         $this->stringsort("First name");
                break;
         case 2:
         $this->stringsort("Last name");
               break;
         case 3:
         $this->intsort("Mobile number");
                 break;
         case 4: 
         $this->intsort("Street number");
                 break;
         case 5: 
         $this->stringsort("Street name");
                  break;
         case 6:
         $this->stringsort("District name");
                   break;
         case 7:
         $this->stringsort("State name");
                 break;
         case 8:
         $this->intsort("Zip code");
                break;
         default :echo "You have chosen wrong option \n";
     }

}

    function check($json,$mobile){
        $i=0;
        while($i<count($json)){
            if ($mobile == $json[$i]['Mobile number']){
                return $i;
                break;
            }
            else {
                $i++;
            }
        }
        return $i;
    }

}






?>