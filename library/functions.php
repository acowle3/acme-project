<?php

function checkEmail($clientEmail){
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

function checkPassword($clientPassword){
 $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
 return preg_match($pattern, $clientPassword);
}

function createNavbar() {
    $categories = getCategories();
    $navList = '<ul>';
    $navList .= "<li><a href='/cow12005-acme/index.php' title='View the Acme home page'>Home</a></li>";
 foreach ($categories as $category) {
  $navList .= "<li><a href='/cow12005-acme/products/index.php?action=category&categoryName=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
 $navList .= '</ul>';
 return $navList;
}

function createCatDropdown() {
     $categories = getCategories();
    
    // Build the categories option list
    $catList = '<select name="categoryId" id="categoryId">';
    $catList .= "<option>Choose a Category</option>";
    foreach ($categories as $category) {
        $catList .= "<option value='$category[categoryId]'";
        if(isset($catType)){
            if($category['categoryId'] === $catType){
                $catList .= ' selected ';
            }
        } elseif(isset($prodInfo['categoryId'])){
            if($category['categoryId'] === $prodInfo['categoryId']){
                $catList .= ' selected ';
            }
        }
        $catList .= ">$category[categoryName]</option>";
    }
    $catList .= '</select>';
    return $catList;
}

function createCatDropdownSelected($catType) {
     $categories = getCategories();
    
    // Build the categories option list
    $catList = '<select name="categoryId" id="categoryId">';
    $catList .= "<option>Choose a Category</option>";
    foreach ($categories as $category) {
        $catList .= "<option value='$category[categoryId]'";
        
            if($category['categoryId'] === $catType){
                $catList .= ' selected ';
            }
        $catList .= ">$category[categoryName]</option>";
    }
    $catList .= '</select>';
    return $catList;
}

function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $pd .= '<li>';
        $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
        $pd .= '<hr>';
        $pd .= "<h2><a href='/cow12005-acme/products?action=product&invId=$product[invId]'>$product[invName]</a></h2>";
        $pd .= "<span>$product[invPrice]</span>";
        $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}

function productPageBuild($prodInfo) {
    $pd =  '<div class="product-page">';
    $pd .= '<h1>'.$prodInfo['invName'].'</h1>';
    $pd .= '<div id="divide">';
    $pd .= '<img alt="Product" src='.$prodInfo['invImage'].'>';
    $pd .= '<div>';
    $pd .= '<p>'.$prodInfo['invDescription'].'</p>';
    $pd .= '<p>Sold by '.$prodInfo['invVendor'].'</p>';
    $pd .= '<p>Weight: '.$prodInfo['invWeight'].'</p>';
    $pd .= '<p>Number In Stock: '.$prodInfo['invStock'].'</p>';
    $pd .= '</div>';
    $pd .= '</div>';
    return $pd;
}