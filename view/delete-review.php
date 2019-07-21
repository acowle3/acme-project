
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>
<main>
    <?php if(isset($message)){
        echo $message; }  ?>
    <h1>Review By <?php echo $singleReview['clientFirstname']." ".$singleReview['clientLastname'] ?> </h1>
    <h2><?php echo $singleReview['invName'] ?></h2>
    <h3><?php echo $singleReview["reviewDate"] ?></h3>
    <p><?php echo $singleReview['reviewText']; ?></p>
    <form method="post" action="/cow12005-acme/reviews/index.php">
        
        <input type='hidden' name='action' value='delete-review'>
        <input type='hidden' name='reviewId' value='<?php echo $singleReview["reviewId"]; ?>'>
        <input type="hidden" name="invId" value="<?php echo $singleReview["invId"]; ?>">
        <input type='submit' value='Delete'>
    </form>
</main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
