

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>
    <main><h1>Register</h1>
        <?php
            if (isset($message)) {
            echo $message;
            }
?>
        <form method="post" action="/cow12005-acme/accounts/index.php">
            <input type="text" name="clientFirstname" placeholder="First Name" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br>
            <input type="text" name="clientLastname" placeholder="Last Name" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required><br>
            <input type="email" name="clientEmail" id="clientEmail" placeholder="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> <br>
            <input type="password" name="clientPassword" placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            <input type="submit" name="submit" id="regbtn" value="Register">
            <input type="hidden" name="action" value="register">
        </form></main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
