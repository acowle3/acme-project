<?php
session_start();
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
  require_once '../model/products-model.php';
require_once '../library/functions.php';
 

 $categories = getCategories();
 
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 if ($action == NULL){
  $action = 'list';
 }
 
 switch($action) {

    case 'add-product-form':
        include '../view/add-product.php';
        break;
    case 'add-category-form':
        include '../view/add-category.php';
        break;
    case 'add-product';
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

        
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
        
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
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
    default:
        
        
        include '../view/list-products.php';
        break;
}