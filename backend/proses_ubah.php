<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil data ID yang dikirim oleh form_ubah.php melalui URL
$id = $_GET['id'];
// Ambil Data yang Dikirim dari Form
$nama = $_POST['nama'];
$merek = $_POST['merek'];
$tipe = $_POST['tipe'];
$harga_br = $_POST['harga_br'];
$stock = $_POST['stock_br'];
// Ambil data foto yang dipilih dari form
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];
// Cek apakah user ingin mengubah fotonya atau tidak
if (empty($foto)) { // Jika user tidak memilih file foto pada form
    // Lakukan proses update tanpa mengubah fotonya
    // Proses ubah data ke Database
    $sql = $pdo->prepare("UPDATE produk SET nama=:nama, merek=:merek, tipe=:tipe, harga_br=:harga_br, stock_br=:stock_br WHERE id=:id");
    $sql->bindParam(':nama', $nama);
    $sql->bindParam(':merek', $merek);
    $sql->bindParam(':tipe', $tipe);
    $sql->bindParam(':harga_br', $harga_br);
    $sql->bindParam(':stock_br', $stock);
    $sql->bindParam(':id', $id);
    $execute = $sql->execute(); // Eksekusi / Jalankan query
    if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        header("location: index.php"); // Redirect ke halaman index.php
    } else {
        // Jika Gagal, Lakukan :
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
    }
} else { // Jika user memilih foto / mengisi input file foto pada form
    // Lakukan proses update termasuk mengganti foto sebelumnya
    // Rename nama fotonya dengan menambahkan tanggal dan jam upload
    $fotobaru = date('dmYHis') . $foto;
    // Set path folder tempat menyimpan fotonya
    $path = "Pictures/" . $fotobaru;
    // Proses upload
    if (move_uploaded_file($tmp, $path)) { // Cek apakah gambar berhasil diupload atau tidak
        // Query untuk menampilkan data produk berdasarkan ID yang dikirim
        $sql = $pdo->prepare("SELECT gambar_produk FROM produk WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute(); // Eksekusi query insert
        $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
        // Cek apakah file foto sebelumnya ada di folder images
        if (is_file("Pictures/" . $data['gambar_produk'])) // Jika gambar_produk ada
            unlink("Pictures/" . $data['gambar_produk']); // Hapus file foto sebelumnya yang ada di folder images
        // Proses ubah data ke Database
        $sql = $pdo->prepare("UPDATE produk SET nama=:nama, merek=:merek, tipe=:tipe, harga_br=:harga_br, stock_br=:stock_br, gambar_produk=:gambar_produk WHERE id=:id");
        $sql->bindParam(':nama', $nama);
        $sql->bindParam(':merek', $merek);
        $sql->bindParam(':tipe', $tipe);
        $sql->bindParam(':harga_br', $harga_br);
        $sql->bindParam(':stock_br', $stock);
        $sql->bindParam(':gambar_produk', $fotobaru);
        $sql->bindParam(':id', $id);
        $execute = $sql->execute(); // Eksekusi / Jalankan query
        if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
            // Jika Sukses, Lakukan :
            echo "<script>alert('Data berhasil diubah.'); window.location='index.php';</script>"; // Redirect ke halaman index.php
        } else {
            // Jika Gagal, Lakukan :
            echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
            echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
        }
    } else {
        // Jika gambar gagal diupload, Lakukan :
        echo "Maaf, Gambar gagal untuk diupload.";
        echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
    }
}
