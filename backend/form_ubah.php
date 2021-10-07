<html>

<head>
    <title>Data Record</title>
</head>

<body>
    <h1>Ubah Data barang</h1>
    <?php
    // Load file koneksi.php
    include "koneksi.php";
    // Ambil data NIS yang dikirim oleh index.php melalui URL
    $id = $_GET['id'];
    // Query untuk menampilkan data siswa berdasarkan ID yang dikirim
    $sql = $pdo->prepare("SELECT * FROM produk WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->execute(); // Eksekusi query insert
    $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
    ?>
    <form method="post" action="proses_ubah.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <table cellpadding="8">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>"></td>
            </tr>
            <tr>
                <td>Merek</td>
                <td><input type="text" name="merek" value="<?php echo $data['merek']; ?>"></td>
            </tr>
            <tr>
                <td>Tipe</td>

                <td><input type="text" name="tipe" value="<?php echo $data['tipe']; ?>"></td>

            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="text" name="harga_br" value="<?php echo $data['harga_br']; ?>"></td>
            </tr>
            <tr>
                <td>Stock</td>
                <td><textarea name="stock_br"><?php echo $data['stock_br']; ?></textarea></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td>
                    <input type="file" name="foto">
                </td>
            </tr>
        </table>
        <hr>
        <input type="submit" value="Ubah">
        <a href="index.php"><input type="button" value="Batal"></a>
    </form>
</body>

</html>