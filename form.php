<?php

    class Form{
        
        private $projAmt;
        private $actAmt;
        private $fromAccount;
        private $toAccount;
        private $fromCategory;
        private $toCategory;
        private $amount;
        private $category;
        private $type;
        private $retailer;
        private $comment;
        private $account;
        private $purchDate;
        private $db_purch_col = array('PurchAmount', 'CategoryName', 'CategoryType', 'RetailerName', 'PurchNotes', 'AcctID', 'PurchDate');
        private $db_deposit_col = array('AcctID', 'DepositAmt', 'RetailerName', 'DepositNote', 'DepositDate');
        private $db_txfer_col = array('AcctID', 'TransferAmt', 'CategoryName', 'RetailerName', 'TransferNote', 'TransferDate');
        public $message;
        public $T_message_1;
        public $T_message_2;
        
        /*
        The private method clean_data is meant to clean all data that is entered into a form by the user.
        First the method takes in the data as a parameter (1)
        Next it trims out any space either before or after the input data (2)
        Next the method strips any special characters from the data entered (3)
        The method's final cleansing process is removing any html characters (4)
        Lastly, the method returns the cleansed data (5)
        */
        
        private function clean_data($data) {    //(1)
            
            $data = trim($data);                //(2)
            $data = stripslashes($data);        //(3)
            $data = htmlspecialchars($data);    //(4)
            
            return $data;                       //(5)
            
        }
        
        /*
        The public method process_category is used when a category is updated from the budget pages (i.e. Broc's Budget or E's Budget)
        First, four parameters are passed to the method - the projected amount, the actual amount, the category object to be manipulated, and the account that is being affected (1)
        Next, the class property projAmt is updated with the cleansed projected data (2)
        Next, the class property actAmt is updated with the cleansed actual amount data (3)
        Finally, the object that was passed to the method is used to increase the category (4)
        ****For further details on the increase() method, look to the Category Class found in the category.php file****
        */
        
        public function process_category($proj, $act, $categoryObject, $account) {  //(1)
            
            $this->projAmt = $this->clean_data($proj);                              //(2)
            $this->actAmt = $this->clean_data($act);                                //(3)
                        
            $categoryObject->increase($this->projAmt, $this->actAmt, $account);     //(4)
            
        }
        
        /*
        The private method get_account($theAccount) is used to instantiate an account object for the purposes of incrementing or decrementing a particular account.
        First, the method takes a parameter, which is the account name that is submitted through the form (1)
        Second, the variable $rtnAcct is declared and assigned the object of the submitted account (2)
        Third, that object is returned to whatever called the method (3)
        */
        
        private function get_account($theAccount) {             //(1)
            
            $rtnAcct = Account::return_account($theAccount);    //(2)
            
            return $rtnAcct;                                    //(3)
            
        }
        
/*
------------------------------------------------ Purchase Form Processing ------------------------------------------------
*/
        
        /*
        The public method validate_purchase() takes in quite a few parameters. Each of these parameters are entry pieces to the purchase form found on purchases.php
        The purpose of this method is to validate what was entered through the form before applying the submission to the database.
        First, all of the parameters are passed (1)
        Second, each parameter is inspected to make sure it meets the requirements of the table that will be receiving the data (2)
        If any parameter fails, the error message is returned to what called this method and is displayed to the user.
        Third, if the message "All good!" is found to be the value of the property $message, then the process_purchase is called & returned.
        */
        
        public function validate_purchase($amount, $category, $cat_type, $seller, $comment, $account, $month, $day, $year, $categoryObject) {   //(1)
            
            /*--------------------------------------- (2) ---------------------------------------*/
            
            if($amount == "") {
                
                $this->message = "Please enter an amount for the deposit";
                return $this->message;
                
            } elseif($category == "") {
                
                $this->message = "Please select a category";
                return $this->message;
                
            } elseif($cat_type == "") {
                
                $this->message = "Please select a category type";
                return $this->message;
                
            } elseif($seller == "") {
                
                $this->message = "Please select a retailer";
                return $this->message;
                
            } elseif($account == "") {
                
                $this->message = "Please select an account to charge";
                return $this->message;
                
            } elseif($comment == "") {
                
                $this->message = "Please add a comment";
                return $this->message;
                
            } elseif(!checkdate(intval($month), intval($day), intval($year))) {
                
                $this->message = "Please select an actual date";
                return $this->message;
                
            } else {
                
                $this->message = "All good!";
                
            }
            
            /*--------------------------------------- (2) ---------------------------------------*/
            
            if($this->message == "All good!") {     //(3)
                
                return $this->process_purchase($amount, $category, $cat_type, $seller, $comment, $account, $month, $day, $year, $categoryObject);
                
            }
            
        }
        
        /*
        The private function process_purchase() takes all the same parameters as the validate_purchase() method. The purpose of this method is to
        cleanse all data entered by the user, submit that cleansed data to the database, and update any account & category attributes as necessary.
        First, all the parameters are passed through to the method (1)
        Second, three global object variables are declared (2)
        Third, the $theAcct variable is declared and initialized by calling the get_account method, which assigns an account object to the variable (3)
        Fourth, the $year, $month, & $day parameteres are concatenated and assigned to the Form  class property purchDate. (4)
        Fifth, the entered data is cleansed and assigned to the Form class properties. 
        Once assigned they are passed through the escape string method of the Database class (5)
        Sixth, the category type that is passed to the method is checked against the database to see if it already exists.
        If it does the if condition moves on, if not the category type is added to the CATEGORY_TYPE table (6)
        Seventh, the same check is done with the retailer or seller. If it is not already in the db the RETAILER table will be updated (7)
        Eight and beyond are explained farther below....
        */
        
        private function process_purchase($amount, $category, $cat_type, $seller, $comment, $account, $month, $day, $year, $categoryObject) {   //(1)
            
            global $db;     //(2)
            global $retail; //(2)
            global $type;   //(2)

            
            $theAcct = self::get_account($account);     //(3)
            
            $this->purchDate = $year . "-" . $month . "-" . $day;   //(4)
            
            /*------------------ (5) ------------------*/
            
            $this->amount = $this->clean_data($amount);
            $this->category = $this->clean_data($category);
            $this->category = $db->escape_string($this->category);
            $this->type = $this->clean_data($cat_type);
            $this->type = $db->escape_string($this->type);
            $this->retailer = $this->clean_data($seller);
            $this->retailer = $db->escape_string($this->retailer);
            $this->comment = $this->clean_data($comment);
            $this->comment = $db->escape_string($this->comment);
            $this->account = $this->clean_data($account);
            $this->purchDate = $this->clean_data($this->purchDate);
            $this->purchDate = $db->escape_string($this->purchDate);
            
            /*------------------ (5) ------------------*/

            if(!$type->return_a_type($this->type)) {    //(6)
                
                $type->CategoryType = $this->type;
                $type->CategoryName = $this->category;
                
                $type->add_Type();
                
            }
            
            if(!$retail->return_a_retailer($this->retailer)) {  //(7)
                
                $retail->RetailerName = $this->retailer;
                
                $retail->add_Retailer();
                
            }
            
            /*
            Eighth, this section begins a validation/check on what account was selected for the purchase (8)
                a, The text held in the account property is replaced with the numerical id of the account. The table requires the ID of the account not the text (8a)
                b, A SQL statement is concatenated together to form the INSERT statement (8b)
                c, Lastly, the method validate_purchase_completion() is called to execute the SQL statement and return any messages to the user
            Ninth, repeats the steps of 8, but looking for a different account
            */
            
            if($this->account == "Broc_Checking" || $this->account == "Broc_Savings") {                         //(8)
                
                $this->account == "Broc_Checking" ? $this->account = 1 : $this->account = 2;                    //(8a)
                
                $mySQL = "INSERT INTO PURCHASE (" . implode(',', $this->db_purch_col) . ")";
                $mySQL .= "VALUES (" . $this->amount . ", '" . $this->category . "', '" . $this->type . "', '"; //(8b)
                $mySQL .= $this->retailer . "', '" . $this->comment . "', " . $this->account;
                $mySQL .= ", '" . $this->purchDate . "')";
                
                return self::validate_purchase_completion($mySQL, $categoryObject, $theAcct, $account);         //(8c)
                
            } else if($this->account == "E_Checking" || $this->account == "E_Savings") {                        //(9)
                
                $this->account == "E_Checking" ? $this->account = 3 : $this->account = 4;                       //(9a)
                
                $mySQL = "INSERT INTO PURCHASE (" . implode(',', $this->db_purch_col) . ")";
                $mySQL .= "VALUES (" . $this->amount . ", '" . $this->category . "', '" . $this->type . "', '"; //(9b)
                $mySQL .= $this->retailer . "', '" . $this->comment . "', " . $this->account;
                $mySQL .= ", '" . $this->purchDate . "')";
                
                return self::validate_purchase_completion($mySQL, $categoryObject, $theAcct, $account);         //(9c)
                
            }
            
        }
        
        private function validate_purchase_completion($sqlPurchase, $categoryObject, $theAcct, $account) {
            
            global $db;
            
            $this->T_message_1 = $db->get_set_query($sqlPurchase);
            
            $db->db_message != "No result set was returned by query!" ? $this->message = "Purchase entry successfull!" : $this->message = "Purchase entry failed!";
            
            $categoryObject->increase(0,$this->amount,$account);
                
            $theAcct->decrement($this->amount);
                
            return $this->message;
            
        }
        
/*
------------------------------------------------ End of Purchase Form Processing ------------------------------------------------
*/
        
        
        
/*
------------------------------------------------ Deposit Form Processing ------------------------------------------------
*/
        
        public function validate_deposit($depAmount, $seller, $receive, $month, $day, $year, $comment, $accountObj) {
            
            if($depAmount == "") {
                
                $this->message = "Please enter an amount for the deposit";
                return $this->message;
                
            } elseif($seller == "") {
                
                $this->message = "Please select a retailer";
                return $this->message;
                
            } elseif($receive == "") {
                
                $this->message = "Please select an account to make the deposit";
                return $this->message;
                
            } elseif($comment == "") {
                
                $this->message = "Please add a comment";
                return $this->message;
                
            } elseif(!checkdate(intval($month), intval($day), intval($year))) {
                
                $this->message = "Please select an actual date";
                return $this->message;
                
            } else {
                
                $this->message = "All good!";
                
            }
            
            if($this->message == "All good!") {
                
                return $this->process_deposit($depAmount, $seller, $receive, $month, $day, $year, $comment, $accountObj);
                
            }
            
        }
        
        private function process_deposit($depAmount, $seller, $receive, $month, $day, $year, $comment, $accountObj) {
            
            global $db;
            
            $this->purchDate = $year . "-" . $month . "-" . $day;
            
            $this->amount = $this->clean_data($depAmount);
            $this->retailer = $this->clean_data($seller);
            $this->retailer = $db->escape_string($this->retailer);
            $this->comment = $this->clean_data($comment);
            $this->comment = $db->escape_string($this->comment);
            $this->account = $this->clean_data($receive);
            $this->purchDate = $this->clean_data($this->purchDate);
            $this->purchDate = $db->escape_string($this->purchDate);
                
            if($this->account == "Broc_Checking" || $this->account == "B_Savings") {
                
                $this->account == "Broc_Checking" ? $this->account = 1 : $this->account = 2;
                
                $mySQL = "INSERT INTO DEPOSIT (" . implode(',', $this->db_deposit_col) . ")";
                $mySQL .= "VALUES (" . $this->account . ", " . $this->amount . ", '" . $this->retailer . "', '";
                $mySQL .= $this->comment . "', '" . $this->purchDate . "')";
                
                return self::validate_deposit_completion($mySQL, $accountObj, $receive);
                
            } else if($this->account == "E_Checking" || $this->account == "E_Savings") {
                
                $this->account == "E_Checking" ? $this->account = 3 : $this->account = 4;
                
                $mySQL = "INSERT INTO DEPOSIT (" . implode(',', $this->db_deposit_col) . ")";
                $mySQL .= "VALUES (" . $this->account . ", " . $this->amount . ", '" . $this->retailer . "', '";
                $mySQL .= $this->comment . "', '" . $this->purchDate . "')";
                
                return self::validate_deposit_completion($mySQL, $categoryObject, $accountObj, $receive);
                
            }
            
        }
        
        private function validate_deposit_completion($sqlDeposit, $accountObj, $receive) {
            
            global $db;
            
            $this->T_message_1 = $db->get_set_query($sqlDeposit);
            
            $db->db_message != "No result set was returned by query!" ? $this->message = "Deposit was successfull!" : $this->message = "Deposit entry failed!";
                
            $accountObj->increase($this->amount);
                
            return $this->message;
            
        }
        
/*
------------------------------------------------ End of Deposit Form Processing ------------------------------------------------
*/
        
        
        
/*
------------------------------------------------ Transfer Form Processing ------------------------------------------------
*/
        
        private function process_transfer($txferAmount, $frmAcct, $toAcct, $frmCategory, $toCategory, $seller, $comment, $month, $day, $year, $accountObj_1, $accountObj_2) {
            
            global $db;
            
            $this->purchDate = $year . "-" . $month . "-" . $day;
            
            $this->amount = $this->clean_data($txferAmount);
            $this->fromAccount = $this->clean_data($frmAcct);
            $this->fromAccount = $db->escape_string($this->fromAccount);
            $this->toAccount = $this->clean_data($toAcct);
            $this->toAccount = $db->escape_string($this->toAccount);
            $this->fromCategory = $this->clean_data($frmCategory);
            $this->fromCategory = $db->escape_string($this->fromCategory);
            $this->toCategory = $this->clean_data($toCategory);
            $this->toCategory = $this->clean_data($this->toCategory);
            $this->retailer = $this->clean_data($seller);
            $this->retailer = $db->escape_string($this->retailer);
            $this->comment = $this->clean_data($comment);
            $this->comment = $db->escape_string($this->comment);
            $this->purchDate = $this->clean_data($this->purchDate);
            $this->purchDate = $db->escape_string($this->purchDate);
                
            if(($this->fromAccount == "Broc_Checking" || $this->fromAccount == "Broc_Savings") && ($this->toAccount == "E_Checking" || $this->toAccount == "E_Savings")) {
                
                $categoryObject_1 = CategoryBroc::return_a_record($frmCategory);
                $categoryObject_2 = CategoryEliz::return_a_record($toCategory);
                
                $this->fromAccount == "Broc_Checking" ? $this->fromAccount = 1 : $this->fromAccount = 2;
                $this->toAccount == "E_Checking" ? $this->toAccount = 3 : $this->toAccount = 4;
                
                $mySQL = "INSERT INTO TRANSFER (" . implode(',', $this->db_txfer_col) . ")";
                $mySQL .= "VALUES (" . $this->fromAccount . ", " . $this->amount . ", '" . $this->fromCategory . "', '" . $this->retailer . "', '";
                $mySQL .= $this->comment . "', '" . $this->purchDate . "')";
                
                $mySQL_2 = "INSERT INTO DEPOSIT (" . implode(',', $this->db_deposit_col) . ")";
                $mySQL_2 .= "VALUES (" . $this->toAccount . ", " . $this->amount . ", '" . $this->toCategory . "', '" . $this->retailer . "', '";
                $mySQL_2 .= $this->comment . "', '" . $this->purchDate . "')";
                
                return $this->validate_transfer_completion($mySQL, $mySQL_2, $frmAcct, $toAcct, $categoryObject_1, $categoryObject_2, $accountObj_1, $accountObj_2);
                
            } else if(($this->fromAccount == "E_Checking" || $this->fromAccount == "E_Savings") && ($this->toAccount == "Broc_Checking" || $this->toAccount == "Broc_Savings")) {
                
                $categoryObject_1 = CategoryEliz::return_a_record($frmCategory);
                $categoryObject_2 = CategoryBroc::return_a_record($toCategory);
                
                $this->fromAccount == "E_Checking" ? $this->fromAccount = 3 : $this->fromAccount = 4;
                $this->toAccount == "Broc_Checking" ? $this->toAccount = 1 : $this->toAccount = 2;
                
                $mySQL = "INSERT INTO TRANSFER (" . implode(',', $this->db_txfer_col) . ")";
                $mySQL .= "VALUES (" . $this->fromAccount . ", " . $this->amount . ", '" . $this->fromCategory . "', '" . $this->retailer . "', '";
                $mySQL .= $this->comment . "', '" . $this->purchDate . "')";
                
                $mySQL_2 = "INSERT INTO DEPOSIT (" . implode(',', $this->db_deposit_col) . ")";
                $mySQL_2 .= "VALUES (" . $this->toAccount . ", " . $this->amount . ", '" . $this->toCategory . "', '" . $this->retailer . "', '";
                $mySQL_2 .= $this->comment . "', '" . $this->purchDate . "')";
                
                return $this->validate_transfer_completion($mySQL, $mySQL_2, $frmAcct, $toAcct, $categoryObject_1, $categoryObject_2, $accountObj_1, $accountObj_2);
                
            } else if(($this->fromAccount == "Broc_Checking" || $this->fromAccount == "Broc_Savings") && ($this->toAccount == "Broc_Checking" || $this->toAccount == "Broc_Savings")) {
                
                $categoryObject_1 = CategoryBroc::return_a_record($frmCategory);
                $categoryObject_2 = CategoryBroc::return_a_record($toCategory);
                
                $this->fromAccount == "Broc_Checking" ? $this->fromAccount = 1 : $this->fromAccount = 2;
                $this->toAccount == "Broc_Checking" ? $this->toAccount = 1 : $this->toAccount = 2;
                
                $mySQL = "INSERT INTO TRANSFER (" . implode(',', $this->db_txfer_col) . ")";
                $mySQL .= "VALUES (" . $this->fromAccount . ", " . $this->amount . ", '" . $this->fromCategory . "', '" . $this->retailer . "', '";
                $mySQL .= $this->comment . "', '" . $this->purchDate . "')";
                
                $mySQL_2 = "INSERT INTO DEPOSIT (" . implode(',', $this->db_deposit_col) . ")";
                $mySQL_2 .= "VALUES (" . $this->toAccount . ", " . $this->amount . ", '" . $this->toCategory . "', '" . $this->retailer . "', '";
                $mySQL_2 .= $this->comment . "', '" . $this->purchDate . "')";
                
                return $this->validate_transfer_completion($mySQL, $mySQL_2, $frmAcct, $toAcct, $categoryObject_1, $categoryObject_2, $accountObj_1, $accountObj_2);
                
            } else if(($this->fromAccount == "E_Checking" || $this->fromAccount == "E_Savings") && ($this->toAccount == "E_Checking" || $this->toAccount == "E_Savings")) {
                
                $categoryObject_1 = CategoryEliz::return_a_record($frmCategory);
                $categoryObject_2 = CategoryEliz::return_a_record($toCategory);
                
                $this->fromAccount == "E_Checking" ? $this->fromAccount = 3 : $this->fromAccount = 4;
                $this->toAccount == "E_Checking" ? $this->toAccount = 3 : $this->toAccount = 4;
                
                $mySQL = "INSERT INTO TRANSFER (" . implode(',', $this->db_txfer_col) . ")";
                $mySQL .= "VALUES (" . $this->fromAccount . ", " . $this->amount . ", '" . $this->fromCategory . "', '" . $this->retailer . "', '";
                $mySQL .= $this->comment . "', '" . $this->purchDate . "')";
                
                $mySQL_2 = "INSERT INTO DEPOSIT (" . implode(',', $this->db_deposit_col) . ")";
                $mySQL_2 .= "VALUES (" . $this->toAccount . ", " . $this->amount . ", '" . $this->toCategory . "', '" . $this->retailer . "', '";
                $mySQL_2 .= $this->comment . "', '" . $this->purchDate . "')";
                
                return $this->validate_transfer_completion($mySQL, $mySQL_2, $frmAcct, $toAcct, $categoryObject_1, $categoryObject_2, $accountObj_1, $accountObj_2);
                
            }
            
        }
        
        public function validate_transfer($txferAmount, $frmAcct, $toAcct, $frmCategory, $toCategory, $seller, $comment, $month, $day, $year, $accountObj_1, $accountObj_2) {
            
            if($txferAmount == "") {
                
                $this->message = "Please enter an amount for the transfer";
                
                return $this->message;
                
            } elseif(($frmAcct != "Broc_Checking" || $frmAcct != "Broc_Savings") xor ($frmAcct != "E_Checking" || $frmAcct != "E_Savings")) {
                
                $this->message = "Please select a proper 'FROM' account";
                
                return $this->message;
                
            } elseif(($toAcct != "Broc_Checking" || $toAcct != "Broc_Savings") xor ($toAcct != "E_Checking" || $toAcct != "E_Savings")) {
                
                $this->message = "Please select a preper 'TO' account";
                
                return $this->message;
                
            } elseif($frmCategory == "") {
                
                $this->message = "Please select a 'FROM' category";
                
                return $this->message;
                
            } elseif($toCategory == "Broc_Checking") {
                
                $this->message = "Please select a 'TO' category";
                
                return $this->message;
                
            } elseif($seller == "") {
                
                $this->message = "Please select a retailer";
                
                return $this->message;
                
            } elseif($comment == "") {
                
                $this->message = "Please add a comment";
                
                return $this->message;
                
            } elseif(!checkdate(intval($month), intval($day), intval($year))) {
                
                $this->message = "Please select an actual date";
                
                return $this->message;
                
            } else {
                
                $this->message = "All good!";
                
            }
            
            if($this->message == "All good!") {
                    
                return $this->process_transfer($txferAmount, $frmAcct, $toAcct, $frmCategory, $toCategory, $seller, $comment, $month, $day, $year, $accountObj_1, $accountObj_2);
             
            }
            
        }
        
        private function validate_transfer_completion($sqlTransfer, $sqlDeposit, $frmAcct, $toAcct, $categoryObject_1, $categoryObject_2, $accountObj_1, $accountObj_2) {
            
            global $db;
            
            $this->T_message_1 = $db->get_set_query($sqlTransfer);
                        
            $this->T_message_2 = $db->get_set_query($sqlDeposit);
            
            $db->db_message != "No result set was returned by query!" ? $this->T_message_1 = "Transfer successfull!" : $this->T_message_1 = "Transfer entry failed!";
            $db->db_message != "No result set was returned by query!" ? $this->T_message_2 = "Deposit successfull!" : $this->T_message_2 = "Deposit entry failed!";
            
            if($this->T_message_1 == "Transfer successfull!" && $this->T_message_2 == "Deposit successfull!") {
                
                $this->message = "Transfer was successfull";
                
                $categoryObject_1->decrement($this->amount, $frmAcct);
                
                $accountObj_1->decrement($this->amount);
                
                $categoryObject_2->increase($this->amount, 0, $toAcct);
                
                $accountObj_2->increase($this->amount);
                
                return $this->message;
                
            } elseif($this->T_message_1 == "Transfer successfull!" && $this->T_message_2 == "Deposit entry failed!") {
                
                $this->message = "Transfer was successful, but the deposit failed";
                
                $categoryObject_1->decrement($this->amount, $frmAcct);
                
                $accountObj_1->decrement($this->amount);
                
                return $this->message;
                
            } elseif($this->T_message_1 == "Transfer entry failed!" && $this->T_message_2 == "Deposit successful!") {
                
                $this->message = "Transfer failed, but the deposit succeeded";
                
                $categoryObject_2->increase($this->amount, 0, $toAcct);
                
                $accountObj_2->increase($this->amount);
                
                return $this->message;
                
            } elseif($this->T_message_1 == "Transfer entry failed!" && $this->T_message_2 == "Deposit entry failed!") {
                
                $this->message = "Both the transfer & deposit failed ";
                
                return $this->message;
                
            }
            
        }
        
/*
------------------------------------------------ End of Transfer Form Processing ------------------------------------------------
*/      

    } // The end of the Form Class

?>