<?php

function acmeConnect(){
 $server = 'localhost';
 if (stripos($_SERVER["HTTP_HOST"], 'localhost') === 0
              || stripos($_SERVER["HTTP_HOST"], '127.0.0.1') === 0) {
            // Running on local server
            $dbname= 'acme';
            $username = 'iClient';
            $password = 'NmkDzy1LQU8JcU7o';
          } else {
            // Running on remote server
            $dbname= 'cow12005_acme'; // [BYU-I username]_acme
            $username = 'cow12005_iClient'; // [BYU-I username]_iClient
            $password = 'cow12005_Pwd'; // [BYU-I username]_Pwd
          }
 $dsn = "mysql:host=$server;dbname=$dbname";
 $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

 // Create the actual connection object and assign it to a variable
 try {
  $link = new PDO($dsn, $username, $password, $options);
  return $link;
 } catch(PDOException $e) {
  header('Location: /cow12005-acme/view/500.php');
  exit;
 }
}