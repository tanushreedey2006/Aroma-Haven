
<?php

include "includes/db_connect.php";
$sql="select count(*) as total_user from clients;";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="icon" type="image/png" href="weblogo.png">

    <link rel="stylesheet" href="admin_panel.css">

    
</head>


<?php


$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";
?>
<body>
      <div class="header" style="width:85%; height:9vh;">
<form class="search-bar"
      method="GET"
      action="<?php echo basename($_SERVER['PHP_SELF']); ?>"
      style="display:flex;align-items:center;gap:8px;position:relative; ">

    <i class="fas fa-search"></i>
  <?php

$current_page = basename($_SERVER['PHP_SELF']);

$placeholder = "Search...";

if($current_page == "user_list.php"){
    $placeholder = "Search Users...";
}
elseif($current_page == "category_list.php"){
    $placeholder = "Search Categories...";
}
elseif($current_page == "subcategory_list.php"){
    $placeholder = "Search Subcategories...";
}
elseif($current_page == "product_list.php"){
    $placeholder = "Search Products...";
}
elseif($current_page == "order_list.php"){
    $placeholder = "Search Orders...";
}

?>
    <input
    type="text"
    id="searchInput"
    name="search"
    placeholder="<?php echo $placeholder; ?>"
    value="<?php echo $search; ?>"
    style="padding-right:35px;"
>

    <?php if(!empty($_GET['search'])){ ?>
        <span
            id="clearSearch"
            style="
                position:absolute;
                right:10px;
                top:50%;
                transform:translateY(-50%);
                cursor:pointer;
                font-size:18px;
                color:#777;
                z-index:999;
            ">
            &times;
        </span>
    <?php } ?>

</form>

        <div class="header-actions">
          <div class="notification">
            <i class="fas fa-bell"></i>
            <div class="badge">0</div>
          </div>
          <div class="notification">
            <i class="fas fa-envelope"></i>
            <div class="badge">0</div>
          </div>

          <div class="user-profile">
            
            <div class="user-info">
                <a href="admin_profile.php"  style="text-decoration:none;">
              <div class="user-name">Admin</div>
             <div class="user-role">
                <?php echo $_SESSION['user_name'] ?? 'Guest'; ?>
                </div>
            </div></a>
          </div>


          
<script>
document.querySelector('.search-bar input').addEventListener('keyup', function(e){
    if(e.key === 'Enter'){
        this.form.submit();
    }
});

document.addEventListener("DOMContentLoaded", function(){

    let clearBtn = document.getElementById("clearSearch");

    if(clearBtn){

        clearBtn.addEventListener("click", function(){

            window.location.href = window.location.pathname;

        });

    }

});
</script>
</body>
</html>


