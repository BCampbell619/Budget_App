<?php

    class Category{
        
        protected static $db_table = "CATEGORY";
        protected static $db_string_field = array('CategoryName');
        protected static $db_float_field = array('CategoryAmt_B', 'CategoryProj_B', 'CategoryAmt_E', 'CategoryProj_E');
        public $CategoryName;
        public $CategoryAmt_B;
        public $CategoryProj_B;
        public $CategoryAmt_E;
        public $CategoryProj_E;
        
    /*
    ---------------------------Value Set functionalities----------------------------
    */
        
        public function increase($proj, $amt, $account) {
            
            if($account == "E_Checking") {
                
                $oldPrj = $this->CategoryProj_E;
                $oldAmt = $this->CategoryAmt_E;
                
                if($proj == "") {
                
                    $proj = 0.00;
                
                    $this->CategoryProj_E = (float)$oldPrj + (float)$proj;
                
                } else {
                
                    $this->CategoryProj_E = (float)$oldPrj + (float)$proj;
                
                }
            
                if($amt == "") {
                
                    $amt = 0.00;
                
                    $this->CategoryAmt_E = (float)$oldAmt + (float)$amt;
                
                } else {
                
                    $this->CategoryAmt_E = (float)$oldAmt + (float)$amt;
                
                }
            
                    $this->update();
                
            } else if($account == "Broc_Checking") {
                
                $oldPrj = $this->CategoryProj_B;
                $oldAmt = $this->CategoryAmt_B;
                
                if($proj == "") {
                
                    $proj = 0.00;
                
                    $this->CategoryProj_B = (float)$oldPrj + (float)$proj;
                
                } else {
                
                    $this->CategoryProj_B = (float)$oldPrj + (float)$proj;
                
                }
            
                if($amt == "") {
                
                    $amt = 0.00;
                
                    $this->CategoryAmt_B = (float)$oldAmt + (float)$amt;
                
                } else {
                
                    $this->CategoryAmt_B = (float)$oldAmt + (float)$amt;
                
                }
            
                    $this->update();
                
            }
            
        }
        
        public function decrement($amt, $account) {
            
            if($account == "E_Checking") {
                
                $oldAmt = $this->CategoryProj_E;
            
                if($amt == "") {
                
                    $amt = 0.00;
                
                    $this->CategoryProj_E = (float)$oldAmt - (float)$amt;
                
                } else {
                
                    $this->CategoryProj_E = (float)$oldAmt - (float)$amt;
                
                }
            
                    $this->update();
                
            } else if($account == "Broc_Checking") {
                
                $oldAmt = $this->CategoryProj_B;
            
                if($amt == "") {
                
                    $amt = 0.00;
                
                    $this->CategoryProj_B = (float)$oldAmt - (float)$amt;
                
                } else {
                
                    $this->CategoryProj_B = (float)$oldAmt - (float)$amt;
                
                }
            
                    $this->update();
                
            }
            
        }
        
    /*
    --------------------------End Value Set functionalities---------------------------
    */
        
    /*
    -------------------------Data Cleansing functionalities---------------------------
    */
        
        protected function get_string_property() {
            
            $property = array();
            
            foreach(static::$db_string_field as $field) {
                
                if(property_exists($this, $field)) {
                    
                    $property[$field] = $this->$field;
                    
                }
                
            }
            
            return $property;
            
        }
        
        protected function clean_string_property() {
            
            global $db;
            
            $clean_property = array();
            
            foreach($this->get_string_property() as $key => $value) {
                
                $clean_property[$key] = $db->escape_string($value);
                
            }
            
            return $clean_property;
            
        }
        
        protected function get_float_property() {
            
            $property = array();
            
            foreach(static::$db_float_field as $field) {
                
                if(property_exists($this, $field)) {
                    
                    $property[$field] = $this->$field;
                    
                }
                
            }
            
            return $property;
            
        }
        
    /*
    ---------------------End Data Cleansing functionalities---------------------
    */
        
    /*
    -------------------------Database functionalities---------------------------
    */
        
        public function create() {
            
            global $db;
            
            $newCategory    = $this->clean_string_property();
            
            $insertSQL = "INSERT INTO ". static::$db_table ." (".implode(array_keys($newCategory)).")";
            $insertSQL .= "VALUES ('". implode(array_values($newCategory)) . "')";
            
            if($db->get_set_query($insertSQL)) {
                
                $this->ID = $db->insert_id();
                return TRUE;
                
            } else {
                
                return FALSE;
                
            }
            
        }
        
        public function update() {
            
            global $db;
            
            $category       = $this->clean_string_property();
            
            $newCategory    = array();
            
            foreach($category as $key => $value) {
                
                $newCategory[] = "{$key}='{$value}'";
                
            }
            
            $amount         = $this->get_float_property();
            
            $newAmount      = array();
            
            foreach($amount as $key => $value) {
                
                $newAmount[] = "{$key}={$value}";
                
            }
            
            $updateSQL = "UPDATE " . static::$db_table . " SET ";
            $updateSQL .= implode(', ', $newAmount) . " ";
            $updateSQL .= "WHERE CategoryName = '" . $db->escape_string($this->CategoryName) . "'";
            
            $db->get_set_query($updateSQL);
            
            return (mysqli_affected_rows(mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)) == 1) ? TRUE : FALSE;
            
        }
        
        public function delete() {
            
            global $db;
            
            $deleteSQL = "DELETE FROM " . static::$db_table . " ";
            $deleteSQL .= "WHERE CategoryName = '" . $this->CategoryName . "'";
            
            $db->get_set_query($deleteSQL);
            
            return (mysqli_affected_rows(mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)) == 1) ? TRUE : FALSE;
            
        }
        
    /*
    -------------------------End Database functionalities---------------------------
    */
        
    /*
    -------------------------Data setting functionalities---------------------------
    */
        
        public static function return_all_categories() {
            
            return static::set_data("SELECT * FROM ". static::$db_table . ";");
            
        }
        
        public static function return_a_record($selection) {
            
            global $db;
            
            $escaped_category = $db->escape_string($selection);
            
            $result = static::set_data("SELECT * FROM " .static::$db_table . " WHERE CategoryName = '{$escaped_category}'");
            
            return !empty($result) ? array_shift($result) : false;
            
        }
        
        private static function set_data($sql) {
            
            global $db;
            
            $resultSet = $db->get_set_query($sql);
            
            $objectArray = array();
            
            while($row = mysqli_fetch_array($resultSet)) {
                
                $objectArray[] = static::instantiation($row);
                
            }
            
            return $objectArray;
            
        }
        
        public static function instantiation($recordSet) {
            
            $the_object = new static;
            
            foreach ($recordSet as $attribute => $value) {
                
                if($the_object->has_attribute($attribute)) {
                    
                    $the_object->$attribute = $value;
                    
                }
                
            }
            
            return $the_object;
            
        }
        
        private function has_attribute($attribute) {
            
            $objectProperties = get_object_vars($this);
            
            return array_key_exists($attribute, $objectProperties);
            
        }
        
    /*
    -------------------------End Data setting functionalities---------------------------
    */
        
    }

    $category_master = new Category();

?>