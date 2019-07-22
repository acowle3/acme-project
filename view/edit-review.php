
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>
<main>
    <?php if(isset($message)){
        echo $message; }  ?>
    <h1>Review By <?php echo $reviewInfo['clientFirstname']." ".$reviewInfo['clientLastname'] ?> </h1>
    <h2><?php echo $reviewInfo['invName'] ?></h2>
    <h3><?php echo $reviewInfo["reviewDate"] ?></h3>
    <form method="post" action="/cow12005-acme/reviews/index.php">
        <textarea rows="5" cols="50" name='reviewText' required><?php echo $reviewText; ?></textarea>
        <input type='hidden' name='action' value='edit-review'>
        <input type='hidden' name='reviewId' value='<?php echo $reviewInfo["reviewId"]; ?>'>
        <input type='submit' value='Save Changes'>
    </form>
</main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
