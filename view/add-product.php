

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>

    <main><h1>Add Product</h1>
        
        <?php
            if (isset($message)) {
            echo $message;
            }
?>
        <form method="post" action="/cow12005-acme/products/index.php">
            <label for="invName" >Name</label>
            <input type="text" name="invName" placeholder="Name of Product" <?php if(isset($invName)){echo "value='$invName'";}  ?>><br>
            
            <label for="invDescription"required>Description</label>
            <textarea rows="5" cols="50" name="invDescription" id="invDescription" required <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?> ></textarea><br>
            
            <label for="invPrice">Price</label>
            <input type="number" name="invPrice" id="invPrice" min="0" step="0.01" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>  required><br>
            
            <label for="invStock">Stock</label>
            <input type="number" name="invStock" min="0" <?php if(isset($invStock)){echo "value='$invStock'";}  ?>  required><br>
            
            <label for="invSize">Size</label>
            <input type="number" name="invSize" min="0" <?php if(isset($invSize)){echo "value='$invSize'";}  ?>  required><br>
            
            <label for="invWeight">Weight</label>
            <input type="number" name="invWeight" min="0" required <?php if(isset($invWeight)){echo "value='$invWeight'";}  ?> ><br>
            
            <label for="invLocation">Location</label>
            <input type="text" name="invLocation" placeholder="Location" required <?php if(isset($invLocation)){echo "value='$invLocation'";}  ?> ><br>
            
            <label for="categoryId" >Category</label>
            <?php echo createCatDropdown() ?><br>
            
            <label for="invVendor">Vendor</label>
            <input type="text" name="invVendor" placeholder="Vendor" required <?php if(isset($invVendor)){echo "value='$invVendor'";}  ?> ><br>
            
            <label for="invStyle">Style</label>
            <input type="text" name="invStyle" placeholder="Style" required <?php if(isset($invStyle)){echo "value='$invStyle'";}  ?> ><br>
            
            <input type="submit" name="submit" id="insertProduct" value="Save Product">
            
            <input type="hidden" name="action" value="add-product">
        </form></main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
