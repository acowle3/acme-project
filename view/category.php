    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>
<main>
    <h1><?php echo $categoryName; ?> Products</h1>
    <?php if(isset($message)){
        echo $message; }  ?>
    <?php if(isset($prodDisplay)){ 
        echo $prodDisplay; } ?>
</main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
