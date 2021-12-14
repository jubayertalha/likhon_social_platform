<?php
    class React{
        public $reactID = "";
        public $storyID = "";
        public $userName = "";
        public $date = "";

        public function __construct($reactID,$storyID,$userName,$date){
            $this->storyID = $storyID;
            $this->userName = $userName;
            $this->date = $date;
            $this->reactID = $reactID;
        }
    }
?>