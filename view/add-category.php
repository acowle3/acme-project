

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/header.php'; ?>
    <?php 
    //
    $dropdownMenu = "<select name='categoryId' id='categoryId' required>";
    foreach($categories as $category) {
        $dropdownMenu .= '<option value="'.$category['categoryId'].'">'.$category['categoryName']."</option>";
    }
    $dropdownMenu .= '</select>';
    ?>
    <main><h1>Add Category</h1>
        
        <?php
            if (isset($message)) {
            echo $message;
            }
?>
        <form method="post" action="/cow12005-acme/products/index.php">
            <label for="categoryName">Name of New Category</label>
            <input type="text" name="categoryName" placeholder="Name of Category" <?php if(isset($categoryName)){echo "value='$categoryName'";}  ?> required><br>
            <input type="submit" name="submit" id="insertProduct" value="Save Category">
            <input type="hidden" name="action" value="add-category">
        </form></main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/cow12005-acme/common/footer.php'; ?>
