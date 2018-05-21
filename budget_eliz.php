<?php 

define('TITLE', "E's Budget");

include('includes/header.php'); ?>
  
<?php

    //For reference
    //$housing_e = CategoryEliz::return_a_record("Housing");
    //$entertain_e = CategoryEliz::return_a_record("Entertainment");
    //$transport_e = CategoryEliz::return_a_record("Transportation");
    //$loans_e = CategoryEliz::return_a_record("Loans");
    //$taxes_e = CategoryEliz::return_a_record("Taxes");
    //$food_e = CategoryEliz::return_a_record("Food");
    //$personal_e = CategoryEliz::return_a_record("Personal Care");
    //$donations_e = CategoryEliz::return_a_record("Gifts and Donations");

        $myForm = new Form();
    
        $setAccount = Account::return_account("E_Checking");
        $usrAccount = $setAccount->AcctName;

        $purchType = Type::return_all_types();
        $purchRetailer = Retailer::return_all_retailers();

        $TOTAL_ACT = $housing_e->CategoryAmt_E + $entertain_e->CategoryAmt_E + $transport_e->CategoryAmt_E + $loans_e->CategoryAmt_E + $taxes_e->CategoryAmt_E + $donations_e->CategoryAmt_E + $food_e->CategoryAmt_E + $personal_e->CategoryAmt_E;

        $TOTAL_PROJ = $housing_e->CategoryProj_E + $entertain_e->CategoryProj_E + $transport_e->CategoryProj_E + $loans_e->CategoryProj_E + $taxes_e->CategoryProj_E + $donations_e->CategoryProj_E + $food_e->CategoryProj_E + $personal_e->CategoryProj_E;

// This is the update form section & code

        if(isset($_POST['updateHouse'])) {
            
            $myForm->process_category($_POST['H_projected'], $_POST['H_actual'], $housing_e, $usrAccount);
            
        } elseif(isset($_POST['updateEntertain'])) {
            
            $myForm->process_category($_POST['E_projected'], $_POST['E_actual'], $entertain_e, $usrAccount);
            
        } elseif(isset($_POST['updateTrans'])) {
            
            $myForm->process_category($_POST['T_projected'], $_POST['T_actual'], $transport_e, $usrAccount);
            
        } elseif(isset($_POST['updateLoans'])) {
            
            $myForm->process_category($_POST['L_projected'], $_POST['L_actual'], $loans_e, $usrAccount);
            
        } elseif(isset($_POST['updateTax'])) {
            
            $myForm->process_category($_POST['X_projected'], $_POST['X_actual'], $taxes_e, $usrAccount);
            
        } elseif(isset($_POST['updateFood'])) {
            
            $myForm->process_category($_POST['F_projected'], $_POST['F_actual'], $food_e, $usrAccount);
            
        } elseif(isset($_POST['updatePersonal'])) {
            
            $myForm->process_category($_POST['P_projected'], $_POST['P_actual'], $personal_e, $usrAccount);
            
        } elseif(isset($_POST['updateDonate'])) {
            
            $myForm->process_category($_POST['D_projected'], $_POST['D_actual'], $donations_e, $usrAccount);
            
        }

// end of the update form section & code

?>
   

<!------------------------------ start of category section ------------------------------>
    
    <section id="category">
           
<!---------------------------- start of Housing & Entertainment tables ---------------------------->
      
      <div class="row">
          <div class="purchHead"><img src="images/category_img.png" alt="category image"></div>
      </div>
       
        <div class="container-fluid">
        
            <div class="row">
            
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 necessary">
                       
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                        
                                <h1 class="categoryHeader"><?php echo $housing_e->CategoryName; ?></h1>
                            
                            </div>
                            
                            <div class="dropdown col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                
                                <button class="drop-btn dropdown-toggle" type="button" id="frmDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">UPDATE</button>
                                <div aria-labelledby="frmDropdown" class="dropdown-menu">
                                    
                                    <form action="budget_eliz.php" method="post"  class="px-4 py-3">
                                        
                                        <div class="form-group">
                                            
                                            <label for="projected">Projected Amt:</label>
                                            <input type="text" name="H_projected" class="form-control">
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                        
                                            <label class="actual">Actual Amt:</label>
                                            <input type="text" name="H_actual" class="form-control">
                                            
                                        </div>
                                        
                                        <button type="submit" name="updateHouse" class="btnEdit">SET</button>
                                        
                                    </form>
                                    
                                </div>
                                
                            </div>
                        
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                
                                <p Class="categorySection">Projected</p>
                                
                            </div>
                            
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                
                                <p Class="categoryMoney"><?php echo money_format('%.2n', $housing_e->CategoryProj_E); ?></p>
                                
                            </div>
                    
                        </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Actual</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categoryMoney"><?php echo money_format('%.2n', $housing_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Difference</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categoryMoney"><?php echo money_format('%.2n', $housing_e->CategoryProj_E - $housing_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                </div>
                  
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 leisure">
                  
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        
                            <h1 class="categoryHeader"><?php echo $entertain_e->CategoryName; ?></h1>
                            
                        </div>
                        
                        <div class="dropdown col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            
                            <button class="drop-btn dropdown-toggle" type="button" id="frmDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">UPDATE</button>
                            <div aria-labelledby="frmDropdown" class="dropdown-menu">
                                
                                <form action="budget_eliz.php" method="post"  class="px-4 py-3">
                                    
                                    <div class="form-group">
                                        
                                        <label for="projected">Projected Amt:</label>
                                        <input type="text" name="E_projected" class="form-control">
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                    
                                        <label class="actual">Actual Amt:</label>
                                        <input type="text" name="E_actual" class="form-control">
                                        
                                    </div>
                                    
                                    <button type="submit" name="updateEntertain" class="btnEdit">SET</button>
                                    
                                </form>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                       
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Projected</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categoryMoney"><?php echo money_format('%.2n', $entertain_e->CategoryProj_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Actual</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categoryMoney"><?php echo money_format('%.2n', $entertain_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Difference</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categoryMoney"><?php echo money_format('%.2n', $entertain_e->CategoryProj_E - $entertain_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                        
                </div>
               
            </div>
            
        </div>
            
<!----------------------------- end of Housing & Entertainment tables ---------------------------->

<!---------------------------- start of Transportation & Loans tables ---------------------------->
       
        <div class="container-fluid">
        
            <div class="row">
            
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 necessary">
                
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            
                            <h1 class="categoryHeader"><?php echo $transport_e->CategoryName; ?></h1>
                        
                        </div>
                    
                        <div class="dropdown col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            
                            <button class="drop-btn dropdown-toggle" type="button" id="frmDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">UPDATE</button>
                            <div aria-labelledby="frmDropdown" class="dropdown-menu">
                                
                                <form action="budget_eliz.php" method="post"  class="px-4 py-3">
                                    
                                    <div class="form-group">
                                        
                                        <label for="projected">Projected Amt:</label>
                                        <input type="text" name="T_projected" class="form-control">
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                    
                                        <label class="actual">Actual Amt:</label>
                                        <input type="text" name="T_actual" class="form-control">
                                        
                                    </div>
                                    
                                    <button type="submit" name="updateTrans" class="btnEdit">SET</button>
                                    
                                </form>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Projected</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categoryMoney"><?php echo money_format('%.2n', $transport_e->CategoryProj_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Actual</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $transport_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Difference</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $transport_e->CategoryProj_E - $transport_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 important">
            
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                        
                                <h1 class="categoryHeader"><?php echo $loans_e->CategoryName; ?></h1>
                            
                            </div>
                            
                            <div class="dropdown col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                
                                <button class="drop-btn dropdown-toggle" type="button" id="frmDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">UPDATE</button>
                                <div aria-labelledby="frmDropdown" class="dropdown-menu">
                                    
                                    <form action="budget_eliz.php" method="post"  class="px-4 py-3">
                                        
                                        <div class="form-group">
                                            
                                            <label for="projected">Projected Amt:</label>
                                            <input type="text" name="L_projected" class="form-control">
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                        
                                            <label class="actual">Actual Amt:</label>
                                            <input type="text" name="L_actual" class="form-control">
                                            
                                        </div>
                                        
                                        <button type="submit" name="updateLoans" class="btnEdit">SET</button>
                                        
                                    </form>
                                    
                                </div>
                                
                            </div>
                        
                        </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Projected</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $loans_e->CategoryProj_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Actual</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $loans_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Difference</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $loans_e->CategoryProj_E - $loans_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                
                </div>
                
            </div>
            
        </div>
            
<!----------------------------- end of Transportation & Loans tables ----------------------------->

<!------------------------------- start of Taxes & Donations tables ------------------------------>
            
        <div class="container-fluid">
        
            <div class="row">
                
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 important">
            
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                        
                                <h1 class="categoryHeader"><?php echo $taxes_e->CategoryName; ?></h1>
                            
                            </div>
                            
                            <div class="dropdown col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                
                                <button class="drop-btn dropdown-toggle" type="button" id="frmDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">UPDATE</button>
                                <div aria-labelledby="frmDropdown" class="dropdown-menu">
                                    
                                    <form action="budget_eliz.php" method="post"  class="px-4 py-3">
                                        
                                        <div class="form-group">
                                            
                                            <label for="projected">Projected Amt:</label>
                                            <input type="text" name="X_projected" class="form-control">
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                        
                                            <label class="actual">Actual Amt:</label>
                                            <input type="text" name="X_actual" class="form-control">
                                            
                                        </div>
                                        
                                        <button type="submit" name="updateTax" class="btnEdit">SET</button>
                                        
                                    </form>
                                    
                                </div>
                                
                            </div>
                        
                        </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Projected</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $taxes_e->CategoryProj_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Actual</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $taxes_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Difference</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $taxes_e->CategoryProj_E - $taxes_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        
                                <h1 class="categoryHeader"><?php echo $donations_e->CategoryName; ?></h1>
                            
                            </div>
                            
                            <div class="dropdown col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                
                                <button class="drop-btn dropdown-toggle" type="button" id="frmDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">UPDATE</button>
                                <div aria-labelledby="frmDropdown" class="dropdown-menu">
                                    
                                    <form action="budget_eliz.php" method="post"  class="px-4 py-3">
                                        
                                        <div class="form-group">
                                            
                                            <label for="projected">Projected Amt:</label>
                                            <input type="text" name="D_projected" class="form-control">
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                        
                                            <label class="actual">Actual Amt:</label>
                                            <input type="text" name="D_actual" class="form-control">
                                            
                                        </div>
                                        
                                        <button type="submit" name="updateDonate" class="btnEdit">SET</button>
                                        
                                    </form>
                                    
                                </div>
                                
                            </div>
                        
                        </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Projected</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $donations_e->CategoryProj_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Actual</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $donations_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Difference</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $donations_e->CategoryProj_E - $donations_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                
                </div>
                
            </div>
            
        </div>
            
<!------------------------------- end of Insurance & Taxes tables ------------------------------->

<!------------------------------- start of Food & Personal tables ------------------------------->

        <div class="container-fluid">
        
            <div class="row">
            
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 necessary">
            
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                        
                                <h1 class="categoryHeader"><?php echo $food_e->CategoryName; ?></h1>
                            
                            </div>
                            
                            <div class="dropdown col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                
                                <button class="drop-btn dropdown-toggle" type="button" id="frmDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">UPDATE</button>
                                <div aria-labelledby="frmDropdown" class="dropdown-menu">
                                    
                                    <form action="budget_eliz.php" method="post"  class="px-4 py-3">
                                        
                                        <div class="form-group">
                                            
                                            <label for="projected">Projected Amt:</label>
                                            <input type="text" name="F_projected" class="form-control">
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                        
                                            <label class="actual">Actual Amt:</label>
                                            <input type="text" name="F_actual" class="form-control">
                                            
                                        </div>
                                        
                                        <button type="submit" name="updateFood" class="btnEdit">SET</button>
                                        
                                    </form>
                                    
                                </div>
                                
                            </div>
                        
                        </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Projected</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $food_e->CategoryProj_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Actual</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $food_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Difference</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $food_e->CategoryProj_E - $food_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 leisure">
            
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        
                                <h1 class="categoryHeader"><?php echo $personal_e->CategoryName; ?></h1>
                            
                            </div>
                            
                            <div class="dropdown col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                
                                <button class="drop-btn dropdown-toggle" type="button" id="frmDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">UPDATE</button>
                                <div aria-labelledby="frmDropdown" class="dropdown-menu">
                                    
                                    <form action="budget_eliz.php" method="post"  class="px-4 py-3">
                                        
                                        <div class="form-group">
                                            
                                            <label for="projected">Projected Amt:</label>
                                            <input type="text" name="P_projected" class="form-control">
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                        
                                            <label class="actual">Actual Amt:</label>
                                            <input type="text" name="P_actual" class="form-control">
                                            
                                        </div>
                                        
                                        <button type="submit" name="updatePersonal" class="btnEdit">SET</button>
                                        
                                    </form>
                                    
                                </div>
                                
                            </div>
                        
                        </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Projected</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $personal_e->CategoryProj_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Actual</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $personal_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p Class="categorySection">Difference</p>
                            
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                            <p class="categoryMoney"><?php echo money_format('%.2n', $personal_e->CategoryProj_E - $personal_e->CategoryAmt_E); ?></p>
                            
                        </div>
                    
                    </div>
                
                </div>
                
            </div>
            
        </div>
            
<!------------------------------- end of Food & Personal tables ------------------------------->

<!------------------------------- start total table ------------------------------->
            
        <div class="container-fluid Totals">
        
            <div class="row">
            
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            
                    <h1 class="categoryFooter">Total Projected</h1>
                    <p class="categoryMoneyTtl">
                    
                    <?php echo money_format('%.2n', $TOTAL_PROJ); ?>
                    
                    </p>
                
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            
                    <h1 class="categoryFooter">Total Actual</h1>
                    <p class="categoryMoneyTtl">
                    
                    <?php echo money_format('%.2n', $TOTAL_ACT); ?>
                    
                    </p>
                
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            
                    <h1 class="categoryFooter">Total Difference</h1>
                    <p class="categoryMoneyTtl">
                    
                    <?php echo money_format('%.2n', $TOTAL_PROJ - $TOTAL_ACT); ?>
                    
                    </p>
                
                </div>
                
            </div>
            
        </div>

<!------------------------------- end of total table ------------------------------->

    </section>
    
<!------------------------------- end of category section ------------------------------->


<?php include('includes/footer.php'); ?>