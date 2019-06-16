<?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>
<main>
<h1>Login</h1>
<?php
            if (isset($message)) {
            echo $message;
            }
?>
        <form method="post" action="/cow12005-acme/accounts/">
            <input type="email" name="username" placeholder="Username" required><br>
            
            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> <br>
            <input type="password" name="password" placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            <input type="hidden" name="action" value="login">
            <input type="submit" name="login" value="Login">
        </form>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>