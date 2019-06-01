

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>
    <?php 
    $dropdownMenu = "<select name='categoryId' id='categoryId' required>";
    foreach($categories as $category) {
        $dropdownMenu .= '<option value="'.$category['categoryId'].'">'.$category['categoryName']."</option>";
    }
    $dropdownMenu .= '</select>';
    ?>
    <main><h1>Add Product</h1>
        
        <?php
            if (isset($message)) {
            echo $message;
            }
?>
        <form method="post" action="/cow12005-acme/products/index.php">
            <label for="invName">Name</label>
            <input type="text" name="invName" placeholder="Name of Product"><br>
            
            <label for="invDescription">Description</label>
            <textarea rows="5" cols="50" name="invDescription" id="invDescription"></textarea><br>
            
            <label for="invPrice">Price</label>
            <input type="number" name="invPrice" id="invPrice" min="0" step="0.01" value="0.00"><br>
            
            <label for="invStock">Stock</label>
            <input type="number" name="invStock" min="0"><br>
            
            <label for="invSize">Size</label>
            <input type="number" name="invSize" min="0"><br>
            
            <label for="invWeight">Weight</label>
            <input type="number" name="invWeight" min="0"><br>
            
            <label for="invLocation">Location</label>
            <input type="text" name="invLocation" placeholder="Location"><br>
            
            <label for="categoryId">Category</label>
            <?php echo $dropdownMenu ?><br>
            
            <label for="invVendor">Vendor</label>
            <input type="text" name="invVendor" placeholder="Vendor"><br>
            
            <label for="invStyle">Style</label>
            <input type="text" name="invStyle" placeholder="Style"><br>
            
            <input type="submit" name="submit" id="insertProduct" value="Save Product">
            
            <input type="hidden" name="action" value="add-product">
        </form></main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
