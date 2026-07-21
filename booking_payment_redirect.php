<?php
session_start();

$_SESSION['booking_data'] = $_POST;

$onlineMethods = [
    'PhonePe',
    'Google Pay',
    'Paytm'
];

if(in_array($_POST['payment_method'], $onlineMethods)){

    header("Location: booking_payment.php");
    exit;

}

header("Location: book_action.php");
exit;
?>