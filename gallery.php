<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link rel="stylesheet" type="text/css" href="coffee.css"  />
   
    <link rel="stylesheet"  type="text/css" href="../CoffeeShop2/assets/bootstrap-5.3.7-dist/css/bootstrap.min.css"  />
<link rel="icon" type="image/png" href="weblogo.png">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
        <?php
session_start();
?>
<style>
    /* .content{
    padding:25px;
}

.premium-tag{
    background:#f4d7a1;
    color:#5c2c06;
    padding:6px 14px;
    border-radius:30px;
    font-size:12px;
    font-weight:600;
    display:inline-block;
    margin-bottom:10px;
}

.product-meta{
    display:flex;
    justify-content:space-between;
    margin:15px 0;
    font-size:14px;
    color:#555;
}

.stock-status{
    margin:15px 0;
}

.instock{
    color:#28a745;
    font-weight:600;
}

.lowstock{
    color:#ff9800;
    font-weight:600;
}

.outstock{
    color:red;
    font-weight:600;
}

.feature-list{
    display:flex;
    flex-wrap:wrap;
    gap:8px;
    margin-top:15px;
}

.feature-list span{
    background:#f8f4ef;
    padding:6px 10px;
    border-radius:20px;
    font-size:12px;
}

.card-buttons{
    display:flex;
    gap:15px;
    margin-top:20px;
}

.card-buttons a{
    flex:1;
    text-align:center;
    text-decoration:none;
    background:#d8b38b;
    color:white;
    padding:10px;
    border-radius:30px;
}

.card-buttons button{
    flex:1;
    border:none;
    background:#4e2613;
    color:white;
    padding:10px;
    border-radius:30px;
    transition:.3s;
}

.card-buttons button:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(0,0,0,.2);
}

.dynamic-desc{
    font-size:14px;
    line-height:1.8;
    margin:12px 0;
    color:#f5f5f5;
    opacity:.9;
}

.premium-tag{
    display:inline-block;
    padding:6px 14px;
    border-radius:30px;
    background:linear-gradient(45deg,#e6c08b,#c68c53);
    color:#4b250f;
    font-weight:700;
    font-size:12px;
} */

.content{
    padding:22px;
}

.top-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:12px;
}

.premium-tag{
    background:linear-gradient(135deg,#f5d08a,#c78a3a);
    color:#fff;
    padding:7px 14px;
    border-radius:30px;
    font-size:11px;
    font-weight:700;
}

.rating{
    background:#fff3cd;
    color:#b8860b;
    padding:6px 12px;
    border-radius:30px;
    font-size:12px;
    font-weight:700;
}

.content h1{
    font-size:25px;
    color:#fff;
    font-weight:700;
    margin-bottom:10px;
}

.category-chip{
    display:inline-block;
    padding:7px 15px;
    border-radius:30px;
    background:rgba(255,255,255,.15);
    color:#fff;
    margin-bottom:14px;
    font-size:12px;
}

.dynamic-desc{
    color:#f5f5f5;
    line-height:1.8;
    font-size:14px;
    margin-bottom:18px;
}

.product-stats{
    display:flex;
    gap:15px;
    flex-wrap:wrap;
    margin-bottom:18px;
}

.product-stats span{
    background:rgba(255,255,255,.12);
    color:#fff;
    padding:8px 12px;
    border-radius:25px;
    font-size:12px;
}

.price-section{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.main-price{
    font-size:34px;
    font-weight:800;
    color:#ffd27d;
}

.instock{
    color:#00d26a;
    font-weight:700;
}

.lowstock{
    color:#ff9800;
    font-weight:700;
}

.outstock{
    color:#ff4d4d;
    font-weight:700;
}



.card-buttons{
    display:flex;
    gap:10px;
    margin-top:15px;
}

.view-btn{
    flex:1;
    text-align:center;
    text-decoration:none;
    padding:12px;
    border-radius:12px;
    border:none;
    /* background:rgba(255,255,255,.15); */
    backdrop-filter:blur(10px);

    color:#fff;
    font-weight:600;

    transition:.3s;
}

.order-btn{
    flex:1;
    text-align:center;
    text-decoration:none;
    padding:12px;
    border-radius:12px;

    background:linear-gradient(
        135deg,
        #d4a574,
        #f0c78c
    );

    color:#2c1a10;
    font-weight:700;

    transition:.3s;
}

.sold-btn{
    flex:1;
    border:none;
    padding:12px;
    border-radius:12px;

    background:#666;
    color:white;
}

.view-btn:hover,
.order-btn:hover{
    transform:translateY(-4px);
}

.card-buttons button{
    flex:1;
    /* padding:12px; */
    border-radius:50px;
    background:white;
    color:#4e2613;
    font-weight:700;
    transition:.3s;
}

.card-buttons button:hover{
    transform:translateY(-4px);
}

.card:hover .premium-tag{
    transform:scale(1.05);
}

.card:hover .main-price{
    letter-spacing:1px;
}


</style>
</head>
<body>
    <?php include("header.php"); ?>
   
     
<!-- Gallery start -->
<h1 style="text-align: center; color: #70533d;" class="gaery">Gallery Section</h1>

<div class="pro" id="galltext">

<?php
include("connect.php");

$query = mysqli_query($conn, "
    SELECT 
        p.*, 
        s.descri
    FROM products p
    LEFT JOIN subcategories s 
    ON p.category_id = s.id
");



while($row = mysqli_fetch_assoc($query)){
?>
    
    <div class="card" id="card" >
        <div class="circle">
            <div class="flex" >
                <img src="./images/<?php echo $row['image']; ?>" class="logo" id="logo">

                <div style="display: flex; justify-content: space-around; gap: 7em;">
                    <div>
                        <h1>Rs. <?php echo $row['price']; ?></h1>
                    </div>

                    <div style="color: gray;">
                        <i class="fa-solid fa-heart"></i>
                        <i class="fa-solid fa-comment"></i>
                    </div>
                </div>
            </div>
        </div>



      <div class="content">

    <div class="top-row">

        <span class="premium-tag">
            <?php
            if($row['price'] >= 400){
                echo "👑 Luxury";
            }
            elseif($row['price'] >= 250){
                echo "🔥 Bestseller";
            }
            else{
                echo "☕ Popular";
            }
            ?>
        </span>
            <div class="category-chip">
        <?php echo $row['category_name']; ?>
    </div>
        <span class="rating">
            ⭐ 4.9
        </span>

    </div>

    <h1><?php echo $row['name']; ?></h1>



    <p class="dynamic-desc">

        <?php
        if(!empty($row['descri'])){
            echo substr($row['descri'],0,90).'...';
        }else{
            echo "Freshly crafted with premium ingredients and exceptional flavour.";
        }
        ?>

    </p>

    <div class="product-stats">

        <span>
            <i class="fa-solid fa-cube"></i>
            <?php echo $row['stock']; ?> Stock
        </span>

        <span>
            <i class="fa-solid fa-truck-fast"></i>
            Fast Delivery
        </span>

    </div>

    <div class="price-section">

        <div class="main-price">
            ₹<?php echo number_format($row['price']); ?>
        </div>

        <div class="stock-badge">

            <?php if($row['stock'] > 20){ ?>
                <span class="instock">In Stock</span>

            <?php } elseif($row['stock'] > 0){ ?>
                <span class="lowstock">Few Left</span>

            <?php } else { ?>
                <span class="outstock">Sold Out</span>
            <?php } ?>

        </div>

    </div>

   <div class="card-buttons">

    <a href="viewproduct.php?id=<?php echo $row['id']; ?>" class="view-btn" style="text-decoration:none; border:none;">
        <i class="fa-solid fa-eye"></i>
        View
    </a>

    <?php if($row['stock'] > 0){ ?>

        <a href="checkout_add_item.php?product_id=<?php echo $row['id']; ?>" class="order-btn">
            <i class="fa-solid fa-bag-shopping"></i>
            Order
        </a>

    <?php }else{ ?>

        <button class="sold-btn" disabled>
            Sold Out
        </button>

    <?php } ?>

</div>


    

</div>

        <img src="./images/<?php echo $row['image']; ?>" class="product" id="product">
    </div>

<?php } ?>

</div>

</div>

 <?php include("footer.php"); ?>

<!-- Gallery end -->



   


  <script src="script.js"></script>
<script src="search.js"></script>
   
    <script src="../CoffeeShop2/assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>