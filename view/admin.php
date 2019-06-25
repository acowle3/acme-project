<?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>

<?php 
if (!$_SESSION['loggedin']) {
    header("location: /cow12005-acme/?action=home");
}

$firstName = $_SESSION['clientData']['clientFirstname'];
$lastName = $_SESSION['clientData']['clientLastname'];
$email = $_SESSION['clientData']['clientEmail'];
$level = $_SESSION['clientData']['clientLevel'];
$clientId = $_SESSION['clientData']['clientId'];

?>

<main>
<h1><?php echo $firstName." ".$lastName; ?></h1>
<p>First Name: <?php echo $firstName; ?></p>
<p>Last Name: <?php echo $lastName; ?></p>
<p>Email: <?php echo $email; ?></p>
<p>User Level: <?php echo $level; ?></p>
<a href="/cow12005-acme/accounts/?action=edit-user">Edit User Account</a>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>