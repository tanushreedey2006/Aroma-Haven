
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Order List</title>

<link rel="icon" type="image/png" href="weblogo.png">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

<link rel="stylesheet"
href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css"/>

<link rel="stylesheet" href="admin_panel.css">
<style>
    /*======================================
        ORDER LIST PREMIUM
=======================================*/

body{
    background:#f5f7fb;
}

/* PAGE */

.order-wrapper{
    margin:30px 18%;
    width:79%;
}

/* HEADER */

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    padding:22px 28px;
    background:linear-gradient(135deg,#4f46e5,#2563eb,#06b6d4);
    color:#fff;
    border-radius:18px;
    box-shadow:0 18px 45px rgba(0,0,0,.12);
}

.page-header h2{
    font-size:30px;
    font-weight:700;
    margin:0;
}

.page-header p{
    margin:4px 0 0;
    opacity:.85;
}

/* STATS */

.order-stats{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:30px;
}

.stat-card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.35s;
}

.stat-card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 45px rgba(0,0,0,.15);
}

.stat-icon{
    width:65px;
    height:65px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:26px;
    margin-bottom:18px;
}

.blue{
background:#2563eb;
}

.green{
background:#16a34a;
}

.orange{
background:#f59e0b;
}

.red{
background:#ef4444;
}

.stat-card h3{
    font-size:34px;
    font-weight:700;
    margin-bottom:5px;
}

.stat-card span{
    color:#888;
}

/* SEARCH */

.top-toolbar{
    background:#fff;
    padding:18px;
    border-radius:16px;
    margin-bottom:25px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.search-box{
    width:350px;
}

.search-box input{
    border-radius:50px;
    padding:12px 18px;
}

/* TABLE */

.table-card{

background:#fff;
border-radius:18px;
padding:20px;
box-shadow:0 12px 35px rgba(0,0,0,.08);

}

.table{

margin:0;

}

.table thead{

position:sticky;
top:0;
z-index:5;

}

.table thead th{

background:linear-gradient(135deg,#2563eb,#4f46e5);
color:#fff;
padding:18px;
border:none;
font-weight:600;

}

.table tbody td{

vertical-align:middle;
padding:18px;

}

.table tbody tr{

transition:.3s;

}

.table tbody tr:hover{

background:#eef4ff;
transform:scale(1.005);

}

.table img{

width:75px;
height:75px;
border-radius:15px;
object-fit:cover;
box-shadow:0 5px 15px rgba(0,0,0,.15);

}

/* BADGES */

.badge{

padding:10px 16px;
font-size:13px;
border-radius:30px;

}

/* ACTION */

.view-btn{

width:42px;
height:42px;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
background:#eff6ff;
transition:.3s;
text-decoration:none;

}

.view-btn:hover{

background:#2563eb;
color:#fff;
transform:rotate(10deg);

}

/* PAGINATION */

.pagination-area{

margin-top:30px;
display:flex;
justify-content:center;
gap:10px;

}

.pagination-area a{

padding:11px 18px;
border-radius:10px;
background:#fff;
color:#444;
text-decoration:none;
box-shadow:0 5px 15px rgba(0,0,0,.08);
transition:.3s;

}

.pagination-area a:hover{

background:#2563eb;
color:#fff;

}

.active-page{

background:#111827!important;
color:#fff!important;

}

/* MOBILE */

@media(max-width:1200px){

.order-wrapper{

margin:30px;
width:auto;

}

.order-stats{

grid-template-columns:repeat(2,1fr);

}

}

@media(max-width:768px){

.order-stats{

grid-template-columns:1fr;

}

.search-box{

width:100%;

}

.page-header{

flex-direction:column;
align-items:flex-start;
gap:10px;

}

}
</style>
</head>

<body>
    <?php

include "includes/db_connect.php";
include "function.php";

$limit = 5;

/* ---------------- PAGE SAFE CHECK ---------------- */
$page = $_GET['page'] ?? 1;

if (!ctype_digit(strval($page))) {
    $page = 1;
} else {
    $page = (int)$page;
}
/* ---------------- SEARCH ---------------- */
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$search_escaped = mysqli_real_escape_string($conn, $search);

/* ---------------- OFFSET ---------------- */
$offset = ($page - 1) * $limit;

/* ---------------- WHERE CONDITION (SAFE REUSE) ---------------- */
$where = "WHERE is_deleted = 0";

if ($search != '') {
    $where .= " AND (
        customer_name LIKE '%$search_escaped%'
        OR order_number LIKE '%$search_escaped%'
        OR product_name LIKE '%$search_escaped%'
        OR payment_status LIKE '%$search_escaped%'
        OR order_status LIKE '%$search_escaped%'
    )";
}

/* ---------------- TOTAL RECORDS ---------------- */
$total_sql = "SELECT COUNT(*) AS total FROM userorder $where";
$total_query = mysqli_query($conn, $total_sql);

if (!$total_query) {
    die("Count Query Error: " . mysqli_error($conn));
}

$total_row = mysqli_fetch_assoc($total_query);
$total_records = (int)$total_row['total'];

/* ---------------- TOTAL PAGES ---------------- */
$total_pages = ceil($total_records / $limit);
if ($total_pages < 1) {
    $total_pages = 1;
}

if ($page > $total_pages) {
    $page = $total_pages;
}
if ($total_pages < 1) $total_pages = 1;

/* FIX: prevent invalid page number */
if ($page > $total_pages) {
    $page = $total_pages;
    $offset = ($page - 1) * $limit;
}

/* ---------------- MAIN QUERY ---------------- */
$sql = "SELECT * FROM userorder $where ORDER BY id DESC LIMIT $limit OFFSET $offset";

$res = mysqli_query($conn, $sql);

if (!$res) {
    die("Main Query Error: " . mysqli_error($conn));
}

?>

<div class="container" style="margin-left:-1%; min-width:102%;">

    <?php include "sidebar.php"; ?>

    <?php include "header.php"; ?>
    <div class="">

    </div>
    </div>

</div>

<!-- <div class="table-responsive" style="margin:3% 19%;  width:80%;"> -->

    <div class="order-wrapper">

    <div class="order-wrapper">

<div class="page-header">

<div>

<h2>
<i class="fa-solid fa-cart-shopping"></i>
Order Management
</h2>

<p>Manage customer orders professionally</p>

</div>

<div>

<span class="badge bg-light text-dark fs-6">

<?php echo $total_records; ?>

Orders

</span>

</div>

</div>

<div class="order-stats">

<div class="stat-card">

<div class="stat-icon blue">
<i class="fa-solid fa-cart-shopping"></i>
</div>

<h3><?php echo $total_records; ?></h3>

<span>Total Orders</span>

</div>

<div class="stat-card">

<div class="stat-icon green">
<i class="fa-solid fa-circle-check"></i>
</div>

<h3>

<?php
$q=mysqli_query($conn,"SELECT COUNT(*) c FROM userorder WHERE order_status='Delivered'");
echo mysqli_fetch_assoc($q)['c'];
?>

</h3>

<span>Delivered</span>

</div>

<div class="stat-card">

<div class="stat-icon orange">
<i class="fa-solid fa-truck"></i>
</div>

<h3>

<?php
$q=mysqli_query($conn,"SELECT COUNT(*) c FROM userorder WHERE order_status='Processing'");
echo mysqli_fetch_assoc($q)['c'];
?>

</h3>

<span>Processing</span>

</div>

<div class="stat-card">

<div class="stat-icon red">
<i class="fa-solid fa-ban"></i>
</div>

<h3>

<?php
$q=mysqli_query($conn,"SELECT COUNT(*) c FROM userorder WHERE order_status='Cancelled'");
echo mysqli_fetch_assoc($q)['c'];
?>

</h3>

<span>Cancelled</span>

</div>

</div>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="title">
            <i class="fa-solid fa-cart-shopping"></i>
            Order Details
        </h1>

    </div>

<table class="table table-bordered table-striped align-middle">

<div class="top-toolbar">

<form method="GET" class="d-flex justify-content-between">

<div class="search-box">

<input
type="text"
name="search"
class="form-control"
placeholder="Search Orders..."
value="<?php echo htmlspecialchars($search); ?>">

</div>

<button class="btn btn-primary">

<i class="fa fa-search"></i>

Search

</button>

</form>

</div>

<div class="table-card">

<div class="table-responsive">

<thead class="table-info text-center">

<tr>

<th>ID</th>
<th>Order No</th>
<th>Customer</th>
<th>Product</th>
<th>Image</th>
<th>Qty</th>
<th>Total</th>
<th>Payment</th>
<th>Order Status</th>
<th>Delivery</th>
<th>Date</th>
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

<td>
<span class="badge bg-dark">
<?php echo $row['order_number']; ?>
</span>
</td>

<td>

<strong>
<?php echo $row['customer_name']; ?>
</strong>

<br>

<small>
<?php echo $row['customer_number']; ?>
</small>

</td>

<td>
<?php echo $row['product_name']; ?>
</td>

<td>

<img
src="<?php echo !empty($row['product_image']) ? '../images/'.$row['product_image'] : '../images/default.avif'; ?>"
style="
width:80px;
height:80px;
object-fit:cover;
border-radius:10px;
">

</td>

<td>
<?php echo $row['quantity']; ?>
</td>

<td>

₹<?php echo number_format($row['grand_total'],2); ?>

</td>

<td>

<?php

if($row['payment_status']=="Paid"){

echo '<span class="badge bg-success">Paid</span>';

}elseif($row['payment_status']=="Failed"){

echo '<span class="badge bg-danger">Failed</span>';

}else{

echo '<span class="badge bg-warning text-dark">Pending</span>';

}

?>

</td>

<td>

<?php

$status = $row['order_status'];

if($status=="Delivered"){

echo '<span class="badge bg-success">Delivered</span>';

}
elseif($status=="Cancelled"){

echo '<span class="badge bg-danger">Cancelled</span>';

}
elseif($status=="Processing"){

echo '<span class="badge bg-primary">Processing</span>';

}
elseif($status=="Shipped"){

echo '<span class="badge bg-info">Shipped</span>';

}
else{

echo '<span class="badge bg-secondary">'.$status.'</span>';

}

?>

</td>

<td>

<?php

$delivery = $row['delivery_status'];

if($delivery=="Delivered"){

echo '<span class="badge bg-success">'.$delivery.'</span>';

}
elseif($delivery=="Near you"){

echo '<span class="badge bg-warning text-dark">'.$delivery.'</span>';

}
elseif($delivery=="On the way"){

echo '<span class="badge bg-primary">'.$delivery.'</span>';

}
else{

echo '<span class="badge bg-secondary">'.$delivery.'</span>';

}

?>

</td>

<td>

<?php

echo !empty($row['created_at'])
? date("d M Y h:i A",strtotime($row['created_at']))
: '-';

?>

</td>

<td>

<a href="view_order.php?id=<?php echo $row['id']; ?>">

<i class="fa-solid fa-eye text-primary fs-5"></i>

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="12" class="text-center text-danger">

No Orders Found

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<div class="text-center mt-4">

<?php if ($total_pages > 1) { ?>

    <!-- Previous -->
    <?php if ($page > 1) { ?>
        <a class="btn btn-primary"
           href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">
            ← Previous
        </a>
    <?php } ?>

    <!-- Page Numbers -->
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a class="btn <?php echo ($i == $page) ? 'btn-dark' : 'btn-light'; ?>"
           href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
            <?php echo $i; ?>
        </a>
    <?php } ?>

    <!-- Next -->
    <?php if ($page < $total_pages) { ?>
        <a class="btn btn-primary"
           href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">
            Next →
        </a>
    <?php } ?>

<?php } ?>

</div>
</div>

<script src="../assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>