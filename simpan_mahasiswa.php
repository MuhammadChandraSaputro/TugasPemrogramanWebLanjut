<?php
include 'koneksi.php';

// Pastikan form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $jurusan = $_POST['jurusan'];
    $prodi = $_POST['prodi'];

    // Query untuk menyimpan data mahasiswa ke database
    $query = "INSERT INTO mahasiswa (nama, jeniskelamin, jurusan, prodi) VALUES ('$nama', '$jeniskelamin', '$jurusan', '$prodi' )";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah penyimpanan data berhasil
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
?>
