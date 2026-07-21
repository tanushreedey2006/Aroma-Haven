<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

<link rel="stylesheet"
href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css"/>

<link rel="stylesheet" href="admin_panel.css">

<link rel="stylesheet"

href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
        <?php

include "includes/db_connect.php";
include "function.php";

?>

<?php
session_start();

include("includes/db_connect.php");


/* STATUS UPDATE */

if(isset($_GET['action']) && isset($_GET['id'])){

    $id = (int)$_GET['id'];

    $status = $_GET['action'];


    mysqli_query($conn,
    "UPDATE bookings 
     SET status='$status'
     WHERE id='$id'");


    header("Location: admin_manage_bookings.php");
    exit();

}


/* SEARCH */

$search = $_GET['search'] ?? '';



$sql = "

SELECT * FROM bookings

WHERE 

customer_name LIKE '%$search%'

OR customer_phone LIKE '%$search%'

OR table_id LIKE '%$search%'


ORDER BY id DESC

";


$result=mysqli_query($conn,$sql);



?>

    <!-- <div class="container" style="margin-left:-1%; min-width:102%;"> -->

    <?php include "sidebar.php"; ?>

    <?php include "header.php"; ?>
    <div class="">
        <div class="table-responsive" style="margin:3% 2%;">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="header">
            ☕ Booking Management
        </h1>

    </div>








<div class="booking-grid">



<?php while($row=mysqli_fetch_assoc($result)){ ?>



<div class="card">



<div class="top">


<img src="../images/<?= $row['event_image'] ?>">



<div>


<h2>

<?= $row['customer_name'] ?>

</h2>


<span class="badge <?= $row['status'] ?>">

<?= $row['status'] ?>

</span>


</div>


</div>






<div class="info">


<p>
📞 
<?= $row['customer_phone'] ?>
</p>


<p>
☕ Table :
<b>
<?= $row['table_id'] ?>
</b>
</p>



<p>
📅 
<?= $row['booking_date'] ?>
</p>


<p>
⏰
<?= $row['booking_time'] ?>
</p>



<p>
👥 Guests :
<?= $row['people'] ?>
</p>



<p>
🎉 Event :
<?= $row['special_event'] ?>
</p>



<p>
💬
<?= $row['message'] ?>
</p>



</div>







<div class="buttons">


<?php if($row['status']!="Confirmed"){ ?>


<a class="btn confirm"

href="?action=Confirmed&id=<?= $row['id'] ?>">

✔ Confirm

</a>


<?php } ?>




<?php if($row['status']!="Cancelled"){ ?>


<a class="btn cancel"

href="?action=Cancelled&id=<?= $row['id'] ?>"
onclick="return confirm('Cancel booking?')">

✖ Cancel

</a>


<?php } ?>


</div>






</div>


</div>



<?php } ?>





</div>
</div>

    </div>
    </div>












</div>
</body>
</html>