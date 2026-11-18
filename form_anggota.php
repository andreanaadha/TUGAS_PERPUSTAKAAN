<!--
NIM : 250202035
NAMA : ANDREANA ADHA WARDANA
KELAS : TI-1B 
-->
<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$pesan = $_SESSION['pesan'] ?? '';

unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['pesan']);

function e($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Anggota</title>
</head>
<body>

<h2>Pendaftaran Anggota Perpustakaan Kampus</h2>

<?php if ($pesan != ''): ?>
    <p style="color: green;">
        <?php echo e($pesan); ?>
    </p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div style="color: red;">
        <b>Terjadi kesalahan:</b>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="proses_anggota.php" method="POST">

    <p>
        Nomor Anggota:<br>
        <input type="text" name="no_anggota"
        maxlength="15" required
        value="<?php echo e($old['no_anggota'] ?? ''); ?>">
    </p>

    <p>
        Nama Lengkap:<br>
        <input type="text" name="nama_lengkap"
        maxlength="100" required
        value="<?php echo e($old['nama_lengkap'] ?? ''); ?>">
    </p>

    <p>
        Email:<br>
        <input type="text" name="email"
        maxlength="100" required
        value="<?php echo e($old['email'] ?? ''); ?>">
    </p>

    <p>
        Nomor HP:<br>
        <input type="text" name="no_hp"
        maxlength="13" required
        value="<?php echo e($old['no_hp'] ?? ''); ?>">
    </p>

    <p>
        Jenis Anggota:<br>
        <select name="jenis_anggota" required>
            <option value="">-- Pilih Jenis Anggota --</option>

            <option value="Mahasiswa"
            <?php if (($old['jenis_anggota'] ?? '') == 'Mahasiswa') echo 'selected'; ?>>
                Mahasiswa
            </option>

            <option value="Dosen"
            <?php if (($old['jenis_anggota'] ?? '') == 'Dosen') echo 'selected'; ?>>
                Dosen
            </option>

            <option value="Tenaga Kependidikan"
            <?php if (($old['jenis_anggota'] ?? '') == 'Tenaga Kependidikan') echo 'selected'; ?>>
                Tenaga Kependidikan
            </option>
        </select>
    </p>

    <p>
        Alamat:<br>
        <textarea name="alamat" required><?php
        echo e($old['alamat'] ?? '');
        ?></textarea>
    </p>

    <button type="submit">Daftar</button>
</form>

</body>
</html>
