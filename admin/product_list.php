

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>

    <link rel="icon" type="image/png" href="weblogo.png">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
    href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css" />

    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet"
    href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="admin_panel.css">

</head>

<body>
<?php

include "includes/db_connect.php";
include "function.php";


$search = isset($_GET['search'])
    ? mysqli_real_escape_string($conn, $_GET['search'])
    : '';


// Product Query
$query = "SELECT
products.*,
categories.name AS category
FROM products
LEFT JOIN categories
ON products.category_id = categories.id";

if(!empty($search)){
    $query .= "
    WHERE
    products.name LIKE '%$search%'
    OR categories.name LIKE '%$search%'
    ";
}

$query .= " ORDER BY products.id ASC";

$res = mysqli_query($conn, $query);


?>
<div class="container" style="margin-left:-1%; min-width:102%;">

    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>

    <!-- Header -->
    <?php include "header.php"; ?>
    <div class="">

    </div>
    </div>


</div>

<div class="table-responsive" style="margin:1% 19%; width:80%;">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="title">Product Details</h1>

        <a href="add_product.php">

            <button class="btn btn-primary">

                <i class="fas fa-plus"></i>
                Add New

            </button>

        </a>

    </div>

    <table id="myTable"
    class="table table-bordered table-striped align-middle"
    style="width:100%;">

        <thead class="table-info">

            <tr>

                <th>ID</th>
                <th>Category ID</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

        <?php

        if(mysqli_num_rows($res) > 0){

            while($row = mysqli_fetch_assoc($res)){

        ?>

            <tr>

                <!-- ID -->
                <td><?php echo $row['id']; ?></td>

                <!-- Category ID -->
                <td><?php echo $row['category_id']; ?></td>

                <!-- Category -->
                <td><?php echo $row['category']; ?></td>

                <!-- Product Name -->
                <td><?php echo $row['name']; ?></td>

                <!-- Price -->
                <td>₹<?php echo $row['price']; ?></td>

                <!-- Stock -->
                <td><?php echo $row['stock']; ?></td>

                <!-- Image -->
                <td>

                    <img
                    src="<?php echo !empty($row['image']) ? '../images/' . $row['image'] : '../images/default.avif'; ?>"
                    style="height:80px;
                    width:90px;
                    object-fit:cover;
                    border-radius:10px;">

                </td>

                <!-- Status -->
                <td>

                    <?php

                    echo $row['status']
                    ? '<span class="text-success fw-bold">Active</span>'
                    : '<span class="text-danger fw-bold">Inactive</span>';

                    ?>

                </td>

                <!-- Created -->
                <td>

                    <?php

                    echo !empty($row['create_at'])
                    ? date("d M Y h:i:s A", strtotime($row['create_at']))
                    : '-';

                    ?>

                </td>

                <!-- Action -->
                <td>

                    <!-- Edit -->


                <a href="admin_view_product.php?id=<?php echo $row['id']; ?>">
                    <i class="fa-solid fa-eye text-primary"></i></a>

                    
                    <a href="edit_product.php?id=<?php echo $row['id']; ?>">

                        <i class="fa-solid fa-pen-to-square "
                        style="color:darkblue;"></i></a>

                    <a href="delete_action.php?type=products&id=<?php echo $row['id']; ?>&btn=user"

                    onclick="return confirm('Are you sure to delete this Product?')">

                        <i class="fa-solid fa-trash "
                        style="color:red;"></i>

                    </a>

                </td>

            </tr>

        <?php

            }

        }else{

        ?>

            <tr>

                <td colspan="10"
                class="text-danger text-center">

                    No Product Found.

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<!-- Bootstrap JS -->
<script src="../assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>

<!-- DataTables Bootstrap 5 JS -->
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.min.js"></script>

<script>

$(document).ready(function () {

    $('#myTable').DataTable({

        paging: true,
        searching: false,
        ordering: true,
        info: true,
        lengthChange: true,
        pageLength: 7

    });

});

</script>

</body>
</html>