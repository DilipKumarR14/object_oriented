<?php
include "node.php";
class LinkList
    {
        public $head = null;
        public $next = null;
        private static $count = 0;
        public function Count()
        {
            return self::$count; //accessing the static content
        }
        public function Insert($item)
        {
            if ($this->head == null) {
                $this->head = new Node($item);
            } else {
                $current = $this->head;
                while ($current->next != null) {
                    $current = $current->next;
                }

                $current->next = new Node($item);
            }

            self::$count++;
        }
        public function Delete($key)
        {
            $current = $previous = $this->head;
            // $current=$previous;
            // $previous=$this->head;
            while ($current->data != $key) {
                $previous = $current;
                $current = $current->next;
            }
            if ($current == $previous) {
                $this->head = $current->next;
            }
            $previous->next = $current->next;

            self::$count--;
        }

        public function PrintAsList()
        {
            $items = [];
            $current = $this->head;
            while ($current != null) {
                array_push($items, $current->data);
                $current = $current->next;
            }
            $str = '';
            foreach ($items as $item) {
                $str .= $item . " ";
            }
            echo $str;
            echo "\n";
        }
        public function search($str)
        {
            $current = $this->head;
            while ($current->next != null) {
                if ($current->data == $str) {
                    return $current->data;
                } else {
                    $current = $current->next;
                }
            }
        }
        
        public function insertAt($element,$key)
        {
            $link=new LinkList($element);
            $prev=null;
            $curr=null;
            for($i=0;$i<$key;$i++)
            {
                $prev=$curr;
                $curr=$curr->next;
            }
            $prev->next=$link;
            $link->next=$curr;
            self::$count++;
        }
        # search the element
        public function searching($string)
        {
            $curr=$this->head;
            while($curr!=null)
            {
                if($curr->data == $string){
                    return true;
                    break;
                }
                elseif ($curr->data != $string) {
                    $curr=$curr->next;
                }
                else
                {
                    return false;
                }   
            }
        }
        #return the particular index
        public function get($index)
        {
            $node=$this->head;
            $r=0;
            for($i=0;$i<$index;$i++)
            {
                if($i==$index-1)
                {
                    $r=$node->data;
                }
                $node=$node->next;
            }
            return $r;
        }
    }

    // $link=new LinkList();
    // $link->Insert(10);
    // $link->Insert(20);
    // $link->Insert(30);
    // $link->Insert(60);
    // $link->Delete(20);
    // print_r($link);
?>