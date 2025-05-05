<html>
<head>
    <title>DATA PRODUK</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f0; /* pink muda */
            color: #cc0066; /* teks utama */
            padding: 20px;
        }

        h2 {
            color: #e60073; /* judul */
            text-align: center;
        }

        form {
            margin-bottom: 20px;
            background-color: #ffd6e8; /* form background */
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ffb3cc;
        }

        select, input[type="text"], input[type="submit"] {
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ff66a3; /* border pink */
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #ff66a3; /* tombol */
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ff3385; /* hover tombol */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff0f5; /* latar tabel */
        }

        th {
            background-color: #ff80bf; /* header tabel */
            color: white;
            padding: 10px;
        }

        td {
            padding: 8px;
            border: 1px solid #ffb3d9; /* border tabel */
        }

        tr:nth-child(even) {
            background-color: #ffe6f0; /* baris genap */
        }

        a img {
            margin: 0 5px;
        }
    </style>
    <script>
        function submitForm() {
            document.getElementById("searchForm").submit();
        }
    </script>
</head>
<body>

<?php
include "koneksi_db.php";

$searchBy = $_POST['searchBy'] ?? '';
$searchQuery = $_POST['searchQuery'] ?? '';

$query = "SELECT Products.productID, Products.product_name, Suppliers.supplier_name, Categories.category_name, Products.unit, Products.price 
          FROM Products 
          JOIN Suppliers ON Products.supplierID = Suppliers.supplierID 
          JOIN Categories ON Products.categoryID = Categories.categoryID";

if (!empty($searchBy) && !empty($searchQuery)) {
    $query .= " WHERE $searchBy LIKE '%$searchQuery%'";
}

$result = mysqli_query($conn, $query);
?>

<h2>DATA PRODUK</h2>

<form method="post" id="searchForm">
    Cari Berdasarkan :
    <select name="searchBy" onchange="submitForm()">
        <option value="">-- Pilih --</option>
        <option value="Products.productID" <?= $searchBy == 'Products.productID' ? 'selected' : '' ?>>ID Produk</option>
        <option value="Products.product_name" <?= $searchBy == 'Products.product_name' ? 'selected' : '' ?>>Nama Produk</option>
        <option value="Suppliers.supplier_name" <?= $searchBy == 'Suppliers.supplier_name' ? 'selected' : '' ?>>Nama Supplier</option>
        <option value="Categories.category_name" <?= $searchBy == 'Categories.category_name' ? 'selected' : '' ?>>Kategori</option>
        <option value="Products.price" <?= $searchBy == 'Products.price' ? 'selected' : '' ?>>Harga</option>
    </select>
    <input type="text" name="searchQuery" value="<?= htmlspecialchars($searchQuery) ?>" placeholder="Masukkan kata kunci">
    <input type="submit" value="Cari">
</form>

<table>
    <tr align="center">
        <th>No</th>
        <th>ID Produk</th>
        <th>Nama Produk</th>
        <th>Nama Supplier</th>
        <th>Kategori</th>
        <th>Unit</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $no++;
        echo "<tr>
                <td align='center'>{$no}</td>
                <td align='center'>{$row['productID']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['supplier_name']}</td>
                <td>{$row['category_name']}</td>
                <td>{$row['unit']}</td>
                <td align='right'>\$".number_format($row['price'], 2)."</td>
                <td align='center'>
                    <a href='edit.php?id={$row['productID']}'><img src='images/edit.png' alt='Edit' width='20'></a>
                    <a href='hapus.php?id={$row['productID']}' onclick=\"return confirm('Yakin ingin menghapus produk ini?');\"><img src='images/delete.png' alt='Hapus' width='20'></a>
                </td>
              </tr>";
    }
    ?>
</table>

</body>
</html>
