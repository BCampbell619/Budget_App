<?php

    define('TITLE', "Deposits");

    include('includes/header.php');

    //For reference
    //$b_Account_ck = Account::return_account("Broc_Checking");
    //$b_Account_sv = Account::return_account("Broc_Savings");
    //$e_Account_ck = Account::return_account("E_Checking");
    //$e_Account_sv = Account::return_account("E_Savings");

    $myDepositForm = new Form();

    $formDepMessage = "";

    if(isset($_POST['depositSubmit'])) {
        
        if($_POST['receive'] == "Broc_Checking") {
        
            $formDepMessage = $myDepositForm->validate_deposit($_POST['depAmount'], $_POST['retailer'], $_POST['receive'], $_POST['month'], $_POST['day'], $_POST['year'], $_POST['item'], $b_Account_ck);
            
        } elseif($_POST['receive'] == "Broc_Savings") {
        
            $formDepMessage = $myDepositForm->validate_deposit($_POST['depAmount'], $_POST['retailer'], $_POST['receive'], $_POST['month'], $_POST['day'], $_POST['year'], $_POST['item'], $b_Account_sv);
            
        } elseif($_POST['receive'] == "E_Checking") {
        
            $formDepMessage = $myDepositForm->validate_deposit($_POST['depAmount'], $_POST['retailer'], $_POST['receive'], $_POST['month'], $_POST['day'], $_POST['year'], $_POST['item'], $e_Account_ck);
            
        } elseif($_POST['receive'] == "E_Savings") {
        
            $formDepMessage = $myDepositForm->validate_deposit($_POST['depAmount'], $_POST['retailer'], $_POST['receive'], $_POST['month'], $_POST['day'], $_POST['year'], $_POST['item'], $e_Account_sv);
            
        } else {
            
            echo "Deposit was successfull!";
            
        }
        
    }

?>


<!------------------------------- start of purchase section -------------------------------->
   
   <section id="purchase">
    
        <div class="purchHead">
            
            <img src="images/deposit_img.png" alt="Deposit header graphic" >
            
        </div>
     
        <div class="purchase">
        
        <?php  if($formDepMessage == "Deposit entry failed!"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formDepMessage}</p> </div>";
            
                    } else if($formDepMessage == "Please enter an amount for the deposit"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formDepMessage}</p> </div>";
            
                    } else if($formDepMessage == "Please select a retailer"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formDepMessage}</p> </div>";
            
                    } else if($formDepMessage == "Please select an account to make the deposit"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formDepMessage}</p> </div>";
            
                    } else if($formDepMessage == "Please add a comment"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formDepMessage}</p> </div>";
            
                    } else if($formDepMessage == "Please select an actual date"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formDepMessage}</p> </div>";
            
                    } else if($formDepMessage == "Deposit was successfull!") {
            
                            echo "<div class=\"alert alert-success alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Yes&#33;</strong> {$formDepMessage}</p> </div>";
                                    
                    } else if($formDepMessage == "") {
    
                            echo "<div class=\"alert alert-info alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Yes&#33;</strong> Extra Money&#44 Money&#44 Money&#44 Money&#44 Mah&ndash;nay&#33;</p></div>";
    
                    }
                    
            ?>
      
<!--------------------------------- start of purchase form --------------------------------->
       
       <form action="deposit.php" method="post" class="form">
          
          <div class="form-row">
               
                <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
           
                    <label for="depAmount" class="col-form-label">Amount&#58;</label>
                    <input type="text" name="depAmount" id="depAmount" class="form-control" onfocus="focusFields.fieldFocus('depAmount')" onblur="focusFields.fieldBlind('depAmount')">
                
                </div>
                
                <div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
                
                    <label for="receive" class="col-form-label">Account&#58;</label><select type="text" name="receive" id="receive" maxlength="50" class="form-control" onfocus="focusFields.fieldFocus('receive')" onblur="focusFields.fieldBlind('receive')">
                    
                    <?php $rcvAccount = Account::return_all_accounts(); foreach($rcvAccount as $allAccounts) { echo "<option value=\"{$allAccounts->AcctName}\">". $allAccounts->AcctName . "</option>"; }  ?>
                    
                    </select>
                
                </div>
                
                <div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
                
                    <label for="retailer" class="col-form-label">Retailer&#58;</label>
                    <select type="text" name="retailer" id="retailer" class="form-control" onfocus="focusFields.fieldFocus('retailer')" onblur="focusFields.fieldBlind('retailer')">
                    
                    <?php $optRetail = Retailer::return_all_retailers(); foreach($optRetail as $allRetail) { echo "<option value=\"{$allRetail->RetailerName}\">". $allRetail->RetailerName . "</option>"; } ?>
                    
                    </select>
                
                </div>
           </div>
              
        <div class="form-row">
                
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
           
                        <label for="item" class="col-form-label">Comment&#58;</label>
                        <input type="text" name="item" id="item" class="form-control" maxlength="150" onfocus="focusFields.fieldFocus('item')" onblur="focusFields.fieldBlind('item')">
                
                </div>

                
                <div class="form-group col-xs-4 col-sm-2 col-md-2 col-lg-2">
                
                <label for="month" class="col-form-label">M&#58;</label>
                
                    <select name="month" id="month" class="form-control" onfocus="focusFields.fieldFocus('month')" onblur="focusFields.fieldBlind('month')">
                       
                        <?php for($i = 1; $i <= 12; $i++) : ?>

                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        
                        <?php endfor; ?>

                    </select>
                    
                </div>
                   
                <div class="form-group col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    
                    <label for="day" class="col-form-label">D&#58;</label>
                    
                    <select name="day" id="day" class="form-control" onfocus="focusFields.fieldFocus('day')" onblur="focusFields.fieldBlind('day')">
                       
                        <?php for($i = 1; $i <= 31; $i++) : ?>
                       
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        
                        <?php endfor; ?>
                        
                    </select>
                    
                </div>
                   
                <div class="form-group col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    
                    <label for="year" class="col-form-label">YY&#58;</label>
                    
                    <select name="year" id="year" class="form-control" onfocus="focusFields.fieldFocus('year')" onblur="focusFields.fieldBlind('year')">
                       
                        <?php for($i = date('Y'); $i <= (date('Y')+20); $i++) : ?>
                       
                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        
                       <?php endfor; ?>
                       
                    </select>
                    
                </div>

        </div>
               
        <div class="form-row">
                            
            <button type="submit" class="btnPurch" name="depositSubmit">Submit</button>
            
        </div>
           
        
           
       </form>
       
<!--------------------------------- end of purchase form --------------------------------->
      
      </div>
       
   </section>


<?php

    include('includes/footer.php');

?>