    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>
<main>
    <?php if(isset($message)){
        echo $message; }  ?>
    <h1>Single Review</h1>
    <?php if(isset($prodReviews)) {
        echo $prodReviews;
    } 
    ?>
</main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
