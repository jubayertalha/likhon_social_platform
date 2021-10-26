<?php
    class Story{
        public $storyID = "";
        public $userName = "";
        public $date = "";
        public $categoryID = "";
        public $coverPic = "";

        public function __construct($storyID,$userName,$date,$categoryID,$coverPic){
            $this->storyID = $storyID;
            $this->userName = $userName;
            $this->date = $date;
            $this->categoryID = $categoryID;
            $this->coverPic = $coverPic;
        }
    }
?>