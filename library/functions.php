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
    $dropdownMenu = "<select name='categoryId' id='categoryId' required>";
    foreach($categories as $category) {
        $dropdownMenu .= '<option value="'.$category['categoryId'].'">'.$category['categoryName']."</option>";
    }
    $dropdownMenu .= '</select>';
}