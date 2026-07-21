<?php
session_start();
include "connect.php";
$user_id = $_SESSION['user_id'] ?? 0;

/* =========================
   GET FORM DATA
========================= */
$name    = trim($_POST['customer_name'] ?? '');
$phone   = trim($_POST['customer_phone'] ?? '');
$date    = $_POST['booking_date'] ?? '';
$time    = $_POST['booking_time'] ?? '';
$people  = (int)($_POST['people'] ?? 1);
$message = trim($_POST['message'] ?? '');

$booking_table = $_POST['booking_table'] ?? '';
$special_event = $_POST['special_event'] ?? 'None';
if($special_event == "None"){
    $special_order = "No";
}else{
    $special_order = "Yes";
}
$event_image   = $_POST['event_image'] ?? '';

$table_id = $_POST['table_id'] ?? '';   // ✅ ADD THIS

/* =========================
   VALIDATION
========================= */
if ($name == '' || $phone == '' || $date == '' || $time == '' || $table_id == '') {
    $_SESSION['error'] = "All required fields must be filled!";
    header("Location: book.php");
    exit();
}

/* =========================
   ESCAPE DATA
========================= */
$user_id        = mysqli_real_escape_string($conn, $user_id);
$name           = mysqli_real_escape_string($conn, $name);
$phone          = mysqli_real_escape_string($conn, $phone);
$booking_table  = mysqli_real_escape_string($conn, $booking_table);
$event_image    = mysqli_real_escape_string($conn, $event_image);
$message        = mysqli_real_escape_string($conn, $message);
$table_id       = mysqli_real_escape_string($conn, $table_id);
$special_event  = mysqli_real_escape_string($conn, $special_event);
$special_order  = mysqli_real_escape_string($conn, $special_order);
$payment_method = mysqli_real_escape_string($conn ,$payment_method);
$payment_status = mysqli_real_escape_string($conn ,$payment_status);

/* =========================
   🔥 STEP 1: CHECK TABLE IS ALREADY BOOKED
   (THIS GOES BEFORE INSERT)
========================= */
$check = mysqli_query($conn,
"SELECT id FROM bookings 
 WHERE table_id='$table_id'
 AND booking_date='$date'
 AND booking_time='$time'
 AND status != 'Cancelled'"
);
if (mysqli_num_rows($check) > 0) {
    $_SESSION['error'] = "❌ This table is already booked!";
    header("Location: book.php?img=$event_image");
    exit();
}

/* =========================
   🔥 STEP 2: INSERT BOOKING
========================= */
$sql = "INSERT INTO bookings (
    user_id,
    customer_name,
    customer_phone,
    booking_table,
    booking_date,
    booking_time,
    people,
    special_event,
    special_order,
    event_image,
    message,
    payment_method,
    payment_status,
    is_paid
    status,
    table_id
) VALUES (
    '$user_id',
    '$name',
    '$phone',
    '$booking_table',
    '$date',
    '$time',
    '$people',
    '$special_event',
    '$special_order',
    '$event_image',
    '$message',
    '$payment_method',
    '$payment_status',
    0
    'Pending',
    '$table_id'
)";

if (mysqli_query($conn, $sql)) {

    $_SESSION['success'] = "🎉 Booking successful! Waiting for confirmation.";
    header("Location: booking_success.php");
exit();

} else {

    $_SESSION['error'] = "Database error: " . mysqli_error($conn);
    header("Location: book.php?error=1");
    exit();
}
?>