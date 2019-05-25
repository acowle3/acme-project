<?php

 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';

 
 $categories = getCategories();
 

 
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
 switch ($action){
case 'login':
    include 'view/login.php';
    break;

case 'register':
    include 'view/registration.php';
    break;
 default:
  include '../view/home.php';
}