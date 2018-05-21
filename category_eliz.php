<?php

    class CategoryEliz extends Category {
        
        protected static $db_table = "CATEGORY";
        protected static $db_string_field = array('CategoryName');
        protected static $db_float_field = array('CategoryAmt_E', 'CategoryProj_E');
        public $CategoryName;
        public $CategoryAmt_E;
        public $CategoryProj_E;
        
    }

    $Eliz_Budget = new CategoryEliz();

?>