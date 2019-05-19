<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/cow12005-acme/main.css">
    <title></title>
</head>
<body>
    <div id="the-body">
<header>
        <img src="/cow12005-acme/images/site/logo.gif" alt="logo" id='logo'>
        <div id="account-link">
        <a href='/cow12005-acme/accounts/index.php?action=login' id="login-link"><img src="/cow12005-acme/images/site/account.gif" alt='account'id='account'>Login</a>
        <a href='/cow12005-acme/accounts/index.php?action=register' id="register-link">Register</a>
        </div>
    </header>
    <nav>
        <?php 
        $navList = '<ul>';
        $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
 foreach ($categories as $category) {
  $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
 $navList .= '</ul>';
 echo $navList;
        ?>
        
    </nav>