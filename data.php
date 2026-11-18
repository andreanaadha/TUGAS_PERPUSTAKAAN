<?php
require_once "koneksi.php";

$no_anggota = isset($_POST['no_anggota']) ? trim($_POST['no_anggota']) : '';
$nama_lengkap = isset($_POST['nama_lengkap']) ? trim($_POST['nama_lengkap']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$no_hp = isset($_POST['no_hp']) ? trim($_POST['no_hp']) : '';
$jenis_anggota = isset($_POST['jenis_anggota']) ? trim($_POST['jenis_anggota']) : '';
$alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';

$sql = "SELECT * FROM anggota ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $sql);
$jumlah = mysqli_num_rows($hasil);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>No Anggota</th><th>Nama Lengkap</th><th>Email</th><th>Nomor Hp</th>
            <th>Jenis Anggota</th><th>Alamat</th><th>Aksi</th>
        </tr>
        <?php $no = 1; while ($baris = mysqli_fetch_assoc($hasil)) { ?>
        <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($baris['no_anggota']); ?></td>
                <td><?php echo htmlspecialchars($baris['nama_lengkap']); ?></td>
                <td><?php echo htmlspecialchars($baris['email']); ?></td>
                <td><?php echo htmlspecialchars($baris['no_hp']); ?></td>
                <td><?php echo htmlspecialchars($baris['jenis_anggota']); ?></td>
                <td><?php echo htmlspecialchars($baris['alamat']); ?></td>
                <td>
                    <a href="detail.php?id=<?php echo (int) $baris['id']; ?>">Detail</a>
                    <form class="inline" action="hapus.php" method="post"
                    onsubmit="return confirm('YAKIN INGIN MENGHAPUS DATA INI?');">
                    <input type="hidden" name="id" value="<?php echo (int) $baris['id']; ?>">
                    <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>