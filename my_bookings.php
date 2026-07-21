<!DOCTYPE html>
<html>
<head>

<title>My Luxury Bookings</title>


<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">


<style>


*{
margin:0;
padding:0;
box-sizing:border-box;
}


body{


font-family:'Inter',sans-serif;


min-height:100vh;


background:

radial-gradient(circle at top,
#fff1cf,
transparent 35%),


linear-gradient(
135deg,
#fffaf0,
#e8c78d
);



color:#4b2b14;


overflow-x:hidden;


}



/* background animation */


body::before{


content:"☕";


position:fixed;


font-size:250px;


opacity:.08;


right:80px;


top:80px;


animation:coffee 6s infinite alternate;


}



@keyframes coffee{


from{

transform:translateY(0);

}


to{

transform:translateY(40px);

}


}




.container{


width:90%;


max-width:1100px;


margin:40px auto;


}



.title{


text-align:center;


font-family:'Playfair Display',serif;


font-size:45px;


margin-bottom:40px;


color:#5a3418;


animation:title 1s ease;


}



@keyframes title{


from{

opacity:0;

transform:translateY(-30px);

}


to{

opacity:1;

}


}





/* BOOKING CARD */


.card{


background:

rgba(255,255,255,.65);



border-radius:35px;



padding:30px;


margin-bottom:35px;



display:grid;


grid-template-columns:250px 1fr;


gap:35px;



backdrop-filter:blur(20px);



border:

1px solid rgba(199,154,69,.4);



box-shadow:

0 30px 70px rgba(100,60,20,.2);



animation:card .8s ease;


}



@keyframes card{


from{

opacity:0;

transform:

translateY(50px)
scale(.95);

}



to{

opacity:1;

transform:none;

}


}





/* IMAGE */


.card img{


width:250px;


height:190px;


object-fit:cover;


border-radius:25px;



box-shadow:

0 20px 40px rgba(0,0,0,.15);



transition:.5s;


}



.card img:hover{


transform:scale(1.05);


}





h2{


font-family:'Playfair Display',serif;


font-size:30px;


color:#6b4020;


}



.info{


margin-top:15px;


line-height:2;


}





.status{


display:inline-block;


margin-top:10px;


padding:8px 18px;


border-radius:50px;


background:#e8f8df;


color:#27843b;


font-weight:600;


}




/* CANCEL BUTTON */


.cancel{


display:inline-block;


margin-top:20px;


padding:13px 25px;


background:#b91c1c;


color:white;


border-radius:50px;


text-decoration:none;


transition:.4s;


}



.cancel:hover{


transform:translateY(-4px);


box-shadow:0 15px 30px rgba(185,28,28,.3);


}







/* VIDEO SECTION */


.video-box{


margin-top:25px;


}



.video-box h3{


font-family:'Playfair Display',serif;


font-size:24px;


color:#7a4b20;


}



video{


width:100%;


margin-top:15px;


border-radius:25px;


box-shadow:

0 20px 50px rgba(0,0,0,.2);


}





/* MOBILE */


@media(max-width:800px){


.card{


grid-template-columns:1fr;


}



.card img{


width:100%;


}



.title{

font-size:35px;

}



}



</style>


</head>
<?php
session_start();

include "connect.php";


/* CHECK LOGIN */

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}


$user_id = $_SESSION['user_id'];



/* FETCH USER BOOKINGS */

$query = mysqli_query($conn,

"SELECT * FROM bookings

WHERE user_id='$user_id'

ORDER BY id DESC"

);



if(!$query){

    die("Query Error: ".mysqli_error($conn));

}

?>

<body>



<div class="container">



<h1 class="title">
☕ My Coffee Reservations ✨
</h1>



<?php while($row=mysqli_fetch_assoc($query)){ ?>



<div class="card">


<div>


<img src="images/<?php echo $row['event_image']; ?>">


</div>



<div class="info">



<h2>
👑 Table <?= $row['table_id']; ?>
</h2>



<p>
📅 Date :
<?= $row['booking_date']; ?>
</p>



<p>
⏰ Time :
<?= $row['booking_time']; ?>
</p>



<p>
👥 Guests :
<?= $row['people']; ?>
</p>




<p class="status">

<?= $row['status']; ?>

</p>




<?php if($row['status']!="Cancelled"){ ?>


<a class="cancel"

href="cancel_booking.php?id=<?= $row['id']; ?>"

onclick="return confirm('Cancel this booking?')">

❌ Cancel Reservation

</a>



<?php } ?>





<div class="video-box">


<h3>
☕ Your Premium Table Experience
</h3>



<video controls>


<source src="videos/table.mp4">


</video>



</div>



</div>



</div>



<?php } ?>



</div>


</body>
</html>