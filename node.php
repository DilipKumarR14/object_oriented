<?php
class Node
    {
        public $data;
        public $next;

        public function __construct($item)
        {
            $this->data = $item;
            $this->next = null;
        }
    }
?>