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
  $navList .= "<li><a href='/cow12005-acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
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