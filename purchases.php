<?php

    define('TITLE', "Purchases");

    include('includes/header.php');

    $housing = Category::return_a_record("Housing");
    $entertain = Category::return_a_record("Entertainment");
    $transport = Category::return_a_record("Transportation");
    $loans = Category::return_a_record("Loans");
    $taxes = Category::return_a_record("Taxes");
    $food = Category::return_a_record("Food");
    $personal = Category::return_a_record("Personal Care");
    $donations = Category::return_a_record("Gifts and Donations");
?>

<?php

    $theForm = new Form();
    $formPurchMessage = "";

// This is the purchase submission section & code

    if(isset($_POST['purchSubmit'])) {
        
        if($_POST['category'] == "Housing") {    
        
            $formPurchMessage = $theForm->validate_purchase($_POST['amount'],  $_POST['category'], $_POST['type'], $_POST['retailer'], $_POST['item'], $_POST['acct'], $_POST['month'], $_POST['day'], $_POST['year'], $housing);
            
        }
        
        if($_POST['category'] == "Entertainment") {    
        
            $formPurchMessage = $theForm->validate_purchase($_POST['amount'],  $_POST['category'], $_POST['type'], $_POST['retailer'], $_POST['item'], $_POST['acct'], $_POST['month'], $_POST['day'], $_POST['year'], $entertain);
            
        }
        
        if($_POST['category'] == "Transportation") {    
        
            $formPurchMessage = $theForm->validate_purchase($_POST['amount'],  $_POST['category'], $_POST['type'], $_POST['retailer'], $_POST['item'], $_POST['acct'], $_POST['month'], $_POST['day'], $_POST['year'], $transport);
            
        }
        
        if($_POST['category'] == "Loans") {    
        
            $formPurchMessage = $theForm->validate_purchase($_POST['amount'],  $_POST['category'], $_POST['type'], $_POST['retailer'], $_POST['item'], $_POST['acct'], $_POST['month'], $_POST['day'], $_POST['year'], $loans);
            
        }
        
        if($_POST['category'] == "Taxes") {    
        
            $formPurchMessage = $theForm->validate_purchase($_POST['amount'],  $_POST['category'], $_POST['type'], $_POST['retailer'], $_POST['item'], $_POST['acct'], $_POST['month'], $_POST['day'], $_POST['year'], $taxes);
            
        }
        
        if($_POST['category'] == "Food") {    
        
            $formPurchMessage = $theForm->validate_purchase($_POST['amount'],  $_POST['category'], $_POST['type'], $_POST['retailer'], $_POST['item'], $_POST['acct'], $_POST['month'], $_POST['day'], $_POST['year'], $food);
            
        }
        
        if($_POST['category'] == "Personal Care") {    
        
            $formPurchMessage = $theForm->validate_purchase($_POST['amount'],  $_POST['category'], $_POST['type'], $_POST['retailer'], $_POST['item'], $_POST['acct'], $_POST['month'], $_POST['day'], $_POST['year'], $personal);
            
        }
        
        if($_POST['category'] == "Gifts and Donations") {    
        
            $formPurchMessage = $theForm->validate_purchase($_POST['amount'],  $_POST['category'], $_POST['type'], $_POST['retailer'], $_POST['item'], $_POST['acct'], $_POST['month'], $_POST['day'], $_POST['year'], $donations);
            
        }
        
    }

// end of the purchase submission section & code
       
?>

<!------------------------------- start of purchase section -------------------------------->
   
   <section id="purchase">
    
        <div class="purchHead">
            
            <img src="../images/purchase_header.png" alt="Header Graphic" >
            
        </div>
     
        <div class="purchase">
        
        <?php  if($formPurchMessage == "Purchase entry failed!"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formPurchMessage}</p> </div>";
            
                    } else if($formPurchMessage == "Please enter an amount for the deposit"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formPurchMessage}</p> </div>";
            
                    } else if($formPurchMessage == "Please select a category"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formPurchMessage}</p> </div>";
            
                    } else if($formPurchMessage == "Please select a category type"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formPurchMessage}</p> </div>";
            
                    } else if($formPurchMessage == "Please select a retailer"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formPurchMessage}</p> </div>";
            
                    } else if($formPurchMessage == "Please select an account to charge"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formPurchMessage}</p> </div>";
            
                    } else if($formPurchMessage == "Please add a comment"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formPurchMessage}</p> </div>";
            
                    } else if($formPurchMessage == "Please select an actual date"){
         
                        echo "<div class=\"alert alert-danger alert-dismissible text-center\" role=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                            <p class=\"lead\"><strong>Uh&ndash;oh</strong> {$formPurchMessage}</p> </div>";
            
                    } else if($formPurchMessage == "Purchase entry successfull!") {
            
                            echo "<div class=\"alert alert-success alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\"><strong>Yes&#33;</strong> {$formPurchMessage}</p> </div>";
                                    
                    } else if($formPurchMessage == "") {
            
                            echo "<div class=\"alert alert-info alert-dismissible text-center\" role=\"alert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <p class=\"lead\">Did we buy something&#63; What&#63; What&#63; Tell me&#33;</p> </div>";
                                    
                    }
                    
            ?>
      
<!--------------------------------- start of purchase form --------------------------------->
       
       <form action="purchases.php" method="post" class="form">
          
          <div class="form-row">
               
                <div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
           
                    <label for="amount" class="col-form-label">Amount&#58;</label>
                    <input type="text" name="amount" id="amount" class="form-control" onfocus="focusFields.fieldFocus('amount')" onblur="focusFields.fieldBlind('amount')">
                
                </div>
                
                <div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
                
                    <label for="category" class="col-form-label">Category&#58;</label>
                    <select type="text" name="category" id="category" class="form-control" onfocus="focusFields.fieldFocus('category')" onblur="focusFields.fieldBlind('category')">
                    
                    <?php $option = Category::return_all_categories(); foreach($option as $allCategories) { echo "<option value=\"{$allCategories->CategoryName}\">".$allCategories->CategoryName."</option>"; } ?>
                    
                    </select>
                
                </div>
                
                <div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
                
                    <label for="type" class="col-form-label">Type&#58;</label>
                    <select type="text" name="type" id="type" class="form-control" onfocus="focusFields.fieldFocus('type')" onblur="focusFields.fieldBlind('type')">
                    
                    <?php $optType = Type::return_all_types(); foreach($optType as $allTypes) { echo "<option value=\"{$allTypes->CategoryType}\">" . $allTypes->CategoryType . "</option>"; } ?>
                    
                    </select>
                
                </div>
           </div>
               
        <div class="form-row">
                
            <div class="form-gourp col-xs-6 col-sm-3 col-md-3 col-lg-3">
                
                <label for="retailer" class="col-form-label">Retailer&#58;</label>
                <select type="text" name="retailer" id="retailer" class="form-control" onfocus="focusFields.fieldFocus('retailer')" onblur="focusFields.fieldBlind('retailer')">
                
                <?php $optRetail = Retailer::return_all_retailers(); foreach($optRetail as $allRetail) { echo "<option value=\"{$allRetail->RetailerName}\">". $allRetail->RetailerName . "</option>"; } ?>
                
                </select>
                
            </div>
                
            <div class="form-gourp col-xs-12 col-sm-9 col-md-9 col-lg-9">
           
                <label for="item" class="col-form-label">Comment&#58;</label>
                <input type="text" name="item" id="item" class="form-control" maxlength="150" onfocus="focusFields.fieldFocus('item')" onblur="focusFields.fieldBlind('item')">
                
            </div>
            
        </div>
           
        <div class="form-row">
                
                <div class="form-group col-xs-4 col-sm-6 col-md-6 col-lg-6">
                
                    <label for="acct" class="col-form-label">Account&#58;</label><select type="text" name="acct" id="acct" maxlength="50" class="form-control" onfocus="focusFields.fieldFocus('acct')" onblur="focusFields.fieldBlind('acct')">
                    
                    <?php $optAccount = Account::return_all_accounts(); foreach($optAccount as $allAccounts) { echo "<option value=\"{$allAccounts->AcctName}\">". $allAccounts->AcctName . "</option>"; }  ?>
                    
                    </select>
                
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
                    
                </div><br>
                   
                    <button type="submit" class="btnPurch" name="purchSubmit">Submit</button>
            
        </div>
           
       </form>
       
<!--------------------------------- end of purchase form --------------------------------->
      
      </div>
       
   </section>


<?php include('includes/footer.php'); ?>