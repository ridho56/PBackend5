<html>

<head>
    <title>Data Record</title>
</head>

<body>
    <h1>Tambah Data Barang RR STORE</h1>
    <form method="post" action="proses_simpan.php" enctype="multipart/form-data">
        <table cellpadding="8">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Merek</td>
                <td><input type="text" name="merek"></td>
            </tr>
            <tr>
                <td>Tipe</td>
                <td><input type="text" name="tipe"></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="number" name="harga"></td>
            </tr>
            <tr>
                <td>Stock</td>
                <td><input type="number" name="stock"></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td><input type="file" name="foto"></td>
            </tr>
        </table>

        <hr>
        <input type="submit" value="Simpan">
        <a href="index.php"><input type="button" value="Batal"></a>
    </form>
</body>

</html>