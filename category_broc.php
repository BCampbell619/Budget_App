<?php

    class CategoryBroc extends Category{
        
        protected static $db_table = "CATEGORY";
        protected static $db_string_field = array('CategoryName');
        protected static $db_float_field = array('CategoryAmt_B', 'CategoryProj_B');
        public $CategoryName;
        public $CategoryAmt_B;
        public $CategoryProj_B;
        
    }

    $Broc_Budget = new CategoryBroc();

?>