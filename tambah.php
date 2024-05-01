<?php
error_reporting(E_ALL);
include_once 'koneksi.php';
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;
    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;;
        }
    }
    $sql = 'INSERT INTO data_barang (nama, kategori,harga_jual, harga_beli,  stok, gambar) ';
    $sql .= "VALUE ('{$nama}', '{$kategori}','{$harga_jual}',  '{$harga_beli}', '{$stok}', '{$gambar}')";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}
?>
<?php require('header.php'); ?>
<div class="container">
    <h1>Tambah Barang</h1>
    <div class="main">
        <form method="post" action="tambah.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="nama">Nama Barang:</label></td>
                    <td><input type="text" id="nama" name="nama" /></td>
                </tr>
                <tr>
                    <td><label for="kategori">Kategori:</label></td>
                    <td>
                        <select id="kategori" name="kategori">
                            <option value="Komputer">Komputer</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Hand Phone">Hand Phone</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="harga_jual">Harga Jual:</label></td>
                    <td><input type="text" id="harga_jual" name="harga_jual" /></td>
                </tr>
                <tr>
                    <td><label for="harga_beli">Harga Beli:</label></td>
                    <td><input type="text" id="harga_beli" name="harga_beli" /></td>
                </tr>
                <tr>
                    <td><label for="stok">Stok:</label></td>
                    <td><input type="text" id="stok" name="stok" /></td>
                </tr>
                <tr>
                    <td><label for="file_gambar">File Gambar:</label></td>
                    <td><input type="file" id="file_gambar" name="file_gambar" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Simpan" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php require('footer.php'); ?>