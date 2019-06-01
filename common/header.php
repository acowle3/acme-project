<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/cow12005-acme/css/main.css">
    <title>Acme Inc</title>
</head>
<body>
    <div id="the-body">
<header>
        <img src="/cow12005-acme/images/site/logo.gif" alt="logo" id='logo'>
        <div id="account-link">
        <a href='/cow12005-acme/accounts/index.php?action=login-page' id="login-link" title="login"><img src="/cow12005-acme/images/site/account.gif" alt='account'id='account'>Login</a>
        <a href='/cow12005-acme/accounts/index.php?action=register-page' title="register" id="register-link">Register</a>
        </div>
    </header>
    <nav>
        <?php 
        $navList = '<ul>';
        $navList .= "<li><a href='/cow12005-acme/index.php' title='View the Acme home page'>Home</a></li>";
 foreach ($categories as $category) {
  $navList .= "<li><a href='/cow12005-acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
 $navList .= '</ul>';
 echo $navList;
        ?>
        
    </nav>