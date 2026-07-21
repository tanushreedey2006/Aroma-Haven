<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subcategory List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="weblogo.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css"/>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="admin_panel.css">
</head>

<body>
<?php
include "includes/db_connect.php";
include "function.php";

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
FROM subcategories s
JOIN categories c
ON s.category_id = c.id
WHERE 1
";

if($search != ''){
    $total_sql .= "
    AND (
        s.name LIKE '%$search%'
        OR s.descri LIKE '%$search%'
        OR c.name LIKE '%$search%'
        OR s.price LIKE '%$search%'
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
SELECT
    s.id,
    s.category_id,
    c.name AS category_name,
    s.name,
    s.descri,
    s.image,
    s.price,
    s.status,
    s.create_at
FROM subcategories s
JOIN categories c
ON s.category_id = c.id
WHERE 1
";

if($search != ''){
    $sql .= "
    AND (
        s.name LIKE '%$search%'
        OR s.descri LIKE '%$search%'
        OR c.name LIKE '%$search%'
        OR s.price LIKE '%$search%'
    )
    ";
}

$sql .= "
ORDER BY s.id ASC
LIMIT $offset,$limit
";

$res = mysqli_query($conn,$sql);

if(!$res){
    die(mysqli_error($conn));
}
?>


<div class="container" style="margin-left:-1%; min-width:102%;">

    <!-- Sidebar + Header -->
    <?php include "sidebar.php"; ?>
    <?php include "header.php"; ?>
    <div class="">

    </div>
    </div>

</div>

<!-- ================= TABLE ================= -->
<div class="table-responsive" style="margin:2% 19%; width:80%;">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="title">Subcategory Details</h1>

        <a href="add_subcategory.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-info text-center">
            <tr>
                <th>ID</th>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php if(mysqli_num_rows($res) > 0){ ?>

            <?php while($row = mysqli_fetch_assoc($res)){ ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['category_id']; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['descri']; ?></td>

                <td>
                    <img src="<?php echo !empty($row['image']) ? '../images/'.$row['image'] : '../images/default.avif'; ?>"
                         style="height:80px;width:80px;object-fit:cover;border-radius:10px;">
                </td>

                <td><?php echo $row['price']; ?></td>

                <td>
                    <?php echo $row['status']
                        ? '<span style="color:green;">Active</span>'
                        : '<span style="color:red;">Inactive</span>'; ?>
                </td>

                <td>
                    <?php
                    echo !empty($row['create_at'])
                        ? date("d M Y h:i A", strtotime($row['create_at']))
                        : '-';
                    ?>
                </td>

                <td>
                    <a href="edit_subcategory.php?id=<?php echo $row['id']; ?>">
                        <i class="fa-solid fa-pen-to-square" style="color:darkblue;"></i>
                    </a>

                    <a href="delete_action.php?type=subcategories&id=<?php echo $row['id']; ?>"
                       onclick="return confirm('Delete this Subcategory?')">
                        <i class="fa-solid fa-trash" style="color:red;"></i>
                    </a>
                </td>
            </tr>

            <?php } ?>

        <?php } else { ?>

            <tr>
                <td colspan="10" class="text-center text-danger">
                    No Subcategories Found
                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>


    <div class="text-center mt-4 mb-4">

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


</div>

<script src="../assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>