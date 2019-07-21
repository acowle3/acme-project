<?php

function listReviews($productId) {
    $db = acmeConnect();

        $sql = 'select inventory.invName, reviews.reviewId, reviews.invId, reviews.clientId, reviews.reviewText, reviews.reviewDate, clients.clientFirstname, clients.clientLastname FROM reviews INNER JOIN clients ON reviews.clientId = clients.clientId INNER JOIN inventory ON reviews.invId = inventory.invId WHERE reviews.invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $productId, PDO::PARAM_INT);
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $reviews = $stmt->fetchAll();
    $stmt->closeCursor();
    return $reviews;
}
function listByReviewsUser($clientId) {
    $db = acmeConnect();

        $sql = 'select inventory.invName, reviews.reviewId, reviews.invId, reviews.clientId, reviews.reviewText, reviews.reviewDate, clients.clientFirstname, clients.clientLastname FROM reviews INNER JOIN clients ON reviews.clientId = clients.clientId INNER JOIN inventory ON reviews.invId = inventory.invId WHERE reviews.clientId = :clientId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $reviews = $stmt->fetchAll();
    $stmt->closeCursor();
    return $reviews;
}
function listReview($reviewId) {
    $db = acmeConnect();

        $sql = 'select inventory.invName, reviews.reviewId, reviews.invId, reviews.clientId, reviews.reviewText, reviews.reviewDate, clients.clientFirstname, clients.clientLastname FROM reviews INNER JOIN clients ON reviews.clientId = clients.clientId INNER JOIN inventory ON reviews.invId = inventory.invId WHERE reviews.reviewId = :reviewId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $reviews = $stmt->fetch();
    $stmt->closeCursor();
    return $reviews;
}

function newReview($reviewText, $invId, $clientId) {
    $db = acmeConnect();
   // The SQL statement
   $sql = 'INSERT INTO reviews (reviewText, invId, clientId) 
   VALUES (:reviewText, :invId, :clientId)';
   
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   $stmt->execute();

   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}

function updateReview($reviewText, $reviewId) {
    $db = acmeConnect();
    
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}

function deleteReview($reviewId) {
    $db = acmeConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}