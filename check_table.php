<?php
include "connect.php";

$table = $_POST['table'];

$res = mysqli_query($conn,
"SELECT id FROM bookings WHERE table_id='$table' AND status!='Cancelled'");

echo mysqli_num_rows($res) > 0 ? "booked" : "free";
?>