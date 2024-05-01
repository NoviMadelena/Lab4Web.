<?php
include("koneksi.php");
// query untuk menampilkan data 
$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>
<?php require('header.php'); ?>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<div class="container">
    <h1>Data Barang</h1>
    <div class="main">
        <table>
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php if ($result && mysqli_num_rows($result) > 0) : ?>
                <?php while ($row = mysqli_fetch_array($result)) : ?>
                    <tr>
                        <td><img src="<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>" style="max-width: 100px; max-height: 100px;"></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['kategori']; ?></td>
                        <td><?= $row['harga_jual']; ?></td>
                        <td><?= $row['harga_beli']; ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $row['id_barang']; ?>">Ubah</a> |
                            <a href="hapus.php?id=<?= $row['id_barang']; ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">Belum ada data</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>
<?php require('footer.php'); ?>