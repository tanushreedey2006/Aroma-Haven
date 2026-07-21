<?php
include "includes/db_connect.php";

header('Content-Type: application/json');

$limit = 5;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;

/* TOTAL */
$total_q = mysqli_query($conn, "SELECT COUNT(*) as total FROM userorder");
$total = mysqli_fetch_assoc($total_q)['total'];
$total_pages = ceil($total / $limit);

/* DATA */
$query = "
SELECT *
FROM userorder
ORDER BY id DESC
LIMIT $limit OFFSET $offset
";

$result = mysqli_query($conn, $query);

$html = "";

if(mysqli_num_rows($result) > 0){

while($order = mysqli_fetch_assoc($result)){

$image = !empty($order['product_image'])
    ? "../images/".$order['product_image']
    : "placeholder.png";

$html .= "
<tr>
<td><img src='{$image}' style='width:60px;height:60px;object-fit:cover;border-radius:10px;'></td>
<td><b>{$order['customer_name']}</b><br>{$order['customer_number']}</td>
<td>{$order['product_name']}</td>
<td>{$order['quantity']}</td>
<td>₹{$order['item_price']}</td>
<td><b>₹{$order['grand_total']}</b></td>
<td>{$order['payment_method']}</td>
<td>{$order['payment_status']}</td>
<td>{$order['created_at']}</td>
</tr>
";

}

}else{

$html = "<tr><td colspan='9' style='text-align:center;'>No Orders Found</td></tr>";

}

/* PAGINATION */
$pagination = "";

for($i = 1; $i <= $total_pages; $i++){

$pagination .= "
<button class='order-pg-btn' data-page='$i'
style='margin:3px;padding:6px 12px;border:1px solid #ccc;background:#fff;cursor:pointer;'>
$i
</button>
";

}

echo json_encode([
    "data" => $html,
    "pagination" => $pagination
]);
?>