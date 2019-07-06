<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/cow12005-acme/css/main.css">
    <title><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?> | Acme, Inc</title>
</head>
<body>
    <div id="the-body">
<header>
        <img src="/cow12005-acme/images/site/logo.gif" alt="logo" id='logo'>
        <div id="account-link">
            <?php
            
            if (!empty($_SESSION['loggedin'])) {
                echo "<span>Welcome ".$_SESSION['clientData']['clientFirstname']."</span>";
                echo '<a href="/cow12005-acme/accounts/index.php?action=admin" id="admin-stuff" title="admin"><img src="/cow12005-acme/images/site/account.gif" alt="account" id="account">Account</a> | ';
                echo '<a href="/cow12005-acme/accounts/index.php?action=logout" title="logout">logout</a>';
            }
            else {
                echo "<a href='/cow12005-acme/accounts/index.php?action=login-page' id='login-link' title='login'>Login</a> | ";
            
                echo "<a href='/cow12005-acme/accounts/index.php?action=register-page' title='register' id='register-link'>Register</a>";
            }
                ?>

        </div>
    </header>
    <nav>
        <?php 
           echo createNavbar();
        ?>
        
    </nav>