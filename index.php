<?php
// Get the database connection file 
session_start();


 require_once 'library/connections.php';
 // Get the acme model for use as needed
 require_once 'model/acme-model.php';
 require_once 'library/functions.php';


 

 
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 if ($action == NULL){
     $action = "home";
     
 }
 
 if(isset($_COOKIE['firstname'])){
 $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}
 
 switch ($action){
 case 'home':
  include 'view/home.php';
     break;
 default:
     include 'view/500.php';
}