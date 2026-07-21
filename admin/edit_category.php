

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Category</title>
    <link rel="icon" type="image/png" href="weblogo.png">
<?php
include "includes/db_connect.php";
global $conn;
$id=$_GET['id'];
$sql="SELECT * FROM categories WHERE id='$id' ";
$run=mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($run);
?> 

<link rel="stylesheet" href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css">

<style>
body {
    background: #f4f6f9;
}

.form-container {
    max-width: 600px;
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
    height: 300px;
    background-repeat: no-repeat;
  background-size: 100% 100%;
  background-position: center;
    /* object-fit: cover; */
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
    <h3 class="form-title">Edit Category</h3>

    <form action="editcate_action.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" class="form-control" name="slug" value="<?php echo $data['slug']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="descri"><?php echo $data['descri']; ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input class="form-control" name="price" value="<?php echo $data['price']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Image</label>
            <input type="file" class="form-control" name="image" id="imginput" accept="image/*">
        </div>

        <div class="mb-3 text-center">
            <img src="../images/<?php echo $data['image']; ?>" id="imgpreview" class="img-preview">
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="status">
                <option value="1" <?php if($data['status']==1) echo "selected"; ?>>Active</option>
                <option value="0" <?php if($data['status']==0) echo "selected"; ?>>Inactive</option>
            </select>
        </div>

        <button type="submit" name="updateBtn" class="btn btn-primary btn-custom">
            Update Category
        </button>

    </form>
</div>

<script>
document.getElementById('imginput').onchange = function(){
    document.getElementById('imgpreview').src = URL.createObjectURL(this.files[0]);
}
</script>

<script src="../assets/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>