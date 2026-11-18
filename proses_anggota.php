<!--
NIM : 250202035
NAMA : ANDREANA ADHA WARDANA
KELAS : TI-1B 
-->
<?php
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form_anggota.php");
    exit;
}

$no_anggota = isset($_POST['no_anggota']) ? trim($_POST['no_anggota']) : '';
$nama_lengkap = isset($_POST['nama_lengkap']) ? trim($_POST['nama_lengkap']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$no_hp = isset($_POST['no_hp']) ? trim($_POST['no_hp']) : '';
$jenis_anggota = isset($_POST['jenis_anggota']) ? trim($_POST['jenis_anggota']) : '';
$alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';


$errors = [];
if (empty($no_anggota)) {
    $errors[] = "Nomor anggota wajib diisi.";
} elseif (!ctype_digit($no_anggota)) {
    $errors[] = "Nomor anggota hanya boleh berisi angka.";
} elseif (strlen($no_anggota) > 15) {
    $errors[] = "Nomor anggota maksimal 15 digit.";
}


if (empty($nama_lengkap)) {
    $errors[] = "Nama lengkap tidak boleh kosong.";
} elseif (strlen($nama_lengkap) > 100) {
    $errors[] = "Nama lengkap maksimal 100 karakter.";
}

if (empty($email)) {
    $errors[] = "Email tidak boleh kosong.";
} elseif (strlen($email) > 100) {
    $errors[] = "Email maksimal 100 karakter.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format email tidak valid.";
}

// Validasi nomor HP
if (empty($no_hp)) {
    $errors[] = "Nomor HP tidak boleh kosong.";
} elseif (!ctype_digit($no_hp)) {
    $errors[] = "Nomor HP hanya boleh berisi angka.";
} elseif (strlen($no_hp) < 10 || strlen($no_hp) > 13) {
    $errors[] = "Nomor HP harus 10 sampai 13 digit.";
}


$pilihan = ["Mahasiswa", "Dosen", "Tenaga Kependidikan"];

if (empty($jenis_anggota)) {
    $errors[] = "Jenis anggota wajib dipilih.";
} elseif (!in_array($jenis_anggota, $pilihan, true)) {
    $errors[] = "Jenis anggota tidak valid.";
}


if (empty($alamat)) {
    $errors[] = "Alamat tidak boleh kosong.";
}

if (!empty($errors)) {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Hasil Penyimpanan Data</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 30px;
                color: #333;
            }

            h2 {
                color: #304d78;
            }

            .error {
                background-color: #fde9e7;
                border-left: 4px solid red;
                padding: 12px;
                margin-bottom: 15px;
            }

            a {
                color: blue;
            }
        </style>
    </head>
    <body>

        <h2>Data Tidak Valid</h2>

        <div class="error">
            Data belum dapat disimpan. Perbaiki kesalahan:
        </div>

        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>

        <a href="form_anggota.php">Kembali dan perbaiki data</a>

    </body>
    </html>
    <?php
    exit;
}


$sql = "INSERT INTO anggota
(no_anggota, nama_lengkap, email, no_hp, jenis_anggota, alamat)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);

if (!$stmt) {
    die("Gagal menyiapkan query: " . htmlspecialchars(mysqli_error($koneksi)));
}


mysqli_stmt_bind_param(
    $stmt,
    "ssssss",
    $no_anggota,
    $nama_lengkap,
    $email,
    $no_hp,
    $jenis_anggota,
    $alamat
);


if (mysqli_stmt_execute($stmt)) {
    $pesan = "Pendaftaran anggota berhasil disimpan!";
} else {
    $pesan = "Data gagal disimpan: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Penyimpanan Data</title>
</head>
<body>

    <h2>Hasil Penyimpanan Data</h2>

    <p>
        <?php echo htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8'); ?>
    </p>

    <a href="form_anggota.php">Kembali ke Formulir</a>

</body>
</html>
