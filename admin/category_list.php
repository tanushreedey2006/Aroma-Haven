
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet"  type="text/css" href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css"  />
     <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet"
    href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.min.css">

     <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="admin_panel.css">
        <link rel="icon" type="image/png" href="weblogo.png">

</head>
<body>
<?php
include("includes/db_connect.php");
include_once("function.php");

$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

$offset = ($page - 1) * $limit;

$search = isset($_GET['search'])
    ? mysqli_real_escape_string($conn,$_GET['search'])
    : '';

/* TOTAL RECORDS */
$total_sql = "
SELECT COUNT(*) as total
FROM categories c
LEFT JOIN categories p
ON p.id = c.parent_id
WHERE 1
";

if($search != ''){
    $total_sql .= "
    AND (
        c.name LIKE '%$search%'
        OR c.slug LIKE '%$search%'
        OR c.descri LIKE '%$search%'
        OR p.name LIKE '%$search%'
    )
    ";
}

$total_query = mysqli_query($conn,$total_sql);
$total_row = mysqli_fetch_assoc($total_query);

$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

if($total_pages < 1){
    $total_pages = 1;
}

/* MAIN QUERY */
$sql = "
SELECT c.*,
       IFNULL(p.name,'Main Category') AS parent_name
FROM categories c
LEFT JOIN categories p
ON p.id = c.parent_id
WHERE 1
";

if($search != ''){
    $sql .= "
    AND (
        c.name LIKE '%$search%'
        OR c.slug LIKE '%$search%'
        OR c.descri LIKE '%$search%'
        OR p.name LIKE '%$search%'
    )
    ";
}

$sql .= "
ORDER BY c.id ASC
LIMIT $offset,$limit
";

$res = mysqli_query($conn,$sql);

if(!$res){
    die(mysqli_error($conn));
}
?>
    <div class="container" style="margin-left:-1%; min-width:102%; ">



      <!-- sidebar -->
      <?php
        include "sidebar.php";

        ?>
     
        <!-- header -->
      <?php
        include "header.php";
        ?>
         <div >

        </div>


      </div>
</div>



    <div class="table-responsive" style="margin:3% 19%; width:80%;">
      <div class="d-flex justify-content-between" >
          <h1 class="title" >Category Details</h1>
          <a href="add_category.php"><button class="btn btn-primary">
              <i class="fas fa-plus"></i>
              Add New
            </button></a>
      </div> 
        <table class="table table-bordered">
            <thead>
                <tr class="table-info text-white"  >
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Parent Category</th>
                    <th>Action</th>
                </tr>
            </thead>
     <tbody>

     <!-- &#8377; rupee symbol -->
                <?php
               if(mysqli_num_rows($res) > 0){
                    // foreach ($data as $key => $row) {
                        while($row = mysqli_fetch_assoc($res)){
                ?>
                        <tr>
                            <!-- <td><?php echo ($key + 1); ?></td> -->
                             <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['slug'] ; ?></td>
                            <td><?php echo $row['descri']; ?></td>
                            <td>₹<?php echo $row['price']; ?> </td>
                            <td><img src="<?php echo !empty($row['image']) ? '../images/' . $row['image'] : '../images/default.avif'; ?>" style="height: 100px ; width:100%;" /></td>
                            <td>
                                <?php echo $row['status'] ? '<span style="color:green;">Active</span>' : '<span style="color:red;">Inactive</span>' ?>
                            </td>
                             <!-- <td><?php echo date("d M Y h:i:s A", strtotime($row['create_at'])) ?></td> -->
                              <td>
                            <?php 
                            echo !empty($row['create_at']) 
                                ? date("d M Y h:i:s A", strtotime($row['create_at'])) 
                                : '-';
                            ?>
                            </td>

                             <td>

                            <?php 
                            // echo ($row['parent_id'] == 0) 
                            //     ? 'Main Category' 
                            //     : $row['parent_name']; 
                             echo $row['parent_name'];
                            ?>
                            </td>

                            <td>
                                <a href="edit_category.php?id=<?php echo $row['id']; ?>"  ><i class="fa-solid fa-pen-to-square"  style="color:darkblue;"></i></a>
                                <a href="delete_action.php?type=categories&id=<?php echo $row['id']; ?>  & btn=user"  onclick="return confirm('Are you sure to delete this Category?')"><i class="fa-solid fa-trash" style="color:red;"></i></a>

                            </td>
                        </tr>
                    <?php
                    }
               } else {
                    ?>
                    <tr>
                        <td colspan="4" class="text-danger text-center">No record Found.</td>
                    </tr>
                <?php  } ?>

            </tbody>
</table>



<div class="text-center mt-4">

<?php if($page > 1){ ?>
    <a class="btn btn-primary"
       href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>">
        ← Previous
    </a>
<?php } ?>

<?php for($p=1; $p<=$total_pages; $p++){ ?>
    <a class="btn <?php echo ($p==$page)?'btn-dark':'btn-outline-primary'; ?>"
       href="?page=<?php echo $p; ?>&search=<?php echo urlencode($search); ?>">
       <?php echo $p; ?>
    </a>
<?php } ?>

<?php if($page < $total_pages){ ?>
    <a class="btn btn-primary"
       href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>">
        Next →
    </a>
<?php } ?>

</div>



    <script type="text/javascript" src="../assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>












