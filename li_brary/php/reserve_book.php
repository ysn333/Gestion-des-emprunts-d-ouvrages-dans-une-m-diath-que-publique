<?php

$book_id = $_POST['book_id'];

// check if the book is available for reservation
$reservations = get_book_reservations($book_id);
if (count($reservations) > 0) {
  $next_available_date = $reservations[0]['return_date'];
  // display an error message or redirect to a page that shows the next available date
  // ...
  exit;
}

// insert the reservation into the database
$reservation_date = date('Y-m-d');
$return_date = date('Y-m-d', strtotime($reservation_date . ' + 1 day'));
$reservation_id = insert_reservation($_SESSION['user_id'], $book_id, $reservation_date, $return_date);
if ($reservation_id === false) {
  // display an error message
  // ...
  exit;
}

// redirect to a page that confirms the reservation
header("Location: reservation_confirmation.php?reservation_id=$reservation_id");
exit;
?>
