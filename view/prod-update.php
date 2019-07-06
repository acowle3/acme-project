

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>

    <main><h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h1>
        
        <?php
            if (isset($message)) {
            echo $message;
            }
?>
        <form method="post" action="/cow12005-acme/products/index.php">
            <label for="invName" >Name</label>
            <input type="text" name="invName" placeholder="Name of Product"  required 
                <?php if(isset($invName)){ echo "value='$invName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>><br>
            
            <label for="invDescription"required>Description</label>
            <textarea name="invDescription" id="invDescription" required>
                <?php if(isset($invDescription)){ echo $invDescription; }
                elseif(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; }?>
            </textarea><br>
            
            <label for="invPrice">Price</label>
            <input type="number" name="invPrice" min="0" <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; }?>  required><br>
            
            <label for="invStock">Stock</label>
            <input type="number" name="invStock" min="0" <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; }?>  required><br>
            
            <label for="invSize">Size</label>
            <input type="number" name="invSize" min="0" <?php if(isset($invSize)){ echo "value='$invSize'"; } elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; }?> required><br>
            
            <label for="invWeight">Weight</label>
            <input type="number" name="invWeight" min="0" required <?php if(isset($invWeight)){ echo "value='$invWeight'"; } elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; }?> ><br>
            
            <label for="invLocation">Location</label>
            <input type="text" name="invLocation" placeholder="Location" required <?php if(isset($invLocation)){ echo "value='$invLocation'"; } elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; }?> ><br>
            
            <label for="categoryId" >Category</label>
            <?php 
                if(isset($prodInfo["categoryId"])) {
                    echo createCatDropdownSelected($prodInfo["categoryId"]);
                }
                else if(isset($categoryId)) {
                    echo createCatDropdownSelected($categoryId);
                }
            
            ?><br>
            
            <label for="invVendor">Vendor</label>
            <input type="text" name="invVendor" placeholder="Vendor" required <?php if(isset($invVendor)){ echo "value='$invVendor'"; } elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; }?> ><br>
            
            <label for="invStyle">Style</label>
            <input type="text" name="invStyle" placeholder="Style" required <?php if(isset($invStyle)){ echo "value='$invStyle'"; } elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; }  ?> ><br>
            
            <input type="submit" name="submit" id="insertProduct" value="Save Product">
            
            <input type="hidden" name="action" value="update-product">
            <input type="hidden" name="invId" value="<?php if(isset($invId)){ echo "value='$invId'"; } elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invId]'"; }  ?>">

        </form></main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
