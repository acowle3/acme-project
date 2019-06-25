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
<?php if(isset($message)) { echo $message; } ?>
<form method="post" action="/cow12005-acme/accounts/index.php">
<label for="firstName">First Name:</label> 
    <input type="text" name="firstName" id="firstName" value="<?php echo $firstName; ?>">
<label for="lastName">Last Name:</label> 
    <input type="text" name="lastName" id="lastName" value="<?php echo $lastName; ?>">
<label for="email">Email:</label> 
    <input type="email" name="email" id="email" value="<?php echo $email; ?>">
    <input type="submit" id="submit" value="Save User">
            
            <input type="hidden" name="action" value="update-client">
            <input type='hidden' name='clientId' value='<?php echo $clientId; ?>'>
            <input type='hidden' name='old-email' value='<?php echo $email; ?>'>
</form>

<form method="post" action="/cow12005-acme/accounts/index.php">
    <label for="password">New Password</label>
    <input type="password" name="password" id="password">
    <input type="submit" id="submit-password" value="Save Password">
    <input type='hidden' name='clientId' value='<?php echo $clientId; ?>'>
    <input type="hidden" name="action" value="update-password">
    <input type='hidden' name='clientEmail' value='<?php echo $email; ?>'>
</form>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>