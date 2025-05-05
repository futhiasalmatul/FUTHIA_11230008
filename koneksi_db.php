<?php
//konfigurasi
$server = "localhost";
$db = "web_lanjut";
$user = "root";
$pass = "";
//membuat koneksi
$conn = mysqli_connect($server, $user, $pass, $db);
//Check koneksi
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}
//echo "Connected successfully";
//mysqli_close($conn);
?>