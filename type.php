<?php

class Type{
        
        protected static $db_table = "CATEGORY_TYPE";
        protected static $db_string_field = array('CategoryType', 'CategoryName');
        public $CategoryType;
        public $CategoryName;
        
/*
    -------------------------Data Cleansing functionalities---------------------------
    */
        
        protected function get_string_property() {
            
            $property = array();
            
            foreach(self::$db_string_field as $field) {
                
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
        
    /*
    ---------------------End Data Cleansing functionalities---------------------
    */

    /*
    -------------------------Database functionalities---------------------------
    */
        
        public function add_Type() {
            
            global $db;
            
            $newType    = $this->clean_string_property();
            
            $insertSQL = "INSERT INTO ". self::$db_table ." (".implode(", ", array_keys($newType)).")";
            $insertSQL .= "VALUES ('". implode( "', '", array_values($newType)) . "')";
            
            if($db->get_set_query($insertSQL)) {
                
                $this->ID = $db->insert_id();
                return TRUE;
                
            } else {
                
                return FALSE;
                
            }
            
        }
        
        public function update_type() {
            
            global $db;
            
            $type      = $this->clean_string_property();
            
            $newType    = array();
            
            foreach($type as $key => $value) {
                
                $newType[] = "{$key}='{$value}'";
                
            }
            
            $updateSQL = "UPDATE " . self::$db_table . " SET ";
            $updateSQL .= implode(', ', $newType) . " ";
            $updateSQL .= "WHERE CategoryType = '" . $db->escape_string($this->CategoryType) . "'";
            
            $db->get_set_query($updateSQL);
            
            return (mysqli_affected_rows(mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)) == 1) ? TRUE : FALSE;
            
        }
        
        public function delete_retailer() {
            
            global $db;
            
            $deleteSQL = "DELETE FROM " . self::$db_table . " ";
            $deleteSQL .= "WHERE CategoryType = '" . $this->CategoryType . "'";
            
            $db->get_set_query($deleteSQL);
            
            return (mysqli_affected_rows(mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)) == 1) ? TRUE : FALSE;
            
        }
        
    /*
    -------------------------End Database functionalities---------------------------
    */
        
    /*
    -------------------------Data setting functionalities---------------------------
    */
        
        public static function return_all_types() {
            
            return self::set_data("SELECT * FROM " . self::$db_table ." ;");
            
        }
        
        public static function return_a_type($type) {
            
            global $db;
            
            $escaped_category = $db->escape_string($type);
            
            $result = self::set_data("SELECT * FROM " .self::$db_table . " WHERE CategoryType = '{$escaped_category}'");
            
            return !empty($result) ? array_shift($result) : false;
            
        }
        
        private static function set_data($sql) {
            
            global $db;
            
            $resultSet = $db->get_set_query($sql);
            
            $objectArray = array();
            
            while($row = mysqli_fetch_array($resultSet)) {
                
                $objectArray[] = self::instantiation($row);
                
            }
            
            return $objectArray;
            
        }
        
        public static function instantiation($recordSet) {
            
            $newObject = new self;
            
            foreach ($recordSet as $attribute => $value) {
                
                if($newObject->has_attribute($attribute)) {
                    
                    $newObject->$attribute = $value;
                    
                }
                
            }
            
            return $newObject;
            
        }
        
        private function has_attribute($attribute) {
            
            $objectProperties = get_object_vars($this);
            
            return array_key_exists($attribute, $objectProperties);
            
        }
        
    /*
    -------------------------End Data setting functionalities---------------------------
    */
        
    }

$type = new Type();

?>