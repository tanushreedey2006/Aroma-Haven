
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="coffee.css"  />
   
    <link rel="stylesheet"  href="../CoffeeShop2/assets/bootstrap-5.3.7-dist/css/bootstrap.min.css"  />
    <link rel="icon" type="image/png" href="weblogo.png">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

<style>
  .seat-title{
    text-align:center;
    padding:60px 0 30px;
    font-size:40px;
    font-weight:700;
    color:#6f4325;
    letter-spacing:1px;
}

.seat-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:25px;
    padding:20px 8%;
}

/* CARD */
.seat-card{
    background:rgba(255,255,255,0.65);
    backdrop-filter:blur(18px);
    border-radius:28px;
    overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,0.12);
    transition:0.5s;
    position:relative;
}

.seat-card:hover{
    transform:translateY(-12px) scale(1.02);
    box-shadow:0 30px 80px rgba(0,0,0,0.18);
}

/* IMAGE */
.img-box{
    position:relative;
    height:230px;
    overflow:hidden;
}

.img-box img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.6s;
}


.seat-card:hover img{
    transform:scale(1.12);
}

/* BADGE */
.badge{
    position:absolute;
    top:15px;
    left:15px;
    padding:6px 14px;
    border-radius:30px;
    font-size:12px;
    font-weight:700;
    background:#fff;
    color:#6f4325;
    letter-spacing:1px;
}


.overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(
        to top,
        rgba(0,0,0,0.5),
        transparent
    );
}

/* PRICE TAG */
.price-tag{
    position:absolute;
    bottom:15px;
    right:15px;
    background:rgba(255,255,255,0.9);
    padding:6px 14px;
    border-radius:20px;
    font-weight:700;
    color:#6f4325;
    font-size:14px;
    box-shadow:0 10px 20px rgba(0,0,0,0.15);
}

.vip-badge{
    background:linear-gradient(135deg,#ffd700,#ffb300);
    color:#000;
    box-shadow:0 0 20px rgba(255,215,0,0.5);
}

/* INFO */
.seat-info{
    padding:22px;
}

.seat-info h3{
    font-size:20px;
    margin-bottom:8px;
    color:#3b2415;
}

.price{
    display:inline-block;
    background:#fff3e0;
    padding:5px 12px;
    border-radius:20px;
    font-weight:bold;
    color:#8a5b18;
    margin-bottom:15px;
}

/* BUTTON */
.book-btn{
    width:100%;
    padding:13px;
    border:none;
    border-radius:40px;
    background:linear-gradient(135deg,#6f4325,#c79a45);
    color:white;
    font-weight:700;
    cursor:pointer;
    transition:0.4s;
    letter-spacing:0.5px;
}

.book-btn:hover{
    transform:scale(1.05);
    box-shadow:0 15px 30px rgba(199,154,69,0.4);
}

.vip-price{
    background:linear-gradient(135deg,#ffd700,#ffb300);
    color:#000;
}

.vip-btn{
    background:linear-gradient(135deg,#ffd700,#ffb300);
    color:#000;
}

.vip-overlay{
    background:linear-gradient(
        to top,
        rgba(255,215,0,0.25),
        transparent
    );
}

/* VIP STYLE */
.vip{
    border:2px solid gold;
    box-shadow:0 0 25px rgba(255,215,0,0.3);
}

.seat-info p{
    font-size:13px;
    color:#7a5a3a;
    margin-bottom:15px;
}

.vip-btn{
    background:linear-gradient(135deg,gold,#ffb300);
    color:#000;
}
</style>
     
        <?php
include('connect.php');
session_start();

?>


  </head>
  <body >
      <!-- <div class="AddToCartFunDiv">
    <div class="reapon_right_Div">
      <h3>Menu</h3>
      <label id="close"><i class="fa-solid fa-xmark" onclick="AddToCartFunDivclose()"
          style="cursor: pointer;"></i></label>
    </div>
    <a href="#home" >Home</a>
          <a href="#about">About</a>
          <a href="#menu" >Catalogue</a>
          <a href="#review">Service</a>
          <a href="#gallery">Gallery</a>
          <a href="#Testimonial">Testimonial</a>
          <a href="#contact">Contact</a>
  </div> -->
<div class="main ">
    <?php include("header.php"); ?>
      


      <div class="position-relative d-flex">
      <div class="about d-flex justify-center  gap-5"  id="home">
        <div class="left ">
          <div class="d-flex flex-column ">
          <h1 class="text "><i> Best Coffee</i></h1>
          <h5 class="fs-2 pt-3 p-0 m-0">Make your day great with our</h5>
          <h5 class="fs-2 p-0 m-0" >special coffee!</h5>
          <p style="font-size: 22px;" class="pt-2 p-0 m-0">Welcome to our Coffee paradise, where every bean tells</p>
          <p style="font-size: 22px;" class="p-0 m-0">a story and every cup sparkes joy</p></div>
          <div class="d-flex gap-4 pt-4">
          <button class="btn" type="submit" id="button">Order Now</button>
          <button class="btn text-dark " type="submit" id="button1">Contact Us</button></div>
        </div>
        <div class="Slider-Right gap-4">
          <div class="Slider-Right-inner">
            <img src="./images/cup1.png" />
            <img src="./images/cup2.png" />
            <img src="./images/cup3.png" />
          </div>
      </div>
      </div>
      <!-- <h1>Special Features :</h1> -->
      <div class="position-absolute special d-flex gap-5 justify-content-center " style="width: 100%;">
          <div class="bg-light rounded-3 border " style="width: 100%; height: 30vh;">
            <div class="d-flex justify-content-between p-2">
            <h3 class="paragraph">Our Catering</h3>
          <img src="./Png/plate-removebg-preview.png"  style="width: 15%; height: 9vh;" /></div>
          <p class="px-3 " style="width: 90%; font-size: 17px;">Catering involves preparing and serving food , handling everything from menu planning and cooking to service , allowing hosts to focus on guests.</p>
          </div>
          <div class="bg-light rounded-3  border" style="width: 100%; height: 30vh;">
            <div class="d-flex justify-content-between p-2">
            <h3 class="paragraph">The food</h3>
          <img src="./images/burger.change.jpg" style="width: 15%; height: 9vh;" /></div>
          <p class="px-3 " style="width: 90%; font-size: 17px;">Coffee snacks range from sweet treats like donuts, croissants, and chocolate to savory options such as bacon, grilled cheese, and hard cheeses. </p>
          </div>
          <div class="bg-light rounded-3  border" style="width: 100%; height: 30vh;">
            <div class="d-flex justify-content-between p-2">
            <h3 class="paragraph">The Gelato</h3>
          <img src="./Png/gelato-removebg-preview.png" style="width: 15%; height: 9vh;" /></div>
          <p class="px-3 " style="width: 90%; font-size: 17px;">Gelato is a traditional  a dense, creamy , achieved by using more milk than cream, less air, and a slower churning process than traditional ice cream. </p>
          </div>
        </div>
        </div>

        <!-- <div class="footer1">
          <img src="./images/firstfooter.jpg" style=" background-repeat: no-repeat; background-size: 100% 100%; margin: 2% 5%; width: 90%; height: 40vh;">
        </div> -->

        <div class="" style="width:99%; display:flex; justify-content:center; gap:10px; padding: 200px  50px; ">

          
              <video   autoplay muted loop  style="border-radius: 10px; width:70%;   height:40vh; object-fit:cover; filter:brightness(100%) contrast(110%);">
                <source src="./images/coffeemaking.mp4" type="video/mp4" >
              </video>
         
              <video   autoplay muted loop  style="border-radius: 10px;  width:70%;   height:40vh; object-fit:cover; filter:brightness(100%) contrast(110%);">
                <source src="./images/snacks.mp4" type="video/mp4" >
              </video>
        

          
              <video   autoplay muted loop  style="border-radius: 10px;  width:70%;   height:40vh; object-fit:cover; filter:brightness(100%) contrast(110%);">
                <source src="./images/coldbeverage.mp4" type="video/mp4" >
              </video>
          
            
         
              <video   autoplay muted loop  style="border-radius: 10px;  width:70%;   height:40vh; object-fit:cover; filter:brightness(100%) contrast(110%);">
                <source src="./images/dessert.mp4" type="video/mp4" >
              </video>
          
              <video   autoplay muted loop  style="border-radius: 10px;  width:70%;   height:40vh; object-fit:cover; filter:brightness(100%) contrast(110%);">
                <source src="./images/pastry.mp4" type="video/mp4" >
              </video>

              <video  autoplay muted loop  style="border-radius: 10px;  width:70%;   height:40vh; object-fit:cover; filter:brightness(100%) contrast(110%);">
                <source src="./images/icecream.mp4" type="video/mp4" >
              </video>
          



          </div>

       
        
          <div class="details d-flex flex-column text-center " style="margin-top:-10%;">
            <h1 class="text offer pt-5">OUR DELICIOUR OFFER</h1>
            <h5 class="pt-2 dark">I am hoping to see you at the Savor Seattle show ! If you want to</h5>
            <h5 class="dark">visit my booth, please here for the address</h5>
            <div class="d-flex justify-content-evenly pt-5">
              <div class="">
                <img src="./Png/cup.png" class="logo" />
                <h4 class="pt-2">TYPE OF COFFEE</h4>
                <p class="dark pt-2 p-0 m-0">This is the standard in coffee. It is the </p>
                <p class="dark p-0 m-0">most common and most popular</p>
                <p class="dark p-0 m-0">style.</p>
              </div>
              <div class="">
                <img src="./Png/bean.png" class="logo" />
                <h4 class="pt-3">BEAN VARIETIES</h4>
                <p class="dark pt-2 p-0 m-0">The experimental design included a</p>
                <p class="dark p-0 m-0">randomized complete block.</p>
              </div>
              <div class="">
                <img src="./Png/base.png"  class="logo" />
                <h4 class="pt-2">COFFEE & PASTRY</h4>
                <p class="dark pt-2 p-0 m-0">This is standard in coffee & pastry. It</p>
                <p class="dark p-0 m-0">is the most common and most</p>
                <p class="dark p-0 m-0">popular style.</p>
              </div>
              <div class="">
                <img src="./Png/glass.png"  class="logo" style="width: 18%;" />
                <h4 class="pt-2">COFFEE TO GO</h4>
                <p class="dark pt-2 p-0 m-0">Experimental design included a</p>
                <p class="dark p-0 m-0">randomized complete block design</p>
                <p class="dark p-0 m-0">with there</p>
              </div>
            </div>
          </div>


         <div class="about_details" style="margin-top:2%;">
              <div class="d-flex pt-5  featur" >
                <div class=" picture d-flex flex-column  ms-5 gap-2" >
                  <img src="./images/IMG-20250823-WA0053.jpg"  class="border rounded-circle  abimg" />
                  <img src="./images/IMG-20250823-WA0052.jpg"  class="border rounded-circle  abimg1" />
                </div>
                <div class="explain p-5" >
                  <h1 class="d-flex justify-content-center">ABOUT US</h1>
                  <div class="bg-warning  line" style="width: 6%; height: 4px;" ></div>
                  <p class="d-flex justify-content-center pt-5 fs-4 p-0 m-0">We at <span class="text-warning">&ensp;CoffeeShop </span>, located in West Bengal, India , are one of the favorite hangouts</p>
                  <p class="d-flex justify-content-center fs-4 p-0 m-0">for coffee and conversations. our goal is to offer the best experience to our guests,</p>
                  <p class="d-flex justify-content-center fs-4  p-0 m-0">ensuring on authentic coffee drinking experience in a sence of relaxation to the city</p>
                  <p class="d-flex justify-content-center fs-4 p-0 m-0">with our cazy space, complete with comfortable couches to lounge in while you   </p>
                  <p class="d-flex justify-content-center fs-4 p-0 m-0">enjoy your  coffee. Now, we're thrilled to share our authentic, ready-to-eat </p>
                  <p class="d-flex justify-content-center fs-4 p-0 m-0">Indian delights with our domestic market, bringing the same love and </p>
                  <p class="d-flex justify-content-center fs-4 p-0 m-0">care to our customers in India.</p>
                <a href="about.php"><button  class="btn" type="submit" id="button3" style="width:15%;  margin:5% 43%;">Explore more</button></a>

                </div>
              </div>
            </div>



        <div class="new d-flex ">
      <div class="" style="width: 50%;">
        <img src="./images/realman.jpg" style="width: 80%; height: 60vh;"/>
      </div>
      <div class="pt-5" style="width: 60%;">
        <h1>Indian New Excusive Coffee</h1>
        <p class="dark pt-5 p-0 m-0 fs-5">Our <span class="text-warning">CoffeeShop </span>uses all type of coffee. All commercially Produced coffee originates</p> 
         <p class="dark  p-0 m-0 fs-5"> from India. The coffee is balanced by its sweet honey notes, creating soft, light</p>
         <p class="dark p-0 m-0 fs-5"> notes with a light character. There are people who can't start their day without</p>
         <p class="dark p-0 m-0 fs-5"> having a freshly brewed cup of coffe and we understand them.</p>
          <div class="pt-4 ">
      <a href="service.php"><button class="btn btn-dark" type="submit">READ MORE</button></a>
      <button class="btn btn-dark" type="submit">SHOP NOW</button>
            </div>         
      </div>
      </div>
      <div class="footer2">

       </div>


            <div class="popular p-5 ">
              <h1 class="d-flex justify-content-center pt-5">POPULAR CATEGORIES</h1>
              <div class="d-flex justify-content-around ">
              <div class="d-flex gap-5 pt-3 flex-wrap">
                <div class="d-flex justify-content-center align-items-center gap-5" style="width: 100%;">
                <img src="./images/IMG-20250823-WA0054.jpg" style="width: 30%; height: 50vh;" class="rounded-3 scrol wow animate__animated animate__zoomIn" data-wow-delay="0.1s">
                <img src="./images/IMG-20250823-WA0027.jpg" style="width: 20%; height: 35vh;" class="rounded-3 scroll wow animate__animated animate__zoomIn" data-wow-delay="0.1s"></div>
               <div class="d-flex justify-content-center align-items-center gap-5" style="width: 100%;">
                <img src="./images/IMG-20250823-WA0026.jpg" style="width: 20%; height: 35vh;" class="rounded-3 scroll wow animate__animated animate__zoomIn" data-wow-delay="0.1s">
                <img src="./images/IMG-20250823-WA0055.jpg" style="width: 30%; height: 50vh;" class="rounded-3 scrol wow animate__animated animate__zoomIn" data-wow-delay="0.1s"></div>
              </div>
            </div></div>   
   
      <div class="SHOP">
        <div class="test d-flex  justify-content-center align-items-center flex-wrap " style="width: 100%; height: 100vh;  ">
          <div class="d-flex  p-2" style="width: 100%;">
            <div class="d-flex align-items-center justify-center img1" style="width: 37%;">
                <img src="./images/IMG-20250823-WA0031.jpg" style="width: 90%; height: 45vh;">
            </div>
            <div class="d-flex flex-column align-items-center justify-center p-3" style="width: 33%;">
                <h1 class="p-0 m-0">Change To</h1>
                <h1 class="p-0 m-0">Have An</h1>
                <h1 class="p-0 m-0">Amazing</h1>
                <h1 >Morning</h1>
               <button class="btn" type="submit" id="button3">Order Now</button>
            </div>
            <div class="d-flex align-items-center justify-center flex-column img2" style="width: 50%;">
                <img src="./images/IMG-20250823-WA0030-removebg-preview.png " style="width: 80%; height: 35vh;">
                <p class="p-0 m-0 fs-5">Lorem ipsum dolor sit amet consectetur </p>
                <p class="p-0 m-0 fs-5">adipisicing elit. Veritatis eum hujiu vits</p>
                <p class="p-0 m-0  fs-5">voluptatibus corporis vitae repellat ghy</p>
                <p class="p-0 m-0 fs-5" >saepe gsoluta a maiores eaque ghgryy</p>
            </div></div> 


           <div class="d-flex gap-5" style="width: 100%;">
            <div class=" img1" style="width: 40%;">
                <h1 class="p-0 m-0">Choose Your</h1>
                <h1 class="p-0 m-0">Favorite</h1>
                <h1 class="p-0 m-0">Test</h1>
                <p class="p-0 m-0 fs-5">Lorem ipsum dolor sit amet consectetur </p>
                <p class="p-0 m-0 fs-5">adipisicing elit. Veritatis eum hujiu vits</p>
                <p class="p-0 m-0 fs-5">voluptatibus corporis vitae repellat ghy</p>
                <button class="btn" type="submit" id="button3">Order Now</button>
            </div>
            <div class="d-flex flex-column align-items-center justify-center">
              <img src="./images/IMG-20250823-WA0025.jpg" style="width: 100%; height: 42vh;">
            </div>
            <div class="d-flex align-items-center justify-center flex-column img2">
              <img src="./images/IMG-20250823-WA0034.jpg" style="width: 100%; height: 42vh;">
            </div></div>
      </div>






<!-- timing -->
 <div style="padding-top: 7%;">
<div class="">
    <h1 class="fw-bold  text-center text-warning-emphasis " style="text-decoration: underline;">OPENING</h1>
    <div class="hr">
   <p class="text-warning fs-2" style="padding-top: 8px;">...Opening hours...</p>
   </div>
    <div class="" style="width: 100%; height: 60vh;">
      <img src="./images/time.png" style="width: 35%; height: 60vh; margin-left: 33%;">
    </div>
</div>
</div>
<!-- timing end -->


 <!-- seating arrangement -->


 <h1 class="seat-title">☕ Seating Arrangement</h1>

<div class="seat-grid">

    <!-- CARD -->
   <div class="seat-card">

    <div class="img-box">
        <img src="./images/seat1.jpeg">

        <div class="overlay"></div>

        <span class="badge" style="color: #e47908;">Standard</span>

        <div class="price-tag">₹500</div>
    </div>

    <div class="seat-info">

        <h3>Cozy Corner Table</h3>

        <p>Private warm seating with café view ambience</p>

        <a href="book.php?img=seat1.jpeg&price=500&table=1">
            <button class="book-btn">Reserve Experience</button>
        </a>

    </div>
</div>

    <!-- VIP CARD -->
   <div class="seat-card vip">

    <div class="img-box">
        <img src="./images/seat2.jpeg">

        <div class="overlay vip-overlay"></div>

        <span class="badge vip-badge">VIP LOUNGE</span>

        <div class="price-tag vip-price">₹2500</div>
    </div>

    <div class="seat-info">

        <h3>Royal Lounge Table</h3>

        <p>Exclusive private seating with premium service & priority care</p>

        <a href="book.php?img=seat2.jpeg&price=2500&special=1&table=2">
            <button class="book-btn vip-btn">Unlock Luxury Table</button>
        </a>

    </div>

</div>





    <!-- CARD -->
   <div class="seat-card">

    <div class="img-box">
        <img src="./images/seat3.jpeg">

        <div class="overlay"></div>

        <span class="badge" style="color: #e47908;">Standard</span>

        <div class="price-tag">₹1000</div>
    </div>

    <div class="seat-info">

        <h3>Cozy Corner Table</h3>

        <p>Private warm seating with café view ambience</p>

        <a href="book.php?img=seat3.jpeg&price=1000&table=3">
            <button class="book-btn">Reserve Experience</button>
        </a>

    </div>
</div>





    <!-- CARD -->
   <div class="seat-card">

    <div class="img-box">
        <img src="./images/seat4.jpeg">

        <div class="overlay"></div>

        <span class="badge" style="color: #e47908;">Standard</span>

        <div class="price-tag">₹500</div>
    </div>

    <div class="seat-info">

        <h3>Cozy Corner Table</h3>

        <p>Private warm seating with café view ambience</p>

        <a href="book.php?img=seat4.jpeg&price=500&table=4">
            <button class="book-btn">Reserve Experience</button>
        </a>

    </div>
</div>







    <!-- CARD -->
   <div class="seat-card">

    <div class="img-box">
        <img src="./images/seat5.jpeg">

        <div class="overlay"></div>

        <span class="badge" style="color: #e47908;">Standard</span>

        <div class="price-tag">₹900</div>
    </div>

    <div class="seat-info">

        <h3>Cozy Corner Table</h3>

        <p>Private warm seating with café view ambience</p>

        <a href="book.php?img=seat5.jpeg&price=900&table=5">
            <button class="book-btn">Reserve Experience</button>
        </a>

    </div>
</div>



    <!-- CARD -->
   <div class="seat-card">

    <div class="img-box">
        <img src="./images/seat6.jpeg">

        <div class="overlay"></div>

        <span class="badge" style="color: #e47908;">Standard</span>

        <div class="price-tag">₹1000</div>
    </div>

    <div class="seat-info">

        <h3>Cozy Corner Table</h3>

        <p>Private warm seating with café view ambience</p>

        <a href="book.php?img=seat6.jpeg&price=1000&table=6">
            <button class="book-btn">Reserve Experience</button>
        </a>

    </div>
</div>



   <div class="seat-card vip">

    <div class="img-box">
        <img src="./images/seat7.jpeg">

        <div class="overlay vip-overlay"></div>

        <span class="badge vip-badge">VIP LOUNGE</span>

        <div class="price-tag vip-price">₹2500</div>
    </div>

    <div class="seat-info">

        <h3>Royal Lounge Table</h3>

        <p>Exclusive private seating with premium service & priority care</p>

        <a href="book.php?img=seat7.jpeg&price=2500&special=2&table=7">
            <button class="book-btn vip-btn">Unlock Luxury Table</button>
        </a>

    </div>

</div>




    <!-- CARD -->
   <div class="seat-card">

    <div class="img-box">
        <img src="./images/seat8.jpeg">

        <div class="overlay"></div>

        <span class="badge" style="color: #e47908;">Standard</span>

        <div class="price-tag">₹1000</div>
    </div>

    <div class="seat-info">

        <h3>Cozy Corner Table</h3>

        <p>Private warm seating with café view ambience</p>

        <a href="book.php?img=seat8.jpeg&price=1000&table=8">
            <button class="book-btn">Reserve Experience</button>
        </a>

    </div>
</div>



       <div class="seat-card vip">

    <div class="img-box">
        <img src="./images/seat9.jpeg">

        <div class="overlay vip-overlay"></div>

        <span class="badge vip-badge">VIP LOUNGE</span>

        <div class="price-tag vip-price">₹3500</div>
    </div>

    <div class="seat-info">

        <h3>Royal Lounge Table</h3>

        <p>Exclusive private seating with premium service & priority care</p>

        <a href="book.php?img=seat9.jpeg&price=3500&special=3&table=9">
            <button class="book-btn vip-btn">Unlock Luxury Table</button>
        </a>

    </div>

</div>


</div>





 <!-- seating arrangement -->

 <!-- why Choose -->
  <div style="margin-top: 3%; background-color: #f4e3e6; ">
  <div class="p-5"><h1 class="d-flex justify-content-center   fw-bold fs-1" style="color: #be9058;">Why Choose Us</h1></div>
  <div class="d-flex justify-content-center " style="width:100%;">
    <div class="p-2" style="width: 33%;">
      <img src="./images/IMG-20250823-WA0029.jpg" style="width: 85%; height: 55vh;">
    </div>
    <div class="">
      <h2 class="fw-bold m-0 p-0">Unleash The Flavor Of Perfect Coffee</h2>
      <p class="m-0 p-0 fs-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque quas  praesent.</p>
      <p class="m-0 p-0 fs-5">omnis ab molestiae optio iure! Enim provident, itaque consequuntur mollitia</p>

      <div class="m-0 p-0">
        <img src=>
        <h2 class="fw-bold m-0 p-0">50+ Kinds of Coffee Beans</h2>
      </div>
      <p class="m-0 p-0 fs-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
      <p class="m-0 p-0 fs-5">Praesentium suscipit officia recusandae assumenda </p>

       <div class="">
        <img src=>
        <h2 class="fw-bold m-0 p-0">100% IOS Certification</h2>
      </div>

      <p class="m-0 p-0 fs-5">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
      <p class="m-0 p-0 fs-5">Praesentium suscipit officia recusandae assumenda </p>
      <div class="pt-2">
      <a href="about.php"><button class="btn " type="submit" id="button3" style="width: 22%; height: 6vh;">Explore more</button></a></div>

    </div>
  </div>
  </div>
   <!-- why Choose end -->



   <!-- testimonial -->
<div class="contact1 "  id="Testimonial">
  <div class="container-fluid ">     
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item  active ">
      <div class="tesi1 ">
        <h1 class="d-flex justify-content-center pt-3 ">Testimonial</h1>
        <div class="">
          <div class="d-flex justify-content-around  pt-2 ">
            <div class="" style="margin-left: -5%;">
             <img src="./images/tes1.jpg" class="rounded-bottom-5 rounded-end-0    d-flex" style="width: 80%;  height: 23vh;">
            
             </div>
              <div class="bg5  position-absolute rounded-3" style="width: 21%; height: 42vh; margin-left: -17%; margin-top: 4%;">
                
            <p class="pt-3 text-center fs-5 m-0 p-2"><i class="fa-solid fa-quote-left text-warning "></i>   It's a great experience to be  part of Tanushree's this <span class="text-warning">"Aroma Haven"</span>. 
              She is a amazing person and powerful source of support. It's her supportive throughtout the journey. <i class="fa-solid fa-quote-right text-warning"></i>
              <div class="m-0 p-0 text-warning text-center"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star text-light"></i></div>
              </p>
            <p class=" m-0 p-0 fs-4 text-center text-warning-emphasis fw-bold">- Olivia Wilson</p>
          </div>

          <div class="">
             <img src="./images/tes2.jpg" class="rounded-top-5 rounded-end-0 d-flex" style="width: 80%; height: 23vh; margin-left: -26%;">
             </div>
              <div class="bg5 position-absolute rounded-3" style="width: 21%; height: 42vh; margin-left: 47%; margin-top: 4%;">
           <p class="pt-3 text-center fs-5 m-0 p-2"><i class="fa-solid fa-quote-left text-warning "></i>  It's a great experience to be  part of Tanushree's this <span class="text-warning">"Aroma Haven"</span>. 
              She is a amazing person and powerful source of support. It's her supportive throughtout the journey.  <i class="fa-solid fa-quote-right text-warning"></i>
              <div class="m-0 p-0 text-warning text-center"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star text-light"></i></div></p>
              <p class=" m-0 p-0 fs-4 text-center text-warning-emphasis fw-bold">- Anil Sharma</p>
        </div>
          </div>
        </div>
      </div>
    </div>

    
      

    <div class="carousel-item">
      <div class="tesi2">
        <h1 class="d-flex justify-content-center pt-3">Testimonial</h1>
        <div class="">
        <div class="d-flex justify-content-around ">
          <div class="">
            <div class=" position-relative z-3 pt-4">             
        <img src="./images/tes3.jpg" class="rounded-circle d-flex bg4"  style="width: 90%; height: 16vh; margin-left: 9%;">
        </div>
        <div class="bg3 opacity-75 position-absolute rounded-3" style="width: 28%; height: 40vh; margin-left: -9%; margin-top: -5%;">
          <div class="m-0 p-0 text-warning text-center  star"><i class="fa-solid fa-star "></i><i class="fa-solid fa-star "></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star text-success-emphasis"></i></div>
            <p class="text-success-emphasis fs-5 p-2 m-0"><i class="fa-solid fa-quote-left text-light "></i>   I really like their service, the seller's response is fast, and the delivery of the goods 
              are fast and better quality of the product is really good.  <i class="fa-solid fa-quote-right text-light"></i></p>
               <p class="m-0 p-0 fs-4 text-center text-light fw-bold">- Jenna Williams</p>
        </div>
        </div>
        <div class="">
        <div class="position-relative z-3 pt-3">
         <img src="./images/tes4.jpeg " class="rounded-circle d-flex bg4 " style="width: 100%; height: 17vh; margin-left: -14%;">
         </div>
         <div class="bg3 opacity-75 position-absolute rounded-3" style="width:   28%; height: 40vh;  margin-left: -11%; margin-top: -5%; ">
          <div class="m-0 p-0 text-warning text-center  star"><i class="fa-solid fa-star "></i><i class="fa-solid fa-star "></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star text-success-emphasis"></i></div>
            <p class="text-success-emphasis fs-5 p-2 m-0"><i class="fa-solid fa-quote-left text-light "></i>   I really like their service, the seller's response is fast, and the delivery of the goods 
              are fast and better quality of the product is really good.  <i class="fa-solid fa-quote-right text-light"></i></p>
            <p class="m-0 p-0 text-center fs-4 text-light fw-bold">- Jacob Green</p>
        </div></div>
         
      </div>
      </div>
      </div>
    </div>
    
    <div class="carousel-item">
      <div class="">
        <div class="tesi3">
          <h1 class="d-flex justify-content-center  pt-3">Testimonial</h1>
          <div class="">
          <div class="d-flex justify-content-around gap-5 pt-3">
            <div class="bg-light opacity-75 position-absolute rounded-4" style="width: 26%; height: 45vh; margin-left: -30%;">
              <div class="text-center p-2 ">
                <i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i> </div>
                <p class="fs-4 text-center m-0 p-0">- Juliyana Silva</p>           
              
            </div>
            
            <div class="bg position-relative  rounded-3 " style=" margin-top: 8%; width: 32%; height: 30vh; ">
             <p class="m-0 p-2 fs-5 "> <i class="fa-solid fa-quote-left text-warning"></i>  It's a great experience to be  part of Tanushree's this <span class="text-warning">"Aroma Haven"</span>. 
              She is a amazing person and powerful source of support. It's her supportive throughtout the journey.  <i class="fa-solid fa-quote-right text-warning"></i></p>
           <div class="" style="padding-left: 29%;">
          <img src="./images/tes5.jpg" class="rounded-circle d-flex border border-5 border-white " style="width: 50%; height: 17vh; "></div>
          
          </div>
          <div class="bg-light opacity-75 position-absolute rounded-4" style="width: 26%; height: 45vh; margin-left: 30%;">
            <div class="text-center p-2 ">
                <i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i> </div>
                <p class="fs-4 text-center m-0 p-0">- Anna Jacob</p> 
          </div>
          <div class="bg1 position-relative  rounded-3 " style=" margin-top: 7.5%; width: 32%; height: 30vh;   margin-left: -19%; ">
            <p class="m-0 p-2 fs-5 " > <i class="fa-solid fa-quote-left text-warning "></i>  It's a great experience to be  part of Tanushree's this <span class="text-warning">"Aroma Haven"</span>. 
              She is a amazing person and powerful source of support. It's her supportive throughtout the journey.  <i class="fa-solid fa-quote-right text-warning"></i></p>
           <div class="" style="padding-left: 29%;">
          <img src="./images/tes6.jpg" class="rounded-circle d-flex border border-5 border-white" style="width: 52%; height: 17vh;"> </div>
        </div> </div></div>
    </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

  </div>
</div>
<!-- testimonial  end-->

<!-- contact -->
     <div class="neww" id="contact">
    
      <div class="">
          <div class="footer4" ></div>
            <h1 class="text-center text-light p-5 fw-bold "  >Get in touch</h1>
          
          
          <div class="d-flex gap-5 p-5">
            <div class="map ">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29660.96048245819!2d87.56314247175585!3d21.67863239395886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a032d15a99538cf%3A0x2cbfb146e598b778!2sRamnagar%20I%2C%20West%20Bengal%20721441!5e0!3m2!1sen!2sin!4v1761633902809!5m2!1sen!2sin" width="470" height="270" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

          <div class="meet ">
              <h1 class="fw-bold py-4">Meet Us</h1>
              <div class="d-flex gap-2 ">
                <i class="fa-solid fa-phone p-1"></i> 
                <p>+9645746985</p>
              </div>
              <div class="d-flex gap-2">
                <i class="fa-brands fa-instagram p-1"></i> 
                <p>contact@admin.com</p>
              </div>
              <div class="d-flex gap-2">
                <i class="fa-solid fa-location-dot p-1"></i> 
                <p>1784 Ramnagar Road</p>
              </div>
          </div>
          <div class="cont ">
            <h2 class="p-3 fw-bold">Contact Us</h2>
              <input type="text" placeholder="  Name" >
              <textarea name="" placeholder="  Message" ></textarea>              
              <button class="btn  rounded-4 text-light" type="submit" >Send</button>
          </div>
          </div>
      </div>           
        </div>       
</div>

 

    <?php include("footer.php"); ?>



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


function toggleCart(id,name,image,price){

    let btn = document.getElementById("cartBtn"+id);

    let action =
    btn.innerText.includes("Add")
    ? "add"
    : "remove";

    fetch("cart_action.php",{

        method:"POST",

        headers:{
            "Content-Type":
            "application/x-www-form-urlencoded"
        },

        body:

        `product_id=${id}
        &name=${encodeURIComponent(name)}
        &image=${encodeURIComponent(image)}
        &price=${price}
        &action=${action}`

    })

    .then(res => res.json())

    .then(data => {

        document.getElementById("cartCount")
        .innerText = data.cart_count;

        document.getElementById("cartItems")
        .innerHTML = data.cart_html;





        if(action == "add"){

            btn.innerHTML =
            `<i class="fa-solid fa-trash"></i>
            Remove`;

            btn.style.background =
            "linear-gradient(135deg,#c40000,#ff2020)";

            showToast("🛒 Added To Cart");

        }

        else{

            btn.innerHTML =
            `<i class="fa-solid fa-cart-shopping"></i>
            Add To Cart`;

            btn.style.background =
            "linear-gradient(135deg,#58260f,#7a1f06)";

            showToast("❌ Removed From Cart");

        }

    });

}

function toggleWishlist(id,name,image,price){

let icon = event.target;

let action = icon.classList.contains("active")
? "remove"
: "add";

fetch("wishlist_action.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:

`product_id=${id}
&product_name=${encodeURIComponent(name)}
&product_image=${encodeURIComponent(image)}
&price=${price}
&action=${action}`

})

.then(res => res.json())

.then(data => {

if(action == "add"){

icon.classList.remove("fa-regular");
icon.classList.add("fa-solid");
icon.classList.add("active");

showToast("❤️ Added To Wishlist");

}else{

icon.classList.remove("fa-solid");
icon.classList.remove("active");
icon.classList.add("fa-regular");

showToast("💔 Removed From Wishlist");

}

document.getElementById("wishlistCount")
.innerText = data.wishlist_count;

});

}



function loadWishlist(){

    fetch("wishlist_action.php",{

        method:"POST",

        headers:{
            "Content-Type":
            "application/x-www-form-urlencoded"
        },

        body:"action=load"

    })

    .then(res => res.json())

    .then(data => {

        document.getElementById("wishlistCount")
        .innerText =
        data.wishlist_count;

    });

}




function removeCart(product_id){

    fetch("cart_action.php",{

        method:"POST",

        headers:{
            "Content-Type":
            "application/x-www-form-urlencoded"
        },

        body:
        `product_id=${product_id}
        &action=remove`

    })

    .then(res => res.json())

    .then(data => {

        document.getElementById("cartItems")
        .innerHTML = data.cart_html;

        document.getElementById("cartCount")
        .innerText = data.cart_count;

        showToast("❌ Removed");

    });

}

window.onload = function(){

    loadCart();

    loadWishlist();

}

window.addEventListener("load", () => {

    loadCart();

});

</script>
  </body>
</html>


