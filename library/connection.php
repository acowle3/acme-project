<?php
//Datebase Connections

function acmeConnection(){
  if (stripos($_SERVER["HTTP_HOST"], "localhost") === 0 
    || stripos($_SERVER["HTTP_HOST"], "127.0.0.1") === 0) {
    $server = "localhost";
    $username = "root";
    $password = "root";
    $database = "acme";
  } else {
    $server = "sql201.epizy.com";
    $username = "epiz_23333457";
    $password = "0jbcrmzk";
    $database = "epiz_23333457_acme";
  }

	$dsn = "mysql:host=$server;dbname=$database";
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

	try {
		$acmeLink = new PDO($dsn, $username, $password, $options);
		return $acmeLink;
	} catch (PDOException $ex) {
		header('location: /acme/view/500.php');
	}
}

acmeConnection();
?>
