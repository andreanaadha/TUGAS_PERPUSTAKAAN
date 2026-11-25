<!--
NIM : 250202035
NAMA : ANDREANA ADHA WARDANA
KELAS : TI-1B 
-->
<?php
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header ("Location: form_anggota.php");
    exit;
    }

$id= $_POST["id"];

$sql= "DELETE FROM anggota WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);
$stmt->bind_param("i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header ("Location: data.php");
    exit;
}else{
    die("Gagal menghapus data: " . mysqli_stmt_error($error));
}

?>