<?php
include "koneksi_db.php";

$id = $_GET['id'];
$query = "SELECT * FROM Products WHERE productID = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama = $_POST['product_name'];
    $supplierID = $_POST['supplierID'];
    $categoryID = $_POST['categoryID'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];

    $updateQuery = "UPDATE Products SET 
        product_name = '$nama', 
        supplierID = '$supplierID', 
        categoryID = '$categoryID', 
        unit = '$unit', 
        price = '$price' 
        WHERE productID = '$id'";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Update gagal: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f0ff;
            padding: 30px;
            color: #4b0082;
        }

        h2 {
            text-align: center;
            color: #800080;
        }

        form {
            background-color: #f3e5ff;
            max-width: 450px;
            margin: auto;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(155, 89, 182, 0.2);
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #c28fff;
            border-radius: 6px;
            background-color: #fff;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #b266ff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #9933ff;
        }
    </style>
</head>
<body>

<h2>Edit Data Produk</h2>

<form method="post">
    <label for="product_name">Nama Produk:</label>
    <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($data['product_name']) ?>">

    <label for="supplierID">ID Supplier:</label>
    <input type="text" id="supplierID" name="supplierID" value="<?= htmlspecialchars($data['supplierID']) ?>">

    <label for="categoryID">ID Kategori:</label>
    <input type="text" id="categoryID" name="categoryID" value="<?= htmlspecialchars($data['categoryID']) ?>">

    <label for="unit">Unit:</label>
    <input type="text" id="unit" name="unit" value="<?= htmlspecialchars($data['unit']) ?>">

    <label for="price">Harga:</label>
    <input type="text" id="price" name="price" value="<?= htmlspecialchars($data['price']) ?>">

    <input type="submit" name="update" value="Update">
</form>

</body>
</html>
