<?php
include "koneksi_db.php";

$id = $_GET['id'];

// Coba hapus data
$query = "DELETE FROM Products WHERE productID = '$id'";
if (mysqli_query($conn, $query)) {
    // Jika berhasil, kembali ke halaman utama
    header("Location: index.php");
    exit;
} else {
    // Cek apakah error disebabkan oleh constraint foreign key
    if (mysqli_errno($conn) == 1451) {
        // 1451 = Cannot delete or update a parent row: a foreign key constraint fails
        echo "<script>
                alert('Produk tidak bisa dihapus karena masih digunakan dalam transaksi!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
}
?>
