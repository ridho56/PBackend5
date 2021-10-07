<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil Data yang Dikirim dari Form
$nama = $_POST['nama'];
$merek = $_POST['merek'];
$tipe = $_POST['tipe'];
$harga_br = $_POST['harga'];
$stock_br = $_POST['stock'];
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];
// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = date('dmYHis') . $foto;
// Set path folder tempat menyimpan fotonya
$path = "Pictures/" . $fotobaru;
// Proses upload
if (move_uploaded_file($tmp, $path)) { // Cek apakah gambar berhasil diupload atau tidak
    // Proses simpan ke Database
    $sql = $pdo->prepare("INSERT INTO produk(nama, merek, tipe, harga_br, stock_br,gambar_produk ) VALUES(:nama,:merek,:tipe,:harga_br,:stock_br,:gambar_produk)");
    $sql->bindParam(':nama', $nama);
    $sql->bindParam(':merek', $merek);
    $sql->bindParam(':tipe', $tipe);
    $sql->bindParam(':harga_br', $harga_br);
    $sql->bindParam(':stock_br', $stock_br);
    $sql->bindParam(':gambar_produk', $fotobaru);
    $sql->execute(); // Eksekusi query insert
    if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        echo "<script>alert('Data berhasil ditambahkan.');window.location='index.php';</script>"; // Redirect ke halaman index.php
    } else {
        // Jika Gagal, Lakukan :
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
    }
} else {
    // Jika gambar gagal diupload, Lakukan :
    echo "Maaf, Gambar gagal untuk diupload.";
    echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
}
