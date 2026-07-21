<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

    <link rel="icon" type="image/png" href="weblogo.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css"/>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.min.css">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="admin_panel.css">

</head>

<body>

<?php
include("includes/db_connect.php");
include("function.php");

$search = isset($_GET['search'])
    ? mysqli_real_escape_string($conn,$_GET['search'])
    : '';

$sql = "
    SELECT * FROM clients
    WHERE role='user'
";

if($search != ''){
    $sql .= "
        AND (
            name LIKE '%$search%'
            OR email LIKE '%$search%'
            OR mobile LIKE '%$search%'
            OR membership LIKE '%$search%'
        )
    ";
}

$sql .= " ORDER BY id ASC";

$res = mysqli_query($conn,$sql);
?>

<div class="container" style="margin-left:-1%; min-width:102%;">

    <?php include "sidebar.php"; ?>
    <?php include "header.php"; ?>
<div class="">

    </div>
    </div>
</div>

<!-- ================= USER TABLE ================= -->
<div class="table-responsive" style="margin:2% 19%; width:80%;">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="title">Customer Details</h1>
    </div>

    <table id="myTable" class="table table-bordered table-striped">

        <thead class="table-info text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Image</th>
                <th>Joined</th>
                <th>Membership</th>
            </tr>
        </thead>

        <tbody>

        <?php if(mysqli_num_rows($res) > 0){ ?>

            <?php while($row = mysqli_fetch_assoc($res)){ ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email'] ?? 'NA'; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['address']; ?></td>

                <td>
                    <img src="<?php echo !empty($row['image']) ? '../images/'.$row['image'] : '../images/default.avif'; ?>"
                         style="height:70px;width:70px;object-fit:cover;border-radius:10px;">
                </td>

                <td>
                    <?php
                    echo !empty($row['addwithus'])
                        ? date("d M Y", strtotime($row['addwithus']))
                        : '-';
                    ?>
                </td>

                <td><?php echo $row['membership']; ?></td>
            </tr>

            <?php } ?>

        <?php } else { ?>

            <tr>
                <td colspan="8" class="text-center text-danger">
                    No Users Found
                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>
</div>

<!-- ================= JS ================= -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#myTable').DataTable({
        paging: true,
       searching: false,
        ordering: true,
        info: true,
        lengthChange: true,
        pageLength: 5
    });
});
</script>

</body>
</html>