<?php
session_start();
include("includes/db_connect.php");

$phone = mysqli_real_escape_string(
$conn,
$_GET['phone'] ?? ''
);

if($phone==''){
    die("Customer not found");
}

/* CUSTOMER INFO */
$customer = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT *
FROM bookings
WHERE customer_phone='$phone'
ORDER BY id DESC
LIMIT 1
")
);

/* TOTAL BOOKINGS */
$totalBookings = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
WHERE customer_phone='$phone'
")
)['total'];

/* CONFIRMED */
$confirmed = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
WHERE customer_phone='$phone'
AND status='Confirmed'
")
)['total'];

/* PAID */
$paid = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
WHERE customer_phone='$phone'
AND is_paid=1
")
)['total'];

/* HISTORY */
$history = mysqli_query($conn,"
SELECT *
FROM bookings
WHERE customer_phone='$phone'
ORDER BY id DESC
");

$totalSpent = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT SUM(amount) total
FROM bookings
WHERE customer_phone='$phone'
AND is_paid=1
")
)['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>

<title>Customer Booking History</title>

<link rel="stylesheet"
href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

body{
background:#f5f7fb;
}

.profile-card{
background:#fff;
padding:25px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
margin-bottom:25px;
}

.stats{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:15px;
margin-top:20px;
}

.box{
background:#f8fafc;
padding:20px;
border-radius:12px;
text-align:center;
}

.box h3{
margin:0;
font-size:26px;
font-weight:700;
}

.timeline{
background:#fff;
padding:20px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.timeline-item{
border-left:4px solid #2563eb;
padding-left:15px;
margin-bottom:20px;
}

.timeline-confirmed{
border-left:5px solid #22c55e;
background:#f0fdf4;
}

.timeline-pending{
border-left:5px solid #f59e0b;
background:#fffbeb;
}

.timeline-cancelled{
border-left:5px solid #ef4444;
background:#fef2f2;
}
</style>

</head>

<body>

<div class="container mt-4">

<a href="admin_manage_bookings.php"
class="btn btn-dark mb-3">
← Back
</a>

<div class="profile-card">

<h2>
<i class="fas fa-user"></i>
<div class="d-flex align-items-center gap-3">

<div style="
width:80px;
height:80px;
border-radius:50%;
background:#2563eb;
color:white;
display:flex;
align-items:center;
justify-content:center;
font-size:30px;
font-weight:bold;
">
<?= strtoupper(substr($customer['customer_name'],0,1)); ?>
</div>

<div>

<h2>
<?= $customer['customer_name']; ?>
</h2>

<?php if($totalBookings >= 3){ ?>
<span class="badge bg-warning text-dark">
⭐ VIP Customer
</span>
<?php } ?>

</div>

</div>
<?php echo $customer['customer_name']; ?>
</h2>

<p>
📞 <?php echo $customer['customer_phone']; ?>
</p>

<div class="stats">

<div class="box">
<h3><?php echo $totalBookings; ?></h3>
<p>Total Bookings</p>
</div>

<div class="box">
<h3><?php echo $confirmed; ?></h3>
<p>Confirmed</p>
</div>

<div class="box">
<h3><?php echo $paid; ?></h3>
<p>Paid Bookings</p>
</div>

<div class="box">

<h3>₹<?= number_format($totalSpent); ?></h3>

<p>Total Spent</p>

</div>
</div>

<div class="row mt-4">

<div class="col-md-4">

<div class="box">

<h5>Favourite Event</h5>

<?php

$fav = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT special_event,COUNT(*) total
FROM bookings
WHERE customer_phone='$phone'
GROUP BY special_event
ORDER BY total DESC
LIMIT 1
")
);

echo $fav['special_event'] ?? 'None';

?>

</div>

</div>

<div class="col-md-4">

<div class="box">

<h5>Last Visit</h5>

<?php

$last = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT booking_date
FROM bookings
WHERE customer_phone='$phone'
ORDER BY booking_date DESC
LIMIT 1
")
);

echo $last['booking_date'];

?>

</div>

</div>

<div class="col-md-4">

<div class="box">

<h5>Loyalty Level</h5>

<?= ($totalBookings>=15)
? "Platinum"
: (($totalBookings>=8)
? "Gold"
: "Silver"); ?>

</div>

</div>

</div>

</div>

<div class="timeline">

<h3>
<i class="fas fa-history"></i>
Booking Timeline
</h3>

<?php while($row=mysqli_fetch_assoc($history)){ ?>

<?php
$class = strtolower($row['status']);
?>

<div class="timeline-item timeline-<?php echo $class; ?>">

<h5>

<?php echo $row['booking_date']; ?>

|
<?php echo date(
"h:i A",
strtotime($row['booking_time'])
); ?>

</h5>

<p>

Table:
<b><?php echo $row['booking_table']; ?></b>

|

People:
<b><?php echo $row['people']; ?></b>

|

Status:
<b><?php echo $row['status']; ?></b>

</p>

<?php if(!empty($row['message'])){ ?>

<p>
💬 <?php echo $row['message']; ?>
</p>

<?php } ?>

</div>

<?php } ?>

</div>

</div>

</body>
</html>