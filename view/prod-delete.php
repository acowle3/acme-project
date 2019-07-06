

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>

    <main><form method="post" action="/cow12005-acme/products/">
 <fieldset>
     <?php echo $message; ?>
  <label for="invName">Product Name</label>
  <input type="text" readonly name="invName" id="invName" <?php if(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>>

  <label for="invDescription">Product Description</label>
  <textarea name="invDescription" readonly id="invDescription"><?php if(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; } ?></textarea>

  <label>&nbsp;</label> 
  <input type="submit" class="regbtn" name="submit" value="Delete Product">

  <input type="hidden" name="action" value="delete-product">
  <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">

 </fieldset>
</form></main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
