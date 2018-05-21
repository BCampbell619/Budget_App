<?php

    class Account{
        
        protected static $db_table = "ACCOUNT";
        protected static $db_string_field = array('AcctName');
        protected static $db_float_field = array('AcctBalance');
        public $AcctID;
        public $AcctName;
        public $AcctBalance;
        
    /*
    ---------------------------Value Set functionalities----------------------------
    */
        
        public function increase($amt) {
            
            $oldAmt = $this->AcctBalance;
            
            if($amt == "") {
                
                $amt = 0.00;
                
                $this->AcctBalance = (float)$oldAmt + (float)$amt;
                
            } else {
                
               $this->AcctBalance = (float)$oldAmt + (float)$amt;
                
            }
            
            $this->update_account();
            
        }
        
        public function decrement($amt) {
            
            $old = $this->AcctBalance;
            
            $this->AcctBalance = (float)$old - (float)$amt;
            
            $this->update_account();
            
        }
        
        public static function return_all_accounts() {
            
            return self::set_data("SELECT * FROM " . self::$db_table);
            
        }
        
        public static function return_account($account) {
            
            global $db;
            
            $escaped_account = $db->escape_string($account);
            
            $result = self::set_data("SELECT * FROM " . self::$db_table . " WHERE AcctName = '{$escaped_account}'");
            
            return !empty($result) ? array_shift($result) : false;
            
        }
        
    /*
    --------------------------End Value Set functionalities---------------------------
    */
        
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
        
        protected function get_float_property() {
            
            $property = array();
            
            foreach(self::$db_float_field as $field) {
                
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
       
        
        public function add_Account() {
            
            global $db;
            
            $newAccount    = $this->clean_string_property();
            
            $insertSQL = "INSERT INTO ". self::$db_table ." (".implode(array_keys($newAccount)).")";
            $insertSQL .= "VALUES ('". implode(array_values($newAccount)) . "')";
            
            if($db->get_set_query($insertSQL)) {
                
                $this->ID = $db->insert_id();
                return TRUE;
                
            } else {
                
                return FALSE;
                
            }
            
        }
        
        public function update_account() {
            
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
            
            $updateSQL = "UPDATE " . self::$db_table . " SET ";
            $updateSQL .= implode(', ', $newAmount) . " ";
            $updateSQL .= "WHERE AcctName = '" . $db->escape_string($this->AcctName) . "'";
            
            $db->get_set_query($updateSQL);
            
            return (mysqli_affected_rows(mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)) == 1) ? TRUE : FALSE;
            
        }
        
        public function delete_account() {
            
            global $db;
            
            $deleteSQL = "DELETE FROM " . self::$db_table . " ";
            $deleteSQL .= "WHERE AcctID = " . $this->AcctID . "";
            
            $db->get_set_query($deleteSQL);
            
            return (mysqli_affected_rows(mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)) == 1) ? TRUE : FALSE;
            
        }
        
    /*
    -------------------------End Database functionalities---------------------------
    */
        
    /*
    -------------------------Data setting functionalities---------------------------
    */
        
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

$acct = new Account();

?>