<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Product</title>

<link rel="icon" type="image/png" href="weblogo.png">
<link rel="stylesheet" href="../assets/bootstrap-5.3.7-dist/css/bootstrap.min.css">

<?php
include "includes/db_connect.php";

$id = $_GET['id'];

$product = mysqli_query($conn,"
SELECT *
FROM products
WHERE id='$id'
");

$data = mysqli_fetch_assoc($product);

$cat = mysqli_query($conn,"
SELECT *
FROM categories
ORDER BY name ASC
");
?>

<style>

body{
    background:#f4f6f9;
}

.form-container{
    max-width:700px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
}

.form-title{
    text-align:center;
    margin-bottom:25px;
    font-weight:700;
}

.img-preview{
    width:100%;
    height:300px;
    object-fit:cover;
    border-radius:10px;
    border:1px solid #ddd;
}

.btn-custom{
    width:100%;
    padding:12px;
    border-radius:8px;
    font-weight:600;
}

</style>

</head>
<body>

<div class="form-container">

    <h3 class="form-title">
        Edit Product
    </h3>

    <form
    action="editpro_action.php"
    method="POST"
    enctype="multipart/form-data">

        <input
        type="hidden"
        name="id"
        value="<?php echo $data['id']; ?>">

        <!-- Category -->

        <div class="mb-3">

            <label class="form-label">
                Category
            </label>

            <select
            class="form-select"
            name="category_id"
            required>

                <?php
                while($row = mysqli_fetch_assoc($cat)){
                ?>

                <option
                value="<?php echo $row['id']; ?>"

                <?php
                if($data['category_id']==$row['id']){
                    echo "selected";
                }
                ?>>

                    <?php echo $row['name']; ?>

                </option>

                <?php } ?>

            </select>

        </div>

        <!-- Product Name -->

        <div class="mb-3">

            <label class="form-label">
                Product Name
            </label>

            <input
            type="text"
            class="form-control"
            name="name"
            value="<?php echo $data['name']; ?>"
            required>

        </div>

        <!-- Price -->

        <div class="mb-3">

            <label class="form-label">
                Price
            </label>

            <input
            type="number"
            class="form-control"
            name="price"
            value="<?php echo $data['price']; ?>"
            required>

        </div>

        <!-- Stock -->

        <div class="mb-3">

            <label class="form-label">
                Stock
            </label>

            <input
            type="number"
            class="form-control"
            name="stock"
            value="<?php echo $data['stock']; ?>"
            required>

        </div>

        <!-- Image -->

        <div class="mb-3">

            <label class="form-label">
                Upload New Image
            </label>

            <input
            type="file"
            class="form-control"
            name="image"
            id="imginput"
            accept="image/*">

        </div>

        <!-- Preview -->

        <div class="mb-3 text-center">

            <img
            src="../images/<?php echo $data['image']; ?>"
            id="imgpreview"
            class="img-preview">

        </div>

        <!-- Status -->

        <div class="mb-3">

            <label class="form-label">
                Status
            </label>

            <select
            class="form-select"
            name="status">

                <option
                value="1"
                <?php if($data['status']==1) echo "selected"; ?>>
                    Active
                </option>

                <option
                value="0"
                <?php if($data['status']==0) echo "selected"; ?>>
                    Inactive
                </option>

            </select>

        </div>

        <button
        type="submit"
        name="updateBtn"
        class="btn btn-primary btn-custom">

            Update Product

        </button>

    </form>

</div>

<script>

document.getElementById("imginput").onchange = function(){

    document.getElementById("imgpreview").src =
    URL.createObjectURL(this.files[0]);

};

</script>

</body>
</html>