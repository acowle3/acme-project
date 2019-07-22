<?php
session_start();
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
  require_once '../model/reviews-model.php';
require_once '../model/accounts-model.php';
require_once '../model/products-model.php';
require_once '../model/uploads-model.php';
 require_once '../library/functions.php';
 $categories = getCategories();
 
$level = $_SESSION['clientData']['clientLevel'];
$clientId = $_SESSION['clientData']['clientId'];

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
     case 'add-review':
         $reviewText = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_STRING);
         $invId = filter_input(INPUT_POST, 'inventory', FILTER_SANITIZE_NUMBER_INT);
         
         $regOutcome = newReview($reviewText, $invId, $_SESSION['clientData']['clientId']);
        
        if($regOutcome === 1){
            
            
        
        } else {
            $message = "<p>Error Adding Review</p>";
            
        
        }
        if (empty($invId)) {
            $message = '<p>No Item Selected.</p>';
            include '../view/product-page.php';
            exit;
        }
        $prodInfo = getProductInfo($invId);
        if (empty($prodInfo)) {
            $message = '<p>No Item Selected.</p>';
            include '../view/product-page.php';
            exit;
        }
        $reviews = listReviews($invId);
        $prodReviews = createReviewList($reviews);
        $prodPage = productPageBuild($prodInfo);
        include '../view/product-page.php';
         break;
     case 'edit-review-form':
         $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewInfo = listReview($reviewId);
        if(count($reviewInfo)<1){
            $message = 'No Review Selected';
        }
        include '../view/edit-review.php';
        exit;
         break;
     case 'view-specific-review':
         $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
         
         if (empty($reviewId)) {
            
            $message = '<p>No Item Selected.</p>';
            include '../view/client-reviews.php';
            exit;
        
         }
         $singleReview = listReview($reviewId);
         $prodReviews = createReviewPage($singleReview);
         include '../view/single-review.php';
         break;
     case 'view-reviews-by-user':
         $clientId = filter_input(INPUT_GET, 'user-id', FILTER_VALIDATE_INT);
         if (empty($clientId)) {
            
            $message = '<p>No Item Selected.</p>';
            include '../view/client-reviews.php';
            exit;
        
         }
         $reviews = listByReviewsUser($clientId);
         $prodReviews = createReviewList($reviews);
         $clientNames = getClientUserName($clientId);
         $client = $clientNames['clientFirstname'] . ' ' . $clientNames["clientLastname"];
         include '../view/client-reviews.php';
         break;
     case 'edit-review':
         $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
         $reviewId = filter_input(INPUT_POST, "reviewId", FILTER_SANITIZE_NUMBER_INT);
         if(empty($reviewText)) {
             $message = "please don't empty the text field.";
             include '../view/edit-review.php';
                exit;
         }
         $updateNow = updateReview($reviewText, $reviewId);
         if ($updateNow) {
                $singleReview = listReview($reviewId);
                $prodReviews = createReviewPage($singleReview);
                $message = "<p>Changes Saved.</p>";
                include '../view/single-review.php';
                exit;
        } else {
            $reviewInfo = listReview($reviewId);
                $message = "<p>Error. The product was not altered.</p>";
                include '../view/edit-review.php';
                exit;
        }
         break;
     case 'delete-review-form':
         $reviewId = filter_input(INPUT_GET, "reviewId", FILTER_SANITIZE_NUMBER_INT);
         
         if(empty($reviewId)) {
            $message = "<p>Sector Clear</p>";
             include '../view/delete-review.php';
                exit;
         }
         else {
             $singleReview = listReview($reviewId);
             include '../view/delete-review.php';
         }
         break;
     case 'delete-review':
         $reviewId = filter_input(INPUT_POST, "reviewId", FILTER_SANITIZE_NUMBER_INT);
         $invId = filter_input(INPUT_POST, "invId", FILTER_SANITIZE_NUMBER_INT);
         if(empty($reviewId)) {
            $message = "<p>Sector Clear</p>";
            header('location: /cow12005-acme/');
                exit;
         }
         $results = deleteReview($reviewId);
         if($results < 1) {
             $message = "I don't wanna eat it.  It was yucky.  :C";
             exit;
            
         }
         $prodInfo = getProductInfo($invId);
            $reviews = listReviews($invId);
            $prodReviews = createReviewList($reviews);
            $prodPage = productPageBuild($prodInfo);
        include '../view/product-page.php';
         break;
     default:
         include '../view/home';
         break;
 }