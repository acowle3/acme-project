

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>

    <main><h1>Add Product</h1>
        
        <?php
            if (isset($message)) {
            echo $message;
            }
?>
        <form method="post" action="/cow12005-acme/products/index.php">
            <label for="invName" <?php if(isset($invName)){echo "value='$invName'";}  ?>>Name</label>
            <input type="text" name="invName" placeholder="Name of Product"><br>
            
            <label for="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?> required>Description</label>
            <textarea rows="5" cols="50" name="invDescription" id="invDescription" required></textarea><br>
            
            <label for="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> >Price</label>
            <input type="number" name="invPrice" id="invPrice" min="0" step="0.01" value="0.00" required><br>
            
            <label for="invStock" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> >Stock</label>
            <input type="number" name="invStock" min="0" required><br>
            
            <label for="invSize" <?php if(isset($invSize)){echo "value='$invSize'";}  ?> >Size</label>
            <input type="number" name="invSize" min="0" required><br>
            
            <label for="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";}  ?> >Weight</label>
            <input type="number" name="invWeight" min="0" required><br>
            
            <label for="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";}  ?> >Location</label>
            <input type="text" name="invLocation" placeholder="Location" required><br>
            
            <label for="categoryId" <?php if(isset($categoryId)){echo "value='$categoryId'";}  ?> >Category</label>
            <?php echo $dropdownMenu ?><br>
            
            <label for="invVendor" <?php if(isset($invVendor)){echo "value='$invVendor'";}  ?> >Vendor</label>
            <input type="text" name="invVendor" placeholder="Vendor" required><br>
            
            <label for="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";}  ?> >Style</label>
            <input type="text" name="invStyle" placeholder="Style" required><br>
            
            <input type="submit" name="submit" id="insertProduct" value="Save Product">
            
            <input type="hidden" name="action" value="add-product">
        </form></main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
