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
           echo createNavbar()
        ?>
        
    </nav>