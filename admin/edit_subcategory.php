

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Subcategory</title>
    <link rel="icon" type="image/png" href="weblogo.png">

<link rel="stylesheet" href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css">
<?php
include "includes/db_connect.php";
global $conn;

$id = $_GET['id'];

// Fetch subcategory data
$sql = "SELECT * FROM subcategories WHERE id='$id'";
$run = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($run);

// Fetch categories for dropdown
$cat_sql = "SELECT * FROM categories";
$cat_run = mysqli_query($conn, $cat_sql);
?>
<style>
body {
    background: #f4f6f9;
}

.form-container {
    max-width: 650px;
    margin: 50px auto;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.form-title {
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
}

.img-preview {
    width: 100%;
    height: 280px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #ddd;
}

.btn-custom {
    width: 100%;
    padding: 10px;
    font-weight: 500;
    border-radius: 8px;
}
</style>

</head>

<body>

<div class="form-container">
    <h3 class="form-title">Edit Subcategory</h3>

    <form action="edisubcate_action.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <!-- Category Dropdown -->
        <div class="mb-3">
            <label class="form-label">Select Category</label>
           <select class="form-select" name="category_id" required>

                <option value="">-- Select Category --</option>

                <?php while($cat = mysqli_fetch_assoc($cat_run)) { ?>

                    <option value="<?php echo $cat['id']; ?>"

                        <?php
                        if($data['category_id'] == $cat['id']){
                            echo "selected";
                        }
                        ?>>

                        <?php echo $cat['name']; ?>

                    </option>

                <?php } ?>

            </select>
        </div>

        <!-- Subcategory Name -->
        <div class="mb-3">
            <label class="form-label">Subcategory Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="descri"><?php echo $data['descri']; ?></textarea>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" class="form-control" name="price" value="<?php echo $data['price']; ?>" required>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label class="form-label">Upload Image</label>
            <input type="file" class="form-control" name="image" id="imginput" accept="image/*">
        </div>

        <!-- Preview -->
        <div class="mb-3 text-center">
            <img src="../images/<?php echo $data['image']; ?>" id="imgpreview" class="img-preview">
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="status">
                <option value="1" <?php if($data['status']==1) echo "selected"; ?>>Active</option>
                <option value="0" <?php if($data['status']==0) echo "selected"; ?>>Inactive</option>
            </select>
        </div>

        <button type="submit" name="updateBtn" class="btn btn-primary btn-custom">
            Update Subcategory
        </button>

    </form>
</div>

<script>
document.getElementById('imginput').onchange = function(){
    document.getElementById('imgpreview').src = URL.createObjectURL(this.files[0]);
}
</script>

</body>
</html>