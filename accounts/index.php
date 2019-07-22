<?php
session_start();
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
require_once '../model/accounts-model.php';
 require_once '../library/functions.php';
 $categories = getCategories();
 


$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
 switch ($action){
case 'login-page':
    include '../view/login.php';
    break;

case 'register-page':
    include '../view/registration.php';
    break;
case 'register':
// Filter and store the data
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $checkEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);
// Check for missing data
    if(empty($clientFirstname) || empty($clientLastname) || empty($checkEmail) || empty($checkPassword)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit;
    }
    $existingEmail = checkExistingEmail($clientEmail);

    // Check for existing email address in the table
    if($existingEmail){
        $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
        include '../view/login.php';
        exit;
    }
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    // Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if($regOutcome === 1){
        setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
        $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        include '../view/login.php';
        exit;
    } else {
        $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        include '../view/registration.php';
        exit;
    }
    break;
case 'login': 
    $clientEmail = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
    $checkEmail = checkEmail($clientEmail);
    $clientPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $passwordCheck = checkPassword($clientPassword);

    // Run basic checks, return if errors
    if (empty($checkEmail) || empty($passwordCheck)) {
        $message = '<p class="notice">Please provide a valid email address and password.</p>';
        include '../view/login.php';
        exit;
    }
  
    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    setcookie('firstname', $_SESSION['clientData']['clientFirstname'], strtotime('+1 year'), '/');
    // Send them to the admin view
    include '../view/admin.php';
    exit;
case "logout":
    session_destroy();
    setcookie('firstname', null, -1, '/'); 
    header('location: /cow12005-acme/');
    break;
case "admin":
    include '../view/admin.php';
    break;
case "edit-user":
    include '../view/client-update.php';
    break;
case "update-client":
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $oldEmail = filter_input(INPUT_POST, 'old-email', FILTER_SANITIZE_EMAIL);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $checkEmail = checkEmail($email);
// Check for missing data
    if(empty($firstName) || empty($lastName) || empty($email)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/client-update.php';
        exit;
    }
    if($oldEmail != $email) {
        $existingEmail = checkExistingEmail($email);

    // Check for existing email address in the table
        if($existingEmail){
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/client-update.php';
            exit;
        }
    }
    // Send the data to the model
    $regOutcome = updateClient($firstName, $lastName, $email, $clientId);

    // Check and report the result
    if($regOutcome === 1){
        $message = "<p>User changed successfully";
        $clientData = getClient($email);
        $_SESSION['clientData'] = $clientData;
        include '../view/admin.php';
        exit;
    } else {
        $message = "<p>Edit failed</p>";
        include '../view/client-update.php';
        exit;
    }
    break;
    
case 'update-password':
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $checkPassword = checkPassword($password);
    if(empty($checkPassword) ) {
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/client-update.php';
        exit;
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $regOutcome = updateClientPassword($hashedPassword, $clientId);

    // Check and report the result
    if($regOutcome === 1){
        $message = "<p>User changed successfully";
        $clientData = getClient($clientEmail);
        $_SESSION['clientData'] = $clientData;
        include '../view/admin.php';
        exit;
    } else {
        $message = "<p>Edit failed</p>";
        include '../view/client-update.php';
        exit;
    }
    
    break;
default:
        include '../view/500.php';
}
