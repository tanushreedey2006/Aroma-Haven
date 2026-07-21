<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
        <link rel="icon" type="image/png" href="weblogo.png">

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="admin_panel.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
      /* ===========================
   PREMIUM PRODUCT TABLE
===========================*/
/* 
.table-card{
    background:#fff;
    border-radius:22px;
    padding:25px;
    margin-top:25px;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
    transition:.35s;
    overflow:hidden;
}

.table-card:hover{
    box-shadow:0 20px 55px rgba(37,99,235,.15);
}

.table-responsive{
    border-radius:18px;
    overflow:hidden;
}

.data-table{
    width:100%;
    border-collapse:collapse;
}

.data-table thead tr{
    background:linear-gradient(90deg,#2563eb,#4f46e5);
}

.data-table thead th{
    color:#fff;
    padding:18px;
    font-size:15px;
    font-weight:700;
    border:none;
    letter-spacing:.5px;
}

.data-table tbody tr{
    transition:.35s;
}

.data-table tbody tr:nth-child(even){
    background:#fafbff;
}

.data-table tbody tr:hover{
    background:#eef4ff;
    transform:scale(1.005);
}

.data-table td{
    padding:16px;
    vertical-align:middle;
    border-bottom:1px solid #edf2f7;
}

.data-table td img{

    width:65px;
    height:65px;
    object-fit:cover;
    border-radius:14px;
    border:3px solid #fff;
    box-shadow:0 8px 18px rgba(0,0,0,.15);
    transition:.35s;

}

.data-table td img:hover{

    transform:scale(1.12) rotate(-2deg);

}

.badge{

    padding:8px 18px;
    border-radius:50px;
    font-size:12px;
    font-weight:700;
    letter-spacing:.5px;

}

.bg-success{

    background:#16a34a !important;

}

.bg-danger{

    background:#dc2626 !important;

}

.data-table td a{

    width:38px;
    height:38px;
    display:inline-flex;
    justify-content:center;
    align-items:center;
    border-radius:10px;
    text-decoration:none;
    margin-right:8px;
    transition:.35s;

}

.data-table td a:first-child{

    background:#e0ecff;
    color:#2563eb;

}

.data-table td a:last-child{

    background:#fff4dd;
    color:#f59e0b;

}

.data-table td a:hover{

    transform:translateY(-4px);
    box-shadow:0 8px 18px rgba(0,0,0,.18);

}

.data-table td:nth-child(3){

    font-weight:700;
    color:#2563eb;
    font-size:15px;

}

.data-table td:nth-child(4){

    font-weight:700;
    color:#0f766e;

}

.table-card{

    animation:fadeUp .7s ease;

}

@keyframes fadeUp{

    from{

        opacity:0;
        transform:translateY(25px);

    }

    to{

        opacity:1;
        transform:translateY(0);

    }

} */
    </style>


    <?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: admin_login.php");
    exit();
}
include "includes/db_connect.php";

$search = isset($_GET['search'])
    ? mysqli_real_escape_string($conn,$_GET['search'])
    : '';
$sql="select count(*) as total_user from clients;";


$run=mysqli_query($conn,$sql);
$result=mysqli_fetch_assoc($run);
$total_user=$result['total_user'];


$order_count_query = mysqli_query($conn,"
SELECT COUNT(*) as total_orders
FROM userorder
");

$order_count_data = mysqli_fetch_assoc($order_count_query);
$total_orders = $order_count_data['total_orders'] ?? 0;

$revenue_query = mysqli_query($conn,"
SELECT SUM(grand_total) AS total_revenue
FROM userorder
WHERE payment_status='Paid'
");

$revenue_data = mysqli_fetch_assoc($revenue_query);

$total_revenue = $revenue_data['total_revenue'] ?? 0;

// Total Users
$user_query = mysqli_query($conn,"
SELECT COUNT(*) as total_users
FROM clients
WHERE role='user'
");

$user_data = mysqli_fetch_assoc($user_query);
$total_users = $user_data['total_users'] ?? 0;


// Total Orders
$order_query = mysqli_query($conn,"
SELECT COUNT(*) as total_orders
FROM userorder
");

$order_data = mysqli_fetch_assoc($order_query);
$total_orders = $order_data['total_orders'] ?? 0;


// Conversion Rate
if($total_users > 0){
    $conversion_rate = round(($total_orders / $total_users) * 100, 2);
}else{
    $conversion_rate = 0;
}
?>

<?php
$current_users = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total
FROM clients
WHERE role='user'
AND MONTH(addwithus) = MONTH(CURRENT_DATE())
"))['total'];

$last_users = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total
FROM clients
WHERE role='user'
AND MONTH(addwithus) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
"))['total'];

$user_change = ($last_users > 0)
? round((($current_users - $last_users) / $last_users) * 100, 1)
: 100;
?>

<?php
$current_revenue = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(grand_total) as total
FROM userorder
WHERE payment_status='Paid'
AND MONTH(created_at) = MONTH(CURRENT_DATE())
"))['total'];

$last_revenue = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(grand_total) as total
FROM userorder
WHERE payment_status='Paid'
AND MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
"))['total'];

$current_revenue = $current_revenue ?? 0;
$last_revenue = $last_revenue ?? 0;

$revenue_change = ($last_revenue > 0)
? round((($current_revenue - $last_revenue) / $last_revenue) * 100, 1)
: 100;
?>

<?php
$current_orders = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total
FROM userorder
WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
"))['total'];

$last_orders = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total
FROM userorder
WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
"))['total'];

$order_change = ($last_orders > 0)
? round((($current_orders - $last_orders) / $last_orders) * 100, 1)
: 100;
?>
  </head>
  <body>
    <div class="container">
      <?php include "sidebar.php";?>
      <?php
        include "header.php";
        ?>
     

        </div>
      </div>

      <div class="main-content">
        <div class="page-title">
          <div class="title">Dashboard</div>
          <div class="action-buttons">
            <button class="btn btn-outline">
              <i class="fas fa-download"></i>
              Export
            </button>
            <button class="btn btn-primary">
              <i class="fas fa-plus"></i>
              Add New
            </button>
          </div>
        </div>

        <div class="stats-cards">
          <div class="stat-card">
            <div class="card-header">
              <div>
                <div class="card-value"><?=$total_user?></div>
                <div class="card-label">Total Users</div>
              </div>
              <div class="card-icon purple">
                <i class="fas fa-users"></i>
              </div>
            </div>
            <div class="card-change positive">
              <div class="card-change <?= ($user_change >= 0 ? 'positive' : 'negative') ?>">
                  <i class="fas fa-arrow-<?= ($user_change >= 0 ? 'up' : 'down') ?>"></i>
                  <span><?= $user_change ?>% from last month</span>
              </div>
            </div>
          </div>

          <div class="stat-card">
            <div class="card-header">
              <div>
                <div class="card-value">
                  ₹<?= number_format($total_revenue,2) ?>
                  </div>
                <div class="card-label">Total Revenue</div>
              </div>
              <div class="card-icon blue">
                <i class="fas fa-dollar-sign"></i>
              </div>
            </div>
            <div class="card-change positive">
                  <div class="card-change <?= ($revenue_change >= 0 ? 'positive' : 'negative') ?>">
                    <i class="fas fa-arrow-<?= ($revenue_change >= 0 ? 'up' : 'down') ?>"></i>
                    <span><?= $revenue_change ?>% from last month</span>
                </div>
            </div>
          </div>

          <div class="stat-card">
            <div class="card-header">
              <div>

                <div class="card-value"><?=$total_orders?></div>
                <div class="card-label">Total Orders</div>
              </div>
              <div class="card-icon green">
                <i class="fas fa-shopping-cart"></i>
              </div>
            </div>
            <div class="card-change negative">
              <div class="card-change <?= ($order_change >= 0 ? 'positive' : 'negative') ?>">
                  <i class="fas fa-arrow-<?= ($order_change >= 0 ? 'up' : 'down') ?>"></i>
                  <span><?= $order_change ?>% from last month</span>
              </div>
            </div>
          </div>

          <div class="stat-card">
            <div class="card-header">
              <div>
               <div class="card-value">
                  <?php echo $conversion_rate; ?>%
              </div>

              <div class="card-label">
                  Conversion Rate
              </div>
              </div>
              <div class="card-icon orange">
                <i class="fas fa-chart-line"></i>
              </div>
            </div>
            <div class="card-change positive">
              <i class="fas fa-arrow-up"></i>
              <span>4.6% from last month</span>
            </div>
          </div>
        </div>


   <!-- <?php


$product_query = "SELECT * FROM products";
$product_run = mysqli_query($conn,$product_query);

$total_products = mysqli_num_rows($product_run);

$view_all =
isset($_GET['view']) &&
$_GET['view'] == 'all';

$active_query =
"SELECT * FROM products WHERE status=1";

if(!$view_all){

    $active_query .= " LIMIT 5";

}

$active_run =
mysqli_query($conn,$active_query);

$active_products =
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM products WHERE status=1")
);



$inactive_query =
"SELECT * FROM products WHERE status=0";

if(!$view_all){

    $inactive_query .= " LIMIT 5";

}

$inactive_run =
mysqli_query($conn,$inactive_query);

$inactive_products =
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM products WHERE status=0")
);

?> -->


<?php
$active_products = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as c FROM products WHERE status=1"))['c'];

$inactive_products = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as c FROM products WHERE status=0"))['c'];
?>




<div class="table-card mb-4">

<div class="card-title d-flex justify-content-between align-items-center">

<h3 style="font-weight:700;">

<i class="fas fa-cube"></i>
Product Analytics

</h3>
<?php
$view_all =
isset($_GET['view']) &&
$_GET['view'] == 'all';
?>



<a href="?view=<?php echo $view_all ? 'less' : 'all'; ?>"
   style="
   text-decoration:none;
   font-weight:600;
   padding:10px 18px;
   background:#f4f4f4;
   border-radius:12px;
   color:#111;
">
   <?php echo $view_all ? 'Show Less' : 'View All'; ?>
</a>

</div>



<div class="row p-4 g-4">


<!-- <div class="col-md-6">

<div class="stat-card"

      style="
      border:none;
      border-radius:25px;
      background:linear-gradient(135deg,#f6fff8,#eafff0);
      box-shadow:0 10px 25px rgba(0,0,0,0.08);
      ">

      <div class="card-header">

      <div>

      <h1
      style="
      font-size:40px;
      font-weight:800;
      color:#0f9d58;
      margin:0;
      ">

      <?php echo $active_products; ?>

      </h1>

      <p
      style="
      margin:0;
      font-weight:600;
      color:#555;
      ">

      Active Products

      </p>

      </div>

      <div class="card-icon green">

      <i class="fas fa-check-circle"></i>

      </div>

      </div>

      <hr>

      <?php
      while($active = mysqli_fetch_assoc($active_run)){
      ?>

      <div

      style="
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding:12px;
      background:#fff;
      border-radius:18px;
      margin-bottom:15px;
      box-shadow:0 4px 15px rgba(0,0,0,0.06);
      ">

      <div
      style="
      display:flex;
      align-items:center;
      gap:15px;
      ">

<img
src="../images/<?php echo $active['image']; ?>"

style="
width:70px;
height:70px;
object-fit:cover;
border-radius:16px;
border:3px solid #d4ffe0;
">

<div>

<h5
style="
margin:0;
font-weight:700;
">

<?php echo $active['name']; ?>

</h5>

<p
style="
margin:0;
color:#666;
font-size:14px;
">

₹<?php echo $active['price']; ?>

</p>

</div>

</div>

<span
style="
display:inline-flex;
align-items:center;
gap:6px;
background:#ecfdf3;
color:#067647;
border:1px solid #abefc6;
padding:7px 14px;
border-radius:999px;
font-size:12px;
font-weight:600;
">
<i class='fas fa-circle' style='font-size:8px;'></i>
Published
</span>

</div>

<?php } ?>

</div>

</div> -->




<!-- replace -->

<!-- <div class="col-md-6">

<h2 style="margin-bottom:10px;">Active Products</h2>



<select id="limit_active"
onchange="loadProducts('active')"
style="padding:8px;">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="20">20</option>
</select>

<div id="active_container"></div>


</div> -->


<!-- replace end -->








<!-- <div class="col-md-6">

<div class="stat-card"

style="
border:none;
border-radius:25px;
background:linear-gradient(135deg,#fff7f7,#ffecec);
box-shadow:0 10px 25px rgba(0,0,0,0.08);
">

<div class="card-header">

<div>

<h1
style="
font-size:40px;
font-weight:800;
color:#d93025;
margin:0;
">

<?php echo $inactive_products; ?>

</h1>

<p
style="
margin:0;
font-weight:600;
color:#555;
">

Inactive Products

</p>

</div>

<div class="card-icon orange">

<i class="fas fa-times-circle"></i>

</div>

</div>

<hr>

<?php
while($inactive = mysqli_fetch_assoc($inactive_run)){
?>

<div

style="
display:flex;
align-items:center;
justify-content:space-between;
padding:12px;
background:#fff;
border-radius:18px;
margin-bottom:15px;
box-shadow:0 4px 15px rgba(0,0,0,0.06);
">

<div
style="
display:flex;
align-items:center;
gap:15px;
">

<img
src="../images/<?php echo $inactive['image']; ?>"

style="
width:70px;
height:70px;
object-fit:cover;
border-radius:16px;
border:3px solid #ffd7d7;
">

<div>

<h5
style="
margin:0;
font-weight:700;
">

<?php echo $inactive['name']; ?>

</h5>

<p
style="
margin:0;
color:#666;
font-size:14px;
">

₹<?php echo $inactive['price']; ?>

</p>

</div>

</div>

<span
style="
display:inline-flex;
align-items:center;
gap:6px;
background:#f8f9fc;
color:#667085;
border:1px solid #d0d5dd;
padding:7px 14px;
border-radius:999px;
font-size:12px;
font-weight:600;
">
<i class='fas fa-circle' style='font-size:8px;'></i>
Draft
</span>

</div>

<?php } ?>

</div>

</div> -->



<!-- rechange -->


<!-- <div class="col-md-6">

<h2>Inactive Products</h2>


<select id="limit_inactive" onchange="loadProducts('inactive')">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="20">20</option>
</select>

<div id="inactive_container"></div>

</div>

</div>

</div> -->

<!-- rechange end -->






<?php

$product_query=mysqli_query($conn,"
SELECT *
FROM products
ORDER BY id DESC
LIMIT 10
");

?>

<div class="table-card">



<div class="table-responsive">

<table class="data-table">

<thead>

<tr>

<th>Image</th>
<th>Product</th>
<th>Price</th>
<th>Stock</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php
while($row=mysqli_fetch_assoc($product_query)){
?>

<tr>

<td>

<img src="../images/<?php echo $row['image'];?>"
width="60"
style="border-radius:10px;">

</td>

<td><?php echo $row['name']; ?></td>

<td>₹<?php echo $row['price']; ?></td>

<td><?php echo $row['stock']; ?></td>

<td>

<?php
if($row['status']==1){
?>
<span class="badge bg-success">Active</span>
<?php
}else{
?>
<span class="badge bg-danger">Inactive</span>
<?php
}
?>

</td>

<td>

<a href="admin_view_product.php?id=<?=$row['id']?>">

<i class="fas fa-eye"></i></a>

<a href="edit_product.php?id=<?=$row['id']?>">

<i class="fas fa-edit"></i>

</a>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>


<?php
/* =========================
   RECENT ORDERS (AJAX READY)
========================= */
?>

<div class="table-card">

<div class="card-title d-flex justify-content-between align-items-center">

<h3 style="font-weight:700;">
<i class="fas fa-shopping-bag"></i>
Recent Orders
</h3>

<a href="order_list.php"
style="
text-decoration:none;
padding:10px 18px;
background:#111;
color:#fff;
border-radius:12px;
font-weight:600;
">
View All
</a>

</div>

<div class="table-responsive">

<table class="data-table">

<thead>
<tr>
<th>Image</th>
<th>Customer</th>
<th>Product</th>
<th>Qty</th>
<th>Price</th>
<th>Total</th>
<th>Payment</th>
<th>Status</th>
<th>Date</th>
</tr>
</thead>

<tbody id="orders_container">
<!-- AJAX DATA WILL LOAD HERE -->
 
</tbody>

</table>

</div>

<div id="orders_pagination" style="margin-top:15px;"></div>

</div>

</div>

</div>


<script>

function loadProducts(type, page = 1){

    let limit = $("#limit_" + type).val();

    $.ajax({
        url: "product_ajax.php",
        type: "POST",
        data: {
            type: type,
            page: page,
            search: <?= json_encode($search) ?>,
            limit: limit
        },
        success: function(res){
            $("#" + type + "_container").html(res);
        },
        error: function(xhr){
            console.log("Product AJAX Error:");
            console.log(xhr.responseText);
        }
    });

}

function loadOrders(page = 1){

    $.ajax({
        url: "orders_ajax.php",
        type: "POST",
        data: {
            page: page
        },
        dataType: "json",

        success: function(res){

            $("#orders_container").html(res.data);
            $("#orders_pagination").html(res.pagination);

        },

        error: function(xhr){

            console.log("Order AJAX Error:");
            console.log(xhr.responseText);

        }
    });

}

$(document).ready(function(){



    //  Products 
    // rechange

    // loadProducts('active', 1);
    // loadProducts('inactive', 1);

    //  Orders 
    // loadOrders(1);

    // rechange

});

/* Product Pagination */
$(document).on("click", ".pg-btn", function(){

    let type = $(this).data("type");
    let page = $(this).data("page");

    loadProducts(type, page);

});

/* Order Pagination */
$(document).on("click", ".order-pg-btn", function(){

    let page = $(this).data("page");

    loadOrders(page);

});

</script>
  </body>
</html>