<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil data yang dikirim oleh index.php melalui URL
$id = $_GET['id'];
// Query untuk menampilkan data produk berdasarkan ID yang dikirim
$sql = $pdo->prepare("SELECT gambar_produk FROM produk WHERE id=:id");
$sql->bindParam(':id', $id);
$sql->execute(); // Eksekusi query insert
$data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
// Cek apakah file gambar_produknya ada di folder Pictures
if (is_file("Pictures/" . $data['gambar_produk'])) // Jika gambar_produk ada
    unlink("Pictures/" . $data['gambar_produk']); // Hapus gambar_produk yang telah diupload dari folder Pictures
// Query untuk menghapus data produk berdasarkan ID yang dikirim
$sql = $pdo->prepare("DELETE FROM produk WHERE id=:id");
$sql->bindParam(':id', $id);
$execute = $sql->execute(); // Eksekusi / Jalankan query
if ($execute) { // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    echo "<script>alert('Data berhasil dihapus.');window.location='index.php';</script>"; // Redirect ke halaman index.php
} else {
    // Jika Gagal, Lakukan :
    echo "Data gagal dihapus. <a href='index.php'>Kembali</a>";
}
