

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>
    <main><h1>Register</h1>
        <?php
            if (isset($message)) {
            echo $message;
            }
?>
        <form method="post" action="/cow12005-acme/accounts/index.php">
            <input type="text" name="clientFirstname" placeholder="First Name"><br>
            <input type="text" name="clientLastname" placeholder="Last Name"><br>
            <input type="email" name="clientEmail" id="clientEmail" placeholder="email"><br>
            <input type="password" name="clientPassword" placeholder="Password"><br>
            <input type="submit" name="submit" id="regbtn" value="Register">
            <input type="hidden" name="action" value="register">
        </form></main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
