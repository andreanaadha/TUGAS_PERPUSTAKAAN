<!--
NIM : 250202035
NAMA : ANDREANA ADHA WARDANA
KELAS : TI-1B 
-->
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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Perpustakaan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f8;
            margin: 0;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        th {
            background-color: #3498db;
            color: white;
            padding: 12px;
            text-align: center;
        }

        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #eaf4fc;
        }

        a {
            text-decoration: none;
            background-color: #2ecc71;
            color: white;
            padding: 7px 12px;
            border-radius: 4px;
        }

        a:hover {
            background-color: #27ae60;
        }

        button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 7px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c0392b;
        }

        .inline {
            display: inline;
        }

        .container {
            overflow-x: auto;
        }
    </style>
</head>

<body>

    <h2>Data Anggota Perpustakaan</h2>
    <a href="form_anggota.php" METHOD="POST">Tambah Anggota</a>

    <div class="container">
        <table>
            <tr>
                <th>No</th>
                <th>No Anggota</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor HP</th>
                <th>Jenis Anggota</th>
                <th>Alamat</th>
                <th>Aksi</th>
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
                    <a href="edit.php?id=<?php echo (int) $baris['id']; ?>">Edit</a>

                    <form class="inline" action="hapus.php" method="post"
                    onsubmit="return confirm('YAKIN INGIN MENGHAPUS DATA INI?');">

                        <input type="hidden" name="id"
                        value="<?php echo (int) $baris['id']; ?>">

                        <button type="submit">Hapus</button>

                    </form>
                </td>
            </tr>
            <?php } ?>

        </table>
    </div>

</body>
</html>
