<!DOCTYPE html>
<html><head>
  <title>Document</title>
  <link rel="stylesheet" href="<?= base_url('vendor/css/sb-admin-2.min.css'); ?>">
</head><body>

  <h4>Data Buku</h4>
  <table class="table table-bordered">
    <tr>
      <th>Nomor</th>
      <th>Judul</th>
      <th>Penulis</th>
      <th>Edisi</th>
      <th>Penerbit</th>
      <th>Tahun Terbit</th>
      <th>Kelas</th>
      <th>Stok</th>
      <th>Tahun Anggaran</th>
    </tr>
    <?php $no = 1; foreach($list_katalog as $item) { ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= $item->buku_judul; ?></td>
      <td><?= $item->buku_penulis; ?></td>
      <td><?= $item->buku_edisi; ?></td>
      <td><?= $item->buku_penerbit; ?></td>
      <td><?= $item->buku_tahunTerbit; ?></td>
      <td><?= $item->buku_noSKU; ?></td>
      <td><?= $item->buku_stok; ?></td>
      <td><?= $item->buku_tahunAnggaran; ?></td>
    </tr>
    <?php } ?>
  </table>

</body></html>