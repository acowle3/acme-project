<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    
 header('location: /cow12005-acme/');
 exit;
}
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>
        <?php
            if (isset($message)) {
                echo $message;
            } if (isset($prodList)) {
                echo $prodList;
            }
        ?>
        <main>
            <h1>Products</h1>
            <h2><a href="/cow12005-acme/products/index.php?action=add-product-form">Add Product</a></h2>
            <h2><a href="/cow12005-acme/products/index.php?action=add-category-form">Add Category</a></h2>
        </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>

<?php unset($_SESSION['message']); ?>