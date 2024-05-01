<?php
error_reporting(E_ALL);
include_once 'koneksi.php';
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
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
    $sql = 'UPDATE data_barang SET ';
    $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
    $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}',  stok = '{$stok}' ";
    if (!empty($gambar))
        $sql .= ", gambar = '{$gambar}' ";
    $sql .= "WHERE id_barang = '{$id}'";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}
$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
if (!$result) die('Error: Data tidak tersedia');
$data = mysqli_fetch_array($result);
function is_select($var, $val)
{
    if ($var == $val) return 'selected="selected"';
    return false;
}
?>
<?php require('header.php'); ?>
<div class="container">
    <h1>Ubah Barang</h1>
    <div class="main">
        <form method="post" action="ubah.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="nama">Nama Barang:</label></td>
                    <td><input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="kategori">Kategori:</label></td>
                    <td>
                        <select id="kategori" name="kategori">
                            <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Komputer">Komputer</option>
                            <option <?php echo is_select('Elektronik', $data['kategori']); ?> value="Elektronik">Elektronik</option>
                            <option <?php echo is_select('Hand Phone', $data['kategori']); ?> value="Hand Phone">Hand Phone</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="harga_jual">Harga Jual:</label></td>
                    <td><input type="text" id="harga_jual" name="harga_jual" value="<?php echo $data['harga_jual']; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="harga_beli">Harga Beli:</label></td>
                    <td><input type="text" id="harga_beli" name="harga_beli" value="<?php echo $data['harga_beli']; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="stok">Stok:</label></td>
                    <td><input type="text" id="stok" name="stok" value="<?php echo $data['stok']; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="file_gambar">File Gambar:</label></td>
                    <td><input type="file" id="file_gambar" name="file_gambar" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $data['id_barang']; ?>" />
                        <input type="submit" name="submit" value="Simpan" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php require('footer.php'); ?>