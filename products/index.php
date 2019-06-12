<?php

 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
  require_once '../model/products-model.php';

 
 $categories = getCategories();
 
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 if ($action == NULL){
  $action = 'list';
 }
 
 switch($action) {
    case 'list':
        include '../view/list-products.php';
        break;
    case 'add-product-form':
        include '../view/add-product.php';
        break;
    case 'add-category-form':
        include '../view/add-category.php';
        break;
    case 'add-product';
        $invName = filter_input(INPUT_POST, 'invName');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invSize = filter_input(INPUT_POST, 'invSize');
        $invWeight = filter_input(INPUT_POST, 'invWeight');
        $invLocation = filter_input(INPUT_POST, 'invLocation');
        $categoryId = filter_input(INPUT_POST, 'categoryId');
        $invVendor = filter_input(INPUT_POST, 'invVendor');
        $invStyle = filter_input(INPUT_POST, 'invStyle');

        
        if(empty($invName) || empty($invDescription) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle) ){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-product.php';
            exit;
        }
        $regOutcome = insertProduct($invName, $invDescription, $invLocation, $categoryId, $invVendor, $invStyle, $invPrice, $invStock, $invSize, $invWeight);
        
        if($regOutcome === 1){
        $message = "<p>Product Added Successfully</p>";
        include '../view/list-products.php';
        exit;
    } else {
        $message = "<p>Error Adding Product</p>";
        include '../view/add-product.php';
        exit;
    }
        break;
    case 'add-category':
        
        $categoryName = filter_input(INPUT_POST, 'categoryName');
        if(empty($categoryName)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-category.php';
            exit;
        }
        $regOutcome = insertCategory($categoryName);
        if($regOutcome === 1){
        $message = "<p>Category Added Successfully</p>";
        include '../view/list-products.php';
        exit;
    } else {
        $message = "<p>Error Adding Category</p>";
        include '../view/add-category.php';
        exit;
    }
        break;
}