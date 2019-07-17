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
<main>
    <h2>Add New Product Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/cow12005-acme/uploads/" method="post" enctype="multipart/form-data">
 <label for="file1">Product</label><br>
 <?php echo $prodSelect; ?><br><br>
 <label>Upload Image:</label><br>
 <input type="file" name="file1"><br>
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
    <hr>
    <h2>Existing Images</h2>
    <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>

