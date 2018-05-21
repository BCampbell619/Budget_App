<?php

    define('TITLE', "Transfers");

    include('includes/header.php');

    //For reference
    //$b_Account_ck = Account::return_account("Broc_Checking");
    //$b_Account_sv = Account::return_account("Broc_Savings");
    //$e_Account_ck = Account::return_account("E_Checking");
    //$e_Account_sv = Account::return_account("E_Savings");

    //For reference
    //$housing_b = CategoryBroc::return_a_record("Housing");
    //$entertain_b = CategoryBroc::return_a_record("Entertainment");
    //$transport_b = CategoryBroc::return_a_record("Transportation");
    //$loans_b = CategoryBroc::return_a_record("Loans");
    //$taxes_b = CategoryBroc::return_a_record("Taxes");
    //$food_b = CategoryBroc::return_a_record("Food");
    //$personal_b = CategoryBroc::return_a_record("Personal Care");
    //$donations_b = CategoryBroc::return_a_record("Gifts and Donations");

    //For reference
    //$housing_e = CategoryEliz::return_a_record("Housing");
    //$entertain_e = CategoryEliz::return_a_record("Entertainment");
    //$transport_e = CategoryEliz::return_a_record("Transportation");
    //$loans_e = CategoryEliz::return_a_record("Loans");
    //$taxes_e = CategoryEliz::return_a_record("Taxes");
    //$food_e = CategoryEliz::return_a_record("Food");
    //$personal_e = CategoryEliz::return_a_record("Personal Care");
    //$donations_e = CategoryEliz::return_a_record("Gifts and Donations");

    $myTransferForm = new Form();
    $formMessage = "";

    if(isset($_POST['transferSubmit'])) {
        
        if($_POST['fromAcct'] == "Broc_Checking" && $_POST['toAcct'] == "E_Checking") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $b_Account_ck, $e_Account_ck);
            
        } elseif($_POST['fromAcct'] == "Broc_Savings" && $_POST['toAcct'] == "E_Checking") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $b_Account_sv, $e_Account_ck);
            
        } elseif($_POST['fromAcct'] == "Broc_Checking" && $_POST['toAcct'] == "E_Savings") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $b_Account_ck, $e_Account_sv);
            
        } elseif($_POST['fromAcct'] == "Broc_Savings" && $_POST['toAcct'] == "E_Savings") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $b_Account_sv, $e_Account_sv);
            
        } elseif($_POST['fromAcct'] == "E_Checking" && $_POST['toAcct'] == "Broc_Checking") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $e_Account_ck, $b_Account_ck);
            
        } elseif($_POST['fromAcct'] == "E_Savings" && $_POST['toAcct'] == "Broc_Checking") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $e_Account_sv, $b_Account_ck);
            
        } elseif($_POST['fromAcct'] == "E_Checking" && $_POST['toAcct'] == "Broc_Savings") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $e_Account_ck, $b_Account_sv);
            
        } elseif($_POST['fromAcct'] == "E_Savings" && $_POST['toAcct'] == "Broc_Savings") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $e_Account_sv, $b_Account_sv);
            
        } elseif($_POST['fromAcct'] == "Broc_Checking" && $_POST['toAcct'] == "Broc_Savings") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $b_Account_ck, $b_Account_sv);
            
        } elseif($_POST['fromAcct'] == "Broc_Savings" && $_POST['toAcct'] == "Broc_Checking") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $b_Account_sv, $b_Account_ck);
            
        } elseif($_POST['fromAcct'] == "E_Checking" && $_POST['toAcct'] == "E_Savings") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $e_Account_ck, $e_Account_sv);
            
        } elseif($_POST['fromAcct'] == "E_Savings" && $_POST['toAcct'] == "E_Checking") {
        
            $formMessage = $myTransferForm->validate_transfer($_POST['txferAmount'], $_POST['fromAcct'], $_POST['toAcct'], $_POST['fromCategory'], $_POST['toCategory'], $_POST['retailer'], $_POST['item'], $_POST['month'], $_POST['day'], $_POST['year'], $e_Account_sv, $e_Account_ck);
            
        } elseif($_POST['fromAcct'] == "Broc_Checking" && $_POST['toAcct'] == "Broc_Checking") {
            
            $formMessage = "Cannot Transfer within same account!";
            
        } elseif($_POST['fromAcct'] == "E_Checking" && $_POST['toAcct'] == "E_Checking") {
            
            $formMessage = "Cannot Transfer within same account!";
            
        } elseif($_POST['fromAcct'] == "Broc_Savings" && $_POST['toAcct'] == "Broc_Savings") {
            
            $formMessage = "Cannot Transfer within same account!";
            
        } elseif($_POST['fromAcct'] == "E_Savings" && $_POST['toAcct'] == "E_Savings") {
            
            $formMessage = "Cannot Transfer within same account!";
            
        } else {
            
            $formMessage = "";
        }
        
    }

?>


<!------------------------------- start of purchase section -------------------------------->
   
   <section id="purchase">
    
        <div class="purchHead">
            
            <img src="images/transfer_img.png" alt="Transfer header graphic" >
            
        </div>
     
        <div class="purchase">
        
        <?php  if($formMessage == "Please enter an amount for the transfer") {
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formMessage}</p> </div>";
            
                    } else if($formMessage == "Please select a proper 'FROM' account") {
            
                            echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Notice&#58;</strong> {$formMessage}</p> </div>";
                                    
                    } else if($formMessage == "Please select a preper 'TO' account") {
            
                            echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Notice&#58;</strong> {$formMessage}</p> </div>";
                                    
                    } else if($formMessage == "Please select a 'FROM' category") {
            
                            echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Notice&#58;</strong> {$formMessage}</p> </div>";
                                    
                    } else if($formMessage == "Please select a 'TO' category") {
            
                            echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Notice&#58;</strong> {$formMessage}</p> </div>";
                                    
                    } else if($formMessage == "Please select a retailer") {
            
                            echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Notice&#58;</strong> {$formMessage}</p> </div>";
                                    
                    } else if($formMessage == "Please add a comment") {
            
                            echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Notice&#58;</strong> {$formMessage}</p> </div>";
                                    
                    } else if($formMessage == "Please select an actual date") {
            
                            echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Notice&#58;</strong> {$formMessage}</p> </div>";
                                    
                    } else if($formMessage == "Cannot Transfer within same account!") {
            
                            echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Notice&#58;</strong> {$formMessage}</p></div>";
                                    
                    } else if($formMessage == "Transfer was successful, but the deposit failed" || $formMessage == "Transfer failed, but the deposit succeeded") {
            
                            echo "<div class=\"alert alert-warning alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Notice&#58;</strong> {$formMessage}</p> </div>";
                                    
                    } else if($formMessage == "Transfer was successfull") {
            
                            echo "<div class=\"alert alert-success alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Yes&#33;</strong> {$formMessage}</p> </div>";
                                    
                    } else if($formMessage == "") {
    
                            echo "<div class=\"alert alert-info alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\">Need to transfer money? This will take care of that&#33;</p></div>";
    
                    }
                    
            ?>
      
<!--------------------------------- start of transfer form --------------------------------->
       
       <form action="transfer.php" method="post" class="form">
          
          <div class="form-row">
               
                <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
           
                    <label for="txferAmount" class="col-form-label">Amount&#58;</label>
                    <input type="text" name="txferAmount" id="txferAmount" class="form-control" onfocus="focusFields.fieldFocus('txferAmount')" onblur="focusFields.fieldBlind('txferAmount')">
                
                </div>
                
                <div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
                
                    <label for="fromAcct" class="col-form-label">From Account&#58;</label>
                    <select type="text" name="fromAcct" id="fromAcct" class="form-control" onfocus="focusFields.fieldFocus('fromAcct')" onblur="focusFields.fieldBlind('fromAcct')">
                    
                    <?php $frmAcct = Account::return_all_accounts(); foreach($frmAcct as $allAccts) { echo "<option value=\"{$allAccts->AcctName}\">".$allAccts->AcctName."</option>"; } ?>
                    
                    </select>
                
                </div>
                
                <div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
                
                    <label for="toAcct" class="col-form-label">To Account&#58;</label>
                    <select type="text" name="toAcct" id="toAcct" class="form-control" onfocus="focusFields.fieldFocus('toAcct')" onblur="focusFields.fieldBlind('toAcct')">
                    
                    <?php $toAcct = Account::return_all_accounts(); foreach($toAcct as $acctsAll) { echo "<option value=\"{$acctsAll->AcctName}\">". $acctsAll->AcctName . "</option>"; } ?>
                    
                    </select>
                
                </div>
           </div>
              
        <div class="form-row">
                
                <div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
                
                    <label for="fromCategory" class="col-form-label">From Category&#58;</label><select type="text" name="fromCategory" id="fromCategory" maxlength="50" class="form-control" onfocus="focusFields.fieldFocus('fromCategory')" onblur="focusFields.fieldBlind('fromCategory')">
                    
                    <?php $frmCategory = CategoryBroc::return_all_categories(); foreach($frmCategory as $allCategories) { echo "<option value=\"{$allCategories->CategoryName}\">". $allCategories->CategoryName . "</option>"; }  ?>
                    
                    </select>
                
                </div>
                
                <div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
                
                    <label for="toCategory" class="col-form-label">To Category&#58;</label><select type="text" name="toCategory" id="toCategory" maxlength="50" class="form-control" onfocus="focusFields.fieldFocus('toCategory')" onblur="focusFields.fieldBlind('toCategory')">
                    
                    <?php $toCategory = CategoryEliz::return_all_categories(); foreach($toCategory as $categoriesAll) { echo "<option value=\"{$categoriesAll->CategoryName}\">". $categoriesAll->CategoryName . "</option>"; }  ?>
                    
                    </select>
                
                </div>
                
                <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                
                    <label for="retailer" class="col-form-label">Retailer&#58;</label><select type="text" name="retailer" id="retailer" maxlength="50" class="form-control" onfocus="focusFields.fieldFocus('retailer')" onblur="focusFields.fieldBlind('retailer')">
                    
                    <?php $retailer = Retailer::return_all_retailers(); foreach($retailer as $allRetailers) { echo "<option value=\"{$allRetailers->RetailerName}\">". $allRetailers->RetailerName . "</option>"; }  ?>
                    
                    </select>
                
                </div>
                
           </div>
               
            <div class="form-row">
                
                <div class="form-gourp col-xs-12 col-sm-6 col-md-6 col-lg-6">
           
                    <label for="item" class="col-form-label">Comment&#58;</label>
                    <input type="text" name="item" id="item" class="form-control" maxlength="150" onfocus="focusFields.fieldFocus('item')" onblur="focusFields.fieldBlind('item')">
                
                </div>

                
                <div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2">
                
                <label for="month" class="col-form-label">M&#58;</label>
                
                    <select name="month" id="month" class="form-control" onfocus="focusFields.fieldFocus('month')" onblur="focusFields.fieldBlind('month')">
                       
                        <?php for($i = 1; $i <= 12; $i++) : ?>

                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        
                        <?php endfor; ?>

                    </select>
                    
                </div>
                   
                <div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    
                    <label for="day" class="col-form-label">D&#58;</label>
                    
                    <select name="day" id="day" class="form-control" onfocus="focusFields.fieldFocus('day')" onblur="focusFields.fieldBlind('day')">
                       
                        <?php for($i = 1; $i <= 31; $i++) : ?>
                       
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        
                        <?php endfor; ?>
                        
                    </select>
                    
                </div>
                   
                <div class="form-group col-xs-3 col-sm-2 col-md-2 col-lg-2">
                    
                    <label for="year" class="col-form-label">YY&#58;</label>
                    
                    <select name="year" id="year" class="form-control" onfocus="focusFields.fieldFocus('year')" onblur="focusFields.fieldBlind('year')">
                       
                        <?php for($i = date('Y'); $i <= (date('Y')+20); $i++) : ?>
                       
                           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        
                       <?php endfor; ?>
                       
                    </select>
                    
                </div>
                
                <button type="submit" class="btnPurch" name="transferSubmit">Submit</button>

        </div>

       </form>
       
<!--------------------------------- end of transfer form --------------------------------->
      
      </div>
       
   </section>


<?php

    include('includes/footer.php');

?>