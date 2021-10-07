<html>

<head>
    <title>DATA RECORD</title>
</head>

<body>
    <h1>Data Produk RR STORE<i class="fas fa-store    "></i></h1>
    <a href="form_simpan.php">Tambah Data</a><br><br>
    <table border="1" width="100%">
        <tr>
            <th>Nama</th>
            <th>Merek</th>
            <th>Tipe</th>
            <th>Harga</th>
            <th>Stock</th>
            <th>Foto</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        // Load file koneksi.php
        include "koneksi.php";
        // Buat query untuk menampilkan semua data Produk
        $sql = $pdo->prepare("SELECT * FROM produk");
        $sql->execute(); // Eksekusi querynya
        while ($data = $sql->fetch()) { // Ambil semua data dari hasil eksekusi $sql
            echo "<tr>";
            echo "<td>" . $data['nama'] . "</td>";
            echo "<td>" . $data['merek'] . "</td>";
            echo "<td>" . $data['tipe'] . "</td>";
            echo "<td> Rp. " . $data['harga_br'] . "</td>";
            echo "<td>" . $data['stock_br'] . "</td>";
            echo "<td><img src='Pictures/" . $data['gambar_produk'] . "' width='100' height='100'></td>";
            echo "<td><a href='form_ubah.php?id=" . $data['id'] . "'>Ubah</a></td>";
            echo "<td><a href='proses_hapus.php?id=" . $data['id'] . "'>Hapus</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>