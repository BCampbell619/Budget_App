<?php

    include('includes/init.php');
    setlocale(LC_MONETARY, 'en_US.UTF-8');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    /* setting global variable instances of class objects*/

    $b_Account_ck = Account::return_account("Broc_Checking");  //Broc's checking account
    $b_Account_sv = Account::return_account("Broc_Savings");   //Broc's savings account
    $e_Account_ck = Account::return_account("E_Checking");  //E's checking account
    $e_Account_sv = Account::return_account("E_Savings");   //E's savings account

    /*------------------ Broc's budget categories ------------------*/

    $housing_b = CategoryBroc::return_a_record("Housing");
    $entertain_b = CategoryBroc::return_a_record("Entertainment");
    $transport_b = CategoryBroc::return_a_record("Transportation");
    $loans_b = CategoryBroc::return_a_record("Loans");
    $taxes_b = CategoryBroc::return_a_record("Taxes");
    $food_b = CategoryBroc::return_a_record("Food");
    $personal_b = CategoryBroc::return_a_record("Personal Care");
    $donations_b = CategoryBroc::return_a_record("Gifts and Donations");
    $savings_b = CategoryBroc::return_a_record("Savings");

    /*------------------ Broc's budget categories ------------------*/

    /*------------------- E's budget categories --------------------*/

    $housing_e = CategoryEliz::return_a_record("Housing");
    $entertain_e = CategoryEliz::return_a_record("Entertainment");
    $transport_e = CategoryEliz::return_a_record("Transportation");
    $loans_e = CategoryEliz::return_a_record("Loans");
    $taxes_e = CategoryEliz::return_a_record("Taxes");
    $food_e = CategoryEliz::return_a_record("Food");
    $personal_e = CategoryEliz::return_a_record("Personal Care");
    $donations_e = CategoryEliz::return_a_record("Gifts and Donations");
    $savings_e = CategoryEliz::return_a_record("Savings");

    /*------------------- E's budget categories --------------------*/

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo TITLE; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="budget.css" type="text/css">
</head>
<body>
  
<!------------------------------------- start of wrapper ---------------------------------->
   <div class="wrapper">
        
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">CampbellsCorner</a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="purchases.php">Purchases</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Budgets <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="budget_broc.php">Broc&#39;s Budget</a></li>
                    <li><a href="budget_eliz.php">E&#39;s Budget</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="deposit.php">Deposits</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="transfer.php">Transfers</a></li>
                  </ul>
                </li>
                <li><a href="#">Reports</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>