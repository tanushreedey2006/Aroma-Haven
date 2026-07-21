
<!DOCTYPE html>
<html>
<head>

<link rel="icon" type="image/png" href="weblogo.png">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

<link rel="stylesheet"
href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css"/>

<link rel="stylesheet" href="admin_panel.css">
<title>Payment Control</title>
<style>
body{
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(135deg,#eef2f7,#f8fafc);
    animation:fadeBody 0.6s ease-in;
}

/* FADE IN PAGE */
@keyframes fadeBody{
    from{opacity:0;transform:translateY(10px);}
    to{opacity:1;transform:translateY(0);}
}

/* CONTAINER */
.container{
    width:96%;
    margin:auto;
}

/* TITLE */
.title{
    font-size:28px;
    font-weight:800;
    color:#111827;
    letter-spacing:0.5px;
    animation:slideLeft 0.5s ease-in;
}

@keyframes slideLeft{
    from{opacity:0;transform:translateX(-20px);}
    to{opacity:1;transform:translateX(0);}
}

/* FILTER BUTTONS */
.filter a{
    padding:10px 18px;
    border-radius:30px;
    background:rgba(17,24,39,0.9);
    color:#fff;
    text-decoration:none;
    font-size:13px;
    margin-right:8px;
    display:inline-block;
    transition:0.3s;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.filter a:hover{
    background:#2563eb;
    transform:translateY(-3px) scale(1.05);
}

/* TABLE CARD */
.table{
    background:white;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    animation:fadeUp 0.5s ease-in;
}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(20px);}
    to{opacity:1;transform:translateY(0);}
}

/* HEADER */
thead.table-info{
    background:linear-gradient(90deg,#111827,#1f2937) !important;
    color:white;
}

/* ROW ANIMATION */
tr{
    transition:0.25s;
}

tr:hover{
    background:#f1f5f9 !important;
    transform:scale(1.01);
}

/* CELLS */
th,td{
    padding:14px !important;
    font-size:14px;
    vertical-align:middle !important;
}

/* BADGES */
.paid{
    background:#16a34a;
    color:white;
    padding:6px 12px;
    border-radius:50px;
    font-size:12px;
    font-weight:600;
    box-shadow:0 4px 10px rgba(22,163,74,0.3);
}

.pending{
    background:#f59e0b;
    color:white;
    padding:6px 12px;
    border-radius:50px;
    font-size:12px;
    font-weight:600;
}

.failed{
    background:#ef4444;
    color:white;
    padding:6px 12px;
    border-radius:50px;
    font-size:12px;
    font-weight:600;
}

/* SELECT */
select{
    padding:6px;
    border-radius:8px;
    border:1px solid #ddd;
    outline:none;
    transition:0.2s;
}

select:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,0.2);
}

/* BUTTON */
button{
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:white;
    border:none;
    padding:7px 14px;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
    font-weight:600;
}

button:hover{
    transform:scale(1.08);
    box-shadow:0 8px 20px rgba(37,99,235,0.3);
}

/* PAGINATION */
.btn{
    border-radius:8px;
    padding:6px 12px;
    margin:3px;
    transition:0.2s;
}

.btn:hover{
    transform:translateY(-2px);
}

/* IMAGE */
img{
    border-radius:10px;
}

/* GLASS EFFECT HEADER AREA (optional enhancement) */
.table-responsive{
    backdrop-filter:blur(6px);
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

/* ---------------- PAYMENT TYPE FILTER ---------------- */
$type = $_GET['type'] ?? 'all'; // all | online | cod

/* ---------------- OFFSET ---------------- */
$offset = ($page - 1) * $limit;

/* ---------------- WHERE CONDITION ---------------- */
$where = "WHERE is_deleted = 0";

/* SEARCH FILTER */
if ($search != '') {
    $where .= " AND (
        customer_name LIKE '%$search_escaped%'
        OR order_number LIKE '%$search_escaped%'
        OR product_name LIKE '%$search_escaped%'
        OR payment_status LIKE '%$search_escaped%'
        OR order_status LIKE '%$search_escaped%'
    )";
}

/* PAYMENT FILTER */
if ($type == 'online') {
    $where .= " AND payment_method != 'Cash On Delivery'";
}

if ($type == 'cod') {
    $where .= " AND payment_method = 'Cash On Delivery'";
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

/* FIX OFFSET AGAIN AFTER PAGE CHANGE */
$offset = ($page - 1) * $limit;

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


<div class="table-responsive" style="margin:3% 18%; width:80%;">

    <div class="d-flex justify-content-between align-items-center mb-3">

            <h1  class="title">💳 Admin Payment Control Panel</h1>

<div class="filter mb-3">
    <a href="?type=all">All</a>
    <a href="?type=online">Online</a>
    <a href="?type=cod">Cash On Delivery</a>
</div>


       

</div>

<table class="table table-bordered table-striped align-middle">

<thead class="table-info text-center">

<tr>
    <th>Order No</th>
    <th>Customer</th>
    <th>Method</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Action</th>
</tr>

</thead>






<?php while($row = mysqli_fetch_assoc($res)) { ?>

<tr>
    <td><?php echo $row['order_number']; ?></td>
    <td>
        <?php echo $row['customer_name']; ?><br>
        <?php echo $row['customer_number']; ?>
    </td>

    <td><?php echo $row['payment_method']; ?></td>

    <td>₹<?php echo $row['grand_total']; ?></td>

    <td>
        <span class="<?php echo strtolower($row['payment_status']); ?>">
            <?php echo $row['payment_status']; ?>
        </span>
    </td>

<td>

    
<form method="POST" action="update_payment_control.php">

    <input type="hidden" name="id" value="<?= $row['id']; ?>">

    <select name="payment_status" required>
        <option value="Pending">Pending</option>
        <option value="Paid">Paid</option>
        <option value="Failed">Failed</option>
    </select>

    <button type="submit">Update</button>

</form>

</td>
</tr>

<?php } ?>

</table>

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

</body>
</html>









