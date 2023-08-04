<?php
include 'koneksi.php';

// Pastikan form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $jurusan = $_POST['jurusan'];
    $prodi = $_POST['prodi'];

    // Query untuk melakukan update data mahasiswa
    $query = "UPDATE mahasiswa SET nama='$nama', jeniskelamin='$jeniskelamin', jurusan='$jurusan', prodi='$prodi' WHERE id=$id";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah proses update berhasil
    if ($result) {
        // Jika berhasil, arahkan kembali ke halaman index.php
        header("Location: index.php");
        exit; // Penting untuk menghentikan eksekusi skrip setelah mengarahkan halaman
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    // Tutup koneksi
    mysqli_close($koneksi);
}

// Ambil data mahasiswa yang akan di-edit berdasarkan id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data mahasiswa berdasarkan id
    $query = "SELECT * FROM mahasiswa WHERE id=$id";
    $result = mysqli_query($koneksi, $query);

    // Pastikan data mahasiswa dengan id tersebut ada
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['nama'];
        $jeniskelamin = $row['jeniskelamin'];
        $jurusan = $row['jurusan'];
        $prodi = $row['prodi'];
    } else {
        echo "Data Mahasiswa tidak ditemukan.";
        exit;
    }

    // Bebaskan memori dari result set
    mysqli_free_result($result);
} else {
    echo "ID Mahasiswa tidak diberikan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Akademik - Edit Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            width: 300px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 4px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            height: 36px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit Data Mahasiswa</h1>

    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="nama">Nama Mahasiswa:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>

        <label for="jeniskelamin">Jenis Kelamin:</label>
        <select id="jeniskelamin" name="jeniskelamin" required>
            <option value="lakilaki" <?php if ($jeniskelamin === 'lakilaki') echo 'selected'; ?>>Laki-laki</option>
            <option value="perempuan" <?php if ($jeniskelamin === 'perempuan') echo 'selected'; ?>>Perempuan</option>
        </select>

        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" value="<?php echo $jurusan; ?>" required>

        <label for="prodi">Program Studi:</label>
        <input type="text" id="prodi" name="prodi" value="<?php echo $prodi; ?>" required>

        

        <input type="submit" value="Simpan Perubahan">
    </form>
</body>
</html>
