<?php

function listProductsByCategory($category) {
    $db = acmeConnect();

        $sql = 'select * FROM inventory WHERE categoryId = :category';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $productsByCategory = $stmt->fetchAll();
    $stmt->closeCursor();
    return $productsByCategory;
}

function listProducts() {
        $db = acmeConnect();

        $sql = 'SELECT * FROM inventory ORDER BY invName ASC';
        $stmt = $db->prepare($sql);
    
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $productData = $stmt->fetchAll();
    $stmt->closeCursor();
    return $productData;
    
}

function getProductInfo($invId){
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $prodInfo;
}

function insertProduct($invName, $invDescription, $invLocation, $categoryId, $invVendor, $invStyle, $invPrice, $invStock, $invSize, $invWeight) {
   // I've changed the default in invImage and invThumbnail to 
   // /cow12005/images/products/no-image.png if no image is listed.
   $db = acmeConnect();
   // The SQL statement
   $sql = 'INSERT INTO inventory (invName, invDescription, invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle)
   VALUES (:invName, :invDescription, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';
   // Create the prepared statement using the acme connection
   $stmt = $db->prepare($sql);
   // The next four lines replace the placeholders in the SQL
   // statement with the actual values in the variables
   // and tells the database the type of data it is
   $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
   $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
   $stmt->bindValue(':invPrice', strval($invPrice), PDO::PARAM_STR);
   $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
   $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
   $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
   $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
   $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
   $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
   $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
   // Insert the data
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}

function updateProduct($invName, $invDescription, $invLocation, $categoryId, $invVendor, $invStyle, $invPrice, $invStock, $invSize, $invWeight, $invId) {
   // I've changed the default in invImage and invThumbnail to 
   // /cow12005/images/products/no-image.png if no image is listed.
   $db = acmeConnect();
   // The SQL statement
   $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :categoryId, invVendor = :invVendor, invStyle = :invStyle
   WHERE invId = :invId';
   // Create the prepared statement using the acme connection
   $stmt = $db->prepare($sql);
   // The next four lines replace the placeholders in the SQL
   // statement with the actual values in the variables
   // and tells the database the type of data it is
   $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
   $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
   $stmt->bindValue(':invPrice', strval($invPrice), PDO::PARAM_STR);
   $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
   $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
   $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
   $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
   $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
   $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
   $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   // Insert the data
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}

function deleteProduct($invId) {
    $db = acmeConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}

function insertCategory($name) {
   $db = acmeConnect();
   // The SQL statement
   $sql = 'INSERT INTO categories (categoryName) VALUES (:name)';
   // Create the prepared statement using the acme connection
   $stmt = $db->prepare($sql);
   // The next four lines replace the placeholders in the SQL
   // statement with the actual values in the variables
   // and tells the database the type of data it is
   $stmt->bindValue(':name', $name, PDO::PARAM_STR);

   // Insert the data
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}