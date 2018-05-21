<?php

    $latest_Deposit_b = $db->get_set_query("SELECT A.AcctName, D.DepositAmt, D.CategoryName, D.RetailerName, D.DepositNote, D.DepositDate AS 'Deposit Date' FROM DEPOSIT AS D INNER JOIN ACCOUNT AS A ON D.AcctID = A.AcctID WHERE D.DepositID = (SELECT MAX(DepositID) FROM DEPOSIT WHERE AcctID = ".$b_Account_ck->AcctID.");");

    $full_Projected_b = $db->get_set_query("SELECT SUM(CategoryProj_B) AS 'Projected' FROM CATEGORY;");
    $full_Actual_b = $db->get_set_query("SELECT SUM(CategoryAmt_B) AS 'Actual' FROM CATEGORY;");
    $everything_b = $db->get_set_query("SELECT SUM(CategoryAmt_B) AS 'Actual', SUM(CATEGORY.CategoryProj_B) AS 'Projected' FROM CATEGORY;");

    $latest_Deposit_e = $db->get_set_query("SELECT A.AcctName, D.DepositAmt, D.CategoryName, D.RetailerName, D.DepositNote, D.DepositDate AS 'Deposit Date' FROM DEPOSIT AS D INNER JOIN ACCOUNT AS A ON D.AcctID = A.AcctID WHERE D.DepositID = (SELECT MAX(DepositID) FROM DEPOSIT WHERE AcctID = ".$e_Account_ck->AcctID.");");

    $full_Projected_e = $db->get_set_query("SELECT SUM(CategoryProj_E) AS 'Projected' FROM CATEGORY;");
    $full_Amount_e = $db->get_set_query("SELECT SUM(CategoryAmt_E) AS 'Actual' FROM CATEGORY;");
    $everything_e = $db->get_set_query("SELECT SUM(CategoryAmt_E) AS 'Actual', SUM(CATEGORY.CategoryProj_E) AS 'Projected' FROM CATEGORY;");

?>
  

  <!------------------------------ start of dashboard section ------------------------------>
   
        <div class="row">
            <div class="purchHead">
                
                <img src="images/dashboard_img.png" alt="dashboard image">
                
            </div>
        </div>
   
    <section id="dashboard">
       
       <div class="dashboard container-fluid">
           
            <div class="row">
               
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-header" id="headingOne" style="border-bottom: solid 1px #0E125C;"><!-- start of card-header -->
                        
                        <h1 class="mb-0 text-center">Broc&#39;s Account</h1>
                        
                    </div>
                
                    <div id="actual" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                       
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo $b_Account_ck->AcctName; ?></h3>
                                </div>
                                <div class="panel-body">
                                    
                                    <p>Account Balance&#58;  <?php echo "&#36;".$b_Account_ck->AcctBalance; ?></p>
                                    
                                </div>
                            </div>
                        
                         </div>
                         
                         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo $b_Account_sv->AcctName; ?></h3>
                                </div>
                                <div class="panel-body">
                                    
                                    <p>Savings Balance&#58; <?php echo "&#36;".$b_Account_sv->AcctBalance; ?></p>
                                    
                                </div>
                            </div>
                        
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-group" id="accordion" role="tablist" aria-multiselectable="true"><!-- start of collapse -->
                        
                            <div class="panel panel-info">
                               
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="color: #333; text-decoration: none;">RECENT DEPOSIT</a>
                                </div>
                                
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                
                                    <div class="panel-body">
                                    
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                       
                                            <div class="panel panel-default">
                                            
                                               <?php foreach($latest_Deposit_b AS $Deposit){ ?>
                                               
                                                <div class="panel-body">
                                                    
                                                    <p><?php echo "ACCOUNT&#58; {$Deposit['AcctName']}"; ?></p>
                                                    
                                                    <p><?php echo "AMOUNT&#58; &#36;{$Deposit['DepositAmt']}"; ?></p>
                                                    
                                                    <p><?php echo "CATEGORY&#58; {$Deposit['CategoryName']}"; ?></p>
                                                    
                                                    <p><?php echo "FROM&#58; {$Deposit['RetailerName']}"; ?></p>
                                                    
                                                    <p><?php echo "COMMENT&#58; {$Deposit['DepositNote']}"; ?></p>
                                                    
                                                    <p><?php echo "DATE&#58; {$Deposit['Deposit Date']}"; } ?></p>
                                                
                                                </div>
                                            
                                            </div>
                                    
                                        </div>
                                    
                                    </div>
                                
                                </div>
                        
                            </div>
                        
                        </div><!-- end of collapse -->
                        
                    </div><!-- end of account section -->
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="panel panel-default">
                    
                    <div class="panel-heading">

                        <h3 class="panel-title text-center">BUDGET</h3>

                    </div>
                    
                    <div class="panel-body">
                    
                        <div id="projBal" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
    
                            <p>Proj. Balance&#58; <?php foreach($full_Projected_b as $projected){ echo "&#36;".$projected['Projected']; } ?></p>
                        
                        </div><!-- end of projected balance -->
                        
                        <div id="actBal" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
    
                            <p>Act. Balance&#58; <?php foreach($full_Actual_b as $actual){ echo "&#36;".$actual['Actual']; } ?></p>
                        
                        </div><!-- end of actual balance -->
                        
                        <div id="difference" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
    
                            <p>Difference&#58; &#36;<?php foreach($everything_b as $all) { echo $all['Projected'] - $all['Actual']; } ?></p>
                        
                        </div><!-- end of difference -->
                    
                    </div><!-- end of panel body -->
                    
                    </div><!-- end of panel wrap -->
                    
                </div><!-- end of budget panel -->
                    
                </div><!-- end of Broc's Dashboard -->
                
           </div>
              
            <div class="row">
               
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-header" id="headingOne" style="border-bottom: solid 1px #0E125C;"><!-- start of card-header -->
                        
                        <h1 class="mb-0 text-center">E&#39;s Account</h1>
                        
                    </div>
                
                    <div id="actual" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                       
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo $e_Account_ck->AcctName; ?></h3>
                                </div>
                                <div class="panel-body">
                                    
                                    <p>Account Balance&#58;  <?php echo "&#36;".$e_Account_ck->AcctBalance; ?></p>
                                    
                                </div>
                            </div>
                        
                         </div>
                         
                         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo $e_Account_sv->AcctName; ?></h3>
                                </div>
                                <div class="panel-body">
                                    
                                    <p>Savings Balance&#58; <?php echo "&#36;".$e_Account_sv->AcctBalance; ?></p>
                                    
                                </div>
                            </div>
                        
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-group" id="accordion" role="tablist" aria-multiselectable="true"><!-- start of collapse -->
                        
                            <div class="panel panel-info">
                               
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color: #333; text-decoration: none;">RECENT DEPOSIT</a>
                                </div>
                                
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                
                                    <div class="panel-body">
                                    
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                       
                                            <div class="panel panel-default">
                                            
                                               <?php foreach($latest_Deposit_e AS $Deposit){ ?>
                                               
                                                <div class="panel-body">
                                                    
                                                    <p><?php echo "ACCOUNT&#58; {$Deposit['AcctName']}"; ?></p>
                                                    
                                                    <p><?php echo "AMOUNT&#58; &#36;{$Deposit['DepositAmt']}"; ?></p>
                                                    
                                                    <p><?php echo "CATEGORY&#58; {$Deposit['CategoryName']}"; ?></p>
                                                    
                                                    <p><?php echo "FROM&#58; {$Deposit['RetailerName']}"; ?></p>
                                                    
                                                    <p><?php echo "COMMENT&#58; {$Deposit['DepositNote']}"; ?></p>
                                                    
                                                    <p><?php echo "DATE&#58; {$Deposit['Deposit Date']}"; } ?></p>
                                                
                                                </div>
                                            
                                            </div>
                                    
                                        </div>
                                    
                                    </div>
                                
                                </div>
                        
                            </div>
                        
                        </div><!-- end of collapse -->
                        
                    </div><!-- end of account section -->
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="panel panel-default">
                    
                    <div class="panel-heading">

                        <h3 class="panel-title text-center">BUDGET</h3>

                    </div>
                    
                    <div class="panel-body">
                    
                        <div id="projBal" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
    
                            <p>Proj. Balance&#58; <?php foreach($full_Projected_e as $projected){ echo "&#36;".$projected['Projected']; } ?></p>
                        
                        </div><!-- end of projected balance -->
                        
                        <div id="actBal" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
    
                            <p>Act. Balance&#58; <?php foreach($full_Amount_e as $actual){ echo "&#36;".$actual['Actual']; } ?></p>
                        
                        </div><!-- end of actual balance -->
                        
                        <div id="difference" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
    
                            <p>Difference&#58; &#36;<?php foreach($everything_e as $all) { echo $all['Projected'] - $all['Actual']; } ?></p>
                        
                        </div><!-- end of difference -->
                    
                    </div><!-- end of panel body -->
                    
                    </div><!-- end of panel wrap -->
                    
                </div><!-- end of budget panel -->
                    
                </div><!-- end of E's dashboard -->
                
            </div>
        
        </div>
        
    </section>
    
<!------------------------------ end of dashboard section ------------------------------->