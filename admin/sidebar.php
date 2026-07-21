
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "includes/db_connect.php";
/* GET ADMIN EMAIL */
$email = $_SESSION['user_email'] ?? null;
$admin = null;

if($email){
    $query = mysqli_query($conn,
    "SELECT * FROM clients WHERE email='$email' LIMIT 1");

    $admin = mysqli_fetch_assoc($query);
}

/* SAFE IMAGE */
$img = (!empty($admin) && !empty($admin['image']))
    ? $admin['image']
    : 'default-user.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        <link rel="stylesheet" href="admin_panel.css">

</head>
<body>

<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar">

    <div class="logo">

        <div class="name">
            <img src="../images/<?php echo htmlspecialchars($img); ?>"
                 style="width:65%; height:20vh; border-radius:50%; object-fit:cover;  border:5px solid #2eeb86;">
        </div>

    </div>

    <div class="nav-menu">

        <div class="top">

            <div class="nav-item <?php echo ($currentPage == 'admin_panel.php') ? 'active' : ''; ?>">
                <a href="admin_panel.php" style="text-decoration:none; color:#fff;">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </div>

           <div class="nav-item <?php echo ($currentPage == 'user_list.php') ? 'active' : ''; ?>">
    <a href="user_list.php" style="text-decoration:none; color:#fff;">
        <i class="fas fa-users"></i>
        <span>Customer</span>
    </a>
</div>

            <div class="nav-item <?php echo ($currentPage == 'category_list.php') ? 'active' : ''; ?>">
    <a href="category_list.php" style="text-decoration:none; color:#fff;">
        <i class="fa-solid fa-layer-group"></i>
        <span>Category list</span>
    </a>
</div>

          <div class="nav-item <?php echo ($currentPage == 'subcategory_list.php') ? 'active' : ''; ?>">
    <a href="subcategory_list.php" style="text-decoration:none; color:#fff;">
        <i class="fas fa-boxes"></i>
        <span>Subcategory list</span>
    </a>
</div>

<div class="nav-item <?php echo ($currentPage == 'product_list.php') ? 'active' : ''; ?>">
    <a href="product_list.php" style="text-decoration:none; color:#fff;">
        <i class="fa fa-tasks"></i>
        <span>Product list</span>
    </a>
</div>

<div class="nav-item <?php echo ($currentPage == 'order_list.php') ? 'active' : ''; ?>">
    <a href="order_list.php?page=1" style="text-decoration:none; color:#fff;">
        <i class="fa fa-tasks"></i>
        <span>Order list</span>
    </a>
</div>

<div class="nav-item <?php echo ($currentPage == 'admin_payment_control.php') ? 'active' : ''; ?>">
    <a href="admin_payment_control.php?page=1" style="text-decoration:none; color:#fff;">
        <i class="fa fa-credit-card"></i>
        <span>Payment Control</span>
    </a>
</div>

<div class="nav-item <?php echo ($currentPage == 'admin_manage_bookings.php') ? 'active' : ''; ?>">
    <a href="admin_manage_bookings.php?page=1" style="text-decoration:none; color:#fff;">
        <i class="fa fa-credit-card"></i>
        <span>Bookings</span>
    </a>
</div>
          

            <div class="nav-item <?php echo ($currentPage == '../index.php') ? 'active' : ''; ?>">
                <a href="../index.php"  style="text-decoration:none; color:#fff;">
                    <i class="fa-solid fa-house"></i>
                    <span>Home Page</span>
                </a>
            </div>

        </div>

        <div class="down">
            <div class="nav-item">
                <a href="../logout.php" style="text-decoration:none; color:#fff;">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </div>
      

<!-- 
          <div class="menu-heading">Reports</div>
          <div class="nav-item">
             <a href="../logout.php" style="text-decoration:none; color:#fff;">
            <i class="fas fa-chart-line"></i>
            <span>Analytics</span>
          </div>
          <div class="nav-item">
            <i class="fas fa-coins"></i>
            <span>Sales</span>
          </div>

          <div class="menu-heading">Admin</div>
          <div class="nav-item">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
          </div>
          <div class="nav-item">
            <i class="fas fa-bell"></i>
            <span>Notifications</span>
          </div>
          <div class="nav-item">
            <i class="fas fa-shield-alt"></i>
            <span>Security</span>
          </div> -->

</div> 
        </div>
      </div>
</body>
</html>