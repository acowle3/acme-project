<?php



function checkEmail($clientEmail){
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

function checkPassword($clientPassword){
 $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
 return preg_match($pattern, $clientPassword);
}

function createNavbar() {
    $categories = getCategories();
    $navList = '<ul>';
    $navList .= "<li><a href='/cow12005-acme/index.php' title='View the Acme home page'>Home</a></li>";
 foreach ($categories as $category) {
  $navList .= "<li><a href='/cow12005-acme/products/index.php?action=category&categoryName=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
 $navList .= '</ul>';
 return $navList;
}

function createCatDropdown() {
     $categories = getCategories();
    
    // Build the categories option list
    $catList = '<select name="categoryId" id="categoryId">';
    $catList .= "<option>Choose a Category</option>";
    foreach ($categories as $category) {
        $catList .= "<option value='$category[categoryId]'";
        if(isset($catType)){
            if($category['categoryId'] === $catType){
                $catList .= ' selected ';
            }
        } elseif(isset($prodInfo['categoryId'])){
            if($category['categoryId'] === $prodInfo['categoryId']){
                $catList .= ' selected ';
            }
        }
        $catList .= ">$category[categoryName]</option>";
    }
    $catList .= '</select>';
    return $catList;
}

function createCatDropdownSelected($catType) {
     $categories = getCategories();
    
    // Build the categories option list
    $catList = '<select name="categoryId" id="categoryId">';
    $catList .= "<option>Choose a Category</option>";
    foreach ($categories as $category) {
        $catList .= "<option value='$category[categoryId]'";
        
            if($category['categoryId'] === $catType){
                $catList .= ' selected ';
            }
        $catList .= ">$category[categoryName]</option>";
    }
    $catList .= '</select>';
    return $catList;
}

function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $pd .= '<li>';
        $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
        $pd .= '<hr>';
        $pd .= "<h2><a href='/cow12005-acme/products?action=product&invId=$product[invId]'>$product[invName]</a></h2>";
        $pd .= "<span>$product[invPrice]</span>";
        $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}

function productPageBuild($prodInfo) {
    $pd =  '<div class="product-page">';
    $pd .= '<h1>'.$prodInfo['invName'].'</h1>';
    $pd .= '<div id="divide">';
    $pd .= '<div>';
    $pd .= '<img alt="Product" src='.$prodInfo['invImage'].'>';
    $thumbnails = listImageThumbnails( $prodInfo['invId'] );
    foreach ($thumbnails as $thumbnail) {
        $pd .= '<img class="thumbnail" alt="'.$thumbnail['imgName'].'" src="'.$thumbnail['imgPath'].'">';
    }
    $pd .= '</div>';
    $pd .= '<div>';
    $pd .= '<p>'.$prodInfo['invDescription'].'</p>';
    $pd .= '<p>Sold by '.$prodInfo['invVendor'].'</p>';
    $pd .= '<p>Weight: '.$prodInfo['invWeight'].'</p>';
    $pd .= '<p>Number In Stock: '.$prodInfo['invStock'].'</p>';
    $pd .= '</div>';
    $pd .= '</div>';
    $pd .= '</div>';
    if(!empty($_SESSION['loggedin'])) {
        $pd .= '<form method="post" action="/cow12005-acme/reviews/index.php">
            <input type="hidden" name="action" value="add-review">
            <input type="hidden" name="inventory" value="' . $prodInfo['invId']. '">';
        $pd .= '<textarea rows="5" cols="50" name="review" id="review" required></textarea><br>
            <input type="submit" value="Submit">
        </form>'; 
    }
    return $pd;
}

function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
        $id .= "<p><a href='/cow12005-acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}

function buildProductsSelect($products) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
        $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
        return;
    }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
}

function processImage($dir, $filename) {
 // Set up the variables
 $dir = $dir . '/';

 // Set up the image path
 $image_path = $dir . $filename;

 // Set up the thumbnail image path
 $image_path_tn = $dir.makeThumbnailName($filename);

 // Create a thumbnail image that's a maximum of 200 pixels square
 resizeImage($image_path, $image_path_tn, 200, 200);

 // Resize original to a maximum of 500 pixels square
 resizeImage($image_path, $image_path, 500, 500);
}

function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
 // Get image type
 $image_info = getimagesize($old_image_path);
 $image_type = $image_info[2];

 // Set up the function names
 switch ($image_type) {
 case IMAGETYPE_JPEG:
  $image_from_file = 'imagecreatefromjpeg';
  $image_to_file = 'imagejpeg';
 break;
 case IMAGETYPE_GIF:
  $image_from_file = 'imagecreatefromgif';
  $image_to_file = 'imagegif';
 break;
 case IMAGETYPE_PNG:
  $image_from_file = 'imagecreatefrompng';
  $image_to_file = 'imagepng';
 break;
 default:
  return;
} // ends the resizeImage function

 // Get the old image and its height and width
 $old_image = $image_from_file($old_image_path);
 $old_width = imagesx($old_image);
 $old_height = imagesy($old_image);

 // Calculate height and width ratios
 $width_ratio = $old_width / $max_width;
 $height_ratio = $old_height / $max_height;

 // If image is larger than specified ratio, create the new image
 if ($width_ratio > 1 || $height_ratio > 1) {

  // Calculate height and width for the new image
  $ratio = max($width_ratio, $height_ratio);
  $new_height = round($old_height / $ratio);
  $new_width = round($old_width / $ratio);

  // Create the new image
  $new_image = imagecreatetruecolor($new_width, $new_height);

  // Set transparency according to image type
  if ($image_type == IMAGETYPE_GIF) {
   $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
   imagecolortransparent($new_image, $alpha);
  }

  if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
   imagealphablending($new_image, false);
   imagesavealpha($new_image, true);
  }

  // Copy old image to new image - this resizes the image
  $new_x = 0;
  $new_y = 0;
  $old_x = 0;
  $old_y = 0;
  imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

  // Write the new image to a new file
  $image_to_file($new_image, $new_image_path);
  // Free any memory associated with the new image
  imagedestroy($new_image);
  } else {
  // Write the old image to a new file
  $image_to_file($old_image, $new_image_path);
  }
  // Free any memory associated with the old image
  imagedestroy($old_image);
} // ends the if - else began on line 36

function thumbnailList() {
    
    
}

function createReviewList($reviews) {
    $reviewList = '<div class="reviews">';
    foreach ($reviews as $review) {
        $reviewList .= "<div class='review-box'>";
        $reviewList .= "<h2>Review By <a href='/cow12005-acme/reviews?action=view-reviews-by-user&user-id=" . $review['clientId'] . "'>";
        $reviewList .= $review['clientFirstname']. " " . $review['clientLastname'] . "</a></h2>";
        $reviewList .= "<h3><a href='/cow12005-acme/products?action=product&invId=" . $review['invId'] . "'>";
        $reviewList .= $review['invName'] . "</a></h3>";
        $reviewList .= "<h4><a href='/cow12005-acme/reviews?action=view-specific-review&reviewId=" . $review['reviewId'] . "'>" . $review['reviewDate'] . "</a></h4>";
        $reviewList .= "<p>" . $review['reviewText'] . "</p>";
        if(!empty($_SESSION['clientData']['clientLevel']) || !empty($_SESSION['clientData']['clientId']))
        {
        if($_SESSION['clientData']['clientLevel'] > 1 || $_SESSION['clientData']['clientId'] == $review['clientId']) {
        $reviewList .= "<div>" . "<a href='/cow12005-acme/reviews/?action=edit-review-form&reviewId=" . $review['reviewId'] . "'>Edit</a>--<a href='/cow12005-acme/reviews/?action=delete-review-form&reviewId=" . $review['reviewId'] . "'>Delete</a></div>";
        }
        }
        $reviewList .= "</div>";
    }
    $reviewList .= '</div>';
    
    return $reviewList;
}

function createReviewPage($review) {
    $reviewList = '<div class="reviews">';

        $reviewList .= "<div class='review-box'>";
        $reviewList .= "<h2>Review By <a href='/cow12005-acme/reviews?action=view-reviews-by-user&user-id=" . $review['clientId'] . "'>";
        $reviewList .= $review['clientFirstname']. " " . $review['clientLastname'] . "</a></h2>";
        $reviewList .= "<h3><a href='/cow12005-acme/products?action=product&invId=" . $review['invId'] . "'>";
        $reviewList .= $review['invName'] . "</a></h3>";
        $reviewList .= "<h4><a href='/cow12005-acme/reviews?action=view-specific-review&reviewId=" . $review['reviewId'] . "'>" . $review['reviewDate'] . "</a></h4>";
        $reviewList .= "<p>" . $review['reviewText'] . "</p>";
        if($_SESSION['clientData']['clientLevel'] > 1 || $_SESSION['clientData']['clientId'] == $review['clientId']) {
        $reviewList .= "<div>" . "<a href='/cow12005-acme/reviews/?action=edit-review-form&reviewId=" . $review['reviewId'] . "'>Edit</a>--<a href='/cow12005-acme/reviews/?action=delete-review-form&reviewId=" . $review['reviewId'] . "'>Delete</a></div>";
        }
        $reviewList .= "</div>";

    $reviewList .= '</div>';
    
    return $reviewList;
}