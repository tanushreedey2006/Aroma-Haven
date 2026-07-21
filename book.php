<?php 
$img = $_GET['img'] ?? '';
$price = $_GET['price'] ?? 0;
$special = $_GET['special'] ?? 0;
$table = $_GET['table'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Elite Table Booking</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@500;700&display=swap" rel="stylesheet">

<style>

:root{
    --coffee:#6f4325;
    --gold:#c79a45;
    --cream:#fff7e8;
    --brown:#3b2415;
}


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}


body{

    font-family:'Inter',sans-serif;

    min-height:100vh;

    display:flex;
    align-items:center;
    justify-content:center;


    background:

    radial-gradient(circle at top left,
    #fff0cf,
    transparent 35%),

    radial-gradient(circle at bottom right,
    #f0c98b,
    transparent 40%),


    linear-gradient(
    135deg,
    #fffaf0,
    #f7e4c2
    );


    color:#3b2415;


    overflow-y:auto;
    overflow-x:hidden;


    padding:20px 0;


    animation:bgMove 8s infinite alternate;

}


@keyframes bgMove{

from{
background-position:left;
}

to{
background-position:right;
}

}



/* floating glow */


body::before{

content:"";

position:fixed;

width:450px;

height:550px;


background:#d6a85d;

opacity:.15;

border-radius:50%;

filter:blur(120px);

animation:float 6s infinite alternate;

pointer-events:none;

}


@keyframes float{

from{
transform:translate(-50px,-30px);
}

to{
transform:translate(50px,40px);
}

}



/* CARD */
.card{

    width:1000px;

    max-width:95%;

    display:grid;


grid-template-columns:55% 45%;


    background:rgba(255,255,255,.65);

    border-radius:35px;

    border:1px solid rgba(199,154,69,.4);

    backdrop-filter:blur(20px);

    box-shadow:0 40px 90px rgba(120,75,30,.25);

    overflow:hidden;

    animation:cardShow 1s ease;

    max-height:90vh;

}


@keyframes cardShow{


from{

opacity:0;

transform:

translateY(60px)
scale(.95);

}



to{

opacity:1;

transform:

translateY(0)
scale(1);

}


}



/* IMAGE */


.image{


position:relative;


overflow:hidden;


}


.image img{


width:100%;


height:100%;


object-fit:cover;



animation:

imageZoom 10s infinite alternate;


}



@keyframes imageZoom{


from{

transform:scale(1);

}


to{

transform:scale(1.12);

}


}




.image::after{


content:"";

position:absolute;


inset:0;



background:

linear-gradient(

to top,

rgba(0,0,0,.35),

transparent

);



}



.content::-webkit-scrollbar{

    width:6px;

}


.content::-webkit-scrollbar-thumb{

    background:#c79a45;

    border-radius:20px;

}

/* CONTENT */


.content{

    padding:55px;

    overflow-y:auto;

    max-height:90vh;

    animation:slideRight 1s ease;

}



@keyframes slideRight{


from{

opacity:0;

transform:translateX(40px);


}


to{

opacity:1;

transform:translateX(0);


}


}





h1{


font-family:'Playfair Display',serif;


font-size:38px;


color:#4a2b15;


letter-spacing:1px;


}



h1::after{


content:" ☕";

color:#c79a45;


}




.price{


margin-top:18px;


display:inline-block;


padding:10px 22px;


border-radius:40px;



background:#fff;


border:1px solid #d5ae66;


color:#9b6b22;


font-weight:600;


box-shadow:

0 10px 25px rgba(0,0,0,.08);



}




/* VIP */


.special{


margin-top:20px;


padding:15px;


border-radius:18px;



background:

linear-gradient(

135deg,

#fff1c7,

#ffe4a0

);



border-left:

5px solid #c79a45;



color:#704512;



animation:

pulse 2s infinite;



}


@keyframes pulse{


50%{

box-shadow:

0 0 25px rgba(199,154,69,.4);

}


}




/* INPUT */


input,
select,
textarea{


width:100%;


margin:10px 0;


padding:15px 18px;



background:

rgba(255,255,255,.8);



border:

1px solid #e3c58c;



border-radius:15px;



color:#4a2b15;


outline:none;



transition:.3s;


}



input:focus,
select:focus,
textarea:focus{


border-color:#c79a45;


transform:translateY(-3px);



box-shadow:

0 10px 25px rgba(199,154,69,.25);


}





select option{

background:white;

}





/* BUTTON */


button{


width:100%;


margin-top:18px;


padding:17px;


border:none;



border-radius:50px;



background:

linear-gradient(

135deg,

#d9ad59,

#b47b24

);



color:white;


font-size:16px;


font-weight:700;



cursor:pointer;



transition:.4s;



box-shadow:

0 15px 30px rgba(180,123,36,.3);



}



button:hover{


transform:

translateY(-5px)
scale(1.03);



box-shadow:

0 25px 50px rgba(180,123,36,.45);


}



/* MOBILE */


@media(max-width:900px){


.card{


grid-template-columns:1fr;

width:95%;


}


.image{

height:300px;

}


.content{

padding:30px;

}



}


.payment-box{
margin-top:25px;
padding:20px;
background:#fffaf2;
border-radius:20px;
border:1px solid #ecd8ae;
}

.payment-box h3{
margin-bottom:15px;
font-size:18px;
color:#6f4325;
}

.payment-grid{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:15px;
}

.pay-card{
position:relative;
cursor:pointer;
background:white;
border:2px solid #eee;
border-radius:18px;
padding:18px;
text-align:center;
transition:.3s;
}

.pay-card img{
width:50px;
height:50px;
object-fit:contain;
margin-bottom:10px;
}

.pay-card i{
font-size:40px;
color:#c79a45;
margin-bottom:10px;
}

.pay-card input{
display:none;
}

.pay-card:hover{
transform:translateY(-5px);
box-shadow:0 15px 35px rgba(0,0,0,.08);
}

.pay-card input:checked + img{
transform:scale(1.08);
}

.pay-card:has(input:checked){
border-color:#c79a45;
box-shadow:0 0 25px rgba(199,154,69,.35);
background:#fff8e8;
}

.booking-summary{
margin-top:20px;
margin-bottom:20px;
padding:20px;
background:linear-gradient(
135deg,
#fff7e5,
#fff1cc
);
border-radius:20px;
border:1px solid #e8cf95;
}

.summary-row{
display:flex;
justify-content:space-between;
padding:10px 0;
border-bottom:1px dashed #d8c08a;
}

.summary-row:last-child{
border:none;
}

.luxury-badge{
display:inline-block;
margin-top:10px;
padding:8px 18px;
border-radius:30px;
background:#fff1c7;
color:#8a5b18;
font-weight:700;
}

.pay-logo{
height:60px;
display:flex;
align-items:center;
justify-content:center;
border-radius:15px;
font-size:22px;
font-weight:700;
margin-bottom:10px;
color:white;
}

.phonepe{
background:linear-gradient(
135deg,
#5f259f,
#7d3cff
);
}

.gpay{
background:linear-gradient(
135deg,
#4285F4,
#34A853
);
}

.paytm{
background:linear-gradient(
135deg,
#00BAF2,
#002970
);
}

.logo-img{
width:90px;
height:50px;
object-fit:contain;
margin-bottom:10px;
}
</style>
</head>

<body>

<div class="card">

    <div class="image">
        <?php if($img){ ?>
            <img src="./images/<?php echo $img; ?>">
        <?php }  ?>
            
    </div>

    <div class="content">

        <h1>
☕ Elite Coffee Lounge
</h1>

<div class="luxury-badge">
★★★★★ Luxury Reservation
</div>
            <p style="margin-top:12px;color:#9b6b22">
            Reserve your private table for a premium coffee experience
            </p>

        <?php if($price > 0){ ?>
            <div class="price">☕ ₹ <?= $price ?> | Premium Experience ✨</div>         
        <?php } ?>

        <?php if($special == 1){ ?>
            <div class="special">
                👑 VIP Experience Activated — Premium Service Included ✨
            </div>
        <?php } ?>


        <div class="booking-summary">

<h3>Reservation Summary</h3>

<div class="summary-row">
<span>Table</span>
<b><?= $table ?></b>
</div>

<div class="summary-row">
<span>Package</span>
<b>Premium Reservation</b>
</div>

<div class="summary-row">
<span>Amount</span>
<b>₹ <?= $price ?></b>
</div>

</div>

        <form action="booking_payment_redirect.php" method="POST">
            <input type="hidden" name="table_id" value="<?= $table ?>">

            <input type="hidden" name="booking_table" value="<?= $img ?>">
            <input type="hidden" name="event_image" value="<?= $img ?>">

            <input type="hidden"  name="amount"  value="<?= $price ?>">

            <input type="text" name="customer_name" placeholder="Full Name" required>

            <input type="text" name="customer_phone" placeholder="Phone Number" required>

            <input type="date" name="booking_date" required>

            <input type="time" name="booking_time" required>

            <input type="number" name="people" placeholder="Guests">

            <select name="special_event">

                <option>☕ Regular Coffee Visit</option>

                <option>🎂 Birthday Celebration</option>

                <option>🥂 Party Celebration</option>

                <option>💼 Business Meeting</option>

                <option>💖🌹 Anniversary</option>

                <option>👑 VIP Private Experience</option>

                </select>

            <textarea name="message" placeholder="Special requests..."></textarea>

<!-- PAYMENT SECTION -->

<div class="payment-box">

<h3>
<i class="fas fa-credit-card"></i>
Choose Payment Method
</h3>

<div class="payment-grid">

<label class="pay-card">
<input type="radio"
name="payment_method"
value="PhonePe"
required>


<img src="./images/phonepe-logo.png" class="logo-img">
<span>PhonePe</span>


</label>

<label class="pay-card">
<input type="radio"
name="payment_method"
value="Google Pay">

<img src="./images/gpay-logo.png" class="logo-img">

<span>Google Pay</span>


</label>

<label class="pay-card">
<input type="radio"
name="payment_method"
value="Paytm">


<img src="./images/paytm-logo.png" class="logo-img">
<span>Paytm</span>


</label>

<label class="pay-card">
<input type="radio"
name="payment_method"
value="Cash On Arrival">

<i class="fas fa-money-bill-wave"></i>

<span>Pay At Cafe</span>
</label>

</div>

</div>

<input type="hidden"
name="payment_status"
value="Pending">

            <button type="submit">
            👑 Reserve My Luxury Table ☕
            </button>

        </form>

    </div>

</div>

</body>
</html>