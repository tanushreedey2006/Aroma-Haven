
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Booking Management</title>

<link rel="icon" href="weblogo.png">

<link rel="stylesheet" href="admin_panel.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet"
href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css">

</head>

<style>
    .stats-grid{
display:grid;
grid-template-columns:repeat(6,1fr);
gap:20px;
margin-bottom:25px;
}

.stat-card{
background:#fff;
padding:25px;
border-radius:18px;
text-align:center;
box-shadow:0 8px 25px rgba(0,0,0,.08);
transition:.3s;
}

.stat-card:hover{
transform:translateY(-5px);
}

.stat-card i{
font-size:32px;
color:#2563eb;
margin-bottom:10px;
}

.stat-card h3{
font-size:28px;
font-weight:700;
margin:0;
}

.stat-card p{
color:#64748b;
margin-top:8px;
}

.booking-table{
background:white;
border-radius:18px;
overflow:hidden;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.booking-table thead{
background:#1e293b;
color:white;
}

.booking-table tr:hover{
background:#f8fafc;
}

.booking-table thead{
background:
linear-gradient(
135deg,
#0f172a,
#1e293b
);
color:white;
}

.booking-table th{
padding:15px;
}

.calendar-card{
background:#fff;
padding:20px;
border-radius:15px;
margin-bottom:25px;
box-shadow:0 10px 20px rgba(0,0,0,.08);
}


.table-map{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:15px;
margin-bottom:25px;
}

.table-box{
background:#fff;
padding:20px;
text-align:center;
border-radius:15px;
font-weight:700;
box-shadow:0 8px 20px rgba(0,0,0,.08);
cursor:pointer;
transition:.3s;
}

.table-box:hover{
transform:translateY(-5px);
background:#2563eb;
color:#fff;
}
</style>
<body>
<?php
session_start();
include("includes/db_connect.php");

/* STATUS UPDATE */
if(isset($_GET['action']) && isset($_GET['id'])){

    $id = (int)$_GET['id'];
    $status = mysqli_real_escape_string($conn,$_GET['action']);

    $allowed = ['Pending','Confirmed','Cancelled'];

    if(in_array($status,$allowed)){

        mysqli_query(
            $conn,
            "UPDATE bookings
             SET status='$status'
             WHERE id='$id'"
        );

        header("Location: admin_manage_bookings.php");
        exit;
    }
}

/* SEARCH */
$search = isset($_GET['search'])
? mysqli_real_escape_string($conn,$_GET['search'])
: '';

/* PAGINATION */
$limit = 5;

$page = isset($_GET['page'])
? (int)$_GET['page']
: 1;

if($page < 1){
    $page = 1;
}

$offset = ($page - 1) * $limit;

/* TOTAL */
$total_sql = "
SELECT COUNT(*) as total
FROM bookings
WHERE 1
";

if($search != ''){

    $total_sql .= "
    AND(
        customer_name LIKE '%$search%'
        OR customer_phone LIKE '%$search%'
        OR booking_table LIKE '%$search%'
        OR special_event LIKE '%$search%'
        OR status LIKE '%$search%'
    )
    ";
}

$total_query = mysqli_query($conn,$total_sql);
$total_row = mysqli_fetch_assoc($total_query);

$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

if($total_pages < 1){
    $total_pages = 1;
}

/* MAIN QUERY */
$sql = "
SELECT *
FROM bookings
WHERE 1
";

if($search != ''){

    $sql .= "
    AND(
        customer_name LIKE '%$search%'
        OR customer_phone LIKE '%$search%'
        OR booking_table LIKE '%$search%'
        OR special_event LIKE '%$search%'
        OR status LIKE '%$search%'
    )
    ";
}

$sql .= "
ORDER BY id DESC
LIMIT $offset,$limit
";

$res = mysqli_query($conn,$sql);



$totalBookings = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
"))['total'];

$confirmed = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
WHERE status='Confirmed'
"))['total'];

$pending = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
WHERE status='Pending'
"))['total'];

$cancelled = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
WHERE status='Cancelled'
"))['total'];

$todayBookings = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
WHERE booking_date = CURDATE()
"))['total'];

$calendarBookings = mysqli_query($conn,"
SELECT booking_date,
COUNT(*) total
FROM bookings
GROUP BY booking_date
");

$tables = [
    "Table-1",
    "Table-2",
    "Table-3",
    "VIP-1",
    "VIP-2",
    "Family-1"
];


$paidBookings = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
WHERE is_paid=1
"))['total'];

$unpaidBookings = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
WHERE is_paid=0
"))['total'];


?>

<div class="container"   style="margin-left:-1%;min-width:102%;">

<?php include "sidebar.php"; ?>

<?php include "header.php"; ?>
<div class="">

</div>
</div>
</div>

<div class="main-content" style="margin:3% 18%; width:80%;">

<div class="table-responsive" >

<div class="d-flex justify-content-between mb-2" >

<h1 class="title">
<i class="fas fa-calendar-check"></i>
Booking Control Center
</h1>

<p style="color:#64748b;">
Manage reservations, confirmations and customer events
</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
    <i class="fas fa-bell"></i>
    <h3><?= $todayBookings ?></h3>
    <p>Today's Bookings</p>
</div>

    <div class="stat-card">
        <i class="fas fa-calendar-check"></i>
        <h3><?= $totalBookings ?></h3>
        <p>Total Bookings</p>
    </div>

    <div class="stat-card">
        <i class="fas fa-check-circle"></i>
        <h3><?= $confirmed ?></h3>
        <p>Confirmed</p>
    </div>

    <div class="stat-card">
        <i class="fas fa-clock"></i>
        <h3><?= $pending ?></h3>
        <p>Pending</p>
    </div>

    <div class="stat-card">
        <i class="fas fa-times-circle"></i>
        <h3><?= $cancelled ?></h3>
        <p>Cancelled</p>
    </div>

    <div class="stat-card">
<i class="fas fa-money-bill-wave"></i>
<h3><?= $paidBookings ?></h3>
<p>Paid Bookings</p>
</div>

<div class="stat-card">
<i class="fas fa-wallet"></i>
<h3><?= $unpaidBookings ?></h3>
<p>Unpaid Bookings</p>
</div>
<div class="calendar-card">
    <h4>
        <i class="fas fa-calendar-alt"></i>
        Reservation Calendar
    </h4>

    <input type="date" class="form-control">
</div>
</div>

<div class="table-map">

<?php foreach($tables as $tb){ ?>

<div class="table-box">

<?= $tb ?>

</div>

<?php } ?>

</div>

<table class="table booking-table">

<thead class="table-info">

<tr>

<th>ID</th>
<th>Customer</th>
<th>Phone</th>
<th>Table</th>
<th>Date</th>
<th>Time</th>
<th>People</th>
<th>Event</th>
<th>Payment</th>
<th>Status</th>
<th>Image</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($res) > 0){

while($row = mysqli_fetch_assoc($res)){

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['customer_name']; ?></td>

<td><?php echo $row['customer_phone']; ?></td>

<td><?php echo $row['booking_table']; ?></td>

<td><?php echo $row['booking_date']; ?></td>

<td>
<?php
echo date(
"h:i A",
strtotime($row['booking_time'])
);
?>
</td>

<td><?php echo $row['people']; ?></td>

<td><?php echo $row['special_event']; ?></td>

<td>

<?php if($row['is_paid']==1){ ?>

<span class="badge bg-success">
Paid
</span>

<?php }else{ ?>

<span class="badge bg-danger">
Unpaid
</span>

<?php } ?>

</td>

<td>

<?php

if($row['status']=="Confirmed"){

echo "<span class='badge bg-success'>Confirmed</span>";

}elseif($row['status']=="Cancelled"){

echo "<span class='badge bg-danger'>Cancelled</span>";

}else{

echo "<span class='badge bg-warning text-dark'>Pending</span>";

}

?>

</td>

<td>

<?php

if(!empty($row['event_image'])){

?>

<img
src="../images/<?php echo $row['event_image']; ?>"
style="
width:60px;
height:60px;
object-fit:cover;
border-radius:10px;">

<?php

}else{

echo "No Image";

}

?>

</td>

<td>

<a class="btn btn-success btn-sm"
href="?action=Confirmed&id=<?php echo $row['id']; ?>">
Confirm
</a>

<a class="btn btn-warning btn-sm"
href="?action=Pending&id=<?php echo $row['id']; ?>">
Pending
</a>

<a class="btn btn-danger btn-sm"
href="?action=Cancelled&id=<?php echo $row['id']; ?>">
Cancel
</a>

<button
class="btn btn-info btn-sm"
data-bs-toggle="modal"
data-bs-target="#booking<?= $row['id']; ?>">
View
</button>

<a class="btn btn-info btn-sm"
href="customer_booking_history.php?phone=<?php echo $row['customer_phone']; ?>">
History
</a>

<div class="modal fade"
id="booking<?= $row['id']; ?>">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5>
Booking Details
</h5>

<button
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<p>
<b>Name:</b>
<?= $row['customer_name']; ?>
</p>

<p>
<b>Phone:</b>
<?= $row['customer_phone']; ?>
</p>

<p>
<b>Date:</b>
<?= $row['booking_date']; ?>
</p>

<p>
<b>Time:</b>
<?= $row['booking_time']; ?>
</p>

<p>
<b>People:</b>
<?= $row['people']; ?>
</p>

<p>
<b>Event:</b>
<?= $row['special_event']; ?>
</p>

<p>
<b>Message:</b>
<?= $row['message']; ?>
</p>

</div>

</div>

</div>

</div>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="12"
class="text-center text-danger">

No Booking Found

</td>

</tr>

<?php } ?>

</tbody>

</table>

<!-- PAGINATION -->

<div class="text-center mt-4">

<?php if($page > 1){ ?>

<a class="btn btn-primary"
href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>">

← Previous

</a>

<?php } ?>

<?php for($p=1;$p<=$total_pages;$p++){ ?>

<a
class="btn <?php echo ($p==$page)?'btn-dark':'btn-outline-primary'; ?>"
href="?page=<?php echo $p; ?>&search=<?php echo urlencode($search); ?>">

<?php echo $p; ?>

</a>

<?php } ?>

<?php if($page < $total_pages){ ?>

<a class="btn btn-primary"
href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>">

Next →

</a>

<?php } ?>

</div>

</div>
</div>
</div>
<script src="../assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>