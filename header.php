<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
<link rel="stylesheet" type="text/css" href="coffee.css">
 <link rel="icon" type="image/png" href="weblogo.png">
    <link rel="stylesheet"  type="text/css" href="../CoffeeShop2/assets/bootstrap-5.3.7-dist/css/bootstrap.min.css"  />

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
      <style>
         .logicon{
          margin-top:7px;
          margin-left:20px;
          font-size: 27px;
          color: red;
      }
      .cart{
        margin-top:7px;
        margin-left:10px;
        color:#fff;
        font-size: 27px;
      }
                 .category-section {
    padding: 40px 40px 70px;
    background: #fffaf4;
}

.category-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.category-head h1 {
    margin: 0;
    font-size: 3rem;
    font-weight: 800;
    color: #58260f;
    letter-spacing: 1px;
}

.category-products {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 26px;
    align-items: stretch;
}

.product-card {
    background: linear-gradient(180deg, #f1c98d 0%, #efc07e 100%);
    border-radius: 26px;
    overflow: hidden;
    box-shadow: 0 14px 30px rgba(88, 38, 15, 0.16);
    transition: transform 0.28s ease, box-shadow 0.28s ease;
    border: 1px solid rgba(88, 38, 15, 0.08);
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 36px rgba(88, 38, 15, 0.22);
}

.product-top {
    padding: 16px 18px 10px;
    min-height: 70px;
    display: flex;
    align-items: flex-start;
}

.product-name {
    margin: 0;
    font-size: 1.1rem;
    line-height: 1.35;
    font-weight: 800;
    color: #7a1f06;
}

.product-image-box {
    width: 100%;
    aspect-ratio: 1 / 1;
    overflow: hidden;
    background: #fff;
}

.product-image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.product-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 18px 18px;
}

.product-price {
    font-size: 1.05rem;
    font-weight: 700;
    color: #fff;
    background: rgba(88, 38, 15, 0.22);
    padding: 8px 14px;
    border-radius: 999px;
    backdrop-filter: blur(6px);
}

.product-heart {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    cursor: pointer;
    transition: 0.25s ease;
}

.product-heart:hover {
    color: #7a1f06;
    transform: scale(1.12);
}

html{
    scroll-behavior: smooth;
}

#newcollection{
    scroll-margin-top: 120px;
}

.view-btn{
    border:none;
    background:#58260f;
    color:#fff;
    padding:8px 18px;
    border-radius:30px;
    font-weight:bold;
    transition:0.3s;
}

.view-btn:hover{
    background:#7a1f06;
    transform:scale(1.05);
    color: #fff;
}

.category-products{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:30px;
}

.product-card{
    background:#fff;
    border-radius:12px;
    overflow:hidden;
    border:1px solid #e5e5e5;
    transition:0.3s;
}

.product-card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.12);
}

.product-image-box{
    position:relative;
    width:100%;
    height:320px;
    overflow:hidden;
    background:#f7f7f7;
}

.product-image-box img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* .wishlist-icon{
    position:absolute;
    top:15px;
    right:15px;
    background:#fff;
    width:40px;
    height:40px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    color:#c40000;
    cursor:pointer;
} */

.product-content{
    padding:20px;
}

.product-title{
    font-size:1.3rem;
    color:#333;
    margin-bottom:15px;
    font-weight:600;
}

.price-section{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:15px;
}

.old-price{
    color:#999;
    text-decoration:line-through;
    font-size:18px;
}

.new-price{
    color:#111;
    font-size:28px;
    font-weight:bold;
}

.size-flex{
    display:flex;
    gap:10px;
    margin-bottom:20px;
}

.size-btn{
     border:1px solid #58260f;
    background:#fff;
    color:#58260f;
    padding:6px 14px;
    border-radius:30px;
    font-size:14px;
}

.action-flex{
    display:flex;
    gap:12px;
}

/* .cart-btn{
      flex:1;
    border:none;
    background:#58260f;
    color:#fff;
    height:48px;
    border-radius:8px;
    font-weight:bold;
} */


/* 
.cart-btn:hover{
    background:#7a1f06;
} */

.cart-btn{
    flex:1;
    border:none;
    background:linear-gradient(135deg,#58260f,#7a1f06);
    color:#fff;
    height:50px;
    border-radius:12px;
    font-weight:bold;
    font-size:15px;
    transition:0.3s;
    cursor:pointer;
}

.cart-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(88,38,15,0.25);
}

.cart-icon-area{
    position:relative;
    padding-left:10px;
}

.cart-icon-box{
    position:relative;
    cursor:pointer;
    font-size:24px;
    color:#fff;
}

.cart-count{
    position:absolute;
    top:-10px;
    right:-12px;

    background:red;
    color:#fff;

    width:22px;
    height:22px;

    border-radius:50%;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:12px;
    font-weight:bold;
}

/* SIDEBAR */
/* =========================
   PREMIUM CART SIDEBAR
========================= */

.cart-sidebar{

    position:fixed;
    top:0;
    right:-450px;

    width:420px;
    height:100vh;

    background:#fffaf5;

    z-index:999999;

    box-shadow:-10px 0 40px rgba(0,0,0,0.18);

    transition:0.4s ease;

    overflow-y:auto;

    border-left:4px solid #58260f;

}

.cart-sidebar.active{
    right:0;
}

/* HEADER */

.cart-header{

    position:sticky;
    top:0;

    background:#fffaf5;

    padding:22px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    border-bottom:1px solid #ead7c5;

    z-index:99;
}

.cart-header h2{

    margin:0;

    color:#58260f;

    font-size:28px;
    font-weight:800;

}

.cart-header button{

    width:38px;
    height:38px;

    border:none;

    background:#58260f;
    color:#fff;

    border-radius:50%;

    cursor:pointer;

    font-size:16px;

    transition:0.3s;
}

.cart-header button:hover{

    background:#7a1f06;
    transform:rotate(90deg);

}

/* EMPTY CART */

.empty-cart{

    text-align:center;

    padding:90px 20px;

    color:#777;
}

.empty-cart i{

    font-size:60px;

    color:#d5b8a0;

    margin-bottom:18px;
}

/* CART ITEM */

.sidebar-item{

    display:flex;
    gap:15px;

    margin:18px;

    padding:16px;

    background:#fff;

    border-radius:20px;

    box-shadow:0 8px 20px rgba(0,0,0,0.06);

    transition:0.3s;

    border:1px solid #f0e3d7;

}

.sidebar-item:hover{

    transform:translateY(-3px);

    box-shadow:0 12px 24px rgba(0,0,0,0.1);

}

/* IMAGE */

.sidebar-item img{

    width:95px;
    height:95px;

    border-radius:18px;

    object-fit:cover;

}

/* INFO */

.sidebar-info{

    flex:1;

}

.sidebar-info h4{

    margin:0;

    color:#2b2b2b;

    font-size:18px;

    font-weight:700;
}

.sidebar-info p{

    margin:10px 0;

    color:#58260f;

    font-size:20px;

    font-weight:bold;

}

/* QUANTITY */

.qty-flex{

    display:flex;
    align-items:center;

    gap:12px;

    margin-top:8px;
}

.qty-btn{

    width:34px;
    height:34px;

    border:none;

    border-radius:50%;

    background:linear-gradient(135deg,#58260f,#7a1f06);

    color:#fff;

    font-size:18px;
    font-weight:bold;

    cursor:pointer;

    transition:0.3s;
}

.qty-btn:hover{

    transform:scale(1.1);

}

.cart-icon{

    position:relative;

    text-decoration:none;

    color:#fff;

    font-size:24px;

    margin-left:20px;
}

.cart-count{

    position:absolute;

    top:-10px;
    right:-12px;

    background:#ff355e;

    color:#fff;

    min-width:22px;
    height:22px;

    border-radius:50%;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:12px;

    font-weight:bold;

    padding:2px 6px;

    box-shadow:
    0 4px 12px rgba(255,53,94,0.4);
}

/* REMOVE BUTTON */

.remove-btn{

    margin-top:14px;

    border:none;

    background:#ffeded;

    color:#c40000;

    padding:9px 16px;

    border-radius:10px;

    font-weight:bold;

    cursor:pointer;

    transition:0.3s;
}

.remove-btn:hover{

    background:#c40000;
    color:#fff;

}

/* FOOTER */

.cart-footer{

    position:sticky;
    bottom:0;

    background:#fffaf5;

    padding:20px;

    border-top:1px solid #ead7c5;
}

/* TOTAL */

.cart-total{

    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:16px;

    font-size:22px;
    font-weight:800;

    color:#58260f;
}

/* CHECKOUT */

.checkout-btn{

    width:100%;
    height:55px;

    border:none;

    border-radius:16px;

    background:linear-gradient(135deg,#58260f,#7a1f06);

    color:#fff;

    font-size:17px;
    font-weight:bold;

    cursor:pointer;

    transition:0.3s;
}

.checkout-btn:hover{

    transform:translateY(-2px);

    box-shadow:0 10px 24px rgba(88,38,15,0.25);

}

.remove-btn{

    border:none;

    background:red;
    color:#fff;

    padding:7px 14px;

    border-radius:8px;

    cursor:pointer;
}

.toast{

    position:fixed;

    bottom:30px;
    right:30px;

    background:#1f1f1f;
    color:#fff;

    padding:14px 22px;

    border-radius:12px;

    z-index:999999;

    font-weight:bold;

    animation:fade 0.3s ease;
}



@keyframes fade{

    from{
        opacity:0;
        transform:translateY(20px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}
.view-btn{
    width:90px;
    border:1px solid #58260f;
    background:#fff;
    color:#58260f;
    border-radius:8px;
    font-weight:bold;
}


@keyframes toastFade{

    from{
        opacity:0;
        transform:translateY(20px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}

/* NAVBAR WISHLIST */

.wishlist-area{

    position:relative;
    padding-left:15px;
    cursor:pointer;
}

.wishlist-nav-icon{

    color:#fff;
    font-size:24px;
}

.wishlist-count{

    position:absolute;
    top:-10px;
    right:-12px;

    width:22px;
    height:22px;

    border-radius:50%;

    background:#ff1e56;

    color:#fff;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:11px;
    font-weight:bold;

    box-shadow:0 5px 12px rgba(255,30,86,0.4);
}



/* PRODUCT HEART */

.wishlist-icon{
    
    position:absolute;
    top:25px;
    right:15px;

    width:44px;
    height:44px;
    padding:4%;
    border-radius:50%;

    background:rgba(255,255,255,0.95);

    display:flex;
    align-items:center;
    justify-content:center;

    color:#ff2d55;

    font-size:18px;

    cursor:pointer;

    transition:0.35s ease;

    box-shadow:0 10px 20px rgba(0,0,0,0.12);
}

.wishlist-icon:hover{

    transform:scale(1.12);
}

.wishlist-active{

    background:linear-gradient(135deg,#ff2d55,#ff4f81);

    color:#fff;

    transform:scale(1.08);

    box-shadow:0 12px 22px rgba(255,45,85,0.35);
}
 </style>

<?php


include("connect.php");

$cart_count = 0;

if(isset($_SESSION['user_email'])){

    $email = $_SESSION['user_email'];

    $userQuery = mysqli_query($conn,

    "SELECT * FROM clients
    WHERE email='$email'");

    $userData = mysqli_fetch_assoc($userQuery);

    if($userData){

        $user_id = $userData['id'];

        $cartQuery = mysqli_query($conn,

        "SELECT SUM(quantity) AS total_cart

        FROM addtocart

        WHERE user_id='$user_id'
        AND status='active'");

        $cartRow = mysqli_fetch_assoc($cartQuery);

        $cart_count =
        $cartRow['total_cart'] ?? 0;

    }

}

?>
</head>
<body>
      <div class="nav d-flex justify-content-evenly fixed-top">
        <div class="head d-flex justify-content-between gap-3">
          <img src="./images/weblogo.png" class="img"  />
          <h1 class="fs-3 py-3 text-light"><i>Aroma Haven</i></h1> 
        </div>
        <div class=" d-flex Alllink fs-5">
          <a href="index.php" class="border-0 p-3" id="a">Home</a>
          <a href="about.php" class="p-3" id="a">About</a>
          <a href="catalogue.php" class="p-3" id="a">Catalogue</a>
          <a href="service.php" class="p-3" id="a">Service</a>
          <a href="gallery.php" class="p-3" id="a">Gallery</a>
         
        </div>
        <div class="maine ">
          <div class="search-bar-container active">
          <img class="  magnifier " style="width:20%; height:5vh;" style="width:20%; height:5vh;"  src="./images/magnifying1.png"></img>
          <input type="text" placeholder="Search Here" class="input  ">
          <img src="./images/micro.png"  class="mic-icon " style=" width:15%; height:4vh;">
        </div>
       </div>


<div class="p-3 button">

<?php
if (isset($_SESSION['user_email'])) {
?>

<div  style="margin-left:-15%; justify-content:space-around; display:flex; width:100%; align-items:center;">

   <select onchange="redirectPage(this)" class="user-select" style="background-color: #081aa2bd; border:none; color: #fff; width:2.5em; height:6vh; border-radius:50%; padding-top:0.2em; text-align:center;">

    <option selected hidden>

        <?php 
        echo strtoupper(substr($_SESSION['user_name'],0,1));
        ?>

    </option>

    <option value="userprofile.php" style="background-color: #fff; color: #000;">
        User Profile
    </option>

    <option value="userorder.php" style="background-color: #fff; color: #000;">
        User Order
    </option>

    <option value="userwishlist.php" style="background-color: #fff; color: #000;">
        Wishlist
    </option>
    <option value="logout.php" style="background-color: #fff; color: #000;">
        <i class="fa fa-sign-out logicon"></i> Logout

    </option>

</select>

<a href="usercart.php"
style="text-decoration:none;">

<div class="cart-icon-area">

    <div class="cart-icon-box">

        <i class="fa-solid fa-cart-shopping"></i>

        <span id="cartCount" class="cart-count">

            <?php echo $cart_count; ?>

        </span>

    </div>

</div>

</a>



<a href="userwishlist.php"
style="text-decoration:none;">

<div class="wishlist-area">

    <i class="fa-solid fa-heart wishlist-nav-icon"></i>

    <span id="wishlistCount"
    class="wishlist-count">

        <?php echo $wishlist_count ?? 0; ?>

    </span>

</div>

</a>
   
</div>

<?php
} else{
?>

<a class="buttons" href="register.php">
    <button class="btn" type="submit" id="button1">Sign In</button>
</a>

<?php } ?>

</div>
</div>

    <script src="script.js"></script>
    <script src="search.js"></script>
   
    <script src="../CoffeeShop2/assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>
<script>
    function redirectPage(select){

    let page = select.value;

    if(page != ""){

        window.location.href = page;
    }

    select.selectedIndex = 0;
  }
</script>

</body>
</html>