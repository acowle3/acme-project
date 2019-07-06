<?php
session_start();
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
  require '../model/products-model.php';
require '../library/functions.php';
 

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
    case 'update-product':
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
            $message = '<p>Please complete all information for the item! Double check the category of the item.</p>';
            include '../view/prod-update.php';
            exit;
        }  $updateResult = updateProduct($invName, $invDescription, $invLocation, $categoryId, $invVendor, $invStyle, $invPrice, $invStock, $invSize, $invWeight, $invId);
        if ($updateResult) {
                $message = "<p>Congratulations, $invName was successfully altered.</p>";
                header('location: /cow12005-acme/products/');
                exit;
        } else {
                $message = "<p>Error. The product was not altered.</p>";
                include '../view/prod-update.php';
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
        
    case 'modify-product':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if(count($prodInfo)<1){
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
        exit;
        break;
    case 'delete-product-form':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (empty($invId)) {
            $message = '<p>No Item Selected.</p>';
            include '../view/list-products.php';
            exit;
        }
        include '../view/prod-delete.php';
        exit;
        break;
    case 'delete-product':
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        echo $invId;
        $deleteResult = deleteProduct($invId);
        if ($deleteResult) {
                $message = "<p>Congratulations, $invName was successfully removed.</p>";
                header('location: /cow12005-acme/products/');
                exit;
        } else {
                $message = "<p>Error. The product was not removed.</p>";
                include '../view/prod-delete.php';
                exit;
        }
        break;
    default:
        $products = listProducts();
        if(count($products) > 0){
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/cow12005-acme/products?action=modify-product&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/cow12005-acme/products?action=delete-product-form&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
            }
            $prodList .= '</tbody></table>';
            } else {
                $message = '<p class="notify">Sorry, no products were returned.</p>';
            }
        include '../view/list-products.php';
        break;
}